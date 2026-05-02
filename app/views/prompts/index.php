<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-braces-asterisk"></i> Prompts</h1>
    <a href="<?= BASE_URL ?>index.php?url=prompts/criar" class="btn-cf"><i class="bi bi-plus-lg"></i> Novo Prompt</a>
</div>

<div class="content-wrap">

<?php if (empty($prompts)): ?>
    <div class="empty-state">
        <div class="icon">⚡</div>
        <p>Nenhum prompt encontrado. Crie o primeiro!</p>
    </div>
<?php else: ?>
<div class="cf-card">
    <table class="cf-table">
        <thead>
            <tr><th>Título</th><th>Projeto</th><th>Modelo IA</th><th>Tags</th><th>Versão</th><th>Atualizado</th><th>Ações</th></tr>
        </thead>
        <tbody>
        <?php foreach ($prompts as $pr): ?>
        <tr>
            <td>
                <a href="<?= BASE_URL ?>index.php?url=prompts/ver/<?= $pr['id'] ?>" class="cf-link" style="font-weight: 600;">
                    <?= htmlspecialchars($pr['titulo']) ?>
                </a>
            </td>
            <td>
                <span class="color-dot" style="background: <?= htmlspecialchars($pr['projeto_cor']) ?>;"></span>
                <?= htmlspecialchars($pr['projeto_nome']) ?>
            </td>
            <td><span class="badge-cf badge-model"><?= htmlspecialchars($pr['modelo_ia']) ?></span></td>
            <td>
                <?php foreach (explode(',', $pr['tags'] ?? '') as $tag): ?>
                    <?php if (trim($tag)): ?>
                        <span class="badge-cf badge-tag"><?= htmlspecialchars(trim($tag)) ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </td>
            <td><span class="badge-cf badge-version">v<?= $pr['versao'] ?></span></td>
            <td style="color: var(--text-muted); font-size: 0.8rem;"><?= date('d/m/Y H:i', strtotime($pr['atualizado_em'])) ?></td>
            <td>
                <div class="d-flex gap-1">
                    <a href="<?= BASE_URL ?>index.php?url=prompts/editar/<?= $pr['id'] ?>" class="btn-outline btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="<?= BASE_URL ?>index.php?url=prompts/deletar/<?= $pr['id'] ?>" class="btn-danger btn-sm" data-confirm="Excluir o prompt '<?= htmlspecialchars($pr['titulo']) ?>'?"><i class="bi bi-trash3"></i></a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
