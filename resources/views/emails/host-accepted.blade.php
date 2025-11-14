<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación</title>
    <style>
        /* Estilos básicos, inline preferido para compatibilidad */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .email-header {
            background-color: #f8f9fa;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 20px;
            color: #1e1e1e;
            line-height: 1.6;
        }
        .email-footer {
            background-color: #66800A;
            color: #66800a;
            padding: 15px;
            text-align: center;
            font-size: 12px;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #4CAF50;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Volunteco te da la bienvenida!</h1>
        </div>
        <div class="email-body">
            <h2>Hola {{ $hostFullName }},</h2>
            <p>
                Nos contactamos para informarle que su perfil de anfitrión ha sido aprobado.
            </p>
            <p>
                Si tiene algún problema, no dude en contactarse con nosotros a esta misma dirección de correo.
            </p>
            <p>
                Gracias por usar nuestra plataforma. Te esperamos!.
            </p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Volunteco. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
