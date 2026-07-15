<?php
$action = $_GET["action"] ?? '';

if ($action == "contato") {

	$nome = trim($_POST["nome"] ?? '');
	$email = trim($_POST["email"] ?? '');
	$assunto = trim($_POST["assunto"] ?? '');
	$mensagem = trim($_POST["mensagem"] ?? '');

	if ($nome == "") {
		echo "<div class='alert alert-danger' role='alert'>Nome em branco...</div>";
	}
	elseif($email == ""){
		echo "<div class='alert alert-danger' role='alert'>Email em branco...</div>";
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<div class='alert alert-danger' role='alert'>Email inválido...</div>";
	}
	elseif($assunto == ""){
		echo "<div class='alert alert-danger' role='alert'>Assunto em branco...</div>";
	}
	elseif($mensagem == ""){
		echo "<div class='alert alert-danger' role='alert'>Mensagem em branco...</div>";
	}
	else{

		include 'config.php';
		require 'vendor/autoload.php';
		$mail = new PHPMailer\PHPMailer\PHPMailer();

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $dadosEmail["host"];  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $dadosEmail["username"];                 // SMTP username
		$mail->Password = $dadosEmail["password"];                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom($dadosEmail["email"], 'Nao Responder PHP PA');
		$mail->addReplyTo($email, $nome);

		$mail->addAddress('contato@phppa.org', "Email contato PHPPA");     // Add a recipient

		$data = date("d/m/Y H:i:s");

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = "[CONTATO SITE] - $assunto";
		$mail->Body    =  "<b>Nome</b> " . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8') . "<br>
						   <b>Email</b> " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "<br>
						   <b>Data</b> $data<br>
						   <b>Assunto</b> " . htmlspecialchars($assunto, ENT_QUOTES, 'UTF-8') . "<br>
						   <b>Mensagem:</b> " . nl2br(htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'));

		if(!$mail->send()) {
		    echo "<div class='alert alert-danger' role='alert'>Não foi possível enviar o contato...</div>";
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {

		    echo "<div class='alert alert-success' role='alert'>Contato enviado com sucesso...</div>";
		    echo "<script>$(document).ready(function() {
						setTimeout(function(){ var novaURL = '/';
					                           $(window.document.location).attr('href',novaURL);
					                    }, 1500);
		    				});</script>";
		}

	}
	
}
