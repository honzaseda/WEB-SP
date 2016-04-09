<?php


define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

require ROOT . 'Core/config.php';
require ROOT . 'Core/core.php';
require ROOT . 'Core/controller.php';

// start
$app = new Core();
