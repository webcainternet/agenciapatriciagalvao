<?php 

/*
ini_set(SMTP,"smtp.terra.com.br");
ini_set(auth, true);
ini_set(username,"fernandof.mendes");
ini_set(password,"241241B"); */


//$to = 'inscricaoconcurso@patriciagalvao.org.br';
//$to = 'concurso1minuto@gmail.com';
$to = 'romano@qualitacomunicacao.com, concurso1minuto@gmail.com, agencia@patriciagalvao.org.br';


// subject
$subject = 'Inscricao';

// message
$message = '
<html>
<body>
<p>Mensagem em HTML:</p>
<p>Nome: '.$_POST["nome"].'</p>
<p>Email: '.$_POST["email"].'</p>
<p>Fone: '.$_POST["phone"].'</p>
<p>Nascimento: '.$_POST["nasc"].'</p>
<p>CPF: '.$_POST["cpf"].'</p>
<p>Nome: '.$_POST["nome"].'</p>
<p>Endereco: '.$_POST["endereco"].'</p>
<p>Complemento: '.$_POST["complemento"].'</p>
<p>Cidade: '.$_POST["cidade"].'</p>
<p>Esado: '.$_POST["uf"].'</p>
<p>CEP: '.$_POST["cep"].'</p>
<p>Link: '.$_POST["link"].'</p>
<p>Mensagem: '.$_POST["mensagem"].'</p>
<p>Aceito: '.$_POST["aceito"].'</p>


</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Inscricao <concurso1minuto@gmail.com>' . "\r\n";
$headers .= 'From: Inscricao <concurso1minuto@gmail.com>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);

header('Location: confirmacao.html');

//echo $message;
?>