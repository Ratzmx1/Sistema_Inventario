# EndPoints

---
## Rutas Usuario
### Sin Middleware
* ~~Login :   /login~~

* registro: /user/Registro

### Admin Middleware
* ~~Ver cuentas inactivas: /user/inactive  - Get~~
* ~~Ver usuarios registrados: /user - GET~~

* ~~Activar Cuenta: /user/activate - POST (id)~~
* Actualizar Rol: /user/role - POST (id, role_id)

### User Middleware
* Actualizar Contraseña: /user/change/password

* Actualizar Correo: /user/change/email
* ~~Cerrar Cuenta: /user/deactivate~~
---
## Rutas Proveedor
### User Middleware
* ~~Agregar Proveedor: /provider/add - POST(name, address, phone)~~

* ~~Ver Proveedores: /provider - GET~~
* ~~Actualizar Proveedor: /provider/update - POST(name, address, phone)~~
---
## Rutas Categoría
### User Middleware
* ~~Agregar Categoria: /category/add - POST (name)~~

* ~~Ver Categorias: /category - GET~~
* ~~Actualizar Categorias: /category/update - POST (name)~~
* Desactivar Categorias: /category/deactivate - POST (status)
---
## Rutas SubCategoria
### User Middleware
* ~~Ver SubCategoria: /subcategory - GET~~

* ~~Actualizar: /subcategory/update - POST (name)~~
* ~~Agregar SubCategoria: /subcategory/add - POST (name)~~
* Desactivar subcategoria: /subcategory/update/status - POST (id, status)
* ~~Cambiar Categoria : /subcategory/update - POST (id, id_category)~~
---
## Rutas Producto
### User Middleware
 * ~~Ver Productos: /product - GET~~
 * ~~Actualizar: /product/update - UPDATE~~
 * ~~Agregar Producto: /product/create - POST (name, id_subcategory, marca, stock_min)~~
 * Desactivar Producto: /product/deactivate - POST
---
## Rutas Entrada
### User Middleware
* ~~Ver Entradas: /check_in - GET~~

* ~~Crear Entrada: /check_in/add - POST (provider_id, n_guia, user_id,  array( [id_products, quantity] ) )~~
* ~~Actualizar: /check_in/update - UPDATE~~
---
## Rutas Salida
### User Middleware
* ~~Ver salidas: /check_out - GET~~

* ~~Crear Salida: /check_out/add - POST (id_user,  array( [id_products, quantity] ) )~~
* * ~~Actualizar: /check_out/update - UPDATE~~
---
## Rutas Detalle Entrada
### User Middleware
* ~~Ver Detalle Entrada: /check_in/detail/<id_check_in> - GET~~

---
## Rutas Detalle Salida
### User Middleware
* ~~Ver Detalle Salida: /check_out/detail/<id_check_out> - GET~~

