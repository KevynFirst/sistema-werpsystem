<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'recep'){
    echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "qtd";
require_once("../conexao.php"); 



?>

<a href="index.php?pag=<?php echo $pag ?>&funcao=retorno&id=<?php echo $id ?>" class='text-info mr-1'
    title='Para Orçamentos'><i class="fas fa-angle-double-left"></i> <b>Retornar</b></a>
<br>
<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>N° Orçamento</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php 

					$query = $pdo->query("SELECT * FROM orc_prod order by id desc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$orcamento = $res[$i]['orcamento'];
                        $produto = $res[$i]['produto'];
                        $qtd = $res[$i]['qtd'];
						$id = $res[$i]['id'];
						
                        $query_cat = $pdo->query("SELECT * FROM produtos where id = '$produto' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$nome = $res_cat[0]['nome'];

						?>

                    <tr>
                        <td><?php echo $orcamento ?></td>
                        <td><?php echo $nome ?></td>
                        <td><?php echo $qtd ?></td>
                        <td>
                            <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>"
                                class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                            <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>"
                                class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
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

					$query = $pdo->query("SELECT * FROM orc_prod where id = '$id2' ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $orcamento2 = $res[0]['orcamento'];
                    $produto2 = $res[0]['produto'];
					$qtd2 = $res[0]['qtd'];
					
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

                    <div class="form-group">
                        <label><b>Orçamento (Não ALTERAR)</b></label>
                        <input value="<?php echo @$orcamento2 ?>" type="text" class="form-control" id="orcamento"
                            name="orcamento" placeholder="quantidade de Produtos">
                    </div>
                    <div class="form-group">
                        <label><b>Produto (Não ALTERAR)</b></label>
                        <input value="<?php echo @$produto2 ?>" type="text" class="form-control" id="produto"
                            name="produto" placeholder="quantidade de Produtos">
                    </div>

                    <div class="form-group">
                        <label><b>Quantidade</b></label>
                        <input value="<?php echo @$qtd2 ?>" type="text" class="form-control" id="qtd" name="qtd"
                            placeholder="quantidade de Produtos">
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

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "retorno") {
    echo "<script language='javascript'> window.location='index.php?pag=orcamentos' </script>";
}

?>




<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM OU SEM IMAGEM -->
<script type="text/javascript">
$("#form").submit(function() {
    var pag = "<?=$pag?>";
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






<script type="text/javascript">
$(document).ready(function() {
    $('#dataTable').dataTable({
        "ordering": false
    })

});
</script>