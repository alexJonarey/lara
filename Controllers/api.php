<?php
include_once '../models/cruds.php';

$opc = $_SERVER['REQUEST_METHOD'];

switch ($opc) {
    case 'GET':
        Cruds::selectEst();
        break;

    case 'POST':
        if (isset($_POST['accion'])) {
            if ($_POST['accion'] == 'insertar') {
                Cruds::insertESt();
            } elseif ($_POST['accion'] == 'buscar') {
                Cruds::selectEStudiante();
            }
        }
        break;

    case 'DELETE':
        Cruds::DeletESt();
        break;

    case 'PUT':
        Cruds::ubdateESt();
        break;
}
?>