<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-folder2-open"></i> Projetos</h1>
    <a href="<?= BASE_URL ?>index.php?url=projetos/criar" class="btn-cf"><i class="bi bi-plus-lg"></i> Novo Projeto</a>
</div>

<div class="content-wrap">

<?php if (empty($projetos)): ?>
    <div class="empty-state">
        <div class="icon">📁</div>
        <p>Nenhum projeto encontrado. Crie o primeiro!</p>
    </div>
<?php else: ?>
<div class="row g-3">
    <?php foreach ($projetos as $i => $p): ?>
    <div class="col-md-4 fade-in fade-in-delay-<?= min($i + 1, 3) ?>">
        <div class="cf-card project-card" style="border-top-color: <?= htmlspecialchars($p['cor']) ?>;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="color-dot" style="background: <?= htmlspecialchars($p['cor']) ?>; width: 14px; height: 14px;"></span>
                <h6 class="mb-0" style="font-weight: 700;"><?= htmlspecialchars($p['nome']) ?></h6>
            </div>
            <p style="color: var(--text-muted); font-size: 0.82rem; min-height: 40px;">
                <?= htmlspecialchars(mb_strimwidth($p['descricao'] ?? 'Sem descrição', 0, 100, '...')) ?>
            </p>
            <div style="margin-bottom: 0.75rem;">
                <span class="badge-cf badge-version"><?= $p['total_prompts'] ?> prompt(s)</span>
                <span style="color: var(--text-muted); font-size: 0.72rem; margin-left: 0.5rem;">
                    <?= date('d/m/Y', strtotime($p['criado_em'])) ?>
                </span>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= BASE_URL ?>index.php?url=projetos/editar/<?= $p['id'] ?>" class="btn-outline btn-sm"><i class="bi bi-pencil"></i> Editar</a>
                <a href="<?= BASE_URL ?>index.php?url=projetos/deletar/<?= $p['id'] ?>" class="btn-danger btn-sm" data-confirm="Excluir o projeto '<?= htmlspecialchars($p['nome']) ?>' e todos os seus prompts?">
                    <i class="bi bi-trash3"></i> Excluir
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
