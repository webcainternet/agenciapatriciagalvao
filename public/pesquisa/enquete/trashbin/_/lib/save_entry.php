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
    $results = json_decode($_REQUEST["result"], true);

    date_default_timezone_set('America/Sao_Paulo');

    $user = false;
    $maid = false;
    $people = array();

    foreach ($results as $result) {
        if ($result['key'] == 'user') {
            $user = $result;
        } elseif($result['key'] == 'maid') {
            $maid = $result;
        } else {
            array_push($people, $result);
        }
    }

    $DBH = new PDO("mysql:dbname=comeati_pesquisa;host=10.0.20.3", "comeati_pesquisa", "d93jdhwd" );
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling

    $sql = "INSERT INTO pgal_users (name, age, gender, color, lives_alone, house_size, has_maid, maid_days, created_at, race, maid_age, maid_gender, maid_race) VALUES (:name, :age, :gender, :color, :lives_alone, :house_size, :has_maid, :maid_days, :created_at, :race, :maid_age, :maid_gender, :maid_race);";

    $data = array(
        'name' => $user['person'],
        'age' => (int) $user['age'],
        'gender' => $user['gender'],
        'color' => $user['color'],
        'lives_alone' => (count($people) > 0) ? 'N' : 'Y',
        'house_size' => (int) $user['house_size'],
        'has_maid' => ($maid) ? 'Y' : 'N',
        'maid_days' => ($maid) ? (int) $user['maid_days'] : 0,
        'maid_age' => ($maid && $maid['age']) ? (int) $maid['age'] : 0,
        'maid_gender' => ($maid && $maid['gender']) ? $maid['gender'] : 'N',
        'maid_race' => ($maid && $maid['race']) ? $maid['race'] : 'N',
        'created_at' => date('Y-m-d H:i:s'),
        'race' => $user['race']
    );

    $STH = $DBH->prepare($sql);
    $STH->execute($data);

    $user_id = $DBH->lastInsertId();

    save_user_meta('pgal_user_meta', 'user_id', $user_id, $user['hours']);

    if ($maid) {
        save_user_meta('pgal_user_meta', 'user_id', $user_id, $maid['hours'], 'maid_');
    }

    foreach ($people as $person) {
        $sql = "INSERT INTO pgal_user_roomies (name, age, gender, color, user_id, race) VALUES (:name, :age, :gender, :color, :user_id, :race)";

        $data = array(
            'name' => $person['person'],
            'age' => (int) $person['age'],
            'gender' => ($person['gender']) ? $person['gender'] : 'N',
            'color' => $person['color'],
            'user_id' => $user_id,
            'race' => ($person['race']) ? $person['race'] : 'N'
        );

        $STH = $DBH->prepare($sql);
        $STH->execute($data);

        $user_roomie_id = $DBH->lastInsertId();

        save_user_meta('pgal_user_roomie_meta', 'user_roomie_id', $user_roomie_id, $person['hours']);
    }

    echo $user_id;
}

function save_user_meta($table, $parent_key, $id, $hours, $prefix = '') {
    $DBH = new PDO("mysql:dbname=comeati_pesquisa;host=10.0.20.3", "comeati_pesquisa", "d93jdhwd" );
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling

    $meta_sql = "INSERT INTO $table (meta_key, meta_value, $parent_key) VALUES (:meta_key, :meta_value, :id);";

    $data = array();
    $data['id'] = $id;

    $STH = $DBH->prepare($meta_sql);
    foreach ($hours as $key => $value) {
        if ($key == 'outbound') {
            $data['meta_key'] = $prefix . 'paid_work';
            $data['meta_value'] = $value;

            $STH->execute($data);
        } else {
            foreach ($value as $ke => $valu) {
                foreach ($valu as $k => $v) {
                    $data['meta_key'] = $prefix . $ke . '_' . $k;
                    $data['meta_value'] = $v;

                    $STH->execute($data);
                }
            }
        }
    }
}

die();
