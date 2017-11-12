<?php
/**
* @Author: julian
* @Date:   2017-06-06 22:51:52
* @Last Modified by:   julian
* @Last Modified time: 2017-06-06 22:51:52
*/

/**
* Controllador para la gestión del modulo usuarios
*/
class usersController extends Controller
{
   private $_usersModel;

   function __construct()
   {
      $this->_usersModel = $this->modelLoad("users");
   }

   function list()
   {
      $modelMethod = $_POST['METHOD'];
      $list = $this->_usersModel->$modelMethod();
      echo json_encode($list);
   }

   function add()
   {
      $modelMethod = $_POST['METHOD'];
      $add = $this->_usersModel->$modelMethod();
      echo json_encode($add);
   }

   function update()
   {
      $modelMethod = $_POST['METHOD'];
      $update = $this->_usersModel->$modelMethod();
      echo json_encode($update);
   }

   function editState()
   {
      $modelMethod = $_POST['METHOD'];
      $editState = $this->_usersModel->$modelMethod();
   }
}

?>