<?php
/**
 * Model: Prompt
 * Representa as instruções/prompts de IA
 */
class Prompt extends BaseModel
{
    protected string $table = 'prompts';

    /**
     * Buscar todos os prompts com nome do projeto
     */
    public function findAllWithProjeto(): array
    {
        $sql = "SELECT pr.*, p.nome as projeto_nome, p.cor as projeto_cor
                FROM prompts pr
                INNER JOIN projetos p ON pr.projeto_id = p.id
                ORDER BY pr.atualizado_em DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Buscar prompts por projeto
     */
    public function findByProjeto(int $projetoId): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM prompts WHERE projeto_id = :projeto_id ORDER BY atualizado_em DESC"
        );
        $stmt->execute(['projeto_id' => $projetoId]);
        return $stmt->fetchAll();
    }

    /**
     * Buscar prompt com dados do projeto
     */
    public function findByIdWithProjeto(int $id): ?array
    {
        $sql = "SELECT pr.*, p.nome as projeto_nome 
                FROM prompts pr 
                INNER JOIN projetos p ON pr.projeto_id = p.id 
                WHERE pr.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    /**
     * Atualiza o prompt e cria registro no histórico automaticamente
     */
    public function updateWithHistory(int $id, array $data, string $observacao = ''): bool
    {
        $atual = $this->findById($id);
        if (!$atual) return false;

        // Incrementar versão
        $novaVersao = $atual['versao'] + 1;
        $data['versao'] = $novaVersao;

        // Registrar no histórico
        $historico = new HistoricoVersao();
        $historico->create([
            'prompt_id'         => $id,
            'conteudo_anterior' => $atual['conteudo'],
            'conteudo_novo'     => $data['conteudo'],
            'versao'            => $novaVersao,
            'observacao'        => $observacao ?: 'Atualização do prompt',
        ]);

        return $this->update($id, $data);
    }
}
