<?php 
# get data and manupulate from csv file
/**
 * 
 */
require_once('bootstrap.php');
class ControllerClass
{
     public function csvData($file)
    {
        $csv = array_map('str_getcsv', file($file));
        array_walk($csv, function(&$a) use ($csv) {
          $a = array_combine($csv[0], $a);
        });
        array_shift($csv); # remove column header

        return $csv;
    }
    public $jsonData  = array();
    public $operators  = array();
    public $matchPrefix = array();

    public function storeData($operators){
        #write json array
        $this->operators = $operators;
        $this->jsonData['operators'] = $operators;
        array_walk($operators, array($this, 'prefixKeys'));
        if(file_put_contents("array.json",json_encode($this->jsonData))){
            echo "Data import successful.";
        }else{
            echo 'Please try again';
        } 
    }


    public function prefixKeys($operator){
        $keys = array_keys(array_column($this->operators, 'prefix'), $operator['prefix']);
        $this->jsonData['prefix'][$operator['prefix']] = $keys;
    }

    public function getJsonOperators(){
            $data = json_decode(file_get_contents('array.json'), true);
            return $data;
    }
    public function MinPriceOperator($prefix){
        $bst = new BSTClass();
        if($bst->search($prefix) == 1){
           $jsonOperators = $this->getJsonOperators();
           array_walk($jsonOperators['prefix'][$prefix], array($this,'arrayBuild'));

        #find min price 
        $min = min(array_column($this->matchPrefix, 'price')); 
        #find min price operator
        $keyMin = array_keys(array_column($this->matchPrefix, 'price'), $min);
        return $this->matchPrefix[$keyMin[0]];
        }
    }

    public function arrayBuild($item){
        $jsonOperators = $this->getJsonOperators();
        return $this->matchPrefix[] = $jsonOperators['operators'][$item];
    }

}

?>






























+

