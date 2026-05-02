<?php
/**
 * BaseController - Classe base para todos os controllers
 * Fornece métodos auxiliares comuns
 */
class BaseController
{
    /**
     * Renderiza uma view com dados
     */
    protected function view(string $viewPath, array $data = []): void
    {
        // Extrai variáveis do array para uso direto na view
        extract($data);

        $viewFile = 'app/views/' . $viewPath . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View não encontrada: {$viewPath}");
        }
    }

    /**
     * Redireciona para outra URL interna
     */
    protected function redirect(string $url): void
    {
        header('Location: ' . BASE_URL . 'index.php?url=' . $url);
        exit;
    }

    /**
     * Define uma mensagem flash para exibir após redirect
     */
    protected function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type'    => $type,
            'message' => $message,
        ];
    }

    /**
     * Obtém e limpa a mensagem flash
     */
    protected function getFlash(): ?array
    {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}
