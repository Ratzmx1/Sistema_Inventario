# EndPoints

---
## Rutas Usuario
### Sin Middleware
* ~~Login :   /user/Login~~

* registro: /user/Registro

### Admin Middleware
* Ver solicitudes de registro: /user/solicitudes  - Get
* ~~Ver usuarios registrados: /user - GET~~

* Activar Cuenta: /user/activar - POST (id)
* Actualizar Rol: /user/role - POST (id, role_id)

### User Middleware
* Actualizar Contraseña: /user/change/password

* Actualizar Correo: /user/change/email
* Cerrar Cuenta: /user/change/status
---
## Rutas Proveedor
### User Middleware
* ~~Agregar Proveedor: /provider - POST(name, address, phone)~~

* ~~Ver Proveedores: /provider - GET~~
* Actualizar Proveedor: /provider/update - POST(name, address, phone)
---
## Rutas Categoria
### User Middleware
* ~~Agregar Categoria: /category/create - POST (name)~~

* ~~Ver Categorias: /category - GET~~
* Actualizar Categorias: /category/update - POST (name)
* Cambiar Status Categorias: /category/update/status - POST (status)
---
## Rutas SubCategoria
### User Middleware
* ~~Ver SubCategoria: /subcategory - GET~~

* Actualizar: /subcategory/update - POST (name)
* ~~Agregar SubCategoria: /subcategory/create - POST (name)~~
* Cambiar Status: /subcategory/update/status - POST (id, status)
* Cambiar Categoria : /subcategory/update/category - POST (id, id_category)
---
## Rutas Producto
### User Middleware
 ~~Ver Producto: /product/<id_product> - GET~~

 ~~Ver Productos: /product - GET~~
 * Actualizar Status: /product/update/status - POST (id, status)
 ~~Agregar Producto: /product/create - POST (name, id_subcategory, marca, stock_min)~~
 * Actualizar Nombre:  /product/update/name - POST (id, name)
 * Actualizar Stock Minimo: /product/update/min_stock - POST (id, min_stock)
 * Actualizar SubCategoria : /product/update/subcategory - POST (id, id_category)
---
## Rutas Entrada
### User Middleware
* ~~Ver Entradas: /check_in - GET~~

* ~~Crear Entrada: /check_in/create - POST (provider_id, n_guia, user_id,  array( [id_products, quantity] ) )~~
* TODO : VER ACTUALIZACION
---
## Rutas Salida
### User Middleware
* ~~Ver salidas: /check_out - GET~~

* ~~Crear Salida: /check_out/create - POST (id_user,  array( [id_products, quantity] ) )~~
* TODO : VER ACTUALIZACION
---
## Rutas Detalle Entrada
### User Middleware
* ~~Ver Detalle Entrada: /check_in_detail/<id_check_in> - GET~~

---
## Rutas Detalle Salida
### User Middleware
* ~~Ver Detalle Salida: /check_out_detail/<id_check_out> - GET~~

