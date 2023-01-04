<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'recep'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "os";
require_once("../conexao.php"); 

$funcao = @$_GET['funcao'];

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Serviço</th>
                        <th>Veículo</th>
                        <th>Valor Total</th>
                        <th>Data Abertura</th>
                        <th>Data Entrega</th>
                        <th>Arquivo Assinado</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php 

					$query = $pdo->query("SELECT * FROM os order by concluido like 'Não' desc, data desc");
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
						$data_prazo = $res[$i]['data_prazo'];
						$concluido = $res[$i]['concluido'];
						$funcionario = $res[$i]['funcionario'];
						$tipo = $res[$i]['tipo'];
						$data_fecha = $res[$i]['data_fecha'];
                        $imagem = $res[$i]['imagem'];
						$id = $res[$i]['id'];

						$data = implode('/', array_reverse(explode('-', $data)));
						$data_prazo = implode('/', array_reverse(explode('-', $data_prazo)));
						$data_fecha = implode('/', array_reverse(explode('-', $data_fecha)));
						//$valor = number_format($valor, 2, ',', '.');
						//$valor_mao_obra = number_format($valor_mao_obra, 2, ',', '.');


						$query_cat = $pdo->query("SELECT * FROM clientes where cpf = '$cliente' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$nome_cli = $res_cat[0]['nome'];
						$email_cli = $res_cat[0]['email'];

						$query_cat = $pdo->query("SELECT * FROM veiculos  where id = '$veiculo' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$modelo = $res_cat[0]['modelo'];
                        $cor_veiculo = $res_cat[0]['cor'];
                        $placa = $res_cat[0]['placa'];


						
						$query_cat = $pdo->query("SELECT * FROM funcionarios where cpf = '$funcionario' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$nome_funcionario = $res_cat[0]['nome'];


						if($concluido == 'Sim'){
							$cor_pago = 'text-success';
						}else{
							$cor_pago = 'text-danger';
						}

						?>

                    <tr>
                        <td><i class='fas fa-square mr-1 <?php echo $cor_pago ?>'></i>
                            <?php echo $nome_cli ?>
                        </td>
                        <td><?php echo $descricao ?></td>
                        <td><?php echo $modelo.' ' .$cor_veiculo. ' [' .$placa.']' ?></td>
                        <td>R$ <?php echo $valor+$valor_mao_obra . ',00' ?></td>

                        <td><?php echo $data ?></td>
                        <td><?php echo $data_fecha ?></td>
                        <td>
                            <?php if ($imagem != "" and $imagem != "sem-foto.jpg") {
									echo '<a href="../img/assinados/' . $imagem . '" title="Clique para ver o arquivo" target="_blank">Visualizar Arquivo</a>';
								} ?>
                        </td>

                        <td>

                            <?php if($concluido == 'Não'){ ?>

                            <a href="index.php?pag=<?php echo $pag ?>&funcao=concluir&id=<?php echo $id ?>"
                                class='text-success mr-1' title='Concluir Serviço'><i class='fas fa-check'></i></a>

                            <?php } ?>

                            <?php if($concluido == 'Sim'){ ?>
                            <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>"
                                class='text-primary mr-1' title='Editar Dados'><i class="fas fa-file-image"></i></a>
                            <?php } ?>

                        </td>
                    </tr>
                    <?php } ?>





                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
				if (@$_GET['funcao'] == 'editar') {
					$titulo = "Editar Registro";
					$id2 = $_GET['id'];

					$query = $pdo->query("SELECT * FROM os where id = '$id2' ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					$imagem2 = $res[0]['imagem'];
				} else {
					$titulo = "Inserir Registro";
				}
				?>

                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Imagem</label>
                            <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem"
                                name="imagem" onChange="carregarImg();">
                        </div>

                        <div id="divImgConta">
                            <?php if (@$imagem2 != "") { ?>
                            <img src="../img/assinados/<?php echo $imagem2 ?>" width="200" height="200" id="target">
                            <?php  } else { ?>
                            <img src="../img/assinados/sem-foto.jpg" width="200" height="200" id="target">
                            <?php } ?>
                        </div>

                    </div>

                    <small>
                        <div id="mensagem">

                        </div>
                    </small>

                </div>
                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">

                    <button type="button" id="btn-fechar" class="btn btn-secondary"
                        data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-concluir" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Concluir Serviço</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Concluir este Serviço?</p>

                <div align="center" id="mensagem_concluir" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="btn-cancelar-concluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-concluir" name="btn-concluir"
                        class="btn btn-success">Concluir</button>
                </form>
            </div>
        </div>
    </div>
</div>





<?php 

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
	echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "concluir") {
	echo "<script>$('#modal-concluir').modal('show');</script>";
}

?>




<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM OU SEM IMAGEM -->

<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
$(document).ready(function() {
    var pag = "<?=$pag?>";
    $('#btn-deletar').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: pag + "/excluir.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(mensagem) {

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

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM OU SEM IMAGEM -->
<script type="text/javascript">
$("#form").submit(function() {
    var pag = "<?= $pag ?>";
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: pag + "/inserir.php",
        type: 'POST',
        data: formData,

        success: function(mensagem) {
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso!") {
                //$('#nome').val('');
                $('#btn-fechar').click();
                window.location = "index.php?pag=" + pag;
            } else {
                $('#mensagem').addClass('text-danger')
            }
            $('#mensagem').text(mensagem)
        },

        cache: false,
        contentType: false,
        processData: false,
        xhr: function() { // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                myXhr.upload.addEventListener('progress', function() {
                    /* faz alguma coisa durante o progresso do upload */
                }, false);
            }
            return myXhr;
        }
    });
});
</script>





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
$(document).ready(function() {
    var pag = "<?=$pag?>";
    $('#btn-concluir').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: pag + "/concluir.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(mensagem) {

                if (mensagem.trim() === 'Concluído com Sucesso!') {
                    $('#btn-cancelar-concluir').click();
                    window.location = "index.php?pag=" + pag;
                }
                $('#mensagem_concluir').text(mensagem)

            },

        })
    })
})
</script>





<script type="text/javascript">
$(document).ready(function() {


    var funcao = "<?=$funcao?>";

    $('#dataTable').dataTable({
        "ordering": false
    })

    $('#dataTable2').dataTable({
        "ordering": false
    })

});
</script>

<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">
function carregarImg() {

    var target = document.getElementById('target');
    var file = document.querySelector("input[type=file]").files[0];

    var arquivo = file['name'];
    resultado = arquivo.split(".", 2);
    //console.log(resultado[1]);

    if (resultado[1] === 'pdf') {
        $('#target').attr('src', "../img/assinados/pdf.png");
        return;
    }


    var reader = new FileReader();

    reader.onloadend = function() {
        target.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);


    } else {
        target.src = "";
    }
}
</script>