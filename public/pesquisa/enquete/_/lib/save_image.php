<?php
$item = json_decode(base64_decode($_REQUEST["item"]));

$timeout = 300;

if($item->time < (time()-$timeout)){
  die("Invalid token - timeout");
}

if($item->token_id !== "A125FC1134F884BB598B94C11D578"){
  die("Invalid token - id");
}

$secret ="37VbrTCs67c18H1vxS69dWuDH4OHuG7f";
$valid = ($_REQUEST["signed"] === base64_encode(hash_hmac("sha256",json_encode($item),$secret)));

if(!$valid){
    die("Invalid token");
} else {
    $dir = dirname(__FILE__) . '/../../results';
    $image = $_POST['image'];
    $name = md5(time());
    $imagename = $name . ".png";

    $image = str_replace('data:image/png;base64,', '', $image);
    $decoded = base64_decode($image);

    file_put_contents($dir . "/" . $imagename, $decoded, LOCK_EX);

    if ($_POST['id'] != '-1') {
        $DBH = new PDO("mysql:dbname=comeati_pesquisa;host=10.0.20.3", "comeati_pesquisa", "d93jdhwd" );
        $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling

        $sql = "UPDATE pgal_user_meta SET result_image = :image_name WHERE user_id = :id";
        $data = array(
            'image_name' => $imagename,
            'user_id' => (int) $_POST['id']
        );

        $STH = $DBH->prepare($sql);
        $STH->execute($data);
    }
}

die();
