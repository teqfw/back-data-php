<?php
/**
 * User: Alex Gusev <alex@flancer64.com>
 */

namespace TeqFw\Lib\Dem\Test;


class DataTest
    extends \TeqFw\Lib\Test\TestCase
{
    public function testConstruct_empty()
    {
        $obj = new \TeqFw\Lib\Data();
        $this->assertInstanceOf(\stdClass::class, $obj);
    }

}