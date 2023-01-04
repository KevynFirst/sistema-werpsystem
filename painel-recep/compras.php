<?php
$pag = "compras";
require_once("../conexao.php"); 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'recep'){
    echo "<script language='javascript'> window.location='../index.php' </script>";
}
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Produto</th>
						<th>Valor</th>
						<th>Funcionário</th>
						<th>Data</th>
						<th>Ações</th>
					</tr>
				</thead>

				<tbody>

					<?php 

					$query = $pdo->query("SELECT * FROM compras order by id desc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$produto = $res[$i]['produto'];
						$valor = $res[$i]['valor'];
						$funcionario = $res[$i]['funcionario'];
						$data = $res[$i]['data'];
						
						$id = $res[$i]['id'];


						$query_prod = $pdo->query("SELECT * FROM produtos where id = '$produto' ");
						$res_prod = $query_prod->fetchAll(PDO::FETCH_ASSOC);
						$nome_produto = $res_prod[0]['nome'];

						$query_usu = $pdo->query("SELECT * FROM usuarios where cpf = '$funcionario' ");
						$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
						$nome_funcionario = $res_usu[0]['nome'];

						$valor = number_format($valor, 2, ',', '.');
						$data = implode('/', array_reverse(explode('-', $data)));

						?>

						<tr>
							<td><?php echo $nome_produto ?></td>
							<td>R$ <?php echo $valor ?></td>
							<td><?php echo $nome_funcionario ?></td>
							<td><?php echo $data ?></td>
							

							<td>
								
								<a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
							</td>
						</tr>
					<?php } ?>





				</tbody>
			</table>
		</div>
	</div>
</div>



<div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Excluir Registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<p>Deseja realmente Excluir este Registro?</p>

				<div align="center" id="mensagem_excluir" class="">

				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
				<form method="post">

					<input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

					<button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
				</form>
			</div>
		</div>
	</div>
</div>





<?php 


if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
	echo "<script>$('#modal-deletar').modal('show');</script>";
}

?>




<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function () {
		var pag = "<?=$pag?>";
		$('#btn-deletar').click(function (event) {
			event.preventDefault();
			$.ajax({
				url: pag + "/excluir.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function (mensagem) {

					if (mensagem.trim() === 'Excluído com Sucesso!') {
						$('#btn-cancelar-excluir').click();
						window.location = "index.php?pag=" + pag;
					}
					$('#mensagem_excluir').text(mensagem)

				},

			})
		})
	})
</script>




<script type="text/javascript">
	$(document).ready(function () {
		$('#dataTable').dataTable({
			"ordering": false
		})

	});
</script>



