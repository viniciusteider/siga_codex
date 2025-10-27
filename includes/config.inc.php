<?php
/**
 * @author squall
 * @copyright 2009
 */
session_name('SIGA-SAMU');
session_start();
header("Content-Type: text/html; charset=UTF-8",true);
//setlocale(LC_TIME, 'portuguese');
// Caminho no servidor via sistema de arquivos
/*$PATH_file = str_replace("\\", "/", $_SERVER["DOCUMENT_ROOT"] . dirname($_SERVER["PHP_SELF"]));
if (substr($PATH_file, -1) != "/") $PATH_file .= "/";*/
$PATH_file = str_replace(DIRECTORY_SEPARATOR, "/", dirname(dirname(__FILE__)))."/";

define("URL_FILE",str_replace("//", "/", $PATH_file));

define("URL_ERP",str_replace("//", "/", $PATH_file). "/");

define("URL_JS","");
// Caminho via browser / internet
define("URL_SITE","http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/");

define("URL_GERADOR","");
//define o limit do autocomplete;'
define("LIMIT_AUTOCOMPLETE",100);

//define o numero de veicuilos para gerar select no sistema;
define("LIMIT_VEICULOS_SELECT",50);

// define o Numero de vericulso a serem exibidos no Monitorar ao iniciar.
define("LIMIT_VEICULOS_MONITORAR",50);

if($_SESSION['usuario']['id_grupo'] == 1)// Define a exibição de erros
    ini_set("display_errors", true);
else
    ini_set("display_errors", true);

/*ini_set('xdebug.max_nesting_level', 3000);*/
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
set_time_limit(0);

define('DIR_IDIOMA', $_SESSION['usuario']['idioma']?:"pt-br");
//$cookieAutenticado = 'autenticado_' . $_SESSION['usuario']['id'];
//if(!empty($_SESSION['usuario']['id']) && !isset($_COOKIE[$cookieAutenticado]) && $_SESSION['emular'] != 'sim')
//    header("location: modulos/login/template/tpl.autenticar.php");

//date_default_timezone_set($_SESSION['usuario']['timezone']?:"America/Sao_Paulo");
include_once(URL_FILE . 'classes/AutoLoad.php');
include_once(URL_FILE . "idioma/".DIR_IDIOMA.".php");

// CONFIGURAÇÕES E PROPRIETARIO
define("TITULO_GERAL","Siga");
define("HERE_API_TOKEN","-imkbpyNcEzg_blVNPZ3SrBRytb7qUr47qoiaib_DxY");
define("HERE_KEY","-imkbpyNcEzg_blVNPZ3SrBRytb7qUr47qoiaib_DxY");
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

// ENDEREÇOS DOS DIRETÓRIOS
$dev = $_SERVER['HTTP_HOST'] == 'localhost' ? true : false;
define('BASE_URL', $dev ? 'http://localhost/gsmedia' : 'http://siga.segeagle.com.br/');
//define('BASE_URL', $dev ? 'http://localhost/gsmedia' : 'http://br340.teste.website/~sheeph03/app/');
define('URI_API', $dev ? '/siga/api' : '');
define('URI_ASSETS', $dev ? '/assets' : '/assets');
define('URI_ANEXOS', $dev ? URI_ASSETS . '/anexos' : '/anexos');

// configuração de banco
include_once(URL_FILE . 'includes/config/banco.php');
// configuração de chaves do google
include_once(URL_FILE . 'includes/config/googlemaps.php');
// configuração de integração dropbox
include_once(URL_FILE . 'includes/config/dropbox.php');
//configuração de envio de emails via PHPMAILER
include_once(URL_FILE . 'includes/config/smtp.php');
//Configuração da plataforma de pagamento Assaas
include_once(URL_FILE . 'includes/config/asaas.php');


define("TAMANHO_BT_GRID", 'style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .60rem;"');

