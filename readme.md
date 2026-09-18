# CRUD de Productos con PHP y MariaDB

## Descripción general

Este proyecto desarrolla una aplicación de gestión de productos mediante el patrón CRUD (Create, Read, Update, Delete) utilizando PHP, MariaDB y XAMPP. La estructura permite registrar artículos, consultar el stock, actualizar datos y eliminar registros de una tabla llamada productos.

La aplicación incluye las siguientes operaciones:
- creación de registros
- listado de productos
- modificación de datos existentes
- eliminación de registros
- conexión con una base de datos MariaDB/MySQL

Los conceptos principales trabajados en el proyecto son:
- bases de datos relacionales
- lenguaje SQL
- uso de PHP para procesamiento del lado servidor
- formularios HTML para interacción con el usuario
- conexión entre la interfaz web y la base de datos

---

## ¿Qué es un CRUD?

CRUD significa:
- C = Create (Crear)
- R = Read (Leer)
- U = Update (Actualizar)
- D = Delete (Eliminar)

En este proyecto, CRUD se aplica a una tabla llamada productos.

Ejemplo de una entidad de datos:
- id
- articulo
- descripcion
- unidades_disponibles

---

## Tecnologías utilizadas

- PHP 8
- MariaDB / MySQL
- HTML
- CSS
- Bootstrap 5
- XAMPP

---

## Estructura del proyecto

Los archivos principales son:

- index.php: página principal con menú inicial
- setup.php: crea la base de datos y la tabla si no existen
- conexion.php: conexión a la base de datos
- crear.php: formulario y lógica para crear productos
- ver.php: muestra todos los productos en tabla
- modificar.php: permite editar un producto
- eliminar.php: elimina un producto por su id
- styles.css: estilos personalizados
- tienda.sql: script SQL para crear la estructura de la base de datos

---

## Base de datos

La base de datos que se usa es:
- nombre: tienda

La tabla es:
- nombre: productos

### Estructura de la tabla productos

```sql
CREATE TABLE productos (
    id INT NOT NULL AUTO_INCREMENT,
    articulo VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    unidades_disponibles INT NOT NULL,
    PRIMARY KEY (id)
);
```

### Explicación de cada campo

- id: identifica cada producto. Es la clave primaria y se incrementa automáticamente.
- articulo: nombre del producto o artículo.
- descripcion: detalle del producto.
- unidades_disponibles: cantidad disponible en stock.

---

## Cómo funciona la aplicación

### 1. Inicio
Al entrar a la aplicación, se muestra un menú con opciones para:
- crear base de datos
- crear producto
- ver productos

### 2. Crear base de datos
El archivo setup.php ejecuta una serie de sentencias SQL para crear la base de datos si no existe.

Ejemplo de lógica:

```php
CREATE DATABASE IF NOT EXISTS tienda;
```

Luego crea la tabla productos si tampoco existe.

### 3. Conexión a la base de datos
El archivo conexion.php usa PDO para conectarse a MariaDB/MySQL.

```php
$conexionbd = new PDO(
    "mysql:host=$host;dbname=$db;charset=utf8mb4",
    $user,
    $pass,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);
```

PDO es una forma segura y moderna de conectarse a bases de datos.

### 4. Crear producto
En crear.php se arma un formulario con:
- artículo
- descripción
- unidades disponibles

Cuando el usuario envía el formulario, el servidor recibe los datos y ejecuta:

```php
INSERT INTO productos (articulo, descripcion, unidades_disponibles)
VALUES (?, ?, ?)
```

Se usan consultas preparadas para evitar inyección SQL.

### 5. Leer productos
En ver.php se ejecuta:

```php
SELECT * FROM productos ORDER BY id DESC
```

Esto devuelve todos los registros de la tabla y luego se muestran en una tabla HTML.

### 6. Modificar producto
En modificar.php se busca el producto por su id y se muestra un formulario con sus datos actuales.

Cuando el usuario cambia la información, se ejecuta un UPDATE:

```php
UPDATE productos
SET articulo = ?, descripcion = ?, unidades_disponibles = ?
WHERE id = ?
```

### 7. Eliminar producto
En eliminar.php se recibe el id del producto y se hace:

```php
DELETE FROM productos WHERE id = ?
```

Con esto se borra el registro seleccionado.

---

## Flujo completo del proyecto

El flujo de trabajo de la app es este:

1. Se crea la base de datos con setup.php
2. Se usa conexion.php para conectarse
3. El usuario llena un formulario de creación
4. PHP envía la información a MariaDB
5. La base de datos guarda los datos
6. La tabla se muestra en ver.php
7. El usuario puede editar o borrar registros

