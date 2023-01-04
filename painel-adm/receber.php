<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "receber";
require_once("../conexao.php"); 

$data_venc2 = date('Y-m-d');

?>


<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Valor</th>
                        <th>Adiantamento</th>
                        <th>Funcionário</th>
                        <th>Cliente</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php 

					$query = $pdo->query("SELECT * FROM contas_receber order by pago asc, data desc");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$descricao = $res[$i]['descricao'];
						$valor = $res[$i]['valor'];
						$adiantamento = $res[$i]['adiantamento'];
						$funcionario = $res[$i]['funcionario'];
						$cliente = $res[$i]['cliente'];
						$pago = $res[$i]['pago'];
						$data = $res[$i]['data'];
						
						$id = $res[$i]['id'];

						$query_usu = $pdo->query("SELECT * FROM clientes where cpf = '$cliente'");
						$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
						$nome_cli = $res_usu[0]['nome'];

						$query_usu = $pdo->query("SELECT * FROM funcionarios where cpf = '$funcionario'");
						$res_usu = $query_usu->fetchAll(PDO::FETCH_ASSOC);
						$nome_mec = $res_usu[0]['nome'];

						$valor = number_format($valor, 2, ',', '.');
						$adiantamento = number_format($adiantamento, 2, ',', '.');
						$data = implode('/', array_reverse(explode('-', $data)));

						if($pago == 'Sim'){
							$cor_pago = 'text-success';
						}else{
							$cor_pago = 'text-danger';
						}

						?>

                    <tr>
                        <td><i class='fas fa-square mr-1 <?php echo $cor_pago ?>'></i>

                            <?php echo $descricao ?>


                        </td>
                        <td>R$ <?php echo $valor ?> </td>
                        <td><?php echo $adiantamento ?> </td>
                        <td><?php echo $nome_mec ?> </td>
                        <td><?php echo $nome_cli ?> </td>
                        <td><?php echo $data ?> </td>



                        <td>
                            <?php if($pago != 'Sim'){ ?>
                            <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>"
                                class='text-primary mr-1' title='Lançar Adiantamento'><i class="fas fa-money-bill-wave"></i></a>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Lançar Valor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">



                    <div class="form-group">
                        <label>Valor</label>
                        <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor">
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




<?php 


if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
	echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
	echo "<script>$('#modal-deletar').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "aprovar") {
	echo "<script>$('#modal-aprovar').modal('show');</script>";
}


?>



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
    var pag = "<?=$pag?>";
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
    var pag = "<?=$pag?>";
    $('#btn-salvar').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: pag + "/adiantamento.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(mensagem) {

                if (mensagem.trim() === 'Salvo com Sucesso!') {
                    $('#btn-fechar').click();
                    window.location = "index.php?pag=" + pag;
                } else {
                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

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