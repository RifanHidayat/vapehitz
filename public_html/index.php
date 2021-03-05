<?php
// Define path to application directory
defined('ZEND_LIBRARY_PATH')
	|| define('ZEND_LIBRARY_PATH', '../library');

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    ZEND_LIBRARY_PATH,
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Loader/Autoloader.php';
require_once 'Zend/Application.php';
require_once 'Zend/Db.php';
//require_once 'test.php'; /*ANTI HACK*/

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap()
            ->run();			
	    