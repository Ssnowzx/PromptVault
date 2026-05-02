<?php
/**
 * Controller: Projetos
 * CRUD completo para o objeto Projetos
 */
class ProjetosController extends BaseController
{
    private Projeto $model;

    public function __construct()
    {
        $this->model = new Projeto();
    }

    /**
     * Listar todos os projetos
     */
    public function index(): void
    {
        $data = [
            'pageTitle' => 'Projetos',
            'projetos'  => $this->model->findAllWithCount(),
            'flash'     => $this->getFlash(),
        ];
        $this->view('projetos/index', $data);
    }

    /**
     * Formulário de criação
     */
    public function criar(): void
    {
        $data = [
            'pageTitle' => 'Novo Projeto',
        ];
        $this->view('projetos/criar', $data);
    }

    /**
     * Processar criação (POST)
     */
    public function salvar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome'      => trim($_POST['nome'] ?? ''),
                'descricao' => trim($_POST['descricao'] ?? ''),
                'cor'       => $_POST['cor'] ?? '#f48120',
            ];

            if (empty($dados['nome'])) {
                $this->setFlash('danger', 'O nome do projeto é obrigatório.');
                $this->redirect('projetos/criar');
                return;
            }

            $this->model->create($dados);
            $this->setFlash('success', 'Projeto criado com sucesso!');
            $this->redirect('projetos');
        }
    }

    /**
     * Formulário de edição
     */
    public function editar($id = null): void
    {
        if (!$id) {
            $this->redirect('projetos');
            return;
        }

        $projeto = $this->model->findByIdWithPrompts((int) $id);
        if (!$projeto) {
            $this->setFlash('danger', 'Projeto não encontrado.');
            $this->redirect('projetos');
            return;
        }

        $data = [
            'pageTitle' => 'Editar Projeto',
            'projeto'   => $projeto,
        ];
        $this->view('projetos/editar', $data);
    }

    /**
     * Processar edição (POST)
     */
    public function atualizar($id = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $dados = [
                'nome'      => trim($_POST['nome'] ?? ''),
                'descricao' => trim($_POST['descricao'] ?? ''),
                'cor'       => $_POST['cor'] ?? '#f48120',
            ];

            if (empty($dados['nome'])) {
                $this->setFlash('danger', 'O nome do projeto é obrigatório.');
                $this->redirect('projetos/editar/' . $id);
                return;
            }

            $this->model->update((int) $id, $dados);
            $this->setFlash('success', 'Projeto atualizado com sucesso!');
            $this->redirect('projetos');
        }
    }

    /**
     * Deletar projeto
     */
    public function deletar($id = null): void
    {
        if ($id) {
            $this->model->delete((int) $id);
            $this->setFlash('success', 'Projeto excluído com sucesso!');
        }
        $this->redirect('projetos');
    }
}
