<?php 
require_once('bootstrap.php');
$controller = new ControllerClass();
//example phone number 4673212345
echo 'Please  enter a phone number:  ';
#get data from terminal
$number = fgets(STDIN);
if(isset($number)){
	#remove wanwanted characters
    $mobileNumber = str_replace(array('+', '-',' '), '', $number);
    $matchArr = array();
    $res = array();
    #match most common digit of phone number.
    for ($i=0; $i < strlen($mobileNumber) ; $i++) { 
       $searchObject = ($i == 0) ? $mobileNumber : substr_replace($mobileNumber, "", -($i));
        $res = $controller->MinPriceOperator($searchObject);
        if(!empty($res)){ print_r($res);  break; }
    }  
    if(empty($res)){
    	echo "Operator is not found";
    }
}