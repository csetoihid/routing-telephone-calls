<?php
ini_set('memory_limit', '-1');
require_once('bootstrap.php');
error_reporting(E_ALL);

class BSTClass
{
    public $root;

    public function __construct($value = null)
    {
        if ($value !== null) {
            $this->root = new NodeClass($value);
        }
    }
    public function search($value)
    {
    $node = $this->getBST();
        while($node) {
            if ($value > $node->value) {
                $node = $node->right;
            } elseif ($value < $node->value) {
                $node = $node->left;
            } else {
                break;
            }
        }
        if($node!= NULL){
        	$res = 1;
        }else{
        	$res = 0;
        }
        //return $node;
        return $res;
    }

	public function insert($operator)
	{
        $value = $operator['prefix'];
	    $node = $this->root;
	    if (!$node) {
	        return $this->root = new NodeClass($value);
	    }
	    while($node) {
	        if ($value > $node->value) {
	            if ($node->right) {
	                $node = $node->right;
	            } else {
	                $node = $node->right = new NodeClass($value);
	                break;
	            }
 	        } elseif ($value < $node->value) {
	            if ($node->left) {
	                $node = $node->left;
	            } else {
	                $node = $node->left = new NodeClass($value);
	                break;
	            }
	        } else {
	            break;
	        }
	    }
	    return $node;
	}
    public function storeBST(){
        $node = $this->root;

        if(file_put_contents("bst_array.json",serialize($node))){
            echo "Created BST successfully";
        }else{
            echo 'Please try again to Create BST';
        }
        
    }

    public function getBST(){
        return unserialize(file_get_contents('bst_array.json'));


    }

}