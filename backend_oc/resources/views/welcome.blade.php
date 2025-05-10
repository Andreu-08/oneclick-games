<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API | OneClick Games</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            padding: 2rem;
        }

        .container {
            max-width: 600px;
            background-color: #1e293b;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #38bdf8;
        }

        p {
            font-size: 1.125rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .tag {
            display: inline-block;
            background-color: #0ea5e9;
            color: #fff;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.875rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container" role="main">
        <h1>OneClick Games API 🎮</h1>
        <p>
            Bienvenido a la API oficial de <strong>OneClick Games</strong>, la plataforma web de juegos accesibles y sencillos, pensada para todas las personas, incluyendo aquellas con discapacidad física o cognitiva.
        </p>
        <p>
            Esta API sirve como motor de la aplicación, gestionando usuarios, puntuaciones y rankings de los juegos.
        </p>
        <div class="tag">v1.0 - Laravel + Postgres</div>
    </div>
</body>
</html>
