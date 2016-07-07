<?php 

/*
ini_set(SMTP,"smtp.terra.com.br");
ini_set(auth, true);
ini_set(username,"fernandof.mendes");
ini_set(password,"241241B"); */


//$to = 'contatoconcurso@patriciagalvao.org.br';
$to = 'contatoconcurso1minuto@gmail.com';

// subject
$subject = 'Contato';

// message
$message = '
<html>
<body>
<p>Mensagem em HTML:</p>
<p><strong>'.$_POST["contato"].'</strong></p>
<p>Nome: '.$_POST["nome"].'</p>
<p>Email: '.$_POST["email"].'</p>
<p>Fone: '.$_POST["phone"].'</p>
<p>Mensagem: '.$_POST["mensagem"].'</p>



</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
//$headers .= 'To: Contato <contatoconcurso@patriciagalvao.org.br>' . "\r\n";
//$headers .= 'From: Contato <contatoconcurso@patriciagalvao.org.br>' . "\r\n";

$headers .= 'To: Contato <contatoconcurso1minuto@gmail.com>' . "\r\n";
$headers .= 'From: Contato <contatoconcurso1minuto@gmail.com>' . "\r\n";


// Mail it
mail($to, $subject, $message, $headers);

header('Location: confirmacao.html');

//echo $message;
?>