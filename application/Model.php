<?php
/**
* @Author: julian
* @Date:   2017-06-06 21:43:57
* @Last Modified by:   julian
* @Last Modified time: 2017-06-06 21:43:57
*/

/**
* Modelo general para ser extendido, en el __construct instancia la conexion a la base
*/
class Model
{
   protected $_db;

   function __construct()
   {
      $this->_db = new Database();
   }
}
?>