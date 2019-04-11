<?php
ini_set('memory_limit', '-1');
require_once('bootstrap.php');

class NodeClass
{
    public $value, $left, $right;
    public function __construct($value)
    {
        $this->value = $value;
    }
}
