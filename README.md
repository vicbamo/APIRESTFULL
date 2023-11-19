# APIRESTFULL
este la documentacion y los Endpoint del proyecto API de la empresa VCM MUEBLES, hecho por el grupo ALFHA

Documentación de la API

Clientes
Obtener todos los clientes

Endpoint: GET /clients
Descripción: Obtiene todos los clientes almacenados.
Parámetros de consulta:
id (opcional): Filtra por ID de cliente.
Respuesta exitosa (200 OK):
[
  {
    "id": 1,
    "name": "Nombre del Cliente",
    "email": "cliente@example.com"
  },
  {
    "id": 2,
    "name": "Otro Cliente",
    "email": "otrocliente@example.com"
  }
]

Obtener un cliente específico

Endpoint: GET /clients/{id}
Descripción: Obtiene información detallada de un cliente específico.
Parámetros de ruta:
{id}: ID del cliente.
Respuesta exitosa (200 OK):
{
  "id": 1,
  "name": "Nombre del Cliente",
  "email": "cliente@example.com"
}
Agregar un nuevo cliente

Endpoint: POST /clients
Descripción: Agrega un nuevo cliente a la base de datos.
Datos de solicitud:
{
  "name": "Nuevo Cliente",
  "email": "nuevocliente@example.com",
  "password": "contraseña"
}
Respuesta exitosa (201 Created):

{
  "status": "success",
  "message": "Cliente creado correctamente"
}
Actualizar información de un cliente

Endpoint: PUT /clients/{id}
Descripción: Actualiza la información de un cliente existente.
Parámetros de ruta:
{id}: ID del cliente.
Datos de solicitud:
{
  "name": "Nuevo Nombre",
  "email": "nuevoemail@example.com",
  "password": "nuevacontraseña"
}
Respuesta exitosa (200 OK):
{
  "status": "success",
  "message": "Cliente actualizado correctamente"
}
Eliminar un cliente

Endpoint: DELETE /clients/{id}
Descripción: Elimina un cliente de la base de datos.
Parámetros de ruta:
{id}: ID del cliente.
Respuesta exitosa (200 OK):
{
  "status": "success",
  "message": "Cliente eliminado correctamente"
}
Productos
Obtener todos los productos

Endpoint: GET /products
Descripción: Obtiene todos los productos almacenados.
Parámetros de consulta:
id (opcional): Filtra por ID de producto.
Respuesta exitosa (200 OK):
[
  {
    "id_product": 1,
    "name": "Nombre del Producto",
    "description": "Descripción del producto",
    "price": 300000.99
  },
  {
    "id_product": 2,
    "name": "Otro Producto",
    "description": "Otra descripción",
    "price": 2000000.99
  }
]
Obtener un producto específico

Endpoint: GET /products/{id}
Descripción: Obtiene información detallada de un producto específico.
Parámetros de ruta:
{id}: ID del producto.
Respuesta exitosa (200 OK):
{
  "id_product": 1,
  "name": "Nombre del Producto",
  "description": "Descripción del producto",
  "price": 200000.99
}
Agregar un nuevo producto

Endpoint: POST /products
Descripción: Agrega un nuevo producto a la base de datos.
Datos de solicitud:
json
Copy code
{
  "name": "Nuevo Producto",
  "description": "Descripción del nuevo producto",
  "price": 350000.99
}
Respuesta exitosa (201 Created):
{
  "status": "success",
  "message": "Producto creado correctamente"
}
Actualizar información de un producto

Endpoint: PUT /products/{id}
Descripción: Actualiza la información de un producto existente.
Parámetros de ruta:
{id}: ID del producto.
Datos de solicitud:
{
  "name": "Nuevo Nombre",
  "description": "Nueva descripción",
  "price": 300000.99
}
Respuesta exitosa (200 OK):
{
  "status": "success",
  "message": "Producto actualizado correctamente"
}
Eliminar un producto

Endpoint: DELETE /products/{id}
Descripción: Elimina un producto de la base de datos.
Parámetros de ruta:
{id}: ID del producto.
Respuesta exitosa (200 OK):
{
  "status": "success",
  "message": "Producto eliminado correctamente"
}
Compras
Obtener todas las compras

Endpoint: GET /purchases
Descripción: Obtiene todas las compras realizadas.
Parámetros de consulta:
id_purchase (opcional): Filtra por ID de compra.
Respuesta exitosa (200 OK):
[
  {
    "id_purchase": 1,
    "id_client": 1,
    "id_product": 1,
    "quantity": 2,
    "total_price": 500000.00,
    "purchase_date": "2023-01-01"
  },
  {
    "id_purchase": 2,
    "id_client": 2,
    "id_product": 2,
    "quantity": 1,
    "total_price": 225000,
    "purchase_date": "2023-01-02"
  }
]
Obtener una compra específica

Endpoint: GET /purchases/{id_purchase}
Descripción: Obtiene información detallada de una compra específica.
Parámetros de ruta:
{id_purchase}: ID de la compra.
Respuesta exitosa (200 OK):
{
  "id_purchase": 1,
  "id_client": 1,
  "id_product": 1,
  "quantity": 2,
  "total_price": 500000.00,
  "purchase_date": "2023-01-01"
}
Realizar una nueva compra

Endpoint: POST /purchases
Descripción: Registra una nueva compra en la base de datos.
Datos de solicitud:
{
  "id_client": 1,
  "id_product": 1,
  "quantity": 2,
  "total_price": 250000.00,
  "purchase_date": "2023-01-03"
}
Respuesta exitosa (201 Created):
{
  "status": "success",
  "message": "Compra realizada correctamente"
}
Actualizar información de una compra

Endpoint: PUT /purchases/{id_purchase}
Descripción: Actualiza la información de una compra existente.
Parámetros de ruta:
{id_purchase}: ID de la compra.
Datos de solicitud:
{
  "id_client": 1,
  "id_product": 1,
  "quantity": 3,
  "total_price": 300000.00,
  "purchase_date": "2023-01-03"
}
Respuesta exitosa (200 OK):
{
  "status": "success",
  "message": "Compra actualizada correctamente"
}
Eliminar una compra

Endpoint: DELETE /purchases/{id_purchase}
Descripción: Elimina una compra de la base de datos.
Parámetros de ruta:
{id_purchase}: ID de la compra.
Respuesta exitosa (200 OK):
{
  "status": "success",
  "message": "Compra eliminada correctamente"
}
