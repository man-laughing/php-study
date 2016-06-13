<?php

class study {
   
    function __construct($x=10,$y=5) {
        $this->aa = $x;
        $this->bb = $y;
    }

    public function jia() {
        $sum = $this->aa + $this->bb;
        return $sum;
    }


}

$wode = new study(120,10);
var_dump($wode->jia())




?>
