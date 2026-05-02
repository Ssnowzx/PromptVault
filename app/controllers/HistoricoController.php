<?php
/**
 * Controller: Historico
 * CRUD completo para o objeto HistoricoVersoes
 */
class HistoricoController extends BaseController
{
    private HistoricoVersao $model;

    public function __construct()
    {
        $this->model = new HistoricoVersao();
    }

    /**
     * Listar todo o histórico
     */
    public function index(): void
    {
        $data = [
            'pageTitle' => 'Histórico de Versões',
            'historico' => $this->model->findAllWithPrompt(),
            'flash'     => $this->getFlash(),
        ];
        $this->view('historico/index', $data);
    }

    /**
     * Ver histórico de um prompt específico
     */
    public function prompt($id = null): void
    {
        if (!$id) {
            $this->redirect('historico');
            return;
        }

        $promptModel = new Prompt();
        $prompt = $promptModel->findByIdWithProjeto((int) $id);

        $data = [
            'pageTitle' => 'Histórico: ' . ($prompt['titulo'] ?? 'Prompt'),
            'prompt'    => $prompt,
            'historico' => $this->model->findByPrompt((int) $id),
            'flash'     => $this->getFlash(),
        ];
        $this->view('historico/prompt', $data);
    }

    /**
     * Criar registro manual no histórico
     */
    public function criar(): void
    {
        $promptModel = new Prompt();
        $data = [
            'pageTitle' => 'Novo Registro de Histórico',
            'prompts'   => $promptModel->findAllWithProjeto(),
        ];
        $this->view('historico/criar', $data);
    }

    /**
     * Salvar registro manual
     */
    public function salvar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'prompt_id'         => (int) ($_POST['prompt_id'] ?? 0),
                'conteudo_anterior' => trim($_POST['conteudo_anterior'] ?? ''),
                'conteudo_novo'     => trim($_POST['conteudo_novo'] ?? ''),
                'versao'            => (int) ($_POST['versao'] ?? 1),
                'observacao'        => trim($_POST['observacao'] ?? ''),
            ];

            if ($dados['prompt_id'] === 0 || empty($dados['conteudo_anterior']) || empty($dados['conteudo_novo'])) {
                $this->setFlash('danger', 'Todos os campos são obrigatórios.');
                $this->redirect('historico/criar');
                return;
            }

            $this->model->create($dados);
            $this->setFlash('success', 'Registro de histórico criado com sucesso!');
            $this->redirect('historico');
        }
    }

    /**
     * Formulário de edição
     */
    public function editar($id = null): void
    {
        if (!$id) {
            $this->redirect('historico');
            return;
        }

        $registro = $this->model->findById((int) $id);
        if (!$registro) {
            $this->setFlash('danger', 'Registro não encontrado.');
            $this->redirect('historico');
            return;
        }

        $promptModel = new Prompt();
        $data = [
            'pageTitle' => 'Editar Registro de Histórico',
            'registro'  => $registro,
            'prompts'   => $promptModel->findAllWithProjeto(),
        ];
        $this->view('historico/editar', $data);
    }

    /**
     * Atualizar registro
     */
    public function atualizar($id = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $dados = [
                'conteudo_anterior' => trim($_POST['conteudo_anterior'] ?? ''),
                'conteudo_novo'     => trim($_POST['conteudo_novo'] ?? ''),
                'observacao'        => trim($_POST['observacao'] ?? ''),
            ];

            $this->model->update((int) $id, $dados);
            $this->setFlash('success', 'Registro atualizado com sucesso!');
            $this->redirect('historico');
        }
    }

    /**
     * Deletar registro do histórico
     */
    public function deletar($id = null): void
    {
        if ($id) {
            $this->model->delete((int) $id);
            $this->setFlash('success', 'Registro excluído com sucesso!');
        }
        $this->redirect('historico');
    }
}
