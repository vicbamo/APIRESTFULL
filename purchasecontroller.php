<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('content-type: application/json; charset=utf-8');

require 'purchasemodel.php';

$purchaseModel = new PurchaseModel();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $id_purchase = isset($_GET['id_purchase']) ? $_GET['id_purchase'] : null;
        $respuesta = $purchaseModel->getPurchases($id_purchase);
        echo json_encode($respuesta);
        break;

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
            $respuesta = $purchaseModel->insertPurchase(
                $_POST['id_client'],
                $_POST['id_product'],
                $_POST['quantity'],
                $_POST['total_price'],
                $_POST['purchase_date']
            );
        }
        echo json_encode($respuesta);
        break;

    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        if (
            !isset($_PUT['id_purchase']) || empty(trim($_PUT['id_purchase'])) ||
            !isset($_PUT['id_client']) || empty(trim($_PUT['id_client'])) ||
            !isset($_PUT['id_product']) || empty(trim($_PUT['id_product'])) ||
            !isset($_PUT['quantity']) || empty(trim($_PUT['quantity'])) ||
            !isset($_PUT['total_price']) || empty(trim($_PUT['total_price'])) ||
            !isset($_PUT['purchase_date']) || empty(trim($_PUT['purchase_date']))
        ) {
            $respuesta = ['error', 'Datos de actualización de compra incompletos'];
        } else {
            $respuesta = $purchaseModel->updatePurchase(
                $_PUT['id_purchase'],
                $_PUT['id_client'],
                $_PUT['id_product'],
                $_PUT['quantity'],
                $_PUT['total_price'],
                $_PUT['purchase_date']
            );
        }
        echo json_encode($respuesta);
        break;

    case 'DELETE':
        $_DELETE = json_decode(file_get_contents('php://input'), true);
        if (!isset($_DELETE['id_purchase']) || empty(trim($_DELETE['id_purchase']))) {
            $respuesta = ['error', 'ID de compra no válido'];
        } else {
            $respuesta = $purchaseModel->deletePurchase($_DELETE['id_purchase']);
        }
        echo json_encode($respuesta);
        break;

    default:
        echo json_encode(['error', 'Método no permitido']);
        break;
}
?>

