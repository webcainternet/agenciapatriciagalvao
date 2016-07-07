<?php
try {
    $db = new PDO("mysql:dbname=comeati_pesquisa;host=10.0.20.3", "comeati_pesquisa", "d93jdhwd" );
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
    $sql = "CREATE table IF NOT EXISTS pgal_users(
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(192) NOT NULL,
                age INT(3) NOT NULL,
                gender VARCHAR(1) NOT NULL,
                color VARCHAR(7) NOT NULL,
                race VARCHAR(32) NOT NULL,
                lives_alone VARCHAR(1) NOT NULL,
                house_size INT(4) NOT NULL,
                has_maid VARCHAR(1) NOT NULL,
                maid_days INT(1) NOT NULL,
                maid_age INT(3) NOT NULL,
                maid_gender VARCHAR(1) NOT NULL,
                maid_race VARCHAR(32) NOT NULL,
                created_at DATETIME NOT NULL);";
    $db->exec($sql);

    $sql = "CREATE table IF NOT EXISTS pgal_user_meta(
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                meta_key VARCHAR(32) NOT NULL,
                meta_value VARCHAR(192) NOT NULL,
                user_id INT(11) NOT NULL,
                FOREIGN KEY (user_id) REFERENCES pgal_users(id));";
    $db->exec($sql);

    $sql = "CREATE table IF NOT EXISTS pgal_user_roomies(
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(192) NOT NULL,
                age INT(3) NOT NULL,
                gender VARCHAR(1) NOT NULL,
                race VARCHAR(32) NOT NULL,
                color VARCHAR(7) NOT NULL,
                user_id INT(11) NOT NULL,
                FOREIGN KEY (user_id) REFERENCES pgal_users(id));";
    $db->exec($sql);

    $sql = "CREATE table IF NOT EXISTS pgal_user_roomie_meta(
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                meta_key VARCHAR(32) NOT NULL,
                meta_value VARCHAR(192) NOT NULL,
                user_roomie_id INT(11) NOT NULL,
                FOREIGN KEY (user_roomie_id) REFERENCES pgal_user_roomies(id));";
    $db->exec($sql);

    print("Created Tables.\n");

} catch(PDOException $e) {
    echo $e->getMessage();//Remove in production code
}
