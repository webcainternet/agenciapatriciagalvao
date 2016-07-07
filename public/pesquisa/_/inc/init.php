<?php
    set_include_path( get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] );

    require("_/inc/functions.php");

    //Constants
    define("FROM_EMAIL", "agenciapatriciagalvao.org.br <webform@agenciapatriciagalvao.org.br>");

    //Setup Variable for tracking VirtualPageViews in analytics.
    $VirtualPageView = "";

    //Variables to store Site/URL information
    $ServerName = $_SERVER['SERVER_NAME'];
    $SiteSection = "";
    $SubSection = "";

    $RequestMethod = $_SERVER['REQUEST_METHOD'];
    $FormErrors = array();

    setSectionInfo();

    //SET SERVER SPECIFIC VARIABLES AND CONSTANTS
    switch ($ServerName) {
        case 'localhost':
            define("BASE_URL", 'http://localhost:8083');
            define("CONTACT_EMAIL", "");
            define("ANALYTICS_ID", "");
            break;

        case 'agenciapatriciagalvao.org.br':
            define("BASE_URL", 'http://agenciapatriciagalvao.org.br/pesquisa');
            define("CONTACT_EMAIL", "");
            define("ANALYTICS_ID", "");
            break;

        default:
            define("BASE_URL", 'http://agenciapatriciagalvao.org.br/pesquisa');
            break;
    }

?>