---

## Requisitos para ejecutar el proyecto

Necesitás tener instalado:
- XAMPP
- Apache activado
- MySQL/MariaDB activado
- PHP habilitado

---

## Cómo levantar el proyecto en XAMPP

### Opción 1: automática con setup.php
1. Abrir XAMPP
2. Iniciar Apache y MySQL
3. Copiar la carpeta del proyecto dentro de:
   - C:\xampp\htdocs\
4. Entrar a la URL:
   - http://localhost/CRUD_POST/
5. Hacer clic en "Crear base de datos"
6. Luego usar la aplicación

### Opción 2: importar la base de datos manualmente
1. Abrir phpMyAdmin
2. Crear la base de datos llamada tienda
3. Importar el archivo tienda.sql
4. Ubicar la carpeta en htdocs
5. Entrar en la aplicación desde el navegador

---

## URL de acceso

Si la carpeta del proyecto se llama CRUD_POST, la URL habitual será:

```text
http://localhost/CRUD_POST/
```

---

## Archivo SQL

El archivo tienda.sql contiene el script de creación de la tabla productos y un registro inicial de ejemplo.

Ejemplo:

```sql
INSERT INTO productos (articulo, descripcion, unidades_disponibles)
VALUES ('Aceite', 'Producto de girasol', 20);
```

Esto ayuda a probar la aplicación enseguida.

---

## Objetivos de aprendizaje

Durante el desarrollo de esta práctica se abordan los siguientes contenidos:

- concepto de tabla en una base de datos
- uso de clave primaria
- funcionamiento de id autoincremental
- inserción de datos desde un formulario web
- lectura de registros desde una base de datos
- uso de sentencias UPDATE y DELETE
- manipulación de información mediante SQL

---

## Conceptos trabajados

El proyecto permite comprender:
- fundamentos de bases de datos
- trabajo con formularios HTML
- envío de datos mediante POST
- interacción entre PHP y MySQL
- consultas SQL básicas
- organización de una aplicación web pequeña
- buenas prácticas básicas de programación

---

## Buenas prácticas implementadas

- uso de PDO para la conexión
- consultas preparadas
- validación básica de campos
- control de números negativos en stock
- mensajes informativos para el usuario
- uso de Bootstrap para una interfaz más clara

---

## Consideraciones para su uso

El proyecto se presenta como una práctica de introducción a la programación web con acceso a base de datos. Para reforzar la comprensión de cada operación, se recomienda explicar cada bloque de código con ejemplos sencillos y relacionarlos con el flujo real de datos.

Algunos puntos de análisis útiles son:
- qué realiza un SELECT
- qué realiza un INSERT
- cuál es la función del id
- por qué es necesario validar los datos ingresados
- cómo se representa una tabla en una base de datos

---

## Resumen

El proyecto es una introducción práctica a la programación web con acceso a bases de datos. A través de un CRUD básico, se puede observar de forma clara cómo se registran, consultan, actualizan y eliminan datos en una tabla usando PHP y MariaDB.

Los temas principales desarrollados son:
- backend
- SQL
- formularios web
- conexión entre la interfaz y la base de datos
- lógica de una aplicación CRUD

---

## Autoría

Desarrollo realizado para uso docente y de práctica en entornos locales con XAMPP.

---

## Nota final

La aplicación está diseñada para funcionar en XAMPP con MariaDB/MySQL en un entorno local. Su enfoque principal es la comprensión de conceptos básicos de bases de datos y programación web en un contexto práctico y accesible.
⚖️ Licencia y Limitación de Responsabilidad Este proyecto está publicado bajo la licencia GNU General Public License v3.0 (GPL-3.0). Podés consultar los términos completos en el archivo LICENSE.

¿Qué significa esto para las clases y proyectos? Libertad de uso: Sos libre de descargar, modificar, usar y distribuir este código para tus trabajos prácticos, proyectos personales o profesionales. Código abierto obligado: Si modificás este software y decidís compartirlo o publicarlo, estás obligado a hacerlo de forma pública y bajo esta misma licencia GPLv3. Sin garantías ("As Is"): El software se entrega tal cual está, con fines puramente educativos. No se ofrece ninguna garantía de funcionamiento. Exención de responsabilidad: El autor no se hace responsable por códigos que no compilen, fallas en el sistema, ni por cualquier daño físico o rotura de componentes de hardware (como placas Arduino, sensores o actuadores) derivados del uso de este programa. El uso corre por cuenta y riesgo del usuario.
