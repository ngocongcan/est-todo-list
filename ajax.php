<?php

use Est\TodoApp\Controller\TaskController;

$loader = require __DIR__.'/vendor/autoload.php';

$taskController = new TaskController();
$result = $taskController->handle();

echo json_encode($result);
