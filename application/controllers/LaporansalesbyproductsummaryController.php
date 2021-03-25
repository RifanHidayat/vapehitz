<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Laporansalesbyproductsummary_Service.php';

class LaporansalesbyproductsummaryController extends Zend_Controller_Action {

  public function init() {
    $registry = Zend_Registry::getInstance();
    $this->auth = Zend_Auth::getInstance();
    $this->Home_Service = Home_Service::getInstance();
		$this->Laporansalesbyproductsummary_Service = Laporansalesbyproductsummary_Service::getInstance();
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
    $this->_helper->layout->setLayout('laporansalesbyproductsummary-layout');
		$this->view->Laporansalesbyproductsummary_Service = $this->Laporansalesbyproductsummary_Service;
		
		// $this->view->salesDetail = $this->Laporansalesbyproductsummary_Service->getlistsales();
		$this->view->totalSales = $this->Laporansalesbyproductsummary_Service->getTotalByProduct();
		// $salesByLiquid = $this->Laporansalesbycustomerdetail_Service->getlistsales();
  }
 
}