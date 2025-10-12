# Volunteco

Web para el proyecto final de la carrera de Diseño y Programación web en Escuela Da Vinci.
Volunteco es una web acerca de voluntariados de carácter ecológico donde participan voluntarios y anfitriones.

## Estudiantes
- Fiorotto Mateo
- Bento Herminia

## Tecnologias usadas
- React
- Laravel 12
    - Laravel Breeze
- Tailwind 4
- HTML 5

## Como usar
1. Instalar NPM, PHP y Composer
2. Entrar al proyecto con "cd volunteco" y ejecutar "npm install && npm run build" y "composer install"
3. Crear DB "volunteco" y ejecutar php artisan migrate
4. Ejecutar en dos consolas distintas "npm run dev" y "php artisan serve" y entrar en localhost:puerto

Commit: Agregando manejo de perfiles de anfitriones. Agregando seeder al ejecutar migraciones para agregar un usuario admin. Simplificación en laravel breeze. Agregando middleware para chequear si esta logueado y si el perfil esta o no activado.

HOY: Manejo de perfiles de anfitriones. Simplificar breeze (quitado recuperar contraseña y verificacion de mail). 

Mas adelante: modificar perfil. logica de guardado de imgs. posible logica de envio de mails al aceptar o denegar perfil. Estilos formularios. Validar que nombres no tenga numeros o caracteres raros, lo mismo con dni, cuit y demas campos.

RAMAS: 
- autenticacion (registro, login y edicion de perfiles. Verificacion de perfiles) 
- layout
- administracion (en caso de hacer dashboard con estadisticas o blog de noticias)
- sistema_voluntariado (aplicacion, creacion, edicion, etc de proyectos)
- sistema_gamificacion (despues de sist de voluntariado)
- internalizacion (i18n --> para traduccion de alertas y errores)
- paginacion

ejemplo estructura
resources/js/
├── Layouts/
│   ├── AppLayout.tsx          # Layout para usuarios autenticados
│   ├── GuestLayout.tsx        # Layout para login/register
│   └── AdminLayout.tsx        # Layout para admin 
│
├── Components/
│   ├── ui/                 
│   │   ├── Button.tsx
│   │   ├── Input.tsx
│   │   ├── Modal.tsx
│   │   ├── Card.tsx
│   │   └── Badge.tsx
│   │
│   ├── Navbar.tsx
│   ├── Sidebar.tsx
│   ├── Footer.tsx
│   ├── UserMenu.tsx
│   └── VoluntarioCard.tsx
│
└── Pages/
    ├── Auth/
    │   ├── Login.tsx
    │   └── Register.tsx
    ├── Profile/
    │   └── Edit.tsx
    ├── Dashboard.tsx
    ├── Home.tsx
    └── Voluntarios/
        ├── Index.tsx
        ├── Show.tsx
        └── Create.tsx

