<?php
/**
 * Roteador Principal - Front Controller
 * Cofre de Engenharia de Prompts de IA
 * 
 * Todas as requisições passam por este arquivo.
 * URL: index.php?url=controller/metodo/param
 */

session_start();

// Autoload simples
spl_autoload_register(function ($class) {
    $paths = [
        'app/controllers/' . $class . '.php',
        'app/models/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

// Configuração do banco
require_once 'config/db.php';

// Base URL para links internos
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/');

// Parser da URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = filter_var($url, FILTER_SANITIZE_URL);
$parts = explode('/', $url);

// Determinar Controller, Método e Parâmetro
$controllerName = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'DashboardController';
$method = $parts[1] ?? 'index';
$param = $parts[2] ?? null;

// Verificar se o controller existe
$controllerFile = 'app/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();

    if (method_exists($controller, $method)) {
        if ($param !== null) {
            $controller->$method($param);
        } else {
            $controller->$method();
        }
    } else {
        // Método não encontrado
        http_response_code(404);
        require_once 'app/views/errors/404.php';
    }
} else {
    // Controller não encontrado
    http_response_code(404);
    require_once 'app/views/errors/404.php';
}
