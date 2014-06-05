<?php
namespace NorthslopePL\JSONCodeur;

use NorthslopePL\Metassione\POPOConverter;

class JSONEncoder
{
	/**
	 * @param mixed $value
	 * @return string
	 */
	public function encode($value)
	{
		$popoConverter = new POPOConverter();
		$convertedValue = $popoConverter->convert($value);

		return json_encode($convertedValue);
	}
}
