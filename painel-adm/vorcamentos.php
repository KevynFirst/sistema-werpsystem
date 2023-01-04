<?php 
@session_start();
if(@$_SESSION['nivel_usuario'] == null || @$_SESSION['nivel_usuario'] != 'admin'){
	echo "<script language='javascript'> window.location='../index.php' </script>";
}

$pag = "vorcamentos";
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
                        <th>N°</th>
                        <th>Cliente</th>
                        <th>Serviço</th>
                        <th>Veiculo</th>
                        <th>Valor Serviço</th>
                        <th>Dt Aberto</th>
                        <th>Funcionário</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php 

					$query = $pdo->query("SELECT * FROM orcamentos order by status asc, id asc ");
					$res = $query->fetchAll(PDO::FETCH_ASSOC);
					
					for ($i=0; $i < @count($res); $i++) { 
						foreach ($res[$i] as $key => $value) {
						}
						$funcionario = $res[$i]['funcionario'];
						$cliente = $res[$i]['cliente'];
						$veiculo = $res[$i]['veiculo'];
						$motorista = $res[$i]['motorista'];
						$descricao = $res[$i]['descricao'];
						$valor = $res[$i]['valor'];
                        $servico = $res[$i]['servico'];
                        $data_aberta = $res[$i]['data_aberta'];
                        $data_prazo = $res[$i]['data_prazo'];
						$status = $res[$i]['status'];

                        $obs = $res[$i]['obs'];
                        
						$id = $res[$i]['id'];

						$data_aberta = implode('/', array_reverse(explode('-', $data_aberta)));
                        $data_prazo = implode('/', array_reverse(explode('-', $data_prazo)));

                        $valor = number_format($valor,2, ',', '.');

						$query_cat = $pdo->query("SELECT * FROM clientes where cpf = '$cliente' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$nome_cli = $res_cat[0]['nome'];
                        $email_cli = $res_cat[0]['email'];

                        $query_cat = $pdo->query("SELECT * FROM veiculos  where id = '$veiculo' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$modelo = $res_cat[0]['modelo'];
                        $cor_veiculo = $res_cat[0]['cor'];
                        $placa = $res_cat[0]['placa'];
                        

                        $query_cat = $pdo->query("SELECT * FROM servicos  where id = '$servico' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$nome_serv = $res_cat[0]['nome'];

                        $query_cat = $pdo->query("SELECT * FROM funcionarios where cpf = '$funcionario' ");
						$res_cat = $query_cat->fetchAll(PDO::FETCH_ASSOC);
						$nome_func = $res_cat[0]['nome'];

						if($status == 'Aberto'){
							$cor_pago = 'text-danger';
						}else if($status == 'Aprovado'){
							$cor_pago = 'text-primary';
						}else{
							$cor_pago = 'text-success';
						}

						?>

                    <tr>
                        <td><?php echo $id ?></td>
                        <td>
                            <i class='fas fa-square mr-1 <?php echo $cor_pago ?>'></i>
                            <?php echo $nome_cli ?>

                        </td>
                        <td><?php echo $nome_serv ?></td>
                        <td><?php echo $modelo.' ' .$cor_veiculo. ' [' .$placa.']' ?></td>

                        <td>R$ <?php echo $valor ?></td>
                        <td><?php echo $data_aberta ?></td>
                        <td><?php echo $nome_func ?></td>
                        <td><?php echo $status ?></td>
                        <td>

                            <?php if($status == 'Aberto'){ ?>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>"
                                class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                            <?php } ?>

                            <a href="rel/rel_orcamento.php?id=<?php echo $id ?>" target="_blank"
                                class='text-info mr-1' title='Imprimir Orçamento'><i class='far fa-file-alt'></i></a>

                            <!--<a href="rel/rel_orcamento.php?id=<?php echo $id ?>&email=<?php echo $email_cli ?>"
                                target="_blank" class='text-info mr-1' title='Email Orçamento'><i
                                    class='far fa-envelope'></i></a>-->

                            <?php if($status == 'Aberto'){ ?>

                                <a href="index.php?pag=<?php echo $pag ?>&funcao=aprovar&id=<?php echo $id ?>"
                                class='text-success mr-1' title='Aprovar Orçamento'><i class='fas fa-check'></i></a>

                            <?php } ?>



                        </td>
                    </tr>
                    <?php } ?>





                </tbody>
            </table>
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

                <div align="center" id="mensagem_excluir" class="">

                </div>

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
                <h5 class="modal-title">Aprovar Orçamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Aprovar este Orçamento?</p>

                <div align="center" id="mensagem_orc" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="btn-cancelar-orc">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-orc" name="btn-orc" class="btn btn-success">Aprovar</button>
                </form>
            </div>
        </div>
    </div>
</div>




<?php 

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
    var pag = "<?=$pag?>";
    $('#btn-orc').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: pag + "/aprovar.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(mensagem) {

                if (mensagem.trim() === 'Aprovado com Sucesso!') {
                    $('#btn-cancelar-orc').click();
                    window.location = "index.php?pag=" + pag;
                }
                $('#mensagem_orc').text(mensagem)

            },

        })
    })
})
</script>



<script type="text/javascript">
$(document).ready(function() {


    var funcao = "<?=$funcao?>";

    if (funcao.trim() === 'editar') {
        $('#btn-buscar').click();
    } else {
        $('#div-veiculo').text('Busque pelo CPF ao Lado');
    }


    $('#dataTable').dataTable({
        "ordering": false
    })

    $('#dataTable2').dataTable({
        "ordering": false
    })

});
</script>