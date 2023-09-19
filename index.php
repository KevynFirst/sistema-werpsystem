<?php 
require_once("conexao.php");

//CRIAR AUTOMATICAMENTE O USUARIO ADMIN
$query = $pdo->query("SELECT * FROM usuarios where nivel = 'admin'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$res = $pdo->query("INSERT INTO usuarios SET nome = 'Administrador', cpf = '000.000.000-01', email = 'admin', senha = '123', nivel = 'admin'");
	//$res_func = $pdo->query("INSERT INTO funcionarios SET nome = 'Administrador', cpf = '000.000.000-01', email = 'admin'");	
}

$query2 = $pdo->query("SELECT * FROM usuarios where nivel = 'recep'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_reg2 = @count($res2);
if($total_reg2 == 0){
	$res2 = $pdo->query("INSERT INTO usuarios SET nome = 'Recepção', cpf = '000.000.000-02', email = 'recep@gmail.com', senha = '123', nivel = 'recep'");
	//$res2_func2 = $pdo->query("INSERT INTO funcionarios SET nome = 'Recepção', cpf = '000.000.000-02', email = 'recep'");	
}

// //EXCLUIR ORÇAMENTO APÓS XX DIAS
// $data_hoje = date('Y-m-d');
// $data_30 = date('Y-m-d', strtotime("-$excluir_orcamento_dias days",strtotime($data_hoje)));


// $query = $pdo->query("SELECT * FROM orcamentos where data_aberta <= '$data_30'");
// $res = $query->fetchAll(PDO::FETCH_ASSOC);
// for ($i=0; $i < @count($res); $i++) { 
// 		foreach ($res[$i] as $key => $value) {
// }
// $id_orc = $res[$i]['id'];
// $pdo->query("DELETE FROM orcamentos where id = '$id_orc'");
// }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>WE RPSystem</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">

				<form class="login100-form validate-form" method="post" action="autenticar.php">
					<span class="login100-form-logo">
						<img src="images/bg-01.png" width="110px">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						WE RPSYSTEM
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="email" placeholder="Email" required="required">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="senha" placeholder="Senha">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>



					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Entrar
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="" data-toggle="modal" data-target="#modalRecuperar" title="Clique para Recuperar sua Senha">
							Esqueceu a senha?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>


<!-- Modal -->
<div class="modal fade" id="modalRecuperar" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Recuperar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Digite Seu E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>

                    <small>
                        <div id="mensagem"></div>
                    </small>

                </div>
                <div class="modal-footer">
                    <button id="btn-fechar" type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-info">Recuperar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM OU SEM IMAGEM -->
<script type="text/javascript">
$("#form").submit(function() {
    event.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "recuperar.php",
        type: 'POST',
        data: formData,
        success: function(mensagem) {
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Sua senha foi Enviada para seu Email!") {
                //$('#nome').val('');
                //$('#btn-fechar').click();
                $('#mensagem').addClass('text-success')
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