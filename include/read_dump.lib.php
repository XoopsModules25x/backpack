<?php
/*
*******************************************************
***													***
*** backpack										***
*** Cedric MONTUY pour CHG-WEB                      ***
*** Original author : Yoshi Sakai					***
***													***
*******************************************************
*/
function PMA_splitSqlFile(&$ret, $sql, $release)
{
    $sql          = rtrim($sql, "\n\r");
    $sql_len      = strlen($sql);
    $char         = '';
    $string_start = '';
    $in_string    = false;
    $nothing      = true;
    $time0        = time();

    for ($i = 0; $i < $sql_len; ++$i) {
        $char = $sql[$i];

        // We are in a string, check for not escaped end of strings except for
        // backquotes that can't be escaped
        if ($in_string) {
            for (;;) {
                $i         = strpos($sql, $string_start, $i);
                // No end of string found -> add the current substring to the
                // returned array
                if (!$i) {
                    $ret[] = $sql;
                    return true;
                }
                // Backquotes or no backslashes before quotes: it's indeed the
                // end of the string -> exit the loop

                if ('`' == $string_start || '\\' != $sql[$i - 1]) {
                    $string_start      = '';
                    $in_string         = false;
                    break;
                }
                // one or more Backslashes before the presumed end of string...
                else {
                    // ... first checks for escaped backslashes
                    $j                     = 2;
                    $escaped_backslash     = false;
                    while ($i-$j > 0 && '\\' == $sql[$i - $j]) {
                        $escaped_backslash = !$escaped_backslash;
                        $j++;
                    }
                    // ... if escaped backslashes: it's really the end of the
                    // string -> exit the loop
                    if ($escaped_backslash) {
                        $string_start  = '';
                        $in_string     = false;
                        break;
                    }
                    // ... else loop

                    $i++;
                } // end if...elseif...else
            } // end for
        } // end if (in string)
       
        // lets skip comments (/*, -- and #)
        elseif (('-' == $char && $sql_len > $i + 2 && '-' == $sql[$i + 1] && $sql[$i + 2] <= ' ') || '#' == $char || ('/' == $char && $sql_len > $i + 1 && '*' == $sql[$i + 1])) {
            $i = strpos($sql, '/' == $char ? '*/' : "\n", $i);
            // didn't we hit end of string?
            if (false === $i) {
                break;
            }
            if ('/' == $char) {
                $i++;
            }
        }

        // We are not in a string, first check for delimiter...
        elseif (';' == $char) {
            // if delimiter found, add the parsed part to the returned array
            $ret[]      = ['query' => substr($sql, 0, $i), 'empty' => $nothing];
            $nothing    = true;
            $sql        = ltrim(substr($sql, min($i + 1, $sql_len)));
            $sql_len    = strlen($sql);
            if ($sql_len) {
                $i      = -1;
            } else {
                // The submited statement(s) end(s) here
                return true;
            }
        } // end else if (is delimiter)

        // ... then check for start of a string,...
        elseif (('"' == $char) || ('\'' == $char) || ('`' == $char)) {
            $in_string    = true;
            $nothing      = false;
            $string_start = $char;
        } // end else if (is start of string)

        elseif ($nothing) {
            $nothing = false;
        }

        // loic1: send a fake header each 30 sec. to bypass browser timeout
        $time1     = time();
        if ($time1 >= $time0 + 30) {
            $time0 = $time1;
            header('X-pmaPing: Pong');
        } // end if
    } // end for

    // add any rest to the returned array
    if (!empty($sql) && preg_match('@[^[:space:]]+@', $sql)) {
        $ret[] = ['query' => $sql, 'empty' => $nothing];
    }

    return true;
} // end of the 'PMA_splitSqlFile()' function


/**
 * Reads (and decompresses) a (compressed) file into a string
 *
 * @param   string   the path to the file
 * @param   string   the MIME type of the file, if empty MIME type is autodetected
 *
 * @global  array    the phpMyAdmin configuration
 *
 * @return  string   the content of the file or
 *          boolean  FALSE in case of an error.
 */
function PMA_readFile($path, $mime = '')
{
    global $cfg;

    if (!is_file($path)) {
        return false;
    }
    switch ($mime) {
        case '':
            if (!$file = fopen($path, 'rb')) {
                return false;
            }
            $test = fread($file, 3);
            fclose($file);
            if ($test[0] == chr(31) && $test[1] == chr(139)) {
                return PMA_readFile($path, 'application/x-gzip');
            }
            if ('BZh' == $test) {
                return PMA_readFile($path, 'application/x-bzip');
            }
            return PMA_readFile($path, 'text/plain');
        case 'text/plain':
            if (!$file = fopen($path, 'rb')) {
                return false;
            }
            $content = fread($file, filesize($path));
            fclose($file);
            break;
        case 'application/x-gzip':
            if ($cfg['GZipDump'] && function_exists('gzopen')) {
                if (!$file = gzopen($path, 'rb')) {
                    return false;
                }
                $content = '';
                while (!gzeof($file)) {
                    $content .= gzgetc($file);
                }
                gzclose($file);
            } else {
                return false;
            }
           break;
        case 'application/x-bzip':
            if ($cfg['BZipDump'] && function_exists('bzdecompress')) {
                if (!$file = fopen($path, 'rb')) {
                    return false;
                }
                $content = fread($file, filesize($path));
                fclose($file);
                $content = bzdecompress($content);
            } else {
                return false;
            }
           break;
        default:
           return false;
    }
    return $content;
}
