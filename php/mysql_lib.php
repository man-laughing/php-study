<?php


define ('DB_HOST','localhost');
define ('DB_USER','root');
define ('DB_PASS','zhanglei');

class mysql_lib  {

     function __construct($DBname)  {
             $this->DBname = $DBname;
#             $this->TBname = $DBname;
     }

     private $db_host = DB_HOST ;
     private $db_user = DB_USER ;
     private $db_pass = DB_PASS ;

     public function custom_query($DataMode) {
             $conn    = mysql_connect($this->db_host,$this->db_user,$this->db_pass);
             $sel_db  = mysql_select_db($this->DBname,$conn);
             $abc     = mysql_query($DataMode);
             while ($result = mysql_fetch_array($abc,MYSQL_ASSOC)) {
                   $arr[] = $result;
             }
             return $arr;
     }

}

$wode = new mysql_lib('web_project');
$zl   = $wode->custom_query("select * from users");
print_r($zl);







?>
