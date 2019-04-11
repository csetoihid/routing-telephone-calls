<?php 

/*Allocate memori limit */
ini_set('memory_limit', '-1');
require_once('bootstrap.php');
$controller  = new ControllerClass();
$bst  = new BSTClass();
// Read from CSV file
$operators = $controller->csvData('price_list_new.csv');

/*test for large volume */
/*$operators = array();
for($i=1;$i< 20000; $i++){
	$op =array();
	if($i < 200){
		$op['name'] = 'Operator(A) ';
	}else{
		$op['name'] = 'Operator(B) ';
	}
	$op['prefix'] = $i;
	$op['price'] = $i;

	$operators[] = 	$op;
}
*/

$controller->storeData($operators);
$jsonOperators = $controller->getJsonOperators();
// Initialization root 
$bst = new BSTClass(0);
// Insert  nodes
array_walk($jsonOperators['operators'], array($bst, 'insert'));
$bst->storeBST();
?>