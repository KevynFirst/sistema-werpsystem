<?php
$pag = "pagar";
@session_start();
if (@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin') {
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

require_once("../conexao.php");
$data_venc2 = date('Y-m-d');

?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block"
        href="index.php?pag=<?php echo $pag ?>&funcao=novo">Nova Conta</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none"
        href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Funcionário</th>
                        <th>Data Vencimento</th>
                        <th>Arquivo</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
					$query = $pdo->query("SELECT * FROM contas_pagar order by pago asc, data_venc desc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);

					for ($i = 0; $i < @count($res); $i++) {
						foreach ($res[$i] as $key => $value) {
						}
						$descricao = $res[$i]['descricao'];
						$valor = $res[$i]['valor'];
						$funcionario = $res[$i]['funcionario'];
						$data_venc = $res[$i]['data_venc'];
						$pago = $res[$i]['pago'];
						$imagem = $res[$i]['imagem'];

						$id = $res[$i]['id'];

						$query_usu = $pdo->query("SELECT * FROM usuarios where cpf = '$funcionario'");
						$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
						$nome_func = $res_usu[0]['nome'];

						$valor = number_format($valor, 2, ',', '.');
						$data_venc = implode('/', array_reverse(explode('-', $data_venc)));

						if ($pago == 'Sim') {
							$cor_pago = 'text-success';
						} else {
							$cor_pago = 'text-danger';
						}

					?>

                    <tr>
                        <td><i class='fas fa-square mr-1 <?php echo $cor_pago ?>'></i>

                            <?php if ($descricao != 'Compra de Produtos') {
									echo $descricao;
								} else {
									echo '<a class="text-dark" href="index.php?pag=' . $pag . '&funcao=compra&id=' . $id . '" title="Ver Detalhes Compra">' . $descricao . '</a>';
								} ?>


                        </td>
                        <td>R$ <?php echo $valor ?> </td>
                        <td><?php echo $nome_func ?> </td>
                        <td><?php echo $data_venc ?> </td>

                        <td>
                            <?php if ($imagem != "" and $imagem != "sem-foto.jpg") {
									echo '<a href="../img/contas/' . $imagem . '" title="Clique para ver o arquivo" target="_blank">Ver Arquivo</a>';
								} ?>
                        </td>

                        <td>
                            <?php if ($pago != 'Sim') { ?>
                            <?php //if($descricao == 'Compra de Produtos'){ 
									?>
                            <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>"
                                class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                            <?php // } ?>
                            <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>"
                                class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                            <a href="index.php?pag=<?php echo $pag ?>&funcao=aprovar&id=<?php echo $id ?>"
                                class='text-success mr-1' title='Aprovar Conta'><i class='fas fa-check-square'></i></a>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
				if (@$_GET['funcao'] == 'editar') {
					$titulo = "Editar Registro";
					$id2 = $_GET['id'];

					$query = $pdo->query("SELECT * FROM contas_pagar where id = '$id2' ");
					$res2 = $query->fetchAll(PDO::FETCH_ASSOC);
					$descricao2 = $res2[0]['descricao'];
					$valor2 = $res2[0]['valor'];
					$data_venc2 = $res2[0]['data_venc'];
					$imagem2 = $res2[0]['imagem'];
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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Descricao</label>
                                <input value="<?php echo @$descricao2 ?>" type="text" class="form-control"
                                    id="descricao" name="descricao" placeholder="Descrição">
                            </div>

                            <div class="form-group">
                                <label>Valor</label>
                                <input value="<?php echo @$valor2 ?>" type="text" class="form-control" id="valor"
                                    name="valor" placeholder="Valor">
                            </div>

                            <div class="form-group">
                                <label>Data Vencimento</label>
                                <input value="<?php echo @$data_venc2 ?>" type="date" class="form-control"
                                    id="data_venc" name="data_venc">
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem"
                                    name="imagem" onChange="carregarImg();">
                            </div>

                            <div id="divImgConta">
                                <?php if (@$imagem2 != "") { ?>
                                <img src="../img/contas/<?php echo $imagem2 ?>" width="170" height="170" id="target">
                                <?php  } else { ?>
                                <img src="../img/contas/sem-foto.jpg" width="170" height="170" id="target">
                                <?php } ?>
                            </div>

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

                <small>
                    <div align="center" id="mensagem_excluir" class=""> </div>
                </small>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="btn-cancelar-excluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal" id="modal-aprovar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aprovar Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Aprovar este Pagamento?</p>

                <small>
                    <div align="center" id="mensagem_aprovar" class=""> </div>
                </small>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="btn-cancelar-aprovar">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-aprovar" name="btn-deletar" class="btn btn-success">Aprovar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal" id="modal-compra" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dados da Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php
				if (@$_GET['funcao'] == 'compra') {

					$id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM contas_pagar where id = '$id2' ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $pago = $res[0]['pago'];

					$query = $pdo->query("SELECT * FROM compras where id_conta = '$id2' ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					$produto = $res[0]['produto'];
					$valor = $res[0]['valor'];
					$funcionario = $res[0]['funcionario'];
					$data = $res[0]['data'];

					$valor = number_format($valor, 2, ',', '.');
					$data = implode('/', array_reverse(explode('-', $data)));

					$query_prod = $pdo->query("SELECT * FROM produtos where id = '$produto' ");
					$res_prod = $query_prod->fetchAll(PDO::FETCH_ASSOC);
					$nome_produto = $res_prod[0]['nome'];
					$img_produto = $res_prod[0]['imagem'];


					$query_prod = $pdo->query("SELECT * FROM usuarios where id = '$funcionario' ");
					$res_prod = $query_prod->fetchAll(PDO::FETCH_ASSOC);
					$nome_funcionario = $res_prod[0]['nome'];
				}


				?>
                <div class="row">
                    <div class="col-md-3">
                        <img src="../img/produtos/<?php echo $img_produto ?>" width="100%">
                    </div>

                    <div class="col-md-9">
                        <span><b>Nome do Produto: </b> <i><?php echo $nome_produto ?></i><br>
                            <span><b>Valor da Compra: </b> <i><?php echo $valor ?></i>
                                <br>
                                <span><b>Data: </b> <i><?php echo $data ?></i><br>

                    </div>
                </div>


            </div>

        </div>
    </div>
</div>



<?php

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "novo") {
	echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
	echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
	echo "<script>$('#modal-deletar').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "aprovar") {
	echo "<script>$('#modal-aprovar').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "compra") {
	echo "<script>$('#modal-compra').modal('show');</script>";
}

?>




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
    var pag = "<?= $pag ?>";
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
                } else {
                    $('#mensagem_excluir').addClass('text-danger')
                }

                $('#mensagem_excluir').text(mensagem)

            },

        })
    })
})
</script>





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
$(document).ready(function() {
    var pag = "<?= $pag ?>";
    $('#btn-aprovar').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: pag + "/aprovar.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(mensagem) {

                if (mensagem.trim() === 'Aprovado com Sucesso!') {
                    $('#btn-cancelar-aprovar').click();
                    window.location = "index.php?pag=" + pag;
                } else {
                    $('#mensagem_aprovar').addClass('text-danger')
                }

                $('#mensagem_aprovar').text(mensagem)

            },

        })
    })
})
</script>




<script type="text/javascript">
$(document).ready(function() {
    $('#dataTable').dataTable({
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
        $('#target').attr('src', "../img/contas/pdf.png");
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