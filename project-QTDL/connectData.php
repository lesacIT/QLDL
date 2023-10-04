<?php
define('BASE_URL_PATH', '/');
require_once __DIR__ . '/src/function.php';
require_once __DIR__ . '/lib/Psr4AutoloaderClass.php';

$loader = new Psr4AutoloaderClass;
$loader->register();
$loader->addNamespace('QTDL\PROJECT',__DIR__.'/src');
try {
    $PDO = (new QTDL\PROJECT\PDOFactory)->create([
    'dbhost' => 'localhost',
    'dbname' => 'project_QTDL',
    'dbuser' => 'root',
    'dbpass' => ''
    ]);
    } catch (Exception $ex) {
        echo 'Không thể kết nối đến MySQL, kiểm tra lại username/password đến MySQL.<br>';
        exit("<pre>${ex}</pre>");
    }