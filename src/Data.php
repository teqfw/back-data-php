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
        setByPath as private;
    }

    /** Separator for path elements */
    const PS = '/';

    public function __construct()
    {
        $argc = func_num_args();
        if ($argc > 0) {
            // parse and store first argument if it is object or array.
            $first = func_get_arg(0);
            if (
                is_object($first) &&
                (
                    (get_class($first) == \stdClass::class) ||
                    ($first instanceof self)
                ) ||
                is_array($first)
            ) {
                foreach ($first as $key => $value) {
                    if (
                        is_object($value) &&
                        (
                            (get_class($value) == \stdClass::class) ||
                            ($value instanceof self)
                        ) ||
                        is_array($value)
                    ) {
                        $data = new self($value);
                        $this->{$key} = $data;
                    } else {
                        $this->{$key} = $value;
                    }
                }
            }
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
     * Set (nested) property by path.
     *
     * @param string $path "path/to/node"
     * @param mixed $value value to set
     * @param bool $replace 'false' - don't replace existing nodes
     */
    public function set($path, $value, $replace = true)
    {
        $parts = $this->explodePath($path);
        $this->setByPath($this, $parts, $value, $replace);
    }
}