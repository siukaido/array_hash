<?php

if (!function_exists('array_hash')) {

	function array_hash($input = null, $indexKey = null, $recusive = false)
	{
		$argc = func_num_args();
		$params = func_get_args();

		if ($argc < 2) {
			trigger_error("array_hash() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
			return null;
		}

		if (!is_array($params[0])) {
			trigger_error('array_hash() expects parameter 1 to by array, ' . gettype($params[0]) . ' given', E_USER_WARNING);
			return null;
		}

		if (!is_int($params[1])
			&& !is_float($params[1])
			&& !is_string($params[1])
			&& !(is_object($params[1]) && method_exists($params[1], '__toString'))
		) {
			trigger_error('array_hash(): The index key should be either a string or an integer', E_USER_WARNING);
			return false;
		}

		if (isset($params[2])
			&& !is_bool($params[2])
		) {
			trigger_error('array_hash(): The recusive flag should be boolean', E_USER_WARNING);
			return false;
		}

		$paramsInput = $params[0];
		if (is_float($params[1]) || is_int($params[1])) {
			$paramsIndexKey = (int) $params[1];
		} else {
			$paramsIndexKey = (string) $params[1];
		}

		$isRecusive = isset($params[2]) ? (boolean) $params[2] : false;

		$resultArray = array();

		foreach ($paramsInput as $row) {
			if (array_key_exists($paramsIndexKey, $row)) {
				$key = (string) $row[$paramsIndexKey];
				if ($isRecusive) {
					$resultArray[$key][] = $row;
				} else {
					$resultArray[$key] = $row;
				}
			}

		}

		return $resultArray;
	}
}
