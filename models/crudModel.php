<?php
/**
* @Author: julian
* @Date:   2017-07-04 19:44:15
* @Last Modified by:   julian
* @Last Modified time: 2017-07-04 19:44:15
*/


/**
* Clase del modelo para listar, inserta, modificar y eliminar datos del crud
*/
class crudModel extends Model
{
   function __construct()
   {
      parent::__construct();
   }

   function list()
   {
      $valorIngresosDespues = 0;
      $valorEgresoDespues = 0;

      if(isset($_POST['ID']) && ($_POST['ID'] > 0))
      {
         $sql = $this->_db->prepare("SELECT contabilidad.ID, contabilidad.ID_USER, contabilidad.ESTADO, contabilidad.DIA_EJECUCION, conceptos.DESCRIPCION AS DESCRIPCION_CONCEPTO, contabilidad.CONCEPTO, contabilidad.VALOR, contabilidad.FECHA_CREADO, contabilidad.FECHA_EJECUCION, contabilidad.DESCRIPCION FROM contabilidad LEFT JOIN conceptos USING(CONCEPTO) WHERE contabilidad.ID_USER = :idUser AND contabilidad.ID = :id ORDER BY contabilidad.DIA_EJECUCION ASC");
         $sql->execute(array('id' => $_POST['ID'], ':idUser' => $_POST['USER_ID']));
         $result = $sql->fetchAll(PDO::FETCH_ASSOC);

         foreach($result as $key => $row)
         {
            $data[] = array("ID" => $row['ID'], "VALOR" => $row['VALOR'], "DESCRIPCION" => $row['DESCRIPCION']);
         }

         return $data;

      } else {

          $sql = $this->_db->prepare("SELECT contabilidad.ID, contabilidad.ID_USER, contabilidad.ESTADO, contabilidad.DIA_EJECUCION, conceptos.DESCRIPCION AS DESCRIPCION_CONCEPTO, contabilidad.CONCEPTO, contabilidad.VALOR, contabilidad.FECHA_CREADO, contabilidad.FECHA_EJECUCION, contabilidad.DESCRIPCION FROM contabilidad LEFT JOIN conceptos USING(CONCEPTO) WHERE contabilidad.ID_USER = :idUser ORDER BY contabilidad.DIA_EJECUCION ASC");
         $sql->execute(array(':idUser' => $_POST['USER_ID']));
         $result = $sql->fetchAll(PDO::FETCH_ASSOC);

         if($_POST['TYPE_DATA'] == 1)
         {
            foreach($result as $key => $row)
            {
               if($row['ESTADO'] == 1)
               {
                  if($row['CONCEPTO'] === "1")
                  {
                     if($row['DIA_EJECUCION'] >= date("d"))
                     {
                        $dataIngresoDespues[] = array("FECHA_EJECUCION" => strftime("%d de %b", strtotime(date("Y-") . date("m-") . $row['DIA_EJECUCION'])), "VALOR" => number_format($row['VALOR'], 0, '.', '.'), 'DESCRIPCION' => $row['DESCRIPCION']);

                        $valorIngresosDespues = $valorIngresosDespues + $row['VALOR'];
                        $totalValorIngresosDespues = array("VALOR_TOTAL" => number_format($valorIngresosDespues, 0, '.', '.'));
                     } else {
                        $dataIngresoAntes[] = array("FECHA_EJECUCION" => strftime("%d de %b", strtotime(date("Y-") . date("m-") . $row['DIA_EJECUCION'])), "VALOR" => number_format($row['VALOR'], 0, '.', '.'), 'DESCRIPCION' => $row['DESCRIPCION']);
                     }
                  }

                  if($row['CONCEPTO'] === "2")
                  {
                     if($row['DIA_EJECUCION'] >= date("d"))
                     {
                        $dataEgresoDespues[] = array("FECHA_EJECUCION" => strftime("%d de %b", strtotime(date("Y-") . date("m-") . $row['DIA_EJECUCION'])), "VALOR" => number_format($row['VALOR'], 0, '.', '.'), 'DESCRIPCION' => $row['DESCRIPCION']);

                        $valorEgresoDespues = $valorEgresoDespues + $row['VALOR'];
                        $totalValorEgresoDespues = array("VALOR_TOTAL" => number_format($valorEgresoDespues, 0, '.', '.'));
                     } else {
                        $dataEgresoAntes[] = array("FECHA_EJECUCION" => strftime("%d de %b", strtotime(date("Y-") . date("m-") . $row['DIA_EJECUCION'])), "VALOR" => number_format($row['VALOR'], 0, '.', '.'), 'DESCRIPCION' => $row['DESCRIPCION']);
                     }
                  }
               }

            }

            return array(0 => $dataIngresoDespues, 1 => $dataIngresoAntes, 2 => $dataEgresoDespues, 3 => $dataEgresoAntes, 4 => $totalValorIngresosDespues, 5 => $totalValorEgresoDespues);
         } else {
            foreach($result as $key => $row)
            {
               $data[] = array("ID" => $row['ID'], "ESTADO" => $row['ESTADO'], "DIA_EJECUCION" => strftime("%d de %b", strtotime(date("Y-m") ."-". $row['DIA_EJECUCION'])), "CONCEPTO" => $row['DESCRIPCION_CONCEPTO'], "VALOR" => number_format($row['VALOR'], 0, '.', '.'), "DESCRIPCION" => $row['DESCRIPCION']);
            }

            return $data;
         }
      }
   }

