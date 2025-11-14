<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Eliminado</title>
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
            background-color: #dc3545;
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
            background-color: #f8f9fa;
            color: #66800a;
            padding: 15px;
            text-align: center;
            font-size: 12px;
        }
        .project-title {
            background-color: #f8f9fa;
            padding: 10px;
            border-left: 4px solid #dc3545;
            margin: 15px 0;
            font-weight: bold;
        }
        .info-box {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 4px;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Proyecto Eliminado</h1>
        </div>
        <div class="email-body">
            <h2>Hola {{ $hostName }},</h2>
            <p>
                Nos comunicamos para informarle que su proyecto ha sido eliminado de nuestra plataforma.
            </p>
            
            <div class="project-title">
                Proyecto eliminado: {{ $projectTitle }}
            </div>

            <div class="info-box">
                <strong>¿Por qué fue eliminado?</strong>
                <p style="margin: 10px 0 0 0;">
                    Su proyecto fue revisado por nuestro equipo de administración y fue eliminado por no cumplir con nuestras políticas de la plataforma o por otras razones administrativas.
                </p>
            </div>

            <p>
                Si considera que esto es un error o desea más información sobre la eliminación, puede contactarnos respondiendo a este correo.
            </p>

            <p>
                Agradecemos su participación en Volunteco y esperamos poder seguir colaborando en futuros proyectos.
            </p>

            <p style="margin-top: 30px;">
                Saludos cordiales,<br>
                <strong>El equipo de Volunteco</strong>
            </p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Volunteco. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>