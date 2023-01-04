<?php 
require_once("../conexao.php"); 
@session_start();

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = strtoupper(utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today'))));
?>

<!DOCTYPE html>
<html>
<head>
	<title>Catálogo de Produtos</title>
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
			<span class="titulorel"> Lista de Produtos </span>
			</div>
			<div class="col-sm-4 direita" align="right">	
				<big> <small> Data: <?php echo $data_hoje; ?></small> </big>
			</div>
		</div>


		<hr>



		<table class='table' width='100%'  cellspacing='0' cellpadding='3'>
			<tr bgcolor='#f9f9f9' >
				<th>Nome</th>
						<th>Categoria</th>
						<th>Fornecedor</th>
						<th>Valor Compra</th>
						<th>Valor Venda</th>
						<th>Estoque</th>
						<th>Imagem</th>

			</tr>
			<?php 

					$query = $pdo->query("SELECT * FROM produtos order by estoque asc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					$totalProdutos = @count($res);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$nome = $res[$i]['nome'];
						$categoria = $res[$i]['categoria'];
						$fornecedor = $res[$i]['fornecedor'];
						$valor_compra = $res[$i]['valor_compra'];
						$valor_venda = $res[$i]['valor_venda'];
						$estoque = $res[$i]['estoque'];
						$descricao = $res[$i]['descricao'];
						$imagem = $res[$i]['imagem'];
						$id = $res[$i]['id'];


						$valor_compra = number_format($valor_compra, 2, ',', '.');
						$valor_venda = number_format($valor_venda, 2, ',', '.');

						$query_cat = $pdo->query("SELECT * FROM categorias where id = '$categoria' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$nome_cate = $res_cat[0]['nome'];

						$query_forn = $pdo->query("SELECT * FROM fornecedores where id = '$fornecedor' ");
						$res_forn = $query_forn->fetchAll(PDO::FETCH_ASSOC);
						$nome_forn = $res_forn[0]['nome'];

						?>

						<tr>
							<td><?php echo $nome ?></td>
							<td><?php echo $nome_cate ?></td>
							<td>
								
									<?php echo $nome_forn ?>
								
							</td>
							<td>R$ <?php echo $valor_compra ?></td>
							<td>R$ <?php echo $valor_venda ?></td>
							<td><?php echo $estoque ?></td>
							<td><img src="../img/produtos/<?php echo $imagem ?>" width="50" ></td>

							
						</tr>
					<?php } ?>



		</table>

		<hr>


		<div class="row margem-superior">
			<div class="col-md-12">
				<div class="" align="right">
								
					<span class="areaTotal"> <b> Total de Produtos = <?php echo @$totalProdutos ?> </b> </span>
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
