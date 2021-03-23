<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initApp()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        Zend_Registry::set('basepath', '');
        Zend_Registry::set('baseData', '../library/');
        Zend_Registry::set('pathFile', '/data_wbls/');
        Zend_Registry::set('pathFilebap', '/data_bap/');
        Zend_Registry::set('linkVideo', 'video/');
        Zend_Registry::set('pathImage', '/image_wbls/');
        Zend_Registry::set('beforeMCE', '\/webptdi-new\/public_html\/');
        Zend_Registry::set('before2MCE', 'http:\/\/localhost\/webptdi-new\/public_html\/');
        Zend_Registry::set('afterMCE', 'http://localhost/webptdi-new/public_html/');
        Zend_Registry::set('after2MCE', '/webptdi-new/public_html/');
    }

    protected function _initDbAdaptersToRegistry()
    {
        $this->bootstrap('multidb');
        $resource = $this->getPluginResource('multidb');

        $Adapter1 = $resource->getDb('db');
        /* $Adapter2 = $resource->getDb('db15');
        $Adapter3 = $resource->getDb('dbsap');
        $Adapter4 = $resource->getDb('dbpublic');
        $Adapter5 = $resource->getDb('dbsdm');
        $Adapter6 = $resource->getDb('dbfis'); */
        Zend_Registry::set('db', $Adapter1);
        /* Zend_Registry::set('db15', $Adapter2);
        Zend_Registry::set('dbsap', $Adapter3);
        Zend_Registry::set('dbpublic', $Adapter4);
        Zend_Registry::set('dbsdm', $Adapter5);
        Zend_Registry::set('dbfis', $Adapter6); */
        /* $db_config['username'] = 'dbfisp0';
	$db_config['password'] = 'fis2017';
	$db_config['dbname'] = '(DESCRIPTION =
                 (ADDRESS = (PROTOCOL = TCP)(HOST = 10.1.94.72)(PORT = 1521))
                 (CONNECT_DATA =
                 (SID = ora12dev)
                 )
                 )';
        Zend_Registry::set('db_config', $db_config); */
    }

    protected function _initSession()
    {
        Zend_Session::start();
        return;
    }

    protected function _initRoutes()
    {
        $this->bootstrap('frontController');
        $frontController = $this->getResource('frontController');
        $router = $frontController->getRouter();

        /* $router->addRoute(
			'name_for_the_route',
			new Zend_Controller_Router_Route('controller/action/:key1/:key2/:key3', array('module' => 'default', 'controller' => 'theController', 'action' => 'theAction', 'key1' => NULL, 'key2' => NULL, 'key3' => NULL))
		); */
        // $router->addRoute(
        //     'default',
        //     new Zend_Controller_Router_Route('tes/testing', array('module' => 'default', 'controller' => 'salecentralController', 'action' => 'tambah', 'no' => NULL, 'index' => NULL))
        // );

        $router->addRoute(
            'newsx',
            new Zend_Controller_Router_Route('news/detail/:no/:index', array('module' => 'default', 'controller' => 'news', 'action' => 'detail', 'no' => NULL, 'index' => NULL))
        );
    }
}
