<?php
namespace NorthslopePL\JSONCodeur;

class JSONDecodingException extends \Exception
{
	/**
	 * @param integer $jsonErrorCode from json_last_error()
	 */
	public function __construct($jsonErrorCode)
	{
		$errorMessages = array(
			JSON_ERROR_NONE => null,
			JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
			JSON_ERROR_STATE_MISMATCH => 'Underflow or the modes mismatch',
			JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
			JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON',
			// JSON_ERROR_UTF8             => 'Malformed UTF-8 characters, possibly incorrectly encoded' TODO: php >= 5.3.3
		);

		if (isset($errorMessages[$jsonErrorCode]))
		{
			$message = $errorMessages[$jsonErrorCode];
		}
		else
		{
			$message = 'Other error. Code: ' . $jsonErrorCode;
		}

		parent::__construct($message);
	}
}
