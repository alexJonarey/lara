<?php
include_once("conexion.php");

Class cruds{

public static function selectESt(){
    $objoConexion= new Conexion();
    $conectar=$objoConexion->conectar();
    $sqlselect="select * from estudiante";
    $resultado=$conectar->prepare($sqlselect);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
public static function selectEStudiante(){
    $objoConexion= new Conexion();
    $conectar=$objoConexion->conectar();
        $cedula=$_POST['txtcedula'];
    $sqlselect="select * from estudiante where cedula='$cedula'";
    $resultado=$conectar->prepare($sqlselect);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
public static function insertESt(){
    $objoConexion= new Conexion();
    $conectar=$objoConexion->conectar();
    $cedula=$_POST['txtcedula'];
    $nombre=$_POST['txtnombre'];
    $apellido=$_POST['txtapellido'];
    $telefono=$_POST['txttelefono'];
    $direccion=$_POST['txtdirecion'];
    $sqlselect="insert into  estudiante values('$cedula','$nombre','$apellido','$telefono','$direccion')";
    $resultado=$conectar->prepare($sqlselect);
    $resultado->execute();
    $data="se inserto correctamente el estudiante ";
    echo json_encode($data);
}
public static function DeletESt(){
    $objoConexion= new Conexion();
    $conectar=$objoConexion->conectar();
    $cedula=$_GET['txtcedula'];

    $sqlDelete="Delete from estudiante where cedula='$cedula'";
    $resultado=$conectar->prepare($sqlDelete);
    $resultado->execute();
    $data="se elimino correctamente el estudiante ";
    echo json_encode($data);
}
public static function ubdateESt(){
    $objoConexion= new Conexion();
    $conectar=$objoConexion->conectar();
    $cedula=$_GET['txtcedula'];
    $nombre=$_GET['txtnombre'];
    $apellido=$_GET['txtapellido'];
    $telefono=$_GET['txttelefono'];
   $direccion=$_GET['txtdirecion'];
    $sqlselect="update   estudiante set nombre='$nombre',apellido='$apellido',telefono='$telefono',direccion='$direccion' where cedula=$cedula";
    $resultado=$conectar->prepare($sqlselect);
    $resultado->execute();
    $data="se actualizo el estudiante";
    echo json_encode($data);
}

}
?>