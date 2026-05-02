<?php
/**
 * Controller: Prompts
 * CRUD completo para o objeto Prompts
 */
class PromptsController extends BaseController
{
    private Prompt $model;
    private Projeto $projetoModel;

    public function __construct()
    {
        $this->model = new Prompt();
        $this->projetoModel = new Projeto();
    }

    /**
     * Listar todos os prompts
     */
    public function index(): void
    {
        $data = [
            'pageTitle' => 'Prompts',
            'prompts'   => $this->model->findAllWithProjeto(),
            'flash'     => $this->getFlash(),
        ];
        $this->view('prompts/index', $data);
    }

    /**
     * Formulário de criação
     */
    public function criar(): void
    {
        $data = [
            'pageTitle' => 'Novo Prompt',
            'projetos'  => $this->projetoModel->findAll(),
        ];
        $this->view('prompts/criar', $data);
    }

    /**
     * Processar criação (POST)
     */
    public function salvar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'projeto_id' => (int) ($_POST['projeto_id'] ?? 0),
                'titulo'     => trim($_POST['titulo'] ?? ''),
                'conteudo'   => trim($_POST['conteudo'] ?? ''),
                'modelo_ia'  => trim($_POST['modelo_ia'] ?? 'GPT-4'),
                'tags'       => trim($_POST['tags'] ?? ''),
            ];

            if (empty($dados['titulo']) || empty($dados['conteudo']) || $dados['projeto_id'] === 0) {
                $this->setFlash('danger', 'Título, conteúdo e projeto são obrigatórios.');
                $this->redirect('prompts/criar');
                return;
            }

            $this->model->create($dados);
            $this->setFlash('success', 'Prompt criado com sucesso!');
            $this->redirect('prompts');
        }
    }

    /**
     * Formulário de edição
     */
    public function editar($id = null): void
    {
        if (!$id) {
            $this->redirect('prompts');
            return;
        }

        $prompt = $this->model->findByIdWithProjeto((int) $id);
        if (!$prompt) {
            $this->setFlash('danger', 'Prompt não encontrado.');
            $this->redirect('prompts');
            return;
        }

        $historicoModel = new HistoricoVersao();

        $data = [
            'pageTitle' => 'Editar Prompt',
            'prompt'    => $prompt,
            'projetos'  => $this->projetoModel->findAll(),
            'historico' => $historicoModel->findByPrompt((int) $id),
        ];
        $this->view('prompts/editar', $data);
    }

    /**
     * Processar edição com versionamento (POST)
     */
    public function atualizar($id = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $dados = [
                'projeto_id' => (int) ($_POST['projeto_id'] ?? 0),
                'titulo'     => trim($_POST['titulo'] ?? ''),
                'conteudo'   => trim($_POST['conteudo'] ?? ''),
                'modelo_ia'  => trim($_POST['modelo_ia'] ?? 'GPT-4'),
                'tags'       => trim($_POST['tags'] ?? ''),
            ];
            $observacao = trim($_POST['observacao'] ?? '');

            if (empty($dados['titulo']) || empty($dados['conteudo'])) {
                $this->setFlash('danger', 'Título e conteúdo são obrigatórios.');
                $this->redirect('prompts/editar/' . $id);
                return;
            }

            $this->model->updateWithHistory((int) $id, $dados, $observacao);
            $this->setFlash('success', 'Prompt atualizado! Nova versão registrada no histórico.');
            $this->redirect('prompts');
        }
    }

    /**
     * Deletar prompt
     */
    public function deletar($id = null): void
    {
        if ($id) {
            $this->model->delete((int) $id);
            $this->setFlash('success', 'Prompt excluído com sucesso!');
        }
        $this->redirect('prompts');
    }

    /**
     * Visualizar detalhes do prompt
     */
    public function ver($id = null): void
    {
        if (!$id) {
            $this->redirect('prompts');
            return;
        }

        $prompt = $this->model->findByIdWithProjeto((int) $id);
        if (!$prompt) {
            $this->setFlash('danger', 'Prompt não encontrado.');
            $this->redirect('prompts');
            return;
        }

        $historicoModel = new HistoricoVersao();

        $data = [
            'pageTitle' => $prompt['titulo'],
            'prompt'    => $prompt,
            'historico' => $historicoModel->findByPrompt((int) $id),
            'flash'     => $this->getFlash(),
        ];
        $this->view('prompts/ver', $data);
    }
}
