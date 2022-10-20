<?php

class Tarefas extends MY_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->model("TarefasModel");
	}

	/**
	 * @return void
	 * Tela iniciar onde é listado todas as Tarefas Cadastradas
	 */
	public function index() {
		if (empty($_SESSION['id'])) {
			redirect('Login');
			exit(0);
		}else{
			$retorno = $this->getErro();
			$dadosTabela = $this->TarefasModel->getTarefas();
			$this->template->set('title', 'Listagem de Tarefas');
			$this->template->load('default', 'tarefas/listar', array(
				'dadosTabela' => $dadosTabela,
				'retorno' => $retorno
			) );
		}
	}


	/**
	 * @param $idTarefa
	 * @return void
	 * Tela de cadastro de tarefa
	 */
	public function cadastrarTarefa($idTarefa = null){
		if (empty($_SESSION['id'])) {
			redirect('Login');
			exit(0);

		}else{
			if(!empty($idTarefa)){
				$dadosTarefa = $this->TarefasModel->getTarefa($idTarefa);
			}
			$retorno = $this->getErro();
			$dadosSelect= NULL;
			$this->template->set('title', 'Cadastrar Notícia');
			$this->template->load('default', 'tarefas/cadastrar', array(
				'retorno' => $retorno,
				'dadosSelect' => $dadosSelect,
				"dadosTarefa" => !empty($dadosTarefa) ? $dadosTarefa : null
			) );
		}
	}

	/**
	 * @param $idTarefa
	 * @return void
	 * Requisição para cadastrar a tarefa
	 */
	public function cadastrar($idTarefa = null) {
		if (empty($_SESSION['id'])) {

			redirect('Login');
			exit(0);

		}else{
			$dadosTarefa = array();
				$this->form_validation->set_rules("nome","Nome da tarefa", "required|min_length[2]|max_length[250]");
				$this->form_validation->set_rules("data","Data da tarefa", "required");
				$this->form_validation->set_rules("descricao","Descrição da Tarefa", "required|min_length[2]|max_length[250]");

			$dadosTarefa = array(
					'nome' 			=> addslashes( $this->input->post("nome")),
					'dataTarefa' 	=> addslashes( $this->input->post("data")),
					'descricao'	 	=> addslashes( $this->input->post("descricao")),
				);
			}
			if($this->form_validation->run() == FALSE) {
				$msg = array(
					"class"     => "danger",
					"msg"  => validation_errors()
				);
				$mensagem = array(
					'msg' => $msg,
					'retorno'=> $dadosTarefa
				);

				$this->setErro($mensagem);

			} else {
				if($this->TarefasModel->salvarTarefa($dadosTarefa, $idTarefa)) {
					$msg = array(
						"class"     => "success",
						"msg"  => "Cadastro feito com sucesso!"
					);
					$mensagem = array(
						'msg' => $msg,
					);

					$this->setErro($mensagem);
				} else {
					$msg = array(
						"class"     => "danger",
						"msg"  => "Erro interno do banco, entrar em contato com o suporte!"
					);
					$mensagem = array(
						'msg' => $msg,
						'retorno'=> $dadosTarefa
					);

					$this->setErro($mensagem);
				}
			}
			redirect('Tarefas/cadastrarTarefa');
		}

	/**
	 * @param $idTarefa
	 * @return void
	 * Requisição para deletar a tarefa selecionada
	 */
	public function deletarTarefa($idTarefa){
		$deletar = $this->TarefasModel->deletarTarefa($idTarefa);
		if($deletar == TRUE){
			$msg = array(
				"class"     => "success",
				"msg"  => "<strong> Tarefa excluida com sucesso! </strong>"
			);
			$mensagem = array(
				'msg' => $msg,
			);

			$this->setErro($mensagem);
			redirect('tarefas');
		}
	}

}
