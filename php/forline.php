<?php
    

function for_line1()  {
    $file1 = file('passfile');
    foreach ($file1 as $key=>$value) {
        echo $value;
    }
}


function for_line2()  {
    $file2 = fopen('passfile','r');
    while (!feof($file2)) {
        echo fgets($file2);
    }
    fclose($file2);


}


for_line1();
#for_line2();


?>
