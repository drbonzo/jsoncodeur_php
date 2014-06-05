<?php
namespace NorthslopePL\JSONCodeur;

class JSONDecoder
{
	/**
	 * @param $json
	 *
	 * @return mixed
	 *
	 * @throws JSONDecodingException
	 */
	public function decode($json)
	{
		$value = json_decode($json, false);

		if (json_last_error() != JSON_ERROR_NONE)
		{
			throw new JSONDecodingException(json_last_error());
		}

		return $value;
	}
}
