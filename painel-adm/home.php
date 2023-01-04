<?php
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

require_once("../conexao.php"); 


//totais dos cards
$hoje = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$dataInicioMes = $ano_atual."-".$mes_atual."-01";

$query_cat2 = $pdo->query("SELECT * FROM orcamentos where status = 'Aberto' and data_aberta >= '$dataInicioMes' and data_aberta <= curDate() ");
$res_cat2 = $query_cat2->fetchAll(PDO::FETCH_ASSOC);
$totalPendentes2 = @count($res_cat2);

$query_cat2 = $pdo->query("SELECT * FROM orcamentos where status = 'Aprovado' and data_aberta >= '$dataInicioMes' and data_aberta <= curDate() ");
$res_cat2 = $query_cat2->fetchAll(PDO::FETCH_ASSOC);
$totalAprovados2 = @count($res_cat2);

$query_cat = $pdo->query("SELECT * FROM os where concluido = 'Sim' ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$totalAprovados = @count($res_cat);

$query_cat = $pdo->query("SELECT * FROM os where concluido != 'Sim' ");
$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
$totalPendentes = @count($res_cat);

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
	$corTotal2 = 'border-left-danger';
}else{
	$corTotal = 'text-success';
	$corTotal2 = 'border-left-success';
}

$entradas = number_format($entradas, 2, ',', '.');
$saidas = number_format($saidas, 2, ',', '.');
$saldo = number_format($saldo, 2, ',', '.');






//TOTALIZAR MOVIMENTÃÇÕES NO MES
$saldoMes = 0;
$entradasMes = 0;
$saidasMes = 0;
$query = $pdo->query("SELECT * FROM movimentacoes where data >= '$dataInicioMes' and data <= curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
for ($i=0; $i < @count($res); $i++) { 
foreach ($res[$i] as $key => $value) {
}
$valor = $res[$i]['valor'];
$tipo = $res[$i]['tipo'];

if($tipo == 'Entrada'){
	$entradasMes = $entradasMes + $valor;
}else{
	$saidasMes = $saidasMes + $valor;
}

}

$saldoMes = $entradasMes - $saidasMes;
if($saldoMes < 0){
	$corTotalMes = 'text-danger';
	$corTotal2Mes = 'border-left-danger';
}else{
	$corTotalMes = 'text-success';
	$corTotal2Mes = 'border-left-success';
}

$entradasMes = number_format($entradasMes, 2, ',', '.');
$saidasMes = number_format($saidasMes, 2, ',', '.');
$saldoMes = number_format($saldoMes, 2, ',', '.');



?>

<div class="row">

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orçamentos Aprovados</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalAprovados2 ?> </div>
					</div>
					<div class="col-auto" align="center">
						<i class="fas fa-clipboard-list fa-2x text-primary"></i>

					</div>
				</div>
			</div>
		</div>
	</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Orçamentos Pendentes</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalPendentes2 ?> </div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-danger"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Serviços Concluídos</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalAprovados ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-success"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Serviços Pendentes</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$totalPendentes ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-clipboard-list fa-2x text-danger"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Entradas do Dia</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$entradas ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-success"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-danger shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Saídas do Dia</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo @$saidas ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x text-danger"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Earnings (Monthly) Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card <?php echo $corTotal2 ?> shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold <?php echo $corTotal ?> text-uppercase mb-1">Saldo do Dia</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?php echo @$saldo ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x <?php echo $corTotal ?>"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Pending Requests Card Example -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card <?php echo $corTotal2Mes ?> shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold <?php echo $corTotalMes ?> text-uppercase mb-1">Saldo do Mês</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?php echo @$saldoMes ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-dollar-sign fa-2x <?php echo $corTotalMes ?>"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="text-xs font-weight-bold text-secondary text-uppercase mt-4">SERVIÇOS PENDENTES</div>
<hr> 

<div class="row">

	<?php 

	$query_cat = $pdo->query("SELECT * FROM os where concluido != 'Sim' order by data_fecha asc, id asc limit 12");
	$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
	for ($i=0; $i < @count($res_cat); $i++) { 
		foreach ($res_cat[$i] as $key => $value) {
		}
		$data_fecha = $res_cat[$i]['data_fecha'];
		$descricao = $res_cat[$i]['descricao'];
		$veiculo = $res_cat[$i]['veiculo'];

		if($data_fecha <= date('Y-m-d')){
			$classe = 'text-danger';
			$classe2 = 'border-left-danger';
		}else{
			$classe = 'text-warning';
			$classe2 = 'border-left-warning';
		}

		$data_fecha = implode('/', array_reverse(explode('-', $data_fecha)));

		$query = $pdo->query("SELECT * FROM veiculos where id = '$veiculo' ");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);
						$modelo = $res[0]['modelo'];
						$marca = $res[0]['marca'];
						$placa = $res[0]['placa'];

		?>

		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card <?php echo $classe2 ?> shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold  <?php echo $classe ?> text-uppercase"><?php echo $marca . ':  ' .$placa ?></div>
							<div class="text-xs text-secondary"><?php echo $descricao ?> </div>
						</div>
						<div class="col-auto" align="center">
							<i class="far fa-calendar-alt fa-2x  <?php echo $classe ?>"></i><br>
							<span class="text-xs"><?php echo $data_fecha ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } ?>

</div>