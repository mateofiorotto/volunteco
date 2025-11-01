# Volunteco

Página Web para el proyecto final de la carrera de Diseño y Programación web en Escuela Da Vinci.
Volunteco es una web acerca de voluntariados de carácter ecológico donde participan voluntarios y anfitriones.

## Estudiantes

- Fiorotto Mateo
- Bento Herminia

## Tecnologias usadas

- Laravel 12
- Bootstrap
- CSS
- HTML

## Como usar

1. Instalar PHP y Composer
2. Configurar variables de entorno en .env (crear archivo similar a .env.example)
3. Crear base de datos con el nombre utilizado en el .env (nombre por defecto "volunteco")
4. Entrar al proyecto con "cd volunteco" y ejecutar EN ORDEN:
    - "composer install" para traer dependencias necesarias
    - "php artisan storage:link" para crear enlace con la carpeta de imagenes
    - "php artisan migrate:fresh --seed" para crear la base de datos mediante eloquent y cargar datos por defecto (chequear seeders)
    - "php artisan serve" para ejecutar el proyecto
5. Entrar en localhost:puerto

## Funcionalidades

### Funcionalidades generales

- **Autenticación**: Se hace uso de Laravel Breeze como base pero con modificaciones. Los usuarios pueden registrarse como anfitriones o voluntarios.
    - Voluntarios: Se registran libremente con la condición de ser mayores de edad y solo una cuenta única (limitado por DNI y mail).
    - Anfitriones: Los anfitriones crean su cuenta limitados por CUIT y mail. El perfil del anfitrión queda en PENDIENTE y no se le permite iniciar sesión hasta estar habilitado.
- **Perfiles**: al registrase, los datos de acceso del usuario quedan en la tabla de "users" y los de perfil en otra tabla separada (dependiendo del tipo de usuario, puede ser la tabla volunteers o la de hosts) que guarda una relación con la tabla de usuarios. Se puede acceder al perfil público de voluntarios o anfitriones y ver ciertos datos.
- **Manejo de imágenes**: Se hacen uso de imagenes por defecto si el usuario no carga cuando se le piden. En caso de cargar se suben imagenes a la carpeta del servidor y se usan mediante un string de referencia. Si el usuario la edita, se borra la imagen vieja y se sube la nueva. Si el usuario elimina algo que tenga imagenes dinamicas en la web se borra de la carpeta del servidor. Esto aplica a perfiles de voluntarios, de anfitriones y a proyectos por el momento.
- **Envio de mails**: Se envian mail a los usuarios para notificar algunas acciones:
    - Cuando se elimina el perfil (a los voluntarios se les envia un mail generico y a los aniftriones algo más detallado con un mensaje personalizado).
    - Al aceptar el perfil de un anfitrion.
    - Al deshabilitar el perfil de un anfitrion / voluntario (a los voluntarios se les envia mail generico y a los anfitriones un mensaje personalizado).
    - Recordatorio de perfil deshabilitado a anfitriones.
- **Validaciones de datos**: Se usan validaciones de laravel para entrada de datos o ediciones.
- **Alertas**: Se utilizan alertas para indicar errores al usuario (errores de validación o login por ejemplo).
- **Soft Deletes**: Se usan soft deletes para no perder información que puede haberse borrado por error.
- **Edición de perfil propio**: Los anfitriones y voluntarios pueden modificar su perfil.

### Funcionalidades para administradores
- **Administración de perfiles**: Los administradores pueden revisar los perfiles de anfitriones y voluntarios. Se pueden deshabilitar, re-habilitar y eliminar.
- **Verificación de perfiles de anfitriones**: Los administradores pueden los perfiles de los anfitriones que se registren para comprobar que tienen un proyecto con suficiente respaldo o son una organización seria. En caso de ser rechazados se les envia un mail con una descripción de datos a cambiar y un link con un formulario para cambiar esos datos.

### Funcionalidades para anfitriones
- **Administración de proyectos propios**: Los anfitriones tienen la posibilidad de publicar y administrar sus proyectos.
- **Filtros**: Hay algunos filtros que vienen predefinidos a la hora de crear o editar proyectos (tipo de proyecto, condiciones y horas de trabajo).
- **Aceptar o Rechazar anfitriones**: Los anfitriones pueden ver que anfitriones aplicaron a su proyecto y aceptarlos o rechazarlos.

### Funcionalidades para voluntarios
- **Aplicación y seguimiento a proyectos**: Los voluntarios tienen la posibilidad de ver el listado de proyectos, ver el detalle y aplicar a los mismos. También tienen la posibilidad de desistir del proyecto solo si no fueron rechazados.

### Funcionalidades a implementar próximamente (pre-tesis --> mover despues a implementadas)
- **API de localidad**: Se implementará para que sea mas sencillo seleccionar una ubicación a la hora de crear proyectos o registrarse y también evitar errores. 
- **Mapa**: Será utilizado para reflejar la ubicación de proyectos
- **Gamificación**: Los voluntarios y anfitriones tendrán insignias en su perfil, las que podrán obtener por medio de un sistema basado en evaluaciones y puntuaciones por parte de sus anfitriones. El objetivo es aportar un mayor dinamismo a la plataforma y de la mano de anteriores funcionalidades, poder aportar seguridad mediante insignias o nivel numerico.
- **Listado de TODOS los proyectos en el dashboard**: En el administrador se mostraran todos los proyectos de todos los administradores separados por estado.
- **Busqueda por buscador y filtros de proyectos en el listado (para voluntarios)**: Se podrán filtrar y buscar proyectos mediante una barra de busqueda y un menú.
- **Paginación**: Se implementará principalmente en el listado de proyectos (tanto para dashboard y frontend), en el listado de usuarios y de aplicantes a proyectos.

### Funcionalidades a implementar próximamente (tesis)
- **Blog con noticias sobre la aplicación (administradores)**: Los administradores podran publicar noticias de la aplicacion y cosas relacionadas a ecologia o voluntariado.
- **Metodo de comunicacion dentro de la plataforma**: Una vez el voluntario sea aceptado en un proyecto, se le va a proveer los datos de contacto del anfitrion y viceversa. También habrá un sistema estilo preguntas de mercadolibre de pregunta y respuesta o mensaje ida y vuelta.
- **Donaciones con metas**: Se implementaran donaciones con metas que pueden ser cambiadas por administradores.
- **Venta de merchandising**: Se implementara venta de articulos de la marca en la web.
- **MercadoPago**: Se implementara como pasarela de pago para solventar el tema de las donaciones y la venta de merchandising.
- **Manejo de tipos de proyectos**
- **Manejo de condiciones**
- **Creacion de usuarios administradores**