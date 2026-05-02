<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-plus-circle"></i> Novo Prompt</h1>
    <a href="<?= BASE_URL ?>index.php?url=prompts" class="btn-outline"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

<div class="content-wrap">
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="cf-card">
            <form action="<?= BASE_URL ?>index.php?url=prompts/salvar" method="POST" class="cf-form">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Título do Prompt *</label>
                        <input type="text" name="titulo" class="form-control" placeholder="Ex: Code Reviewer Sênior" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Modelo de IA</label>
                        <select name="modelo_ia" class="form-select">
                            <option value="GPT-4">GPT-4</option>
                            <option value="GPT-4o">GPT-4o</option>
                            <option value="Claude">Claude</option>
                            <option value="Gemini">Gemini</option>
                            <option value="Llama">Llama</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Projeto *</label>
                    <select name="projeto_id" class="form-select" required>
                        <option value="">Selecione um projeto...</option>
                        <?php foreach ($projetos as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Conteúdo do Prompt *</label>
                    <textarea name="conteudo" class="form-control" rows="8" placeholder="Digite a instrução completa para a IA..." required></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Tags</label>
                    <input type="text" name="tags" class="form-control" placeholder="Ex: código, revisão, refatoração (separadas por vírgula)">
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-cf"><i class="bi bi-check-lg"></i> Criar Prompt</button>
                    <a href="<?= BASE_URL ?>index.php?url=prompts" class="btn-outline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
