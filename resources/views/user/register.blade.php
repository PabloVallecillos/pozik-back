<!doctype html>
<html lang="{{ $user->locale }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>

    <style>
        /*  */
        body {
            background-color: #f8f8f8;
            color: #333;
        }

        /* dark */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #333;
                color: #f8f8f8;
            }
        }
    </style>
</head>
<body>
<div style="max-width: 600px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">
    <h1 style="text-align: center;">¡Bienvenido, {{ $user->name }}!</h1>

    <p style="text-align: justify;">
        Gracias por registrarte en nuestro sitio web. ¡Estamos emocionados de tenerte como parte de nuestra comunidad!
    </p>

    <p style="text-align: justify;">
        A partir de ahora, podrás disfrutar de todos los beneficios de ser miembro de nuestro sitio.
    </p>

    <p style="text-align: center;">
        <strong>¡Que disfrutes tu experiencia con nosotros!</strong>
    </p>

    <p style="text-align: center;">
        Equipo de {{ config('app.name') }}
    </p>
</div>
</body>
</html>
