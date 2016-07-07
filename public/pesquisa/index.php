<?php

$title = 'Trabalho doméstico e trabalho remunerado - Uma tensão permanente';
$description = 'Instituto Patrícia Galvão, SOS Corpo e Data Popular apresentam os resultados de pesquisa inédita feita com mulheres brasileiras e seus familiares para encontrar o estado da tensão entre o trabalho remunerado e o trabalho doméstico.';
$fb_id = '490934331011067';
$site_lang = "pt_br";
$site_thumbnail = 'http://agenciapatriciagalvao.org.br/pesquisa/enquete/images/header-img-1.jpg';

$default_page = 'sobre-a-pesquisa';
$auth_pages = array('sobre-a-pesquisa', 'dia-a-dia', 'trabalho-remunerado', 'trabalho-domestico', 'demandas-e-preocupacoes');

$requested_page = (isset($_GET['page'])) ? $_GET['page'] : $default_page;

if (!in_array($requested_page, $auth_pages)) {
    $requested_page = $default_page;
}

?>
<?php require('_/inc/init.php'); ?>
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
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <?php require('_/inc/header.php'); ?>

    <?php require('_/sections/' . $requested_page . '.php'); ?>

    <?php require('_/sections/modals.php'); ?>

    <?php require('_/inc/tail.php'); ?>
</body>
</html>
