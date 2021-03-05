<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
//require_once 'service/admin/Faq_Service.php';

class indexController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
        //$this->Faq_Service = Faq_Service::getInstance();
	$sessionlogin = new Zend_Session_Namespace('sessionlogin');
	$sessionlogin->setExpirationSeconds(9000) ;	
	$this->view->userid = $sessionlogin->userid;
	$this->view->nama=$sessionlogin->nama;
	$this->view->auth=$sessionlogin->auth;
	$this->view->group = $sessionlogin->group;
	$this->view->email = $sessionlogin->email;
	$this->view->permission = $sessionlogin->permission;
	}

    public function indexAction() {
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
        $this->_helper->layout->setLayout('index-layout');
		
		$this->view->Home_Service = $this->Home_Service;		

		$logmail = $sessionlogin->email;
		$this->view->email = $sessionlogin->email;
		$this->view->nama = $sessionlogin->nama;
		$this->view->group = $sessionlogin->group;
		
		$id = 'admin';
		$this->view->data=$this->Home_Service->getData($id);
		
		$this->view->menu=$this->Home_Service->getDataMainMenu();
		$this->view->submenu=$this->Home_Service->getDataSubMenu();
		$this->view->menu = $this->Home_Service->getmenu();
		$this->view->ordertotalpermonth = $this->Home_Service->getOrderCentralTotalPerMonth();

		##ORDER CENTRAL##
		$this->view->ordertotal = $this->Home_Service->getOrderCentralTotal();
		$this->view->orderjanuari = $this->Home_Service->getOrderCentralJanuari();
		$this->view->orderfebruari = $this->Home_Service->getOrderCentralFebruari();
		$this->view->ordermaret = $this->Home_Service->getOrderCentralMaret();
		$this->view->orderapril = $this->Home_Service->getOrderCentralApril();
		$this->view->ordermei = $this->Home_Service->getOrderCentralMei();
		$this->view->orderjuni = $this->Home_Service->getOrderCentralJuni();
		$this->view->orderjuli = $this->Home_Service->getOrderCentralJuli();
		$this->view->orderagustus = $this->Home_Service->getOrderCentralAgustus();
		$this->view->orderseptember = $this->Home_Service->getOrderCentralSeptember();
		$this->view->orderoktober = $this->Home_Service->getOrderCentralOktober();
		$this->view->ordernovember = $this->Home_Service->getOrderCentralNovember();
		$this->view->orderdesember = $this->Home_Service->getOrderCentralDesember();

		##SALE CENTRAL##
		$this->view->salejanuari = $this->Home_Service->getSaleCentralJanuari();
		$this->view->salefebruari = $this->Home_Service->getSaleCentralFebruari();
		$this->view->salemaret = $this->Home_Service->getSaleCentralMaret();
		$this->view->saleapril = $this->Home_Service->getSaleCentralApril();
		$this->view->salemei = $this->Home_Service->getSaleCentralMei();
		$this->view->salejuni = $this->Home_Service->getSaleCentralJuni();
		$this->view->salejuli = $this->Home_Service->getSaleCentralJuli();
		$this->view->saleagustus = $this->Home_Service->getSaleCentralAgustus();
		$this->view->saleseptember = $this->Home_Service->getSaleCentralSeptember();
		$this->view->saleoktober = $this->Home_Service->getSaleCentralOktober();
		$this->view->salenovember = $this->Home_Service->getSaleCentralNovember();
		$this->view->saledesember = $this->Home_Service->getSaleCentralDesember();

		##SALE RETAIL##
		$this->view->retail1 = $this->Home_Service->getSaleRetail1();
		$this->view->retail2 = $this->Home_Service->getSaleRetail2();
		$this->view->retail3 = $this->Home_Service->getSaleRetail3();
		$this->view->retail4 = $this->Home_Service->getSaleRetail4();
		$this->view->retail5 = $this->Home_Service->getSaleRetail5();
		$this->view->retail6 = $this->Home_Service->getSaleRetail6();
		$this->view->retail7 = $this->Home_Service->getSaleRetail7();
		$this->view->retail8 = $this->Home_Service->getSaleRetail8();
		$this->view->retail9 = $this->Home_Service->getSaleRetail9();
		$this->view->retail10 = $this->Home_Service->getSaleRetail10();
		$this->view->retail11 = $this->Home_Service->getSaleRetail11();
		$this->view->retail12 = $this->Home_Service->getSaleRetail12();

		##SALE RETAIL##
		$this->view->studio1 = $this->Home_Service->getSaleStudio1();
		$this->view->studio2 = $this->Home_Service->getSaleStudio2();
		$this->view->studio3 = $this->Home_Service->getSaleStudio3();
		$this->view->studio4 = $this->Home_Service->getSaleStudio4();
		$this->view->studio5 = $this->Home_Service->getSaleStudio5();
		$this->view->studio6 = $this->Home_Service->getSaleStudio6();
		$this->view->studio7 = $this->Home_Service->getSaleStudio7();
		$this->view->studio8 = $this->Home_Service->getSaleStudio8();
		$this->view->studio9 = $this->Home_Service->getSaleStudio9();
		$this->view->studio10 = $this->Home_Service->getSaleStudio10();
		$this->view->studio11 = $this->Home_Service->getSaleStudio11();
		$this->view->studio12 = $this->Home_Service->getSaleStudio12();
    }
 
	public function logoutAction() {
	/* setcookie ("member_login","");
	setcookie ("member_password",""); */
        Zend_Session::destroy(true);
        $this->_helper->viewRenderer->setNoRender(TRUE);
        
       // $this->_redirect('./');
        
    //		Zend_Session::namespaceUnset('sessionlogin');
			$this->view->email = null;
			$this->view->fullname = null;
			
	$this->_helper->layout->setLayout('index-layout');
        	
    }
 
}