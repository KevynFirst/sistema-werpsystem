<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "clientes";
require_once("../conexao.php"); 

$tipo_pessoa2 = "Física";

?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block"
        href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo Cliente</a>
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
                        <th>Nome</th>
                        <th>Tipo Pessoa</th>
                        <th>CPF / CNPJ</th>
                        <th>Insc. Estadual</th>
                        <th>Razão Social</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php 

					$query = $pdo->query("SELECT * FROM clientes order by id desc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$nome = $res[$i]['nome'];
						$tipo_pessoa = $res[$i]['tipo_pessoa'];
						$cpf = $res[$i]['cpf'];
						$estadual = $res[$i]['estadual'];
						$social = $res[$i]['social'];
						$telefone = $res[$i]['telefone'];
						
						$email = $res[$i]['email'];
						$id = $res[$i]['id'];
						?>

                    <tr>
                        <td><?php echo $nome ?></td>
                        <td><?php echo $tipo_pessoa ?></td>
                        <td><?php echo $cpf ?></td>
                        <td><?php echo $estadual ?></td>
                        <td><?php echo $social ?></td>
                        <td><?php echo $telefone ?></td>
                        <td><?php echo $email ?></td>


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

					$query = $pdo->query("SELECT * FROM clientes where id = '$id2' ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					$nome2 = $res[0]['nome'];
					$tipo_pessoa2 = $res[0]['tipo_pessoa'];
					$cpf2 = $res[0]['cpf'];
					$estadual2 = $res[0]['estadual'];
					$social2 = $res[0]['social'];
					$telefone2 = $res[0]['telefone'];					
					$email2 = $res[0]['email'];



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
                                <label>Nome</label>
                                <input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="nome_mec"
                                    name="nome_mec">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo Pessoa</label>
                                <select name="tipo_pessoa" class="form-control" id="pessoa">
                                    <option <?php if($tipo_pessoa2 == 'Física'){ ?> selected <?php } ?> value="Física">
                                        Física</option>
                                    <option <?php if($tipo_pessoa2 == 'Jurídica'){ ?> selected <?php } ?>
                                        value="Jurídica">Jurídica</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6" id="divcpf">
                            <div class="form-group">
                                <label>CPF</label>
                                <input value="<?php echo @$cpf2 ?>" type="text" class="form-control" id="cpf"
                                    name="cpf_mec">
                            </div>
                        </div>

                        <div class="col-md-6" id="divcnpj">
                            <div class="form-group">
                                <label>CNPJ</label>
                                <input value="<?php echo @$cpf2 ?>" type="text" class="form-control" id="cnpj"
                                    name="cnpj_mec">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input value="<?php echo @$telefone2 ?>" type="text" class="form-control" id="telefone"
                                    name="telefone_mec">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Inscrição Estadual </label>
                                <input value="<?php echo @$estadual2 ?>" type="text" class="form-control" id="estadual"
                                    name="estadual">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Razão Social</label>
                                <input value="<?php echo @$social2 ?>" type="text" class="form-control" id="social"
                                    name="social">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input value="<?php echo @$email2 ?>" type="text" class="form-control" id="email"
                            name="email_mec" placeholder="exemple@exemple.com">
                    </div>

                    <small>
                        <div id="mensagem">

                        </div>
                    </small>

                </div>



                <div class="modal-footer">



                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
                    <input value="<?php echo @$cpf2 ?>" type="hidden" name="antigo" id="antigo">
                    <input value="<?php echo @$email2 ?>" type="hidden" name="antigo2" id="antigo2">

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
$(document).ready(function() {
    $('#cpf').mask('000.000.000-00');
    $('#cnpj').mask('00.000.000/0000-00');
});
</script>



<script type="text/javascript">
var pessoa = "<?=$tipo_pessoa2?>";
$(document).ready(function() {
    if (pessoa === "Física") {
        document.getElementById('divcnpj').style.display = "none";
    } else {
        document.getElementById('divcpf').style.display = "none";
    }
})

$('#pessoa').change(function(event) {
    var select = document.getElementById('pessoa');
    var value = select.options[select.selectedIndex].value;
    if (value === 'Física') {
        document.getElementById('divcnpj').style.display = "none";
        document.getElementById('divcpf').style.display = "block";
    } else {
        document.getElementById('divcnpj').style.display = "block";
        document.getElementById('divcpf').style.display = "none";
    }

});
</script>