<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-pencil-square"></i> Editar Projeto</h1>
    <a href="<?= BASE_URL ?>index.php?url=projetos" class="btn-outline"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

<div class="content-wrap">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="cf-card">
            <form action="<?= BASE_URL ?>index.php?url=projetos/atualizar/<?= $projeto['id'] ?>" method="POST" class="cf-form">
                <div class="mb-3">
                    <label class="form-label">Nome do Projeto *</label>
                    <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($projeto['nome']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="descricao" class="form-control" rows="3"><?= htmlspecialchars($projeto['descricao'] ?? '') ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Cor de Identificação</label>
                    <input type="color" name="cor" value="<?= htmlspecialchars($projeto['cor']) ?>" class="form-control form-control-color" style="width: 50px; height: 40px; padding: 2px; border-radius: var(--radius-sm);">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-cf"><i class="bi bi-check-lg"></i> Salvar Alterações</button>
                    <a href="<?= BASE_URL ?>index.php?url=projetos" class="btn-outline">Cancelar</a>
                </div>
            </form>
        </div>

        <!-- Prompts deste projeto -->
        <?php if (!empty($projeto['prompts'])): ?>
        <div class="section-title" style="margin-top: 2rem;">
            <i class="bi bi-braces-asterisk"></i> Prompts neste Projeto
        </div>
        <div class="cf-card">
            <table class="cf-table">
                <thead><tr><th>Título</th><th>Modelo</th><th>Versão</th><th>Ações</th></tr></thead>
                <tbody>
                <?php foreach ($projeto['prompts'] as $pr): ?>
                <tr>
                    <td style="font-weight: 500;"><?= htmlspecialchars($pr['titulo']) ?></td>
                    <td><span class="badge-cf badge-model"><?= htmlspecialchars($pr['modelo_ia']) ?></span></td>
                    <td><span class="badge-cf badge-version">v<?= $pr['versao'] ?></span></td>
                    <td>
                        <a href="<?= BASE_URL ?>index.php?url=prompts/editar/<?= $pr['id'] ?>" class="btn-outline btn-sm"><i class="bi bi-pencil"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
