<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-clock-history"></i> Histórico de Versões</h1>
    <a href="<?= BASE_URL ?>index.php?url=historico/criar" class="btn-cf"><i class="bi bi-plus-lg"></i> Novo Registro</a>
</div>

<div class="content-wrap">

<?php if (empty($historico)): ?>
    <div class="empty-state">
        <div class="icon">🔄</div>
        <p>Nenhuma versão registrada. Edite um prompt para gerar histórico automaticamente.</p>
    </div>
<?php else: ?>
<div class="cf-card">
    <table class="cf-table">
        <thead>
            <tr><th>Prompt</th><th>Projeto</th><th>Versão</th><th>Observação</th><th>Data</th><th>Ações</th></tr>
        </thead>
        <tbody>
        <?php foreach ($historico as $h): ?>
        <tr>
            <td style="font-weight: 500;"><?= htmlspecialchars($h['prompt_titulo']) ?></td>
            <td style="color: var(--text-secondary);"><?= htmlspecialchars($h['projeto_nome']) ?></td>
            <td><span class="badge-cf badge-version">v<?= $h['versao'] ?></span></td>
            <td style="color: var(--text-muted); font-size: 0.8rem;"><?= htmlspecialchars($h['observacao'] ?? '-') ?></td>
            <td style="color: var(--text-muted); font-size: 0.8rem;"><?= date('d/m/Y H:i', strtotime($h['alterado_em'])) ?></td>
            <td>
                <div class="d-flex gap-1">
                    <a href="<?= BASE_URL ?>index.php?url=historico/editar/<?= $h['id'] ?>" class="btn-outline btn-sm"><i class="bi bi-pencil"></i></a>
                    <a href="<?= BASE_URL ?>index.php?url=historico/deletar/<?= $h['id'] ?>" class="btn-danger btn-sm" data-confirm="Excluir este registro de histórico?"><i class="bi bi-trash3"></i></a>
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
