<?php include_once '../models/cruds.php';
 $opc=$_SERVER['REQUEST_METHOD']; 
 switch($opc){ 
    case 'GET':  
    if(isset($_GET['txtcedula'])){
        Cruds::selectEStudiante(); // buscar por cédula
    }else{
        Cruds::selectEst(); // listar todos
    }
    break;
     case 'POST': 
        Cruds::insertEst(); break; 
     case 'DELETE': 
        Cruds::deleteEst(); break; 
     case 'PUT': 
     Cruds::ubdateESt(); break; } ?>