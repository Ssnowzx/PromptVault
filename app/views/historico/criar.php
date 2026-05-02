<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-plus-circle"></i> Novo Registro de Histórico</h1>
    <a href="<?= BASE_URL ?>index.php?url=historico" class="btn-outline"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

<div class="content-wrap">
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="cf-card">
            <form action="<?= BASE_URL ?>index.php?url=historico/salvar" method="POST" class="cf-form">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Prompt *</label>
                        <select name="prompt_id" class="form-select" required>
                            <option value="">Selecione um prompt...</option>
                            <?php foreach ($prompts as $pr): ?>
                            <option value="<?= $pr['id'] ?>"><?= htmlspecialchars($pr['titulo']) ?> (<?= htmlspecialchars($pr['projeto_nome']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Versão *</label>
                        <input type="number" name="versao" class="form-control" value="1" min="1" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Conteúdo Anterior *</label>
                    <textarea name="conteudo_anterior" class="form-control" rows="4" placeholder="Conteúdo antes da alteração..." required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Conteúdo Novo *</label>
                    <textarea name="conteudo_novo" class="form-control" rows="4" placeholder="Conteúdo depois da alteração..." required></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Observação</label>
                    <input type="text" name="observacao" class="form-control" placeholder="Ex: Ajuste de tom">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-cf"><i class="bi bi-check-lg"></i> Salvar Registro</button>
                    <a href="<?= BASE_URL ?>index.php?url=historico" class="btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
