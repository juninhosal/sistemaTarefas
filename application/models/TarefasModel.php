<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TarefasModel extends MY_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * @param $dadosTarefa
	 * @param $idTarefa
	 * @return bool
	 * Função para salvar o cadastro da tarefa
	 */
	public function salvarTarefa($dadosTarefa, $idTarefa) {
		$this->db->trans_begin();
		if(!empty($idTarefa)){
			$this->db->set("nome", $dadosTarefa['nome']);
			$this->db->set("dataTarefa", $dadosTarefa['dataTarefa']);
			$this->db->set("descricao", $dadosTarefa['descricao']);
			$this->db->where("idTarefa", $idTarefa);
			$this->db->update("tarefas");
		}else {
			$this->db->insert("tarefas", $dadosTarefa);
		}
		if($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}

	}

	/**
	 * @return mixed
	 * Função para pegar todas as tarefas cadastradas
	 */
	public function getTarefas(){
		$ret = $this->db->query("
		 SELECT 
		 	 idTarefa
		 	,nome
		 	,dataTarefa
		 	,descricao
		 FROM
			tarefas
		")->result_array();

		return ($ret);
	}

	/**
	 * @param $idTarefa
	 * @return mixed
	 * pegar as informações das tarefas selecionadas
	 */
	public function getTarefa($idTarefa){
		$ret = $this->db->query("
		 SELECT 
		 	 idTarefa
		 	,nome
		 	,dataTarefa
		 	,descricao
		 FROM
			tarefas
		WHERE 
		 idTarefa = '$idTarefa'
		")->result_array();
		return ($ret);
	}

	/**
	 * @param $idTarefa
	 * @return bool
	 * Deletar as tarefas
	 */
	public function deletarTarefa($idTarefa){
		$this->db->trans_begin();
		$this->db->where('idTarefa', $idTarefa);
		$this->db->delete('tarefas');
		if($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			$ret = FALSE;
		} else {
			$this->db->trans_commit();
			$ret = TRUE;
		}
		return $ret;
	}

}
