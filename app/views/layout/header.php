<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PromptVault - Cofre de Engenharia de Prompts de IA. Salve, organize e versione suas instruções para IAs.">
    <title><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?> | PromptVault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>public/css/style.css" rel="stylesheet">
</head>
<body>

<!-- Sidebar -->
<nav class="sidebar">
    <div class="sidebar-brand">
        <h4><i class="bi bi-shield-lock-fill"></i> PromptVault</h4>
        <small>Engenharia de Prompts</small>
    </div>
    <div class="sidebar-nav">
        <div class="nav-section">Principal</div>
        <a href="<?= BASE_URL ?>index.php" class="nav-link <?= ($pageTitle ?? '') === 'Dashboard' ? 'active' : '' ?>">
            <span class="icon"><i class="bi bi-grid-1x2-fill"></i></span> Dashboard
        </a>

        <div class="nav-section">Gerenciar</div>
        <a href="<?= BASE_URL ?>index.php?url=projetos" class="nav-link <?= ($pageTitle ?? '') === 'Projetos' ? 'active' : '' ?>">
            <span class="icon"><i class="bi bi-folder2-open"></i></span> Projetos
        </a>
        <a href="<?= BASE_URL ?>index.php?url=prompts" class="nav-link <?= ($pageTitle ?? '') === 'Prompts' ? 'active' : '' ?>">
            <span class="icon"><i class="bi bi-braces-asterisk"></i></span> Prompts
        </a>
        <a href="<?= BASE_URL ?>index.php?url=historico" class="nav-link <?= ($pageTitle ?? '') === 'Histórico de Versões' ? 'active' : '' ?>">
            <span class="icon"><i class="bi bi-clock-history"></i></span> Histórico
        </a>
    </div>
    <div class="sidebar-footer">
        <i class="bi bi-code-slash"></i> PHP MVC &middot; MySQL
    </div>
</nav>

<!-- Main Content -->
<main class="main-content">

<!-- Flash Message -->
<?php if (!empty($flash)): ?>
<div class="flash-message flash-<?= $flash['type'] ?>">
    <i class="bi bi-<?= $flash['type'] === 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill' ?>"></i>
    <?= htmlspecialchars($flash['message']) ?>
</div>
<?php endif; ?>
