<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$config = require_once __DIR__ . '/config.php';

use Core\App;
use Core\Database;
use Core\ErrorHandler;

// Error handling setup
set_exception_handler([ErrorHandler::class, 'handleException']);
set_error_handler([ErrorHandler::class, 'handleError']);

// Bind configuration to the App container
App::bind('config', $config);

// Pass only the 'database' part of the configuration
App::bind('database', new Database($config['database']));
var_dump($config);