<?php
/**
 * User: Alex Gusev <alex@flancer64.com>
 */

namespace TeqFw\Lib\Test;


class DataTest
    extends \TeqFw\Lib\Test\TestCase
{
    public function testConstruct_arrayAssoc()
    {
        $param = [
            'key1' => 'value1',
            'key2' => 'value2'
        ];
        $obj = new \TeqFw\Lib\Data($param);
        $this->assertInstanceOf(\stdClass::class, $obj);
    }

    public function testConstruct_arraySimple()
    {
        $param = ['value1', 'value2'];
        $obj = new \TeqFw\Lib\Data($param);
        $this->assertInstanceOf(\stdClass::class, $obj);
    }

    public function testConstruct_empty()
    {
        $obj = new \TeqFw\Lib\Data();
        $this->assertInstanceOf(\stdClass::class, $obj);
    }

    public function testConstruct_object()
    {
        $param = new \stdClass();
        $param->sub = new \stdClass();
        $param->sub->value = 'subvalue';
        $param->value = 'value';
        $obj = new \TeqFw\Lib\Data($param);
        $this->assertInstanceOf(\stdClass::class, $obj);
    }

    public function testGet_byPath()
    {
        $obj = new \TeqFw\Lib\Data();
        $obj->path = new \TeqFw\Lib\Data();
        $obj->path->to = new \TeqFw\Lib\Data();
        $obj->path->to->node = 'value';
        $value = $obj->get('/path/to/node');
        $this->assertEquals('value', $value);
    }

    public function testGet_propertyExists()
    {
        $obj = new \TeqFw\Lib\Data();
        $obj->prop = 'value';
        $value = $obj->prop;
        $this->assertEquals('value', $value);
    }

    public function testGet_propertyMissed()
    {
        $obj = new \TeqFw\Lib\Data();
        $value = $obj->prop;
        $this->assertNull($value);
    }

    public function testSet_propertyExists()
    {
        $obj = new \TeqFw\Lib\Data();
        $obj->prop = 'value';
        $value = $obj->prop;
        $this->assertEquals('value', $value);
        $obj->prop = 'value2';
        $value = $obj->prop;
        $this->assertEquals('value2', $value);
    }


}