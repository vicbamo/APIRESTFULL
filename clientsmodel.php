<?php

class clientsModel
{
    private $conexion;

    public function __construct()
    {
        // se establece la conexión a la base de datos 
        $this->conexion = new mysqli('localhost','root','123456789','api');
        mysqli_set_charset($this->conexion,'utf8mb4');

        if ($this->conexion->connect_error) {
            die('Error de conexión: ' . $this->conexion->connect_error);
        }
    }
  // Métodos para la entidad 'clients'
    public function getClients($clientId = null)
    {
        $query = ($clientId === null)
            ? 'SELECT * FROM clients'
            : 'SELECT * FROM clients WHERE id_client = ' . $clientId;

        $result = $this->conexion->query($query);

        if (!$result) {
            return ['error', 'Error al obtener clientes'];
        }

        $clients = [];

        while ($row = $result->fetch_assoc()) {
            $clients[] = $row;
        }

        return $clients;
    }

    public function saveClient($name, $email, $password)
    {
        $query = "INSERT INTO clients (name_client, email_client, password_client) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            return ['success', 'Cliente registrado correctamente'];
        } else {
            return ['error', 'Error al registrar el cliente'];
        }
    }

    public function updateClient($clientId, $name, $email, $password)
    {
        $query = "UPDATE clients SET name_client = ?, email_client = ?, password_client = ? WHERE id_client = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("sssi", $name, $email, $password, $clientId);

        if ($stmt->execute()) {
            return ['success', 'Cliente actualizado correctamente'];
        } else {
            return ['error', 'Error al actualizar el cliente'];
        }
    }

    public function deleteClient($clientId)
    {
        $query = "DELETE FROM clients WHERE id_client = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $clientId);

        if ($stmt->execute()) {
            return ['success', 'Cliente eliminado correctamente'];
        } else {
            return ['error', 'Error al eliminar el cliente'];
        }
    }
 // Métodos para la entidad 'purchases'...

 public function insertPurchase($id_client, $id_product, $quantity, $total_price, $purchase_date) {
    $query = "INSERT INTO purchases (id_client, id_product, quantity, total_price, purchase_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->conexion->prepare($query);
    $stmt->bind_param("iiids", $id_client, $id_product, $quantity, $total_price, $purchase_date);

    if ($stmt->execute()) {
        return ['success', 'Compra realizada correctamente'];
    } else {
        return ['error', 'Error al realizar la compra: ' . $this->conexion->error];
    }
}
    public function __destruct()
    {
        // Cerrar la conexión a la base de datos al destruir la instancia del modelo
        $this->conexion->close();
    }
}

?>
