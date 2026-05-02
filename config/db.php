<?php
/**
 * Configuração de conexão com o banco de dados MySQL via PDO
 * Cofre de Engenharia de Prompts de IA
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'cofre_prompts');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

function getConnection(): PDO
{
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        die('<div style="background:#1a1a2e;color:#ff6b6b;padding:2rem;font-family:monospace;border-radius:12px;margin:2rem;">
            <h2>⚠️ Erro de Conexão com o Banco de Dados</h2>
            <p>' . $e->getMessage() . '</p>
            <p style="color:#aaa;">Verifique se o MySQL está rodando e se o banco <code>cofre_prompts</code> foi criado.</p>
        </div>');
    }
}
