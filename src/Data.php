<?php
/**
 * User: Alex Gusev <alex@flancer64.com>
 */

namespace TeqFw\Lib;


/**
 * Data Object to be used in Tequila FW.
 */
class Data
    extends \stdClass
{
    public function __construct()
    {
        $argc = func_num_args();
        if ($argc == 0) {
            // empty DataObject is just an \stdClass
        } elseif ($argc == 1) {
            // parse and store first argument if it is not 'null'.
            $first = func_get_arg(0);
            if (!is_null($first)) {
                $this->data = func_get_arg(0);
            }
        } else {
            throw new \Exception('Wrong number of constructor arguments (should be <2).');
        }
    }
}