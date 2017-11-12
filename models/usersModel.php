<?php
/**
* @Author: julian
* @Date:   2017-06-21 22:03:01
* @Last Modified by:   julian
* @Last Modified time: 2017-06-21 22:03:01
*/


/**
* Users, modelo para la gestión de usuarios
*/
class usersModel extends Model
{
   function __construct()
   {
      parent::__construct();
   }

   function list()
   {
      if(isset($_POST['USER']) && isset($_POST['USER_ID']))
      {
         $sql = $this->_db->prepare("SELECT ID_USER, TOKEN, USUARIO, ESTADO, FECHA_CREACION, FECHA_ACTUALIZACION, NOMBRES, APELLIDOS, CEDULA FROM usuarios WHERE USUARIO = :user AND ID_USER = :idUser");
         $sql->execute(array(':user' => $_POST['USER'], ':idUser' => $_POST['USER_ID']));
      } else {
         $sql = $this->_db->prepare("SELECT ID_USER, TOKEN, USUARIO, ESTADO, FECHA_CREACION, FECHA_ACTUALIZACION, NOMBRES, APELLIDOS, CEDULA FROM usuarios");
         $sql->execute();
      }

      $result = $sql->fetchAll(PDO::FETCH_ASSOC);
      return $result;
   }

   function add()
   {
      $sqlValidateUSer = $this->_db->prepare("SELECT ID_USER FROM usuarios WHERE USUARIO = :user");
      $sqlValidateUSer->execute(array(':user' => $_POST['USER']));
      if($resultValidateUser = $sqlValidateUSer->fetchAll(PDO::FETCH_ASSOC))
      {
         return array( 0 => array('SAVE' => false, 'REPEAT' => true, 'MESSAGE' => "¡Algo salio mal! Usuario (" . $_POST['USER'] . ") ya se encuentra en el sistema"));
      } else {
         $sql = $this->_db->prepare("INSERT INTO usuarios (USUARIO, PASSWORD, FECHA_EXPIRA, FECHA_CREACION, FECHA_ACTUALIZACION, NOMBRES, APELLIDOS, CEDULA) VALUES (:user, :pass, '". strftime("%Y-%m-%d", strtotime(date("Y-m-d") . " + 1 month")) ."', '". date("Y-m-d") ."', '". date("Y-m-d") ."', :nombres, :apellidos, :cedula)");
         $sql->execute(array(':user' => $_POST['USER'], ':pass' => md5($_POST['PASS']), ':nombres' => $_POST['NOMBRE'], ':apellidos' => $_POST['APELLIDO'], ':cedula' => $_POST['CEDULA']));
         $affectedRows = $sql->rowCount();
         if($affectedRows > 0)
         {
            return array( 0 => array('SAVE' => true, 'REPEAT' => false, 'MESSAGE' => "¡Adelante! usuario creado"));
         } else {
            return array( 0 => array('SAVE' => false, 'REPEAT' => false, 'MESSAGE' => "¡Algo salio mal! el usuario no se creo"));
         }
      }
   }

   function update()
   {
      $sql = $this->_db->prepare("UPDATE usuarios SET NOMBRES = :nombres, APELLIDOS = :apellidos, CEDULA = :cedula, PASSWORD = :pass WHERE ID_USER = :idUser AND USUARIO = :user AND TOKEN = :token");
      $sql->execute(array(':nombres' => $_POST['NOMBRE'], ':apellidos' => $_POST['APELLIDO'], ':cedula' => $_POST['CEDULA'], ':pass' => md5($_POST['PASS']), ':idUser' => $_POST['USER_ID'], ':user' => $_POST['USER'], ':token' => $_POST['TOKEN']));
      $affectedRows = $sql->rowCount();
      if($affectedRows > 0)
      {
         return array( 0 => array('SAVE' => true, 'MESSAGE' => "¡Adelante! usuario editado"));
      } else {
         return array( 0 => array('SAVE' => false, 'MESSAGE' => "¡Algo salio mal! son los mismo datos"));
      }
   }

   function editState()
   {
      $sql = $this->_db->prepare("UPDATE usuarios SET ESTADO = :estado WHERE ID_USER = :idUser");
      $sql->execute(array(':estado' => $_POST['ESTADO'], ':idUser' => $_POST['ID_USER']));
   }
}
?>