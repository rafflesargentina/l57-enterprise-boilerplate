<?php

namespace Raffles\Http;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

/**
 * Stream - Handle raw input stream
 *
 * LICENSE: This source file is subject to version 3.01 of the GPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.html. If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 *
 * @author  jason.gerfen@gmail.com
 * @license http://www.gnu.org/licenses/gpl.html GPL License 3
 *
 * Massive modifications by TGE (dev@mycloudfulfillment.com) to support
 * proper parameter name processing and Laravel compatible UploadedFile
 * support. Class name changed to be more descriptive and less likely to
 * collide.
 *
 * Original Gist at:
 *   https://gist.github.com/jas-/5c3fdc26fedd11cb9fb5#file-class-stream-php
 */
class ParseInputStream
{
    /**
     * @abstract Raw input stream
     */
    protected $input;

    /**
     * @function __construct
     *
     * @param array $data stream
     */
    public function __construct(array &$data)
    {
        $this->input = file_get_contents('php://input');
        $boundary = $this->_boundary();

        if (!strlen($boundary)) {
            $data = [
                'parameters' => $this->_parse(),
                'files' => []
            ];
        } else {
            $blocks = $this->_split($boundary);
            $data = $this->_blocks($blocks);
        }

        return $data;
    }

    /**
     * @function _boundary
     *
     * @return string
     */
    private function _boundary()
    {
        if (!isset($_SERVER['CONTENT_TYPE'])) {
            return null;
        }

        preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);

        return $matches[1];
    }

    /**
     * @function _parse
     *
     * @return array
     */
    private function _parse()
    {
        parse_str(urldecode($this->input), $result);
        return $result;
    }

    /**
     * @function _split
     *
     * @param  $boundary string
     * @return array
     */
    private function _split($boundary)
    {
        $result = preg_split("/-+$boundary/", $this->input);
        array_pop($result);
        return $result;
    }

    /**
     * @function _blocks
     *
     * @param  $array array
     * @return array
     */
    private function _blocks($array)
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (empty($value)) {
                continue;
            }

            $block = $this->_decide($value);
            foreach ($block['parameters'] as $key => $val) {
                $this->parseParameter($results, $key, $val);
            }

            foreach ( $block['files'] as $key => $val ) {
                $this->parseParameter($results, $key, $val);
            }
        }

        return $results;
    }

    /**
     * @function _decide
     *
     * @param  $string string
     * @return array
     */
    private function _decide($string)
    {
        if (strpos($string, 'application/octet-stream') !== false) {
            return [
                'parameters' => $this->_file($string),
                'files' => []
            ];
        }

        if (strpos($string, 'filename') !== false) {
            return [
                'parameters' => [],
                'files' => $this->_fileStream($string)
            ];
        }

        return [
            'parameters' => $this->_parameter($string),
            'files' => []
        ];
    }

    /**
     * @function _file
     *
     * @param  $string
     * @return array
     */
    private function _file($string)
    {
        preg_match('/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s', $string, $match);
        return [
            $match[1] => ($match[2] !== null ? $match[2] : '')
        ];
    }

    /**
     * @function _fileStream
     *
     * @param  $string
     * @return array
     */
    private function _fileStream($data)
    {
        $result = [];
        $data = ltrim($data);
        $idx = strpos($data, "\r\n\r\n");

        if ($idx === false ) {
            Log::warning("ParseInputStream.file_stream(): Could not locate header separator in data:");
            Log::warning($data);
        } else {
            $headers = substr($data, 0, $idx);
            $content = substr($data, $idx + 4, -2); // Skip the leading \r\n and strip the final \r\n
            $name = '-unknown-';
            $filename = '-unknown-';
            $filetype = 'application/octet-stream';
            $header = strtok($headers, "\r\n");

            while ( $header !== false ) {
                if (substr($header, 0, strlen("Content-Disposition: ")) == "Content-Disposition: " ) {
                    // Content-Disposition: form-data; name="attach_file[TESTING]"; filename="label2.jpg"
                    if (preg_match('/name=\"([^\"]*)\"/', $header, $nmatch) ) {
                        $name = $nmatch[1];
                    }
                    if (preg_match('/filename=\"([^\"]*)\"/', $header, $nmatch) ) {
                        $filename = $nmatch[1];
                    }
                } elseif (substr($header, 0, strlen("Content-Type: ")) == "Content-Type: " ) {
                    // Content-Type: image/jpg
                    $filetype = trim(substr($header, strlen("Content-Type: ")));
                } else {
                    Log::debug("PARSEINPUTSTREAM: Skipping Header: " . $header);
                }

                $header = strtok("\r\n");
            }

            if (substr($data, -2) === "\r\n" ) {
                $data = substr($data, 0, -2);
            }

            $path = sys_get_temp_dir() . '/php' . substr(sha1(rand()), 0, 6);
            $bytes = file_put_contents($path, $content);

            if ($bytes !== false ) {
                $file = new UploadedFile($path, $filename, $filetype, $bytes, null, true);
                $result = array( $name => $file );
            }
        }

        return $result;
    }

    /**
     * @function _parameter
     *
     * @param  $string
     * @return array
     */
    private function _parameter($string)
    {
        $data = [];
        if (preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $string, $match) ) {
            if (preg_match('/^(.*)\[\]$/i', $match[1], $tmp)) {
                $data[$tmp[1]][] = ($match[2] !== null ? $match[2] : '');
            } else {
                $data[$match[1]] = ($match[2] !== null ? $match[2] : '');
            }
        }

        return $data;
    }

    /**
     * @function _merge
     *
     * @param  $array array
     * @return array
     */
    private function _merge($array)
    {
        $results = [
            'parameters' => [],
            'files' => []
        ];

        if (count($array['parameters']) > 0) {
            foreach ($array['parameters'] as $key => $value) {
                foreach ($value as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $kk => $vv) {
                            $results['parameters'][$k][] = $vv;
                        }
                    } else {
                        $results['parameters'][$k] = $v;
                    }
                }
            }
        }

        if (count($array['files']) > 0) {
            foreach ($array['files'] as $key => $value) {
                foreach ($value as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $kk => $vv) {
                            if (is_array($vv) && (count($vv) === 1)) {
                                $results['files'][$k][$kk] = $vv[0];
                            } else {
                                $results['files'][$k][$kk][] = $vv[0];
                            }
                        }
                    } else {
                        $results['files'][$k][$key] = $v;
                    }
                }
            }
        }

        return $results;
    }

    function parseParameter(&$params, $parameter, $value)
    {
        if (strpos($parameter, '[') !== false ) {
            $matches = array();
            if (preg_match('/^([^[]*)\[([^]]*)\](.*)$/', $parameter, $match) ) {
                $name = $match[1];
                $key = $match[2];
                $rem = $match[3];
                if ($name !== '' && $name !== null ) {
                    if (! isset($params[$name]) || ! is_array($params[$name]) ) {
                        $params[$name] = array();
                    } else {
                    }
                    if (strlen($rem) > 0 ) {
                        if ($key === '' || $key === null ) {
                            $arr = array();
                            $this->parseParameter($arr, $rem, $value);
                            $params[$name][] = $arr;
                        } else {
                            if (!isset($params[$name][$key]) || !is_array($params[$name][$key]) ) {
                                $params[$name][$key] = array();
                            }
                            $this->parseParameter($params[$name][$key], $rem, $value);
                        }
                    } else {
                        if ($key === '' || $key === null ) {
                            $params[$name][] = $value;
                        } else {
                            $params[$name][$key] = $value;
                        }
                    }
                } else {
                    if (strlen($rem) > 0 ) {
                        if ($key === '' || $key === null ) {
                            // REVIEW Is this logic correct?!
                            $this->parseParameter($params, $rem, $value);
                        } else {
                            if (! isset($params[$key]) || ! is_array($params[$key]) ) {
                                $params[$key] = array();
                            }
                            $this->parseParameter($params[$key], $rem, $value);
                        }
                    } else {
                        if ($key === '' || $key === null ) {
                            $params[] = $value;
                        } else {
                            $params[$key] = $value;
                        }
                    }
                }
            } else {
                Log::warning("ParseInputStream.parseParameter() Parameter name regex failed: '" . $parameter . "'");
            }
        } else {
            $params[$parameter] = $value;
        }
    }
}
