<?php
/**
 * Model: Projeto
 * Representa pastas/categorias de organização de prompts
 */
class Projeto extends BaseModel
{
    protected string $table = 'projetos';

    /**
     * Buscar projeto com contagem de prompts
     */
    public function findAllWithCount(): array
    {
        $sql = "SELECT p.*, COUNT(pr.id) as total_prompts 
                FROM projetos p 
                LEFT JOIN prompts pr ON p.id = pr.projeto_id 
                GROUP BY p.id 
                ORDER BY p.criado_em DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    /**
     * Buscar projeto por ID com seus prompts
     */
    public function findByIdWithPrompts(int $id): ?array
    {
        $projeto = $this->findById($id);
        if ($projeto) {
            $stmt = $this->db->prepare("SELECT * FROM prompts WHERE projeto_id = :id ORDER BY atualizado_em DESC");
            $stmt->execute(['id' => $id]);
            $projeto['prompts'] = $stmt->fetchAll();
        }
        return $projeto;
    }
}
