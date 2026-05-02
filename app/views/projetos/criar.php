<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-plus-circle"></i> Novo Projeto</h1>
    <a href="<?= BASE_URL ?>index.php?url=projetos" class="btn-outline"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

<div class="content-wrap">
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="cf-card">
            <form action="<?= BASE_URL ?>index.php?url=projetos/salvar" method="POST" class="cf-form">
                <div class="mb-3">
                    <label class="form-label">Nome do Projeto *</label>
                    <input type="text" name="nome" class="form-control" placeholder="Ex: Assistente de Código" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea name="descricao" class="form-control" rows="3" placeholder="Descreva o objetivo deste projeto..."></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Cor de Identificação</label>
                    <div class="d-flex align-items-center gap-3">
                        <input type="color" name="cor" value="#f6821f" class="form-control form-control-color" style="width: 50px; height: 40px; padding: 2px; border-radius: var(--radius-sm);">
                        <small style="color: var(--text-muted);">Escolha uma cor para identificar visualmente o projeto</small>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-cf"><i class="bi bi-check-lg"></i> Criar Projeto</button>
                    <a href="<?= BASE_URL ?>index.php?url=projetos" class="btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
