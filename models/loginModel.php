<?php
/**
* @Author: julian
* @Date:   2017-06-07 21:13:02
* @Last Modified by:   julian
* @Last Modified time: 2017-06-07 21:13:02
*/

/**
* Login, modelo conecta la base para enviar datos
*/
class loginModel extends Model
{
   function __construct()
   {
      parent::__construct();
   }

   function authentication()
   {
      $token = date("YmdHis") . $_POST['USER'];
      $sqlToken = $this->_db->prepare("UPDATE usuarios SET TOKEN = :token WHERE USUARIO = :user AND PASSWORD = :pass AND ESTADO = :state");
      $sqlToken->execute(array(':token' => md5($token), ':user' => $_POST['USER'], ':pass' => md5($_POST['PASS']), ':state' => 1));

      $sql = $this->_db->prepare("SELECT ID_USER, TOKEN, USUARIO, NOMBRES, APELLIDOS, ESTADO, FECHA_CREACION, FECHA_EXPIRA FROM usuarios WHERE USUARIO = :user AND PASSWORD = :pass");
      $sql->execute(array(':user' => $_POST['USER'], ':pass' => md5($_POST['PASS'])));
      if($result = $sql->fetchAll(PDO::FETCH_ASSOC))
      {
         if($result[0]['ESTADO'] == 0)
         {
            return array( 0 => array('LOGIN' => false, 'MESSAGE' => "¡Algo salio mal! Usuario inactivo"));
         }
         elseif(date("Y-m-d") > $result[0]['FECHA_EXPIRA'])
         {
            return array( 0 => array('LOGIN' => false, 'MESSAGE' => "¡Algo salio mal! Usuario vencido"));
         } else {
            return $result;
         }

      } else {
         return array( 0 => array('LOGIN' => false, 'MESSAGE' => "¡Algo salio mal! Usuario o contraseña incorrectos", 'USUARIO' => false));
      }
   }

   function validateSession()
   {
      $sql = $this->_db->prepare("SELECT TOKEN, FECHA_EXPIRA FROM usuarios WHERE TOKEN = :token AND USUARIO = :user AND ESTADO = :state");
      $sql->execute(array(':token' => $_POST['TOKEN'], ':user' => $_POST['USER'], ':state' => 1));
      if($result = $sql->fetchAll(PDO::FETCH_ASSOC))
      {
         if(date("Y-m-d") > $result[0]['FECHA_EXPIRA'])
         {
            return false;
         } else {
            return true;
         }
      } else {
         return false;
      }
   }
}

?>