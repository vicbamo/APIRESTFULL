<?php
class PurchaseModel
{
    private $conexion;

    public function __construct()
    {
        // se establece la conexión a la base de datos
        $this->conexion = new mysqli('localhost', 'root', '123456789', 'api');
        mysqli_set_charset($this->conexion, 'utf8mb4');

        if ($this->conexion->connect_error) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }
    }

    public function getPurchases($purchaseId = null)
    {
        $query = ($purchaseId === null)
            ? 'SELECT * FROM purchases'
            : 'SELECT * FROM purchases WHERE id_purchase = ' . $purchaseId;

        $result = $this->conexion->query($query);

        if (!$result) {
            return ['error', 'Error al obtener las compras'];
        }

        $purchases = [];

        while ($row = $result->fetch_assoc()) {
            $purchases[] = $row;
        }

        return $purchases;
    }

    public function updatePurchase($purchaseId, $id_client, $id_product, $quantity, $total_price, $purchase_date)
    {
        $query = "UPDATE purchases SET id_client = ?, id_product = ?, quantity = ?, total_price = ?, purchase_date = ? WHERE id_purchase = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("iiidsi", $id_client, $id_product, $quantity, $total_price, $purchase_date, $purchaseId);

        if ($stmt->execute()) {
            return ['success', 'Compra actualizada correctamente'];
        } else {
            return ['error', 'Error al actualizar la compra: ' . $this->conexion->error];
        }
    }

    public function deletePurchase($purchaseId)
    {
        $query = "DELETE FROM purchases WHERE id_purchase = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $purchaseId);

        if ($stmt->execute()) {
            return ['success', 'Compra eliminada correctamente'];
        } else {
            return ['error', 'Error al eliminar la compra: ' . $this->conexion->error];
        }
    }

    public function __destruct()
    {
        // Cerrar la conexión a la base de datos al destruir la instancia del modelo
        $this->conexion->close();
    }
}
?>

