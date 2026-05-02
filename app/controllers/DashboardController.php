<?php
/**
 * Controller: Dashboard
 * Página inicial com visão geral do sistema
 */
class DashboardController extends BaseController
{
    public function index(): void
    {
        $projetoModel = new Projeto();
        $promptModel = new Prompt();
        $historicoModel = new HistoricoVersao();

        $data = [
            'pageTitle'      => 'Dashboard',
            'totalProjetos'  => $projetoModel->count(),
            'totalPrompts'   => $promptModel->count(),
            'totalVersoes'   => $historicoModel->count(),
            'projetos'       => $projetoModel->findAllWithCount(),
            'recentPrompts'  => $promptModel->findAllWithProjeto(),
            'flash'          => $this->getFlash(),
        ];

        $this->view('dashboard/index', $data);
    }
}
