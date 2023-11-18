<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('content-type: application/json; charset=utf-8');
require 'clientsModel.php';

$clientsModel = new clientsModel();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $respuesta = (!isset($_GET['id'])) ? $clientsModel->getClients() : $clientsModel->getClients($_GET['id']);
        echo json_encode($respuesta);
        break;

    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (
            !isset($_POST['name']) || empty(trim($_POST['name'])) ||
            !isset($_POST['email']) || empty(trim($_POST['email'])) ||
            !isset($_POST['password']) || empty(trim($_POST['password']))
        ) {
            $respuesta = ['error', 'Datos de cliente incompletos'];
        } else {
            $respuesta = $clientsModel->saveClient($_POST['name'], $_POST['email'], $_POST['password']);
        }
        echo json_encode($respuesta);
        break;

    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        if (
            !isset($_PUT['id']) || empty(trim($_PUT['id'])) ||
            !isset($_PUT['name']) || empty(trim($_PUT['name'])) ||
            !isset($_PUT['email']) || empty(trim($_PUT['email'])) ||
            !isset($_PUT['password']) || empty(trim($_PUT['password']))
        ) {
            $respuesta = ['error', 'Datos de cliente incompletos'];
        } else {
            $respuesta = $clientsModel->updateClient($_PUT['id'], $_PUT['name'], $_PUT['email'], $_PUT['password']);
        }
        echo json_encode($respuesta);
        break;

    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input'), true);
        if (!isset($_DELETE['id']) || empty(trim($_DELETE['id']))) {
            $respuesta = ['error', 'ID de cliente no válido'];
        } else {
            $respuesta = $clientsModel->deleteClient($_DELETE['id']);
        }
        echo json_encode($respuesta);
        break;
         // Operaciones CRUD para la tabla 'purchases'
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        if (
            !isset($_POST['id_client']) || empty(trim($_POST['id_client'])) ||
            !isset($_POST['id_product']) || empty(trim($_POST['id_product'])) ||
            !isset($_POST['quantity']) || empty(trim($_POST['quantity'])) ||
            !isset($_POST['total_price']) || empty(trim($_POST['total_price'])) ||
            !isset($_POST['purchase_date']) || empty(trim($_POST['purchase_date']))
        ) {
            $respuesta = ['error', 'Datos de compra incompletos'];
        } else {
            $respuesta = $clientsModel->insertPurchase(
                $_POST['id_client'],
                $_POST['id_product'],
                $_POST['quantity'],
                $_POST['total_price'],
                $_POST['purchase_date']
            );
        }
        echo json_encode($respuesta);
        break;

    // Puedes agregar otras operaciones CRUD para 'purchases' según sea necesario

    default:
        echo json_encode(['error', 'Método no permitido']);
        break;
}
?>
