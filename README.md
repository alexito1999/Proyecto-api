<h1 align="center">Contenido</h1>

**carpeta src**: Donde guardo la Api-Restful.

**Docker-compose**: Usado para configurar las conexiones con php y msql para ser dockerizado. 

**Dockerfile**: Usado para configurar el php.

## Tabla de Contenido de la SRC
- [API](#api)
- [Configuración](#config)
- [Middleware](#/middleware)
- [Modelos](#models)
### API
- [estudiantes](src/api/estudiantes/index.php)
- [asignaturas](src/api/asignaturas/index.php)
- [calificaciones](src/api/calificaciones/index.php)
- [inscripciones](src/api/inscripciones/index.php)
- [profesores](src/api/profesores/index.php)
### Configuración
- [estudiantes](src/api/estudiantes/index.php)
- [asignaturas](src/api/asignaturas/index.php)
- [calificaciones](src/api/calificaciones/index.php)
- [inscripciones](src/api/inscripciones/index.php)
- [profesores](src/api/profesores/index.php)
### Middleware
- [middleware](src/middleware/config.php)
### Modelos
- [estudiantes](src/api/estudiantes/estudiantes.php)
- [asignaturas](src/api/asignaturas/asignaturas.php)
- [calificaciones](src/api/calificaciones/calificaciones.php)
- [inscripciones](src/api/inscripciones/inscripciones.php)
- [profesores](src/api/profesores/profesores.php)


<h1 align="center">FUNCIONAMIENTO</h1>

<h3>Tenemos cuatro carpetas principales:</h3>

**Midleware**: Se guarda la conexion a base de datos con la api y se creamos la funcion para ejecutar las consultas sql.

**Config**: Se guarda lasa variables para conectar con la base de datos como por ejempo usuario y contraseña.

**API**: Donde albergo las carpetas de cada uno de los componentes de mi api desde los cuales tengo en index principal que servira para hacer las llamadas a mis funciones como son:
GET, POST, DELETE Y PUT.

**Modelos**: Tengo las funciones que realizan las consultas sql.


<h3>Explicacion sustancial de las carpetas mas importantes</h3>

**API**: Aqui se encuentra el "index.php" que se usara para hacer las llamadas y probar nuestros metodos POST, GET ... 
Vamos a poner como ejemplo el index de profesor porque los demas se  replicaron con el mismo modelo.
- [profesores](src/api/profesores/index.php)
  El index cuenta con la ruta relativa de donde estan la funciones para ello instancio un objeto de esa clase para poder usar sus funciones.
  Usando este metodo: $method = $_SERVER["REQUEST_METHOD"]; puedo crear un switch poniendo como soluciones las 4 funciones que necesitaremos que son GET, POST, DELETE Y PUT.
  En cada una de estas opciones colocamos la funcion que necesitemos.
  


  

<h2 align="left">Explicacion estudiantes/profesor</h2>
E
