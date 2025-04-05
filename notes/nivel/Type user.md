# Niveles/Tipos de usuario
- Personal de atención al cliente (frontline, customer service)
- Personal de cocina (kitchen staff)

# Sistema de acceso cerrado
Los usuarios de la aplicación son los que se encuentran creados en la base de datos. Los nuevos usuarios deben 
ser creados directamente por algun tipo de administrados de la apliacion o directamente por base de datos.
No tiene página ruta de registro de nuevos usuarios.

# Estructura inicial de la base de datos
- users
- tables -> Mesas del restaurante
  - id
  - name -> Nombre de la mesa
- menu_entries -> Patos, bebidas y productos que se puedan ordenar
  - id
  - name -> Nombre del producto
  - description -> Descripción del producto
  - price -> Precio del producto
- orders -> Los platos/productis que se han ordenado en una mesa
  - id
  - table_id -> id de la mesa
  - menu_entry_id -> id del producto
  - quantity -> Cantidad del producto

