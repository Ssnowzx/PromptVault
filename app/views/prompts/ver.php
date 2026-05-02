<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-braces-asterisk"></i> <?= htmlspecialchars($prompt['titulo']) ?></h1>
    <div class="d-flex gap-2">
        <a href="<?= BASE_URL ?>index.php?url=prompts/editar/<?= $prompt['id'] ?>" class="btn-cf btn-sm"><i class="bi bi-pencil"></i> Editar</a>
        <a href="<?= BASE_URL ?>index.php?url=prompts" class="btn-outline"><i class="bi bi-arrow-left"></i> Voltar</a>
    </div>
</div>

<div class="content-wrap">
<div class="row g-4">
    <div class="col-md-8">
        <div class="cf-card">
            <div class="detail-label">Conteúdo do Prompt</div>
            <div class="detail-code"><?= htmlspecialchars($prompt['conteudo']) ?></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="cf-card mb-3">
            <div class="detail-label">Detalhes</div>
            <div style="font-size: 0.85rem;">
                <p><strong style="color: var(--text-muted);">Projeto:</strong><br>
                    <span class="color-dot" style="background: <?= htmlspecialchars($prompt['projeto_cor'] ?? '#f6821f') ?>;"></span>
                    <?= htmlspecialchars($prompt['projeto_nome']) ?>
                </p>
                <p><strong style="color: var(--text-muted);">Modelo IA:</strong><br>
                    <span class="badge-cf badge-model"><?= htmlspecialchars($prompt['modelo_ia']) ?></span>
                </p>
                <p><strong style="color: var(--text-muted);">Versão:</strong><br>
                    <span class="badge-cf badge-version">v<?= $prompt['versao'] ?></span>
                </p>
                <p><strong style="color: var(--text-muted);">Tags:</strong><br>
                    <?php foreach (explode(',', $prompt['tags'] ?? '') as $tag): ?>
                        <?php if (trim($tag)): ?><span class="badge-cf badge-tag"><?= htmlspecialchars(trim($tag)) ?></span><?php endif; ?>
                    <?php endforeach; ?>
                </p>
                <p style="color: var(--text-muted); font-size: 0.78rem;">Criado: <?= date('d/m/Y H:i', strtotime($prompt['criado_em'])) ?><br>Atualizado: <?= date('d/m/Y H:i', strtotime($prompt['atualizado_em'])) ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Histórico -->
<?php if (!empty($historico)): ?>
<div class="section-title" style="margin-top: 2rem;">
    <i class="bi bi-clock-history"></i> Histórico de Versões (<?= count($historico) ?>)
</div>
<?php foreach ($historico as $h): ?>
<div class="cf-card mb-3 fade-in">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="badge-cf badge-version">v<?= $h['versao'] ?></span>
        <small style="color: var(--text-muted);"><?= date('d/m/Y H:i', strtotime($h['alterado_em'])) ?></small>
    </div>
    <?php if ($h['observacao']): ?>
        <p style="color: var(--text-secondary); font-size: 0.82rem;"><i class="bi bi-chat-dots"></i> <?= htmlspecialchars($h['observacao']) ?></p>
    <?php endif; ?>
    <div class="diff-old"><?= htmlspecialchars($h['conteudo_anterior']) ?></div>
    <div class="diff-new"><?= htmlspecialchars($h['conteudo_novo']) ?></div>
</div>
<?php endforeach; ?>
<?php endif; ?>

</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
