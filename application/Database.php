<?php
/**
* @Author: julian
* @Date:   2017-06-06 22:26:49
* @Last Modified by:   julian
* @Last Modified time: 2017-06-06 22:26:49
*/

/**
* Clase que extiende pdo para conectar con la base de datos
*/
class Database extends PDO
{
   function __construct()
   {
      parent::__construct('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR));
   }
}
?>