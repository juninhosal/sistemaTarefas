<div class="col-lg-12 col-sm-12 col-md-12" style="margin-top:2%; text-align: center">
		<a class="btn btn-danger btn-sm" style="margin-left: 85px; float: right"
		   href="<?= site_url('Tarefas'); ?>">Voltar</a>
</div>
<div style="padding-top: 50px"></div>
<?php if(empty($dadosTarefa)){ ?>
<form id="FormEnviar" method="post" action="<?= site_url('Tarefas/cadastrar')?>">
<?php } else { ?>
<form id="FormEnviar" method="post" action="<?= site_url('Tarefas/cadastrar/') . $dadosTarefa[0]['idTarefa'] ?>">
	<?php }?>
		<div class="box-body">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-xs-6 col-lg-6">
						<label>Nome da tarefa</label>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Nome da tarefa" name="nome" value="<?= !empty($dadosTarefa[0]['nome']) ? $dadosTarefa[0]['nome'] : null ?>"  maxlength="250"/>
						</div>
					</div>
					<div class="col-md-3 col-xs-3 col-lg-3">
						<label>Data da tarefa</label>
						<div class="form-group">
							<input type="date" class="form-control" name="data" value="<?= !empty($dadosTarefa[0]['dataTarefa']) ? $dadosTarefa[0]['dataTarefa'] : dataAgoraFormatada() ?>"/>
						</div>
					</div>
				</div>
				<div class="row">
						<div class="col-md-12 col-xs-12 col-lg-12">
							<label>Descrição da Tarefa</label>
							<textarea class="form-control" rows="3" placeholder="Descrição da Tarefa" name="descricao"><?= !empty($dadosTarefa[0]['descricao']) ? $dadosTarefa[0]['descricao'] : null ?></textarea>
						</div>
				<div class="row">
			</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12" style="margin-top:2%; text-align: center">
			<button type="button" class="btn btn-success btn-sm" onclick="confirmar()">salvar</button>
		</div>
</form>

<script>

	function confirmar(){
		Swal.fire({
			icon: 'info',
			title: 'Cadastrar tarefa',
			text: 'Você deseja salvar o cadasto?',
			showCancelButton: true,
			showConfirmButton: true,
			confirmButtonText: 'Salvar',
			cancelButtonText: 'Cancelar',
			confirmButtonColor: '#43A047',
			cancelButtonColor: '#d33'
		}).then((result) => {
			if(result.value === true){
				$('#FormEnviar').submit();
			}
		});
	}


	function deletaLinha(item){

		var tr = $(item).closest('tr');
		tr.fadeOut(400, function(){
			tr.remove();
		});
		return false;
	}

	function onClikRemove(){
		$('.remove').off('click');
		$('.remove').on('click', function(){
			deletaLinha($(this));
		});
	}

	onClikRemove();
</script>
