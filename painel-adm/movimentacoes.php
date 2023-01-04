<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "movimentacoes";
require_once("../conexao.php"); 


//TOTALIZAR MOVIMENTÃÇÕES NO DIA
$saldo = 0;
$entradas = 0;
$saidas = 0;
$query = $pdo->query("SELECT * FROM movimentacoes where data = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i < @count($res); $i++) { 
foreach ($res[$i] as $key => $value) {
}

$valor = $res[$i]['valor'];
$tipo = $res[$i]['tipo'];

if($tipo == 'Entrada'){
	$entradas = $entradas + $valor;
}else{
	$saidas = $saidas + $valor;
}

}

$saldo = $entradas - $saidas;
if($saldo < 0){
	$corTotal = 'text-danger';
}else{
	$corTotal = 'text-success';
}

$entradas = number_format($entradas, 2, ',', '.');
$saidas = number_format($saidas, 2, ',', '.');
$saldo = number_format($saldo, 2, ',', '.');
?>


<!-- DataTales Example -->
<div class="card shadow mb-4">

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Descrição</th>
						<th>Valor</th>
						<th>Data</th>
						
					</tr>
				</thead>

				<tbody>

					<?php 

					$query = $pdo->query("SELECT * FROM movimentacoes order by id desc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$descricao = $res[$i]['descricao'];
						$tipo = $res[$i]['tipo'];
						$data = $res[$i]['data'];
						$valor = $res[$i]['valor'];			
						
						$id = $res[$i]['id'];


						$valor = number_format($valor, 2, ',', '.');
						$data = implode('/', array_reverse(explode('-', $data)));

						if($tipo == 'Entrada'){
							$cor_pago = 'text-success';
						}else{
							$cor_pago = 'text-danger';
						}

						?>

						<tr>
							<td><i class='fas fa-square mr-1 <?php echo $cor_pago ?>'></i>
								<?php echo $tipo ?>
							</td>
							<td><?php echo $descricao ?> </td>
							<td>R$ <?php echo $valor ?> </td>
							<td><?php echo $data ?> </td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>

		<div class="row mt-4 ml-1">
			<span>Entradas Dia: <span class="text-success">R$ <?php echo $entradas ?></span></span>

			<span class="ml-4">Saídas Dia: <span class="text-danger">R$ <?php echo $saidas ?></span></span>


		</div>

		<div align="right">Saldo Dia:  <span class="<?php echo $corTotal ?>">R$ <?php echo $saldo ?></span></div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#dataTable').dataTable({
			"ordering": false
		})

	});
</script>




