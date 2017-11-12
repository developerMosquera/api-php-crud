<?php
/**
* @Author: julian
* @Date:   2017-06-06 21:37:29
* @Last Modified by:   julian
* @Last Modified time: 2017-06-06 21:37:29
*/

/**
* Inicidor del programa
*/
class Bootstrap
{
   public static function run()
   {
      $controllerRoute = ROOT . 'controllers' . DS . $_POST['CONTROLLER'] . 'Controller.php';
      $controllerName = $_POST['CONTROLLER'] . 'Controller';
      $controllerMethod = $_POST['METHOD'];

      if(is_readable($controllerRoute))
      {
         require_once $controllerRoute;
         $controllerCall = new $controllerName;
         $controllerCall->$controllerMethod();

      } else {
         echo "ErrorController.php";
      }
   }
}

?>