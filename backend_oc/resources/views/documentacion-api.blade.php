<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Documentación API | OneClick Games</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #0f172a, #1e293b);
      color: #f1f5f9;
      padding: 2rem;
    }
    h1, h2 {
      color: #38bdf8;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background-color: #1e293b;
      padding: 2rem;
      border-radius: 16px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }
    .endpoint {
      border-left: 5px solid #38bdf8;
      margin: 2rem 0;
      padding: 1rem;
      background-color: #0f172a;
      border-radius: 8px;
    }
    summary {
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
      color: #0ea5e9;
    }
    .tag {
      display: inline-block;
      background-color: #334155;
      color: #fff;
      padding: 0.2rem 0.6rem;
      border-radius: 999px;
      font-size: 0.75rem;
      margin-left: 0.5rem;
    }
    pre {
      background: #1e293b;
      padding: 1rem;
      border-radius: 8px;
      overflow: auto;
      color: #f8fafc;
    }
    details[open] summary::after {
      content: "▲";
      float: right;
    }
    summary::after {
      content: "▼";
      float: right;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Documentación API - OneClick Games 🎮</h1>
    <p>Documentación completa de los endpoints disponibles en la API. Incluye métodos, descripción, respuestas esperadas y códigos HTTP.</p>

    <!-- AUTENTICACIÓN -->
    <div class="endpoint">
      <details>
        <summary>POST /auth/login <span class="tag">Public</span></summary>
        <p>Inicia sesión o registra al usuario automáticamente.</p>
        <pre><strong>Request:</strong>
{
  "nickname": "juanito",
  "pin": "1234"
}</pre>
        <pre><strong>Response 200:</strong>
{
  "access_token": "token",
  "token_type": "Bearer",
  "user": { "id": 1, "nickname": "juanito" },
  "registered": true
}</pre>
        <p><strong>Status:</strong> 200 OK / 201 Created</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>GET /auth/profile <span class="tag">Auth</span></summary>
        <p>Devuelve los datos del usuario autenticado.</p>
        <pre><strong>Response:</strong>
{
  "user": {
    "id": 1,
    "nickname": "juanito"
  }
}</pre>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>POST /auth/logout <span class="tag">Auth</span></summary>
        <p>Cierra sesión y revoca el token actual.</p>
        <pre><strong>Response:</strong>
{
  "message": "Sesión cerrada correctamente"
}</pre>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>

    <!-- JUEGOS -->
    <div class="endpoint">
      <details>
        <summary>GET /games <span class="tag">Public</span></summary>
        <p>Lista todos los juegos activos.</p>
        <pre><strong>Response:</strong>
[
  {
    "id": 1,
    "title": "Memoria",
    "description": "Juego de emparejar cartas",
    "url": "/games/memoria",
    "difficulty_levels": ["fácil", "medio", "difícil"],
    "image_url": "/img/memoria.webp"
  }
]</pre>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>GET /games/{id} <span class="tag">Public</span></summary>
        <p>Devuelve los detalles de un juego específico.</p>
        <pre><strong>Response:</strong>
{
  "id": 1,
  "title": "Memoria",
  "description": "Juego de emparejar cartas",
  "url": "/games/memoria",
  "difficulty_levels": ["fácil", "medio"],
  "is_active": true,
  "created_at": "2025-05-01T12:34:56Z"
}</pre>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>POST /games <span class="tag">Admin</span></summary>
        <p>Crea un nuevo juego (requiere autenticación admin).</p>
        <pre><strong>Request:</strong>
{
  "title": "Juego nuevo",
  "description": "Descripción opcional",
  "difficulty_levels": ["fácil", "difícil"]
}</pre>
        <pre><strong>Response:</strong>
{
  "message": "Juego creado correctamente",
  "game": {
    "id": 2,
    "title": "Juego nuevo",
    "description": "Descripción opcional"
  }
}</pre>
        <p><strong>Status:</strong> 201 Created</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>PUT /games/{id} <span class="tag">Admin</span></summary>
        <p>Actualiza un juego existente.</p>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>PATCH /games/{id}/desactivate <span class="tag">Admin</span></summary>
        <p>Desactiva un juego activo.</p>
        <pre><strong>Response:</strong>
{
  "message": "Juego desactivado correctamente"
}</pre>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>PATCH /games/{id}/activate <span class="tag">Admin</span></summary>
        <p>Activa un juego previamente desactivado.</p>
        <pre><strong>Response:</strong>
{
  "message": "Juego reactivado correctamente"
}</pre>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>

    <!-- SCORES -->
    <div class="endpoint">
      <details>
        <summary>POST /scores <span class="tag">Auth</span></summary>
        <p>Guarda una puntuación del usuario autenticado.</p>
        <pre><strong>Request:</strong>
{
  "game_id": 1,
  "score": 85,
  "duration": 120
}</pre>
        <pre><strong>Response:</strong>
{
  "message": "Puntuación guardada",
  "score": {
    "id": 20,
    "user_id": 3,
    "game_id": 1,
    "score": 85,
    "duration": 120
  }
}</pre>
        <p><strong>Status:</strong> 201 Created</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>GET /scores/top <span class="tag">Auth</span></summary>
        <p>Ranking global de usuarios por puntuación total.</p>
        <pre><strong>Response:</strong>
{
  "ranking": [
    { "id": 1, "nickname": "ana", "total_score": 215 }
  ]
}</pre>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>GET /scores/global/me <span class="tag">Auth</span></summary>
        <p>Ranking y puntuación total del usuario autenticado.</p>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>GET /scores/game/{id}/top <span class="tag">Auth</span></summary>
        <p>Top 10 usuarios por juego específico.</p>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>GET /scores/game/{id}/me <span class="tag">Auth</span></summary>
        <p>Puntuación total del usuario en ese juego.</p>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>

    <!-- USERS -->
    <div class="endpoint">
      <details>
        <summary>GET /users <span class="tag">Admin</span></summary>
        <p>Lista todos los usuarios registrados.</p>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>GET /users/{id} <span class="tag">Admin</span></summary>
        <p>Devuelve datos básicos del usuario por ID.</p>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>GET /users/register/{nickname} <span class="tag">Public</span></summary>
        <p>Busca un usuario por su nickname.</p>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>
    <div class="endpoint">
      <details>
        <summary>DELETE /users/me <span class="tag">Auth</span></summary>
        <p>Elimina la cuenta y cierra sesión.</p>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>

    <!-- WORD -->
    <div class="endpoint">
      <details>
        <summary>GET /palabra <span class="tag">Public</span></summary>
        <p>Devuelve una palabra aleatoria para juegos como \"Ordenar Palabras\".</p>
        <pre><strong>Response:</strong>
{
  "word": "sol"
}</pre>
        <p><strong>Status:</strong> 200 OK</p>
      </details>
    </div>

    <p style="margin-top: 3rem; font-size: 0.9rem; color: #94a3b8;"> API v1.0</p>
  </div>
</body>
</html>
