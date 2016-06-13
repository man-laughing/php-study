<?php
#################################################
/*
    Descripition: PHP MySQL interface.
    Author: Laughing
    Date:   2016-04-07
    Mail: 305835227@qq.com
*/
#################################################

define ('DB_TYPE','your db type');
define ('DB_HOST','your db host');
define ('DB_NAME','your db name');
define ('DB_USER','your db user');
define ('DB_PASS','your db pass');

class mysql_lib {

   private $conn;
   private $tabName;

   function __construct($tabName) {
        if (isset($tabName) and !empty($tabName) ) {
            $this->tabName = $tabName;
        }
        try { 
           $db_type = DB_TYPE;
           $db_host = DB_HOST; 
           $db_name = DB_NAME;
           $db_user = DB_USER; 
           $db_pass = DB_PASS;
           $dsn = "$db_type:host=$db_host;dbname=$db_name";
           $this->conn = new PDO($dsn,$db_user,$db_pass);
        } catch (PDOException $err_msg) {
               echo  $err_msg;     
          }
   }
/*
   Add one record.
   para:  <Array> 
   exam:  array(
                    Account  =>'xxxx',
                    Password =>'yyyy',
               ) 
*/
   public function addOne($datamodel) {
       if (!is_array($datamodel)) {
          return 0;
       }
       $keys = array();
       $vals = array();
       foreach ( $datamodel as $key=>$value)  {   
           $keys[] = $key;
           $vals[] = "'" . $value . "'";
       }
       $colums     = implode(',',$keys);
       $colums_val = implode(',',$vals);
       $sql = "INSERT INTO $this->tabName ($colums) values ($colums_val)";
       $result = $this->conn->exec($sql);
       return $this->conn->lastInsertId();
   }

/*
   Delete one record.
   para:  <String> <String>
   exam:
          $col = 'Account'
          $val = 'lisi'
    
*/
   public function delOne($col,$val)  {
       if (!isset($col) or !isset($val)) {
           return 0;
       }
       if (empty($col) or empty($val)) {
           return 0;
       }
       $sql = "DELETE FROM $this->tabName WHERE $col='$val'";
       $result = $this->conn->exec($sql);
       return $result;
   }

/*
   Update one record.
   para: <Array> <Array>
   exam:  
         $condition = array( 'Account'  => 'lisi' )
         $value     = array( 'Password' => 999    )
*/
   
   public function uptOne($condition,$value) {
       if (!isset($condition) or !isset($value)) {
           return 0;
       }
       if (empty($condition) or empty($value)) {
           return 0;
       }
       $value_key = array();
       $value_val = array();
       foreach ($value as $key1=>$value1) {
           $value_key[] = $key1;
           $value_val[] = "'" . $value1 . "'";
       }
       $condition_key = array();
       $condition_val = array();
       foreach ($condition as $key2=>$value2) {
           $condition_key[] = $key2;
           $condition_val[] = "'" . $value2 .  "'";
       }

       $sql = "UPDATE  $this->tabName SET " . $value_key[0] . '=' . $value_val[0] . ' WHERE ' . $condition_key[0] . '=' . $condition_val[0] ;
       $result = $this->conn->exec($sql);
       return $result;
   }

/*
   Query one record.
   para: [Array] [Array]
   exam:  
         $columns     = array( 'Account','Passwrod' ) 
         $conditions  = array( 'id_number' => 1    )
*/

     public function qurOne($colums=array('*'),$conditions) {
             #如果conditions存在并且不为空
             if (isset($conditions) and !empty($conditions))   {
                 #不是数组就退出
                 if (!is_array($conditions)) {
                     return 0;
                 }
                 $cols = implode(',',$colums);
                 $cond_k = [];
                 $cond_v = [];
                 foreach ($conditions as $keys=>$vals) {
                     $cond_k[] = $keys;
                     $cond_v[] = "'" . $vals . "'";
                 }
                 $sql = "SELECT $cols FROM $this->tabName  WHERE " . $cond_k[0] . '=' . $cond_v[0]  . " LIMIT 1";
                 $result = $this->conn->query($sql,PDO::FETCH_ASSOC);
                 foreach ($result as $row) {
                     return $row;
                 }
             #或者conditions不存在
             }  else {
                    $cols2 = implode(',',$colums);
                    $sql   = "SELECT $cols2 FROM $this->tabName LIMIT 1";
                    $result = $this->conn->query($sql,PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        return $row;
                    }
             }

   }


}

##################################################
