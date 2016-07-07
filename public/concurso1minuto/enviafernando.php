<?php 

/*
ini_set(SMTP,"smtp.terra.com.br");
ini_set(auth, true);
ini_set(username,"fernandof.mendes");
ini_set(password,"241241B"); */


$to = 'fernando.mendes@webca.com.br';


// subject
$subject = 'Assunto da mensagem';

// message
$message = '
<html>
<body>
<p>Mensagem em HTML:</p>
<p>Nome: '.$_POST["nome"].'</p>
<p>Email: '.$_POST["email"].'</p>
<p>Mensagem: '.$_POST["mensagem"].'</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Fernando Mendes <fernando.mendes@webca.com.br>' . "\r\n";
$headers .= 'From: Fernando Mendes <fernando.mendes@webca.com.br>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);

//header('Location: http://www.google.com.br/');

echo $message;
?>