   function listConceptos()
   {
      $sql = $this->_db->prepare("SELECT conceptos.CONCEPTO, conceptos.DESCRIPCION FROM conceptos");
      $sql->execute();
      $result = $sql->fetchAll(PDO::FETCH_ASSOC);

      return $result;
   }

   function add()
   {
      $sql = $this->_db->prepare("INSERT INTO contabilidad (ID_USER, CONCEPTO, VALOR, FECHA_CREADO, FECHA_EJECUCION, DIA_EJECUCION, DESCRIPCION) VALUES (:idUser, :concepto, :valor, '". date("Y-m-d") ."', :fechaEjecucion, :diaEjecucion, :descripcion)");
      $sql->execute(array(':idUser' => $_POST['ID_USER'], ':concepto' => $_POST['CONCEPTO'], ':valor' => $_POST['VALOR'], ':fechaEjecucion' => $_POST['FECHA_EJECUCION'], ':diaEjecucion' => strftime("%d", strtotime($_POST['FECHA_EJECUCION'])), ':descripcion' => $_POST['DESCRIPCION']));
      $affectedRows = $sql->rowCount();
      if($affectedRows > 0)
      {
         return array( 0 => array('SAVE' => true, 'MESSAGE' => "¡Adelante! registro creado"));
      } else {
         return array( 0 => array('SAVE' => false, 'MESSAGE' => "¡Algo salio mal! registro no almacenado"));
      }
   }

   function update()
   {
      $sql = $this->_db->prepare("UPDATE contabilidad SET CONCEPTO = :concepto, VALOR = :valor, FECHA_EJECUCION = :fechaEjecucion, DESCRIPCION = :descripcion WHERE ID_USER = :idUser AND ID = :id");
      $sql->execute(array(':concepto' => $_POST['CONCEPTO'], ':valor' => $_POST['VALOR'], ':fechaEjecucion' => $_POST['FECHA_EJECUCION'], ':descripcion' => $_POST['DESCRIPCION'], ':idUser' => $_POST['USER_ID'], ':id' => $_POST['ID']));
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
      $sql = $this->_db->prepare("UPDATE contabilidad SET ESTADO = :estado WHERE ID = :id");
      $sql->execute(array(':estado' => $_POST['ESTADO'], ':id' => $_POST['ID']));
   }
}
?>