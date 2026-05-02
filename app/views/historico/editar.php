<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-pencil-square"></i> Editar Registro de Histórico</h1>
    <a href="<?= BASE_URL ?>index.php?url=historico" class="btn-outline"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

<div class="content-wrap">
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="cf-card">
            <form action="<?= BASE_URL ?>index.php?url=historico/atualizar/<?= $registro['id'] ?>" method="POST" class="cf-form">
                <div class="mb-3">
                    <label class="form-label">Conteúdo Anterior</label>
                    <textarea name="conteudo_anterior" class="form-control" rows="4" required><?= htmlspecialchars($registro['conteudo_anterior']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Conteúdo Novo</label>
                    <textarea name="conteudo_novo" class="form-control" rows="4" required><?= htmlspecialchars($registro['conteudo_novo']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Observação</label>
                    <input type="text" name="observacao" class="form-control" value="<?= htmlspecialchars($registro['observacao'] ?? '') ?>">
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <button type="submit" class="btn-cf"><i class="bi bi-check-lg"></i> Salvar Alterações</button>
                    <a href="<?= BASE_URL ?>index.php?url=historico" class="btn-outline">Cancelar</a>
                    <span class="badge-cf badge-version ms-auto">Versão: v<?= $registro['versao'] ?></span>
                </div>
            </form>
        </div>
    </div>
</div>
</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
