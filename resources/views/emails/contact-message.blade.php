<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Nuevo mensaje de contacto</title>
    <style>
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
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #66800A;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 22px;
        }

        .email-body {
            padding: 24px 28px;
            color: #1e1e1e;
            line-height: 1.6;
        }

        .email-body p.intro {
            margin-top: 0;
            color: #555;
        }

        .field-label {
            font-weight: bold;
            color: #66800A;
            margin-top: 18px;
            display: block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .field-value {
            margin: 6px 0 0 0;
            padding: 10px 14px;
            background-color: #f4f4f4;
            border-left: 4px solid #66800A;
            border-radius: 3px;
            white-space: pre-wrap;
        }

        .email-footer {
            background-color: #66800A;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Nuevo mensaje de contacto</h1>
        </div>
        <div class="email-body">
            <p class="intro">Se recibió un nuevo mensaje a través del formulario de contacto.</p>

            <span class="field-label">Nombre</span>
            <p class="field-value">{{ $data['name'] }}</p>

            <span class="field-label">Correo electrónico</span>
            <p class="field-value">{{ $data['email'] }}</p>

            <span class="field-label">Asunto</span>
            <p class="field-value">{{ $data['subject'] }}</p>

            <span class="field-label">Mensaje</span>
            <p class="field-value">{{ $data['message'] }}</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} Volunteco. Todos los derechos reservados.
        </div>
    </div>
</body>

</html>
