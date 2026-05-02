<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-grid-1x2-fill"></i> Dashboard</h1>
    <a href="<?= BASE_URL ?>index.php?url=prompts/criar" class="btn-cf"><i class="bi bi-plus-lg"></i> Novo Prompt</a>
</div>

<div class="content-wrap">

<!-- Stats -->
<div class="row g-4 mb-4">
    <div class="col-md-4 fade-in fade-in-delay-1">
        <div class="stat-card">
            <div class="stat-icon">📁</div>
            <div class="stat-number"><?= $totalProjetos ?></div>
            <div class="stat-label">Projetos</div>
        </div>
    </div>
    <div class="col-md-4 fade-in fade-in-delay-2">
        <div class="stat-card">
            <div class="stat-icon">⚡</div>
            <div class="stat-number"><?= $totalPrompts ?></div>
            <div class="stat-label">Prompts</div>
        </div>
    </div>
    <div class="col-md-4 fade-in fade-in-delay-3">
        <div class="stat-card">
            <div class="stat-icon">🔄</div>
            <div class="stat-number"><?= $totalVersoes ?></div>
            <div class="stat-label">Versões Registradas</div>
        </div>
    </div>
</div>

<!-- Projetos -->
<div class="section-title">
    <i class="bi bi-folder2-open"></i> Projetos Recentes
</div>
<div class="row g-3 mb-4">
    <?php if (empty($projetos)): ?>
        <div class="col-12">
            <div class="empty-state">
                <div class="icon">📁</div>
                <p>Nenhum projeto criado ainda.</p>
                <a href="<?= BASE_URL ?>index.php?url=projetos/criar" class="btn-cf btn-sm mt-2"><i class="bi bi-plus"></i> Criar Projeto</a>
            </div>
        </div>
    <?php else: ?>
        <?php foreach (array_slice($projetos, 0, 6) as $p): ?>
        <div class="col-md-4 fade-in">
            <div class="cf-card project-card" style="border-top-color: <?= htmlspecialchars($p['cor']) ?>;">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="color-dot" style="background: <?= htmlspecialchars($p['cor']) ?>;"></span>
                    <strong><?= htmlspecialchars($p['nome']) ?></strong>
                </div>
                <p style="color: var(--text-muted); font-size: 0.82rem; margin-bottom: 0.75rem;">
                    <?= htmlspecialchars(mb_strimwidth($p['descricao'] ?? 'Sem descrição', 0, 80, '...')) ?>
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge-cf badge-version"><?= $p['total_prompts'] ?> prompt(s)</span>
                    <a href="<?= BASE_URL ?>index.php?url=projetos/editar/<?= $p['id'] ?>" class="btn-outline btn-sm">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Recent Prompts -->
<?php if (!empty($recentPrompts)): ?>
<div class="section-title">
    <i class="bi bi-braces-asterisk"></i> Prompts Recentes
</div>
<div class="cf-card">
    <table class="cf-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Projeto</th>
                <th>Modelo</th>
                <th>Versão</th>
                <th>Atualizado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (array_slice($recentPrompts, 0, 5) as $pr): ?>
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
                <td><span class="badge-cf badge-version">v<?= $pr['versao'] ?></span></td>
                <td style="color: var(--text-muted);"><?= date('d/m/Y H:i', strtotime($pr['atualizado_em'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
