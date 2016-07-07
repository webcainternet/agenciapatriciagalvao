<?php 


$to = 'romanoterra@gmail.com';

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
$headers .= 'To: Romano terra  <romanoterra@gmail.com>' . "\r\n";
$headers .= 'From: Remetente <remetente@webca/cp,/br>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);

header('Location: http://www.google.com.br/');
?>