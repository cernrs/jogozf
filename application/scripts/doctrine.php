<?php
//Caminho para a pasta da aplicação
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/..'));
//Ambiente em que a aplicação será executada
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'doctrineCLI'));
//Adiciona a "library" no include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path()
)));
require_once 'Zend/Application.php';
//Cria a aplicação, faz o bootstrap e a executa
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->getBootstrap()->bootstrap('autoload');
$application->getBootstrap()->bootstrap('doctrine');
$config = $application->getOption('doctrine');
$cli = new Doctrine_Cli($config);
$cli->run($_SERVER['argv']);