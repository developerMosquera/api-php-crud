<?php
/**
* @Author: julian
* @Date:   2017-06-07 21:08:47
* @Last Modified by:   julian
* @Last Modified time: 2017-06-07 21:08:47
*/

/**
* Login, valida el logueo del usuario
*/
class loginController extends Controller
{
   private $_loginModel;

   function __construct()
   {
      $this->_loginModel = $this->modelLoad("login");
   }

   function authentication()
   {
      $modelMethod = $_POST['METHOD'];
      $authentication = $this->_loginModel->$modelMethod();
      echo json_encode($authentication);
   }

   function validateSession()
   {
      $modelMethod = $_POST['METHOD'];
      $validateSession = $this->_loginModel->$modelMethod();
      if($validateSession === true)
      {
         echo json_encode(array( 0 => array("status" => $validateSession)));
      } else {
         echo json_encode(array( 0 => array("status" => $validateSession)));
      }
   }
}
?>