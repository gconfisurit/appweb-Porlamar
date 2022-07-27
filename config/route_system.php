<?php

# URL  (principalmente para cargar librerias por url)
const URL_APP = 'http://' . SERVER . '/appweb-Porlamar/app/';
const URL_LIBRARY = 'http://' . SERVER . '/appweb-Porlamar/public/';
const URL_LANDINGPAGE =
    'http://' . SERVER . '/appweb-Porlamar/public/landingpage/';
const URL_HELPERS_JS = 'http://' . SERVER . '/appweb-Porlamar/helpers/js/';

# PATH  (los archivos php se cargan por ruta absoluta y no por url)
define('PATH_APP_PHP', $_SERVER['DOCUMENT_ROOT'] . '/appweb-Porlamar/app/');
define(
    'PATH_HELPERS_PHP',
    $_SERVER['DOCUMENT_ROOT'] . '/appweb-Porlamar/helpers/'
);
define(
    'PATH_SERVICE_PHP',
    $_SERVER['DOCUMENT_ROOT'] . '/appweb-Porlamar/services/'
);
define('PATH_LIBRARY', $_SERVER['DOCUMENT_ROOT'] . '/appweb-Porlamar/public/');
define('PATH_VENDOR', $_SERVER['DOCUMENT_ROOT'] . '/appweb-Porlamar/vendor/');
define('PATH_CONFIG', $_SERVER['DOCUMENT_ROOT'] . '/appweb-Porlamar/config/');

# Constantes de fecha
const FORMAT_DATE = 'd/m/Y';
const FORMAT_DATE_TO_EVALUATE = 'Y-m-d';
const FORMAT_DATETIME = 'd/m/Y h:i:s';
const FORMAT_DATETIME2 = 'd/m/Y h:i A';
const FORMAT_DATETIME_FOR_INSERT = 'Y-m-d h:i:s';
