
<?php 
require_once("../conexao.php"); 
@session_start();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = strtoupper(utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today'))));

$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];


$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));


if($dataInicial != $dataFinal){
	$apuracao = $dataInicialF. ' até '. $dataFinalF;
}else{
	$apuracao = $dataInicialF;
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Serviços</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<style>

		@page {
			margin: 0px;

		}

		.footer {
			margin-top:20px;
			width:100%;
			background-color: #ebebeb;
			padding:10px;
			position:relative;
			bottom:0;
		}

		.cabecalho {    
			background-color: #ebebeb;
			padding:10px;
			margin-bottom:30px;
			width:100%;
			height:100px;
		}

		.titulo{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:0;
			font-size:17px;
			font-family:Arial, Helvetica, sans-serif;
		}

		.areaTotais{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			position:absolute;
			right:20;
		}

		.areaTotal{
			border : 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right:25px;
			margin-left:25px;
			background-color: #f9f9f9;
			margin-top:2px;
		}

		.pgto{
			margin:1px;
		}

		.fonte13{
			font-size:13px;
		}

		.esquerda{
			display:inline;
			width:50%;
			float:left;
		}

		.direita{
			display:inline;
			width:50%;
			float:right;
		}

		.table{
			padding:15px;
			font-family:Verdana, sans-serif;
			margin-top:20px;
		}

		.texto-tabela{
			font-size:12px;
		}


		.esquerda_float{

			margin-bottom:10px;
			float:left;
			display:inline;
		}


		.titulos{
			margin-top:10px;
		}

		.image{
			margin-top:-10px;
		}

		.margem-direita{
			margin-right: 80px;
		}

		.margem-direita50{
			margin-right: 50px;
		}

		hr{
			margin:8px;
			padding:1px;
		}


		.titulorel{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.margem-superior{
			margin-top:30px;
		}


	</style>

</head>
<body>


	<div class="cabecalho">
		<div class="container">
			<div class="row titulos">
				<div class="col-sm-3 esquerda_float image">	
					<img src="../img/logo_favicon.png" width="250px">
				</div>
				<div class="col-sm-9 esquerda_float">	
					<h2 class="titulo"><b><?php echo strtoupper($nome_rp) ?></b></h2>
					<h6 class="subtitulo"><?php echo $endereco_rp . '<p> Tel: '.$telefone_rp . '</p>' ?></h6>

				</div>
			</div>
		</div>

	</div>

	<div class="container">

		<div class="row">
			<div class="col-sm-8 esquerda">	
				<span class="titulorel"> Relatório de Serviços Concluídos </span>
			</div>
			<div class="col-sm-4 direita" align="right">	
				<big> <small> Data: <?php echo $data_hoje; ?></small> </big>
			</div>
		</div>


		<hr>



		<div class="row margem-superior">
			<div class="col-md-12">
				<div class="esquerda_float margem-direita50">	
					<span class=""> <b> Período da Apuração </b> </span>
				</div>
				<div class="esquerda_float margem-direita50">	
					<span class=""> <?php echo $apuracao ?> </span>
				</div>
				
			</div>
		</div>


		<hr>


		<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
			<tr bgcolor='#f9f9f9' >
				<th><b>Cliente</b></th>
						<th><b>Valor Serviço</b></th>
						<th><b>Serviço</b></th>
						<th><b>Data Entrega</b></th>

			</tr>

			<?php 

ini_set('display_errors', 0 );
error_reporting(0);
					$totalValores = 0;
					$totalValoresF = 0;
					$query = $pdo->query("SELECT * FROM os where data >= '$dataInicial' and data_fecha <= '$dataFinal' and concluido LIKE 'Sim' order by data asc");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$cliente = $res[$i]['cliente'];
						$veiculo = $res[$i]['veiculo'];
						$descricao = $res[$i]['descricao'];
						$valor = $res[$i]['valor'];
						$valor_mao_obra = $res[$i]['valor_mao_obra'];
						$data = $res[$i]['data'];
						$data_fecha = $res[$i]['data_fecha'];
						$concluido = $res[$i]['concluido'];
						$funcionario = $res[$i]['funcionario'];
						$tipo = $res[$i]['tipo'];
						$id = $res[$i]['id'];

						$totalValores = $valor + $valor_mao_obra + $totalValores;
						$totalValoresF = number_format($totalValores, 2, ',', '.');

						$data = implode('/', array_reverse(explode('-', $data)));
						$data_fecha = implode('/', array_reverse(explode('-', $data_fecha)));
						//$valor = number_format($valor, 2, ',', '.');
						//$valor_mao_obra = number_format($valor_mao_obra, 2, ',', '.');
						


						$query_cat = $pdo->query("SELECT * FROM clientes where cpf = '$cliente' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$nome_cli = $res_cat[0]['nome'];
						
						$query_vei = $pdo->query("SELECT * FROM veiculos where id = '$veiculo' ");
						$res_vei = $query_vei->fetchAll(PDO::FETCH_ASSOC);
						$modelo = $res_vei[0]['modelo'];
						$marca = $res_vei[0]['marca'];
						$placa = $res_vei[0]['placa'];
						$cor = $res_vei[0]['cor'];


						if($concluido == 'Sim'){
							$cor_pago = 'text-success';
						}else{
							$cor_pago = 'text-danger';
						}

						?>

						<tr>
							<td>
								<?php echo $nome_cli ?></td>
							<td>R$ <?php echo @$valor + @$valor_mao_obra . ',00' ?></td>
							<td><?php echo $descricao ?></td>
							<td><?php echo $data_fecha ?></td>							
							
						</tr>
					<?php } ?>



		</table>

		<hr>


		<div class="row margem-superior">
			<div class="col-md-12">
				<div class="" align="right">	
					<span class="areaTotal"> <b> Total de Serviços : R$<?php echo @$totalValoresF ?> </b> </span>
				</div>
								
			</div>
		</div>

		<hr>


	</div>


	<div class="footer">
		<p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
	</div>




</body>
</html>