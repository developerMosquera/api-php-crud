<?php
/**
* @Author: julian
* @Date:   2017-06-06 21:46:18
* @Last Modified by:   julian
* @Last Modified time: 2017-06-06 21:46:18
*/

/**
* Controller general para ser extendido
*/
class Controller
{
   function __construct()
   {
      echo "Extends del Controller general";
   }

   protected function modelLoad($modelCall)
   {
      $modelName = $modelCall . "Model";
      $modelRoute = ROOT . 'models' . DS . $modelName . '.php';
      if(is_readable($modelRoute))
      {
         require_once $modelRoute;
         $model = new $modelName;
         return $model;
      } else {
         echo "Error de modelo";
      }
   }
}
?>
