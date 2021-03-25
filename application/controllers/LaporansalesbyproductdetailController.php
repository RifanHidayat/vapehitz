<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Laporansalesbyproductdetail_Service.php';

class LaporansalesbyproductdetailController extends Zend_Controller_Action {

  public function init() {
    $registry = Zend_Registry::getInstance();
    $this->auth = Zend_Auth::getInstance();
    $this->Home_Service = Home_Service::getInstance();
		$this->Laporansalesbyproductdetail_Service = Laporansalesbyproductdetail_Service::getInstance();
    $sessionlogin = new Zend_Session_Namespace('sessionlogin');
    $sessionlogin->setExpirationSeconds(9000) ;	
    $this->view->email = $sessionlogin->email;
    $this->view->nama = $sessionlogin->nama;
    $this->view->active = $sessionlogin->active;
    $this->view->permission = $sessionlogin->permission;
	}
	
	public function indexAction() {
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
    $this->_helper->layout->setLayout('laporansalesbyproductdetail-layout');
		$this->view->Laporansalesbyproductdetail_Service = $this->Laporansalesbyproductdetail_Service;
		
		$this->view->salesDetail = $this->Laporansalesbyproductdetail_Service->getlistsales();
		$this->view->totalSales = $this->Laporansalesbyproductdetail_Service->getTotalByCustomer();
		// $salesByLiquid = $this->Laporansalesbyproductdetail_Service->getlistsales();
  }
 
}