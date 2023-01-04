<?php 
$pag = "funcionarios";
require_once("../conexao.php"); 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
    echo "<script language='javascript'> window.location='../index.php' </script>";
}
?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block"
        href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo Funcionário</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none"
        href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>
</div>

<!-- show DataTales -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Data Admissão</th>
                        <th>Salário</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $query = $pdo->query("SELECT * FROM funcionarios order by id desc ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    for ($i=0; $i < @count($res); $i++) { 
                        foreach ($res[$i] as $key => $value) {
                    }

                    $nome = $res[$i]['nome'];
                    $cpf = $res[$i]['cpf'];
                    $dtadmissao = $res[$i]['dtadmissao'];
                    $salario = $res[$i]['salario'];
                    $telefone = $res[$i]['telefone'];
                    $endereco = $res[$i]['endereco'];
                    $email = $res[$i]['email'];
                    $id = $res[$i]['id'];
                    ?>

                    <tr>
                        <td><?php echo $nome ?></td>
                        <td><?php echo $cpf ?></td>
                        <td><?php echo $dtadmissao ?></td>
                        <td><?php echo $salario ?></td>
                        <td><?php echo $telefone ?></td>
                        <td><?php echo $endereco ?></td>
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
                if (@$_GET['funcao'] == 'editar'){
                    
                    $titulo = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM funcionarios where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $nome2 = $res[0]['nome'];
                    $cpf2 = $res[0]['cpf'];
                    $dtadmissao2 = $res[0]['dtadmissao'];
                    $salario2 = $res[0]['salario'];
                    $telefone2 = $res[0]['telefone'];
                    $endereco2 = $res[0]['endereco'];
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
                                <label><b>Nome</b></label>
                                <input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="nome-func"
                                    name="nome-func">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>CPF</b></label>
                                <input value="<?php echo @$cpf2 ?>" type="text" class="form-control" id="cpf"
                                    name="cpf-func">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Data Admissão</b></label>
                                <input value="<?php echo @$dtadmissao2 ?>" type="text" class="form-control"
                                    id="dtadmissao" name="dtadmissao-func">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><b>Salário</b></label>
                                <input value="<?php echo @$salario2 ?>" type="text" class="form-control" id="salario"
                                    name="salario-func">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label><b>Telefone</b></label>
                                <input value="<?php echo @$telefone2 ?>" type="text" class="form-control" id="telefone"
                                    name="telefone-func">
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label><b>Email</b></label>
                                <input value="<?php echo @$email2 ?>" type="text" class="form-control" id="email-func"
                                    name="email-func" placeholder="exemple@exemple.com">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label><b>Endereço</b></label>
                                <input value="<?php echo @$endereco2 ?>" type="text" class="form-control"
                                    id="endereco-func" name="endereco-func"
                                    placeholder="ex.: R. Exemple, 00, exemple-ce">
                            </div>
                        </div>
                    </div>



                    <small>
                        <div id="mensagem"></div>
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

<!--MODAL DELETAR-->
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
                <div align="center" id="mensagem_excluir" class=""></div>
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
//CHAMAR FUNÇÕES
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
                }
                $('#mensagem_excluir').text(mensagem)

            },

        })
    })
})
</script>

<!--SCRIPT PARA CARREGAR IMAGEM -->
<script type="text/javascript">
function carregarImg() {

    var target = document.getElementById('target');
    var file = document.querySelector("input[type=file]").files[0];
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

<!--Ignorar order table-->
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTable').dataTable({
        "ordering": false
    })
});
$(document).ready(function() {
    $('#cpf').mask('000.000.000-00');
    $('#dtadmissao').mask('00/00/0000');
    $('#salario').mask('R$ 0.000,00');
    $('#telefone').mask('(00) 0.0000-0000');
});
</script>