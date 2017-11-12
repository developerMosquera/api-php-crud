<?php
/**
* @Author: julian
* @Date:   2017-07-04 19:40:55
* @Last Modified by:   julian
* @Last Modified time: 2017-07-04 19:41:00
*/


/**
* Clase para listar, inserta, modificar y eliminar datos del crud
*/
class crudController extends Controller
{
   private $_crudModel;

   function __construct()
   {
      $this->_crudModel = $this->modelLoad("crud");
   }

   function list()
   {
      $modelMethod = $_POST['METHOD'];
      $list = $this->_crudModel->$modelMethod();
      echo json_encode($list);
   }

   function listConceptos()
   {
      $modelMethod = $_POST['METHOD'];
      $listConceptos = $this->_crudModel->$modelMethod();
      echo json_encode($listConceptos);
   }

   function add()
   {
      $modelMethod = $_POST['METHOD'];
      $add = $this->_crudModel->$modelMethod();
      echo json_encode($add);
   }

   function update()
   {
      $modelMethod = $_POST['METHOD'];
      $update = $this->_crudModel->$modelMethod();
      echo json_encode($update);
   }

   function editState()
   {
      $modelMethod = $_POST['METHOD'];
      $editState = $this->_crudModel->$modelMethod();
      echo json_encode($editState);
   }
}
?>