<?php
namespace NorthslopePL\JSONCodeur\Tests;

use NorthslopePL\JSONCodeur\JSONDecoder;

class JSONDecoderTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var JSONDecoder
	 */
	private $decoder;

	protected function setUp()
	{
		$this->decoder = new JSONDecoder();
	}

	/**
	 * @param mixed $value
	 * @param mixed $expected
	 * @dataProvider scalarValuesDataProvider
	 */
	public function testDecodingScalarValues($value, $expected)
	{
		$this->assertSame($expected, $this->decoder->decode($value));
	}

	public function scalarValuesDataProvider()
	{
		return array(
			array('', null),
			array(null, null),
			array(false, null),
			array(true, 1),
			array('""', ''),
			array('"foobar"', 'foobar'),
			array(42, 42),
			array('42', 42),
			array(12.95, 12.95),
			array('12.95', 12.95),
		);
	}

	public function testDecodingArrays()
	{
		$json = '["foo",1,2,3,"bar"]';
		$expected = array('foo', 1, 2, 3, 'bar');
		$this->assertEquals($expected, $this->decoder->decode($json));
	}

	public function testDecodingObjects()
	{
		$json = '{"foo":"bar","items":[1,2,3],"lorem":{"name":"ipsum"}}';


		$expected = new \stdClass();
		$expected->foo = 'bar';

		$lorem = new \stdClass();
		$lorem->name = 'ipsum';
		$expected->lorem = $lorem;

		$items = array(1, 2, 3);
		$expected->items = $items;

		$this->assertEquals($expected, $this->decoder->decode($json));
	}

	/**
	 * @dataProvider invalidJSONDataProvider
	 */
	public function testDecodingInvalidJSON($invalidJSON)
	{
		$this->setExpectedException('NorthslopePL\JSONCodeur\JSONDecodingException');
		$this->decoder->decode($invalidJSON);
	}

	public function invalidJSONDataProvider()
	{
		return array(
			array("{ 'bar': 'baz' }"),
			array('{ bar: "baz" }'),
			array('{ bar: "baz", }'),
			array('foobar'),
		);
	}
}
