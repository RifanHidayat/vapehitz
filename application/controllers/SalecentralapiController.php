<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Salecentral_Service.php';

class SalecentralapiController extends Zend_Rest_Controller
{

  public function init()
  {
    $this->_helper->viewRenderer->setNoRender(true);
  }

  public function indexAction()
  {
    $this->getResponse()->setBody('List of Resources');
    $this->getResponse()->setHttpResponseCode(200);
  }

  public function getAction()
  {
    $this->getResponse()->setBody(sprintf('Resource #%s', $this->_getParam('id')));
    $this->getResponse()->setHttpResponseCode(400);
  }

  public function postAction()
  {
    $this->getResponse()->setBody('Resource Created');
    $this->getResponse()->setHttpResponseCode(200);
  }

  public function putAction()
  {
    $this->getResponse()->setBody(sprintf('Resource #%s Updated', $this->_getParam('id')));
    $this->getResponse()->setHttpResponseCode(201);
  }

  public function deleteAction()
  {
    $this->getResponse()->setBody(sprintf('Resource #%s Deleted', $this->_getParam('id')));
    $this->getResponse()->setHttpResponseCode(200);
  }
}
