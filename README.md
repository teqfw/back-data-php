# Data objects in Tequila Framework (PHP)


## Goals

Data objects are used in TeqFW as improved `\srdClass` objects.

### Prevent warnings

Prevent warnings if some property is not set yet:

stdClass:
```php
$data = new \stdClass();
$val = $data->prop;
// PHP Notice:  Undefined property: stdClass::$prop in ...
```

Data object:
```php
$data = new \TeqFw\Lib\Data();
$val = $data->prop; // $val = null
```


### Set/get property by path

stdClass:

```php
$data = new \stdClass();
$data->path = new \stdClass();
$data->path->to = new \stdClass();
$data->path->to->node = 'value';
$val = $data->path->to->node;   // $val = 'value'

```

Data object:
```php
$data = new \TeqFw\Lib\Data();
$data->set('path/to/node', 'value');
$val = $data->get('path/to/node'); // $val = 'value'

```


### Wrap arrays or other objects
```php
$param = [
    'key1' => 'value1',
    'key2' => 'value2'
];
$obj = new \TeqFw\Lib\Data($param);
$val1 = $obj->key1; // $val1 = 'value1'
$val2 = $obj->key2; // $val2 = 'value2'

```