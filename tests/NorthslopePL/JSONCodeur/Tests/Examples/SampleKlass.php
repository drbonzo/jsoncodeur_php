<?php
namespace NorthslopePL\JSONCodeur\Tests\Examples;

class SampleKlass
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var array|int[]
	 */
	private $items = array();

	/**
	 * @var SampleKlass
	 */
	private $sampleObject = null;

	/**
	 * @param array|\int[] $items
	 */
	public function setItems($items)
	{
		$this->items = $items;
	}

	/**
	 * @return array|\int[]
	 */
	public function getItems()
	{
		return $this->items;
	}

	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param SampleKlass $sampleObject
	 */
	public function setSampleObject($sampleObject)
	{
		$this->sampleObject = $sampleObject;
	}

	/**
	 * @return SampleKlass
	 */
	public function getSampleObject()
	{
		return $this->sampleObject;
	}

}
