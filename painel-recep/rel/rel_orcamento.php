<?php 

require_once("../../conexao.php"); 
@session_start();

$id = $_GET['id'];
$email = @$_GET['email'];

$html = file_get_contents($url."/painel-recep/rel/rel_orcamento_html.php?id=$id");
echo $html;

//ENVIAR O ORÇAMENTO PARA O EMAIL DO CLIENTE
if($email != ""){
	$destinatario = $email;
	$assunto = $nome_rp . ' - Orçamento';;
	$mensagem = $html;
	$cabecalhos = "From: " . $email_rp. "\r\n" ."Content-type: text/html; charset=utf-8; ";
	@mail($destinatario, $assunto, $mensagem, $cabecalhos);
}

?>