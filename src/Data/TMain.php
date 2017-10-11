<?php
/**
 * User: Alex Gusev <alex@flancer64.com>
 */

namespace TeqFw\Lib\Data;

/**
 * Trait is used to simplify test of the private methods of the "\TeqFw\Lib\Data".
 */
trait TMain
{
    /**
     * Convert string representation into array ('/path/to/node' => ['path', 'to', 'node']).
     *
     * @param string $path
     * @return array
     */
    public function explodePath($path)
    {
        $result = explode(\TeqFw\Lib\Data::PS, $path);
        // unset empty nodes
        foreach ($result as $key => $item) {
            if (!$item && $item !== "0") {
                unset($result[$key]);
            }
        }
        // re-index array
        $result = array_values($result);
        return $result;
    }

    public function getByPath($obj, $parts)
    {
        $result = null;
        $depth = count($parts); // number of steps in the path
        if ($depth <= 1) {
            /* we should return property of the object */
            $prop = reset($parts);
            $result = $obj->{$prop};
        } else {
            $current = $obj;
            $level = 0;
            foreach ($parts as $part) {
                if ($current instanceof \TeqFw\Lib\Data) {
                    $next = $current->get($part);
                    if (!is_null($next)) {
                        /* go to the next step */
                        $current = $next;
                    } else {
                        /* next step is missed in the path, return null */
                        break;
                    }
                } else {
                    /* we have no data for the next step */
                    break;
                }
                $level++; // one step on the path is done
            }
            /* return current value if we have reached the end of path */
            if ($level >= $depth) {
                $result = $current;
            }
        }
        return $result;
    }

    public function setByPath($obj, $parts, $value, $replace)
    {
        $depth = count($parts); // number of steps in the path
        $current = $obj;
        $level = 1;
        foreach ($parts as $part) {
            if ($level >= $depth) {
                /* set value here */
                $current->{$part} = $value;
            } else {
                $prop = $current->{$part};
                if ($prop instanceof \TeqFw\Lib\Data) {
                    if ($replace) {
                        $current = $prop;
                    } else {
                        break;
                    }
                } else {
                    $current->{$part} = new \TeqFw\Lib\Data();
                    $current = $current->{$part};
                }
            }
            $level++;
        }
    }
}