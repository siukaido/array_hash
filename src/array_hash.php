<?php

if (!function_exists('array_hash')) {

    function array_hash($input = null, $index_key = null, $is_recusive = false)
    {
        $argc = func_num_args();
        $params = func_get_args();

        if ($argc < 2) {
            trigger_error("array_hash() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
            return null;
        }

        if (!is_array($params[0])) {
            trigger_error('array_hash() expects parameter 1 to be array, ' . gettype($params[0]) . ' given', E_USER_WARNING);
            return null;
        }
        $params_input = $params[0];

        if (!is_int($params[1])
            && !is_float($params[1])
            && !is_string($params[1])
            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
        ) {
            trigger_error('array_hash(): The index key should be either a string or an integer, ' . gettype($params[1]) .' given', E_USER_WARNING);
            return false;
        }
        if (is_float($params[1]) || is_int($params[1])) {
            $params_index_key = (int)$params[1];
        } else {
            $params_index_key = (string)$params[1];
        }

        if (isset($params[2]) && !is_bool($params[2])) {
            trigger_error('array_hash(): The recusive flag should be boolean, ' . gettype($params[2]) . ' given', E_USER_WARNING);
            return false;
        }
        $params_is_recusive = isset($params[2]) ? (boolean)$params[2] : false;

        $result = array();
        foreach ($params_input as $row) {
            if (array_key_exists($params_index_key, $row)) {
                $key = (string)$row[$params_index_key];
                if ($params_is_recusive) {
                    $result[$key][] = $row;
                } else {
                    $result[$key] = $row;
                }
            }

        }

        return $result;
    }
}
