<?php 
require_once("../../conexao.php"); 
@session_start();

$id = $_GET['id'];

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = strtoupper(utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today'))));


//DADOS DO ORÇAMENTO
$query_orc = $pdo->query("SELECT * FROM orcamentos where id = '$id' ");
$res_orc = $query_orc->fetchAll(PDO::FETCH_ASSOC);

$funcionario = $res_orc[0]['funcionario'];
$cpf_cliente = $res_orc[0]['cliente'];
$veiculo = $res_orc[0]['veiculo'];
$motorista = $res_orc[0]['motorista'];
$descricao = $res_orc[0]['descricao'];
$valor_orc = $res_orc[0]['valor'];
$servico = $res_orc[0]['servico'];
$data_aberta = $res_orc[0]['data_aberta'];
$data_prazo = $res_orc[0]['data_prazo'];

$obs = $res_orc[0]['obs']; 


$data_prazo = implode('/', array_reverse(explode('-', $data_prazo)));
$valor_orc_f = number_format($valor_orc, 2, ',', '.');


$query_mec = $pdo->query("SELECT * FROM funcionarios where cpf = '$funcionario' ");
$res_mec = $query_mec->fetchAll(PDO::FETCH_ASSOC);
$nome_funcionario = $res_mec[0]['nome'];


$query_mec = $pdo->query("SELECT * FROM servicos where id = '$servico' ");
$res_mec = $query_mec->fetchAll(PDO::FETCH_ASSOC);
$nome_servico = $res_mec[0]['nome'];


$query_cli = $pdo->query("SELECT * FROM clientes where cpf = '$cpf_cliente' ");
$res_cli = $query_cli->fetchAll(PDO::FETCH_ASSOC);
$nome_cli = $res_cli[0]['nome'];
$telefone_cli = $res_cli[0]['telefone'];
$email_cli = $res_cli[0]['email'];


$query_vei = $pdo->query("SELECT * FROM veiculos where id = '$veiculo' ");
$res_vei = $query_vei->fetchAll(PDO::FETCH_ASSOC);
$modelo = $res_vei[0]['modelo'];
$marca = $res_vei[0]['marca'];
$placa = $res_vei[0]['placa'];
$cor = $res_vei[0]['cor'];


?>

<!DOCTYPE html>
<html>
<head>
	<title>Relatório de Orçamento</title>
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
		}

		.cabecalho {    
			background-color: #ebebeb;
			padding:10px;
			margin-bottom:30px;
			width:100%;
			height:120px;
		}

		.titulo{
			margin:0;
			font-size:30px;
			font-family:Arial, Helvetica, sans-serif;
			color:#000000;

		}

		.subtitulo{
			margin:0;
			font-size:14px;
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

		hr{
			margin:8px;
			padding:1px;
		}


	</style>

</head>
<body>


	<div class="cabecalho">
		<div class="container">
			<div class="row titulos">
				<div class="col-sm-3 esquerda_float image">	
					<img src="../../img/logo_favicon.png" width="220px">
				</div>
				<div class="col-sm-9 esquerda_float">	
					<h2 class="titulo"><b><?php echo strtoupper($nome_rp) ?></b></h2>
					<h6 class="subtitulo"><?php echo $endereco_rp .'&nbsp;&nbsp;&nbsp;&nbsp; '. $bairro_rp ?></h6>
					<h6 class="subtitulo"><?php echo '<b>CEP: </b>'. $cep_rp .' &nbsp;&nbsp;&nbsp;&nbsp; '.'<b> CNPJ: </b>'. $cnpj_rp ?></h6>
					<h6 class="subtitulo"><?php echo '<b>Telefone: </b>'. $telefone_rp  .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Email: </b> '. $email_rp ?></h6>
					
				</div>
			</div>
		</div>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-sm-8 esquerda">	
				<big> Orçamento Nº <?php echo $id ?>  </big>
			</div>

		</div>


		<hr>



		<div class="row">
			<div class="col-sm-12">
				<p class="fonte13"> <b> DADOS DO CLIENTE </b> </p>
			</div>
		</div>

		<div class="row">
			<div class="esquerda">
				<div class="col-sm-6">
					<p class="fonte13">  <b>Nome:</b> <?php echo $nome_cli; ?> </p>

					<p class="fonte13">  <b>Email:</b> <?php echo $email_cli; ?> </p>
				</div>
				
			</div>

			<div class="direita">
				<div class="col-sm-6">
					<p class="fonte13">  <b>Telefone:</b> <?php echo $telefone_cli; ?> </p>
					<p class="fonte13">  <b>CPF/CNPJ:</b> <?php echo $cpf_cliente; ?> </p>
					<p class="fonte13"> &nbsp;&nbsp;  </p>
				</div>
			</div>
		</div>



		<hr>


		<div class="row">
			<div class="col-sm-12">
				<p class="fonte13"> <b> DADOS DO VEÍCULO </b> </p>
			</div>
		</div>
		
		<div class="row">
			<div class="esquerda">
				<div class="col-sm-3">
					<p class="fonte13">  <b>Marca: </b><?php echo $marca; ?> </p>

					<p class="fonte13"> <b>Cor: </b><?php echo $cor; ?> </p>
				</div>
				
			</div>


				<div class="col-sm-3">
					<p class="fonte13"> <b>Modelo: </b><?php echo $modelo; ?> </p>
					<p class="fonte13">  <b>Placa: </b><?php echo $placa; ?> </p>
					<p class="fonte13"> &nbsp;&nbsp;  </p>
				</div>

		</div>



		
				<div class="">
					<p class="fonte13">  <b>Observações:</b> <?php echo $obs; ?> </p>

				</div>

		<hr>



		<div class="row ">
			<div class="col-sm-12">
				<p style="font-size:14px"> <b> DESCRIÇÃO DO SERVIÇO </b> </p>
				<p style="font-size:13px"> <b> Tipo de Serviço: </b> <?php echo $nome_servico; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
					<p style="font-size:13px">  <?php echo $descricao; ?>  </p>
			</div>
		</div>
		
				<?php 
				$total_prod = 0;
				$valor_prod_f = 0;
				$total_prod_f = 0;
				$total_pagar_f = 0;
				$id_orc = $_GET['id'];
				$query = $pdo->query("SELECT * FROM orc_prod where orcamento = '$id' ");
				$res = $query->fetchAll(PDO::FETCH_ASSOC);
				if(@count($res) > 0){
					?>

					<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
						<tr bgcolor='#f9f9f9' >
							<td> <b>Produto</b> </td>
							<td> <b>Valor Unid</b> </td>
							<td> <b> Quantidade</b> </td>
							<td> <b>Valor Sub.</b> </td>

						</tr>
						<?php 


						for ($i=0; $i < @count($res); $i++) { 
							foreach ($res[$i] as $key => $value) {
							}
							$prod = $res[$i]['produto'];
							

							$query_pro = $pdo->query("SELECT * FROM produtos where id = '$prod' ");
							$res_pro = $query_pro->fetchAll(PDO::FETCH_ASSOC);
							$nome_prod = $res_pro[0]['nome'];
							$valor_prod = $res_pro[0]['valor_venda'];
							$id_prd = $res_pro[0]['id'];

							$query2 = $pdo->query("SELECT * FROM orc_prod where produto = '$prod' and  orcamento = '$id_orc'");
							$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
							$qtd = $res2[0]['qtd'];

							$valor_prod_qtd = $valor_prod*$qtd;

							@$total_prod = $valor_prod_qtd + @$total_prod;
							$total_pagar = @$total_prod + $valor_orc;


							$total_pagar_avista = $total_pagar - ($total_pagar * $valor_desconto / 100);

							$valor_prod_f = number_format($valor_prod, 2, ',', '.');
							$valor_prod_qtd_f = number_format($valor_prod_qtd, 2, ',', '.');
							$total_prod_f = number_format($total_prod, 2, ',', '.');
							$total_pagar_f = number_format($total_pagar, 2, ',', '.');

							?>

							<tr>
								<td> <?php echo $nome_prod; ?> </td>
								<td>R$ <?php echo $valor_prod_f; ?> </td>
								<td> <?php echo $qtd; ?> </td>
								<td>R$ <?php echo $valor_prod_qtd_f; ?> </td>

							</tr>

						<?php } ?>

					</table>
				<?php }else{
					$total_pagar = $valor_orc;
					$total_pagar_f = number_format($total_pagar, 2, ',', '.');

				} ?>

				<hr>
				
				



				<div class="row">
					<div class="col-md-6">	

						<p style="font-size:13px">  <b>Valor Dos Produtos: </b> R$ <?php echo $total_prod_f; ?> </p>
						<p style="font-size:13px">  <b>Valor Do Serviço: </b> R$ <?php echo $valor_orc_f; ?> </p>
						<p style="font-size:13px">  <b>Funcionário: </b> <?php echo $nome_funcionario; ?>  </p>

					</div>
					<div class="col-md-4 areaTotal" align="right">	

						<p class="pgto" style="font-size:16px">  <b>Total a Pagar: </b> R$ <?php echo $total_pagar_f; ?>  </p>
						<p class="pgto" style="font-size:12px">  Previsão de Entrega: <?php echo $data_prazo; ?> <br> 
								<br>

							</div>


						</div>



						<br><br><br>


					</div>


					<div class="footer">
						<div align="center">_______________________________________________________________________________</div> 
						<p style="font-size:14px" align="center"><big> <small><?php echo $data_hoje; ?></small> </big></p> 
					</div>




				</body>
				</html>
