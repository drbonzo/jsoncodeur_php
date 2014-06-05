<?php
namespace NorthslopePL\JSONCodeur\Tests;

use NorthslopePL\JSONCodeur\JSONEncoder;
use NorthslopePL\JSONCodeur\Tests\Examples\SampleKlass;

class JSONEncoderTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var JSONEncoder
	 */
	private $encoder;

	protected function setUp()
	{
		$this->encoder = new JSONEncoder();
	}

	/**
	 * @param mixed $value
	 * @param string $expected
	 * @dataProvider scalarValuesDataProvider
	 */
	public function testEncodingScalarValues($value, $expected)
	{
		$actual = $this->encoder->encode($value);
		$this->assertSame($expected, $actual);
	}

	public function scalarValuesDataProvider()
	{
		return array(
			array(null, 'null'),
			array('', '""'),
			array('foobar', '"foobar"'),
			array(42, '42'),
			array(12.95, '12.95')
		);
	}

	public function testEncodingArrays()
	{
		$json = $this->encoder->encode(array(1, 2, 3, 'foobar'));
		$expected = '[1,2,3,"foobar"]';

		$this->assertEquals($expected, $json);
	}

	public function testEncodingObjects()
	{
		$object = new \stdClass();
		$object->foo = "bar";
		$object->items = array(1, 2, 3);

		$json = $this->encoder->encode($object);
		$expected = '{"foo":"bar","items":[1,2,3]}';

		$this->assertEquals($expected, $json);
	}

	public function testEncodingCustomClasses()
	{
		$object = new SampleKlass();
		$object->setName('foobar');
		$object->setItems(array(1, 2, 3));

		$innerObject = new SampleKlass();
		$innerObject->setName('inner');
		$object->setSampleObject($innerObject);

		$expectedJSON = '{"name":"foobar","items":[1,2,3],"sampleObject":{"name":"inner","items":[],"sampleObject":null}}';
		$actualJSON = $this->encoder->encode($object);
		$this->assertEquals($expectedJSON, $actualJSON);
	}

	public function testEncodingArraysOfCustomClasses()
	{
		$object1 = new SampleKlass();
		$object1->setName('foobar_1');
		$object2 = new SampleKlass();
		$object2->setName('foobar_2');
		$object3 = new SampleKlass();
		$object3->setName('foobar_3');

		$objects = array($object1, $object2, $object3);

		$expectedJSON = '[{"name":"foobar_1","items":[],"sampleObject":null},{"name":"foobar_2","items":[],"sampleObject":null},{"name":"foobar_3","items":[],"sampleObject":null}]';
		$actualJSON = $this->encoder->encode($objects);
		$this->assertEquals($expectedJSON, $actualJSON);
	}
}
