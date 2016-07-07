<?php require('_/inc/init.php'); ?>
<?php

$title = 'Quanto você realmente trabalha?';
$description = 'Acha que trabalha demais? Que não tem tempo para estudar ou se divertir? Descubra quantas horas você e as pessoas da sua casa de fato trabalham durante uma semana.';
$fb_id = '490934331011067';
$site_lang = "pt_br";
$site_thumbnail = BASE_URL . '/images/header-img-1.jpg/';

?>
<?php
    $DBH = new PDO("mysql:dbname=comeati_pesquisa;host=10.0.20.3", "comeati_pesquisa", "d93jdhwd" );
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling

    $sql = "SELECT name, color, has_maid, maid_days, gender FROM pgal_users WHERE id = :id";
    $data = array('id' => (int) $_GET['id']);
    $STH = $DBH->prepare($sql);
    $STH->execute($data);

    $user = false;
    $maid = false;
    $result = array();

    $user_db = $STH->fetch(PDO::FETCH_ASSOC);

    $result_url = get_result_url((int) $_GET['id']);
    $result_img = '';

    if ($user_db) {
        $sql = "SELECT meta_key, meta_value FROM pgal_user_meta WHERE user_id = :id;";
        $STH = $DBH->prepare($sql);
        $STH->execute($data);

        $user = array(
            'person' => $user_db['name'],
            'color' => $user_db['color'],
            'key' => 'user',
            'gender' => $user_db['gender'],
            'hours' => array(
                'outbound' => 0,
                'inbound' => array(
                    'children' => array(
                        'total' => 0
                    ),
                    'household' => array(
                        'total' => 0
                    )
                )
            )
        );

        if ($user_db['has_maid'] == 'Y') {
            $maid = array(
                'person' => 'Empregado(a) Doméstico(a)',
                'color' => '#0000AA',
                'key' => 'maid',
                'gender' => 'O',
                'workingDays' => (int) $user_db['maid_days'],
                'hours' => array(
                    'outbound' => 0,
                    'inbound' => array(
                        'children' => array(
                            'total' => 0
                        ),
                        'household' => array(
                            'total' => 0
                        )
                    )
                )
            );
        }

        $meta = $STH->fetchAll();
        foreach ($meta as $m) {
            switch ($m['meta_key']) {
                case 'result_image':
                    $result_img = BASE_URL . '/results/' . $m['meta_value'];
                    break;

                case 'paid_work':
                    $user['hours']['outbound'] = (int) $m['meta_value'];
                    break;

                case 'children_total':
                    $user['hours']['inbound']['children']['total'] = (int) $m['meta_value'];
                    break;

                case 'household_total':
                    $user['hours']['inbound']['household']['total'] = (int) $m['meta_value'];
                    break;

                case 'maid_paid_work':
                    if ($maid) {
                        $maid['hours']['outbound'] = (int) $m['meta_value'];
                    }
                    break;

                default:
                    break;
            }
        }

        array_push($result, $user);

        $sql = "SELECT id, name, color, gender FROM pgal_user_roomies WHERE user_id = :id;";
        $STH = $DBH->prepare($sql);
        $STH->execute($data);

        $roomies = $STH->fetchAll();

        foreach ($roomies as $roomie) {
            $person = array(
                'person' => $roomie['name'],
                'color' => $roomie['color'],
                'key' => 'person',
                'gender' => $roomie['gender'],
                'hours' => array(
                    'outbound' => 0,
                    'inbound' => array(
                        'children' => array(
                            'total' => 0
                        ),
                        'household' => array(
                            'total' => 0
                        )
                    )
                )
            );

            $sql = "SELECT meta_key, meta_value FROM pgal_user_roomie_meta WHERE user_roomie_id = :id;";
            $STH = $DBH->prepare($sql);
            $data = array('id' => $roomie['id']);
            $STH->execute($data);
            $meta = $STH->fetchAll();
            foreach ($meta as $m) {
                switch ($m['meta_key']) {
                    case 'paid_work':
                        $person['hours']['outbound'] = (int) $m['meta_value'];
                        break;

                    case 'children_total':
                        $person['hours']['inbound']['children']['total'] = (int) $m['meta_value'];
                        break;

                    case 'household_total':
                        $person['hours']['inbound']['household']['total'] = (int) $m['meta_value'];
                        break;

                    default:
                        break;
                }
            }

            array_push($result, $person);
        }

        if ($maid) {
            array_push($result, $maid);
        }

        $user_hour_sum = $result[0]['hours']['outbound'] + $result[0]['hours']['inbound']['children']['total'] + $result[0]['hours']['inbound']['household']['total'];
        $user_hour_sum = round($user_hour_sum, 2);

        $title = 'Quanto você realmente trabalha?';
        $description = 'Eu trabalho ' . $user_hour_sum . ' horas por semana. Veja como está dividida a escala de trabalho em sua casa!';
        $fb_id = '490934331011067';
        $site_lang = "pt_br";
    } else {
        header('Location: ' . BASE_URL);
    }
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9 lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title><?php echo $title ?></title>
    <meta name="description" content="<?php echo $description; ?>">

    <meta property="og:type" content="blog">
    <meta property="og:url" content="<?php echo BASE_URL; ?>"/>
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:site_name" content="<?php echo $title; ?>"/>
    <meta property="og:description" content="<?php echo $description; ?>"/>
    <meta property="og:locale" content="<?php echo $site_lang; ?>" />
    <meta property="og:author" content="<?php echo $fb_id; ?>"/>

    <meta itemprop="image" content="<?php echo $site_thumbnail; ?>">
    <meta property="og:image" content="<?php echo $site_thumbnail; ?>" />

    <?php require("_/inc/head.php"); ?>

    <?php
        require("_/inc/analytics.php");
    ?>
</head>
<body>
    <!--[if lt IE 9]>
        <p class="browsehappy">Você está usando um navegador <strong>desatualizado</strong>. Por favor, <a href="http://browsehappy.com/">atualize o seu navegador</a> para melhorar a sua experiência.</p>
    <![endif]-->
    <?php require('_/inc/header.php'); ?>

    <?php require('_/sections/step6.php'); ?>

    <?php require('_/inc/hbs-templates.php'); ?>

    <?php require('_/inc/footer.php'); ?>

    <?php require('_/inc/tail.php'); ?>

    <script>
        var result = <?php echo json_encode($result); ?>;

        resultDrawer.content(result, {}, function(){
            resultDrawer.draw(result);
            resultDrawer.replaceShare('<?php echo $result_url; ?>');
        });
    </script>
</body>
</html>
