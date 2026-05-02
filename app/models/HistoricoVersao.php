<?php
/**
 * Model: HistoricoVersao
 * Registra o log de alterações dos prompts (versionamento)
 */
class HistoricoVersao extends BaseModel
{
    protected string $table = 'historico_versoes';

    /**
     * Buscar histórico de um prompt específico
     */
    public function findByPrompt(int $promptId): array
    {
        $sql = "SELECT hv.*, pr.titulo as prompt_titulo
                FROM historico_versoes hv
                INNER JOIN prompts pr ON hv.prompt_id = pr.id
                WHERE hv.prompt_id = :prompt_id
                ORDER BY hv.versao DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['prompt_id' => $promptId]);
        return $stmt->fetchAll();
    }

    /**
     * Buscar todo o histórico com dados dos prompts
     */
    public function findAllWithPrompt(): array
    {
        $sql = "SELECT hv.*, pr.titulo as prompt_titulo, p.nome as projeto_nome
                FROM historico_versoes hv
                INNER JOIN prompts pr ON hv.prompt_id = pr.id
                INNER JOIN projetos p ON pr.projeto_id = p.id
                ORDER BY hv.alterado_em DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Contar versões de um prompt
     */
    public function countByPrompt(int $promptId): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM historico_versoes WHERE prompt_id = :prompt_id");
        $stmt->execute(['prompt_id' => $promptId]);
        return (int) $stmt->fetch()['total'];
    }
}
