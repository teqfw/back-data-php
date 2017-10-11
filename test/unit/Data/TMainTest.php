<?php
/**
 * User: Alex Gusev <alex@flancer64.com>
 */

namespace TeqFw\Lib\Test\Data;


/**
 * Empty class to include methods to test.
 */
class Blank
{
    use \TeqFw\Lib\Data\TMain {
        explodePath as public;
        getByPath as public;
    }
}

class TMainTest
    extends \TeqFw\Lib\Test\TestCase
{
    public function testExplodePath()
    {
        $obj = new \TeqFw\Lib\Test\Data\Blank();
        $res = $obj->explodePath('/path/to/node');
        $this->assertTrue(is_array($res));
        $this->assertEquals(3, count($res));
        $this->assertEquals('path', $res[0]);
        $this->assertEquals('to', $res[1]);
        $this->assertEquals('node', $res[2]);
    }

    public function testGetByPath_longPath()
    {
        $obj = new \TeqFw\Lib\Test\Data\Blank();
        $data = new \TeqFw\Lib\Data();
        $data->path = new \TeqFw\Lib\Data();
        $data->path->to = new \TeqFw\Lib\Data();
        $data->path->to->node = 'value';
        $value = $obj->getByPath($data, ['path', 'to', 'node', 'long']);
        $this->assertNull($value);
    }

    public function testGetByPath_normal()
    {
        $obj = new \TeqFw\Lib\Test\Data\Blank();
        $data = new \TeqFw\Lib\Data();
        $data->path = new \TeqFw\Lib\Data();
        $data->path->to = new \TeqFw\Lib\Data();
        $data->path->to->node = 'value';
        $value = $obj->getByPath($data, ['path', 'to', 'node']);
        $this->assertEquals('value', $value);
    }

    public function testGetByPath_shortPath()
    {
        $obj = new \TeqFw\Lib\Test\Data\Blank();
        $data = new \TeqFw\Lib\Data();
        $data->path = new \TeqFw\Lib\Data();
        $data->path->to = new \TeqFw\Lib\Data();
        $data->path->to->node = 'value';
        $value = $obj->getByPath($data, ['path', 'to']);
        $this->assertInstanceOf(\TeqFw\Lib\Data::class, $value);
    }

    public function testSetByPath_nestedDataObject_replaceFalse()
    {
        $obj = new \TeqFw\Lib\Test\Data\Blank();
        $data = new \TeqFw\Lib\Data();
        $data->path = new \TeqFw\Lib\Data();
        $obj->setByPath($data, ['path', 'to', 'node'], 'value', false);
        $value = $obj->getByPath($data, ['path']);
        $this->assertInstanceOf(\TeqFw\Lib\Data::class, $value);
        $value = $obj->getByPath($data, ['path', 'to']);
        $this->assertNull($value);
    }

    public function testSetByPath_nestedDataObject_replaceTrue()
    {
        $obj = new \TeqFw\Lib\Test\Data\Blank();
        $data = new \TeqFw\Lib\Data();
        $data->path = new \TeqFw\Lib\Data();
        $obj->setByPath($data, ['path', 'to', 'node'], 'value', true);
        $value = $obj->getByPath($data, ['path', 'to']);
        $this->assertInstanceOf(\TeqFw\Lib\Data::class, $value);
    }

    public function testSetByPath_normal()
    {
        $obj = new \TeqFw\Lib\Test\Data\Blank();
        $data = new \TeqFw\Lib\Data();
        $obj->setByPath($data, ['path', 'to', 'node'], 'value', true);
        $value = $obj->getByPath($data, ['path', 'to']);
        $this->assertInstanceOf(\TeqFw\Lib\Data::class, $value);
    }
}