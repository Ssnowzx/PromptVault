<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1>
        <span class="gradient-text">Histórico: <?= htmlspecialchars($prompt['titulo'] ?? 'Prompt') ?></span>
    </h1>
    <a href="<?= BASE_URL ?>index.php?url=historico" class="btn-outline"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

<?php if (empty($historico)): ?>
    <div class="empty-state">
        <div class="icon">🔄</div>
        <p>Nenhuma versão registrada para este prompt.</p>
    </div>
<?php else: ?>
    <?php foreach ($historico as $h): ?>
    <div class="cf-card mb-3 fade-in">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge-cf badge-version">v<?= $h['versao'] ?></span>
            <small style="color: var(--text-muted);"><?= date('d/m/Y H:i', strtotime($h['alterado_em'])) ?></small>
        </div>
        <?php if ($h['observacao']): ?>
            <p style="color: var(--text-secondary); font-size: 0.82rem; margin-bottom: 0.5rem;">
                <i class="bi bi-chat-dots"></i> <?= htmlspecialchars($h['observacao']) ?>
            </p>
        <?php endif; ?>
        <div class="diff-old"><?= htmlspecialchars($h['conteudo_anterior']) ?></div>
        <div class="diff-new"><?= htmlspecialchars($h['conteudo_novo']) ?></div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php require_once 'app/views/layout/footer.php'; ?>
