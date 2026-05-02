<?php require_once 'app/views/layout/header.php'; ?>

<div class="top-bar">
    <h1><i class="bi bi-pencil-square"></i> Editar Prompt</h1>
    <a href="<?= BASE_URL ?>index.php?url=prompts" class="btn-outline"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>

<div class="content-wrap">
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="cf-card">
            <form action="<?= BASE_URL ?>index.php?url=prompts/atualizar/<?= $prompt['id'] ?>" method="POST" class="cf-form">
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Título *</label>
                        <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($prompt['titulo']) ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Modelo de IA</label>
                        <select name="modelo_ia" class="form-select">
                            <?php foreach (['GPT-4','GPT-4o','Claude','Gemini','Llama','Outro'] as $m): ?>
                            <option value="<?= $m ?>" <?= $prompt['modelo_ia'] === $m ? 'selected' : '' ?>><?= $m ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Projeto</label>
                    <select name="projeto_id" class="form-select" required>
                        <?php foreach ($projetos as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= $prompt['projeto_id'] == $p['id'] ? 'selected' : '' ?>><?= htmlspecialchars($p['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Conteúdo do Prompt *</label>
                    <textarea name="conteudo" class="form-control" rows="8" required><?= htmlspecialchars($prompt['conteudo']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tags</label>
                    <input type="text" name="tags" class="form-control" value="<?= htmlspecialchars($prompt['tags'] ?? '') ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label">Observação da alteração</label>
                    <input type="text" name="observacao" class="form-control" placeholder="Ex: Melhorei o tom de voz">
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <button type="submit" class="btn-cf"><i class="bi bi-check-lg"></i> Salvar (nova versão)</button>
                    <a href="<?= BASE_URL ?>index.php?url=prompts" class="btn-outline">Cancelar</a>
                    <span class="badge-cf badge-version ms-auto">Versão atual: v<?= $prompt['versao'] ?></span>
                </div>
            </form>
        </div>

        <!-- Histórico -->
        <?php if (!empty($historico)): ?>
        <div class="section-title" style="margin-top: 2rem;">
            <i class="bi bi-clock-history"></i> Histórico de Versões
        </div>
        <?php foreach ($historico as $h): ?>
        <div class="cf-card mb-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge-cf badge-version">v<?= $h['versao'] ?></span>
                <small style="color: var(--text-muted);"><?= date('d/m/Y H:i', strtotime($h['alterado_em'])) ?></small>
            </div>
            <?php if ($h['observacao']): ?>
                <p style="color: var(--text-secondary); font-size: 0.82rem; margin-bottom: 0.5rem;"><strong>Obs:</strong> <?= htmlspecialchars($h['observacao']) ?></p>
            <?php endif; ?>
            <div class="diff-old"><?= htmlspecialchars(mb_strimwidth($h['conteudo_anterior'], 0, 200, '...')) ?></div>
            <div class="diff-new"><?= htmlspecialchars(mb_strimwidth($h['conteudo_novo'], 0, 200, '...')) ?></div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</div><!-- /.content-wrap -->

<?php require_once 'app/views/layout/footer.php'; ?>
