<?php require('_/inc/init.php'); ?>
<?php

$title = 'Quanto você realmente trabalha?';
$description = 'Acha que trabalha demais? Que não tem tempo para estudar ou se divertir? Descubra quantas horas você e as pessoas da sua casa de fato trabalham durante uma semana.';
$fb_id = '490934331011067';
$site_lang = "pt_br";
$site_thumbnail = BASE_URL . '/images/header-img-1.jpg/';

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js ie ie6 lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie ie7 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie ie8 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie ie9 lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>">

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo BASE_URL; ?>"/>
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:site_name" content="<?php echo $title; ?>"/>
    <meta property="og:description" content="<?php echo $description; ?>"/>
    <meta property="og:locale" content="<?php echo $site_lang; ?>" />

    <meta itemprop="image" content="<?php echo $site_thumbnail; ?>">
    <meta property="og:image" content="<?php echo $site_thumbnail; ?>" />

    <?php require("_/inc/head.php"); ?>

    <?php require("_/inc/analytics.php"); ?>
</head>
<body>

    <!--[if lt IE 9]>
        <div class="container browsehappy">
            <h4>Você está usando um navegador <strong>desatualizado</strong>.</h4>
            <p>Por favor, <a href="http://browsehappy.com/"><strong>atualize o seu navegador</strong></a> para melhorar a sua experiência.</p>
        </div>
    <![endif]-->

    <form name="app-form" action="#" method="post">
        <?php require('_/sections/step0.php'); ?>
        <?php require('_/sections/step1.php'); ?>
        <?php require('_/sections/step2.php'); ?>
        <?php require('_/sections/step3.php'); ?>
        <?php require('_/sections/step4.php'); ?>
        <?php require('_/sections/step5.php'); ?>
        <?php require('_/sections/step6.php'); ?>
    </form>

    <?php require('_/sections/modals.php'); ?>

    <?php require('_/inc/hbs-templates.php'); ?>

    <?php require('_/inc/tail.php'); ?>
</body>
</html>
