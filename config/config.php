<?php
define('DIR',realpath(__DIR__.'/..'));
define('PATH_LANG',DIR.'/lang');



$protocolo = (strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false) ? 'http' : 'https'; 
$host = $_SERVER['HTTP_HOST'];

define('HOSTNAME',$host);
define('BASE_URL',$protocolo.'://'.$host);

Lang::init();