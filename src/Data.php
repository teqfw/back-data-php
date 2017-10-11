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
    use \TeqFw\Lib\Data\TMain {
        explodePath as private;
        getByPath as private;
    }

    /** Separator for path elements */
    const PS = '/';

    public function __construct()
    {
        $argc = func_num_args();
        if ($argc == 0) {
            // empty DataObject is just an \stdClass
        } elseif ($argc == 1) {
            // parse and store first argument if it is not 'null'.
            $first = func_get_arg(0);
            /* TODO: parse constructor argument */
            if (!is_null($first)) {
                $this->data = $first;
            }
        } else {
            throw new \Exception('Wrong number of constructor arguments (should be <2).');
        }
    }

    /**
     * Magic method to read properties that are not exist.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $result = null;
        if (isset($this->$name)) {
            $result = $this->$name;
        }
        return $result;
    }

    /**
     * Get (nested) property by path.
     *
     * @param $path
     * @return mixed
     */
    public function get($path)
    {
        $parts = $this->explodePath($path);
        $result = $this->getByPath($this, $parts);
        return $result;
    }


    /**
     * Magic method to write properties directly.
     *
     * @param $name
     * @param $value
     */
//    public function __set($name, $value)
//    {
//        $this->$name = $value;
//    }
}