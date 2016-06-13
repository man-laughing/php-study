<?php

class jisuan {

    public $a;
    public $b;


    public function jia() {
        $sum = $this->a + $this->b;
        return $sum;
    }

    public function jian() {
        $sum1 = $this->a - $this->b;
        return $sum1;

    }



}

$abc = new jisuan();
$abc->a = 30;
$abc->b = 20;
var_dump($abc->jian());



?>
