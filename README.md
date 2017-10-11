# Data objects in Tequila Framework (PHP)


## Overview

### Prevent warnings

Data object is used in TeqFW to prevent warnings if some property of the `\stdClass` is not set yet:

```php
$data = new \stdClass();
$val = $data->prop;
// PHP Notice:  Undefined property: stdClass::$prop in ...
```

```php
$data = new \TeqFw\Lib\Data();
$val = $data->prop; // $val = null
```


### Set/get property by path

```php
$obj = new \TeqFw\Lib\Data();
$obj->path = new \TeqFw\Lib\Data();
$obj->path->to = new \TeqFw\Lib\Data();
$obj->path->to->node = 'value';
$value = $obj->get('/path/to/node');
$this->assertEquals('value', $value);

```