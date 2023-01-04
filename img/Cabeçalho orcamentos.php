<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="../css/rel.css">

<?php
$id = $_GET['id'];
include('../conexao.php');
$query = "select o.id, o.cliente, o.motorista, o.placa, o.servico, o.valor_servico, o.valor_obra, o.valor_total, o.desconto, o.frete, o.dtfechamento, o.status,
        c.nome, c.cnpj, c.estadual, c.social, c.telefone, c.email
        from orcamentos as o 
        INNER JOIN 
        clientes as c 
        on o.cliente = c.nome
        where o.id = '$id'";
$result = mysqli_query($conexao, $query);
$porcentagem = 100;
 while($res_1 = mysqli_fetch_array($result)){
    $dtfechamento2 = implode('/', array_reverse(explode('-', $res_1['dtfechamento'])));
    $servico2 = implode('<hr>', (explode(';', $res_1['servico'])));
    $desconto2 = $res_1['desconto']*$porcentagem; 
 ?>  

<div class="cabecalho">
    <div class="row">
        <div class="col-sm-4">	
          <img id="logo" src="../img/logo_origin.fw.png" width="270px">
        </div>
        <div class="col-sm-8">
            <h3 class="titulo"><b>WP DA SILVA - ME</b></h3> 
            <table>
            <tr>
                <th class="cabecath"> CNPJ: 09.500.074/0001-61 </th>
                <th class="cabecath"> IE: 06.362337-4 </th>
            </tr>
            <tr>
                <td class="cabecath"> Rua Josias Inojosa de Oliveira, 5500 </td>
                <td class="cabecath"> Juazeiro do Norte - Ceará </td>
            </tr>
            <tr>
                <td class="cabecath"> Bairro: Santa Rosa </td>
                <td class="cabecath"> CEP: 63045-010 </td>
            </tr>
            <tr>
                <td class="cabecath"> Distrito Industrial do Cariri </td>
                <td class="cabecath">Tele-vendas: (88) 99901-9397 </td>
            </tr>
            <tr>
                <td class="cabecath">Contato: (88) 98826-1075 </td>
                <td class="cabecath"> E-mail: wecarrocerias@yahoo.com.br </td>
            </tr>
            </table>
		</div>
    </div>
    </div >
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <big>Orçamento N°  <?php echo $id ?> </big>
            </div>
            <div class="col-sm-4">
                <big>Data: <?php echo $dtfechamento2; ?></big>
            </div>
        </div>
    </div>
    <hr>
        <div class="row">
            <div class="col-sm-6">
                <p class="pdefine"><b>Nome do Cliente:</b> <?php echo $res_1['cliente']; ?> </p>
            </div>
            <div class="col-sm-6">
                <p class="pdefine"><b>CNPJ/CPF: </b> <?php echo $res_1['cnpj']; ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p class="pdefine"><b>R. Social: </b><?php echo $res_1['social']; ?></p>
            </div>
            <div class="col-sm-6">
                <p class="pdefine"><b>I. Estadual: </b><?php echo $res_1['estadual']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p class="pdefine"><b>Motorista: </b><?php echo $res_1['motorista']; ?></p>
            </div>
            <div class="col-sm-6">
                <p class="pdefine"><b>Telefone: </b><?php echo $res_1['telefone']; ?></p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <p class="porcamentos"><b> Orçamento - PLACA: <?php echo $res_1['placa']; ?> </b></p>
            </div>
        </div>
        <table id="spsv" class="table table-bordered">
            <thead>
                <tr>
                <th scope="col" colspan="2"><div class="thsp">Serviços Prestados<div></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row" colspan="2"><div><?php echo $servico2; ?></div></td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td class="thvalor" scope="col">serviço: R$ <?php echo $res_1['valor_servico']; ?></td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td class="thvalor" scope="col">frete: R$ <?php echo $res_1['frete']; ?></td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td class="thvalor" scope="col">desconto: <?php echo $desconto2; ?> %</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <th scope="col">Total: R$ <?php echo $res_1['valor_total']; ?></th>
                </tr>
            </tbody>
            </table>
    <div class="footer">
        Assinatura
    </div>
</div>
<?php } ?>