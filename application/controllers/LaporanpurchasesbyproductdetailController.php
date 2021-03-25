<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Laporanpurchasesbyproductdetail_Service.php';

class LaporanpurchasesbyproductdetailController extends Zend_Controller_Action {

  public function init() {
    $registry = Zend_Registry::getInstance();
    $this->auth = Zend_Auth::getInstance();
    $this->Home_Service = Home_Service::getInstance();
		$this->Laporanpurchasesbyproductdetail_Service = Laporanpurchasesbyproductdetail_Service::getInstance();
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
    $this->_helper->layout->setLayout('laporanpurchasesbyproductdetail-layout');
		$this->view->Laporanpurchasesbyproductdetail_Service = $this->Laporanpurchasesbyproductdetail_Service;
		
		$this->view->purchasesDetail = $this->Laporanpurchasesbyproductdetail_Service->getlistpurchases();
		// $this->view->totalSales = $this->Laporanpurchasesbyproductdetail_Service->getTotalByCustomer();
		// $salesByLiquid = $this->Laporansalesbyproductdetail_Service->getlistsales();
  }
 
}