<?php

return [

    'paths' => ['api/*', 'loginChat'], // Ajuste para incluir suas rotas de API
    'allowed_methods' => ['*'], // Permitir todos os métodos
    'allowed_origins' => ['http://localhost:8081'], // Permitir apenas a origem específica
    'allowed_headers' => ['*'], // Permitir todos os cabeçalhos
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Se você estiver usando cookies ou autenticação

];
