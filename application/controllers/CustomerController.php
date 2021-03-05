<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Customer_Service.php';

class CustomerController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Customer_Service = Customer_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('customer-layout');
		$this->view->data = $this->Customer_Service->getlistcustomer();
		$this->view->menu = $this->Customer_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->seq=$this->Customer_Service->getNoSeq();
    }
	
	public function kirimdataAction() { 
	
		$this->_helper->layout->setLayout('customer-layout');
		
		$kode_customer 	 = $_POST['kode_customer'];
		$nama_customer 	 = $_POST['nama_customer'];
		$alamat_customer = $_POST['alamat_customer'];
		$no_tlp 		 = $_POST['no_tlp'];
		$no_hp 			 = $_POST['no_hp'];
		$email 			 = $_POST['email'];
		$status 		 = $_POST['status'];
		
		$data = array('kode_customer' => $kode_customer,
					  'nama_customer' => $nama_customer,
					  'alamat_customer' => $alamat_customer,
					  'no_tlp' => $no_tlp,
					  'no_hp' => $no_hp,
					  'email' => $email,
					  'status' => $status); 
		
		$this->view->datainsert=$this->Customer_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$kode_customer = '';
		
		if(isset($_REQUEST['kode_customer'])){ $kode_customer = $_REQUEST['kode_customer'];}
		
		$dataInput = array('kode_customer' => $kode_customer);
		$hasil = $this->Customer_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$kode_customer_data   = $_GET['id'];
		$this->view->kode_customer_data = $kode_customer_data;
		
		$this->view->data=$this->Customer_Service->getDataCustomer($kode_customer_data);
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('customer-layout');
		
		$kode_customer 	 = $_POST['kode_customer'];
		$nama_customer 	 = $_POST['nama_customer'];
		$alamat_customer = $_POST['alamat_customer'];
		$no_tlp 		 = $_POST['no_tlp'];
		$no_hp 			 = $_POST['no_hp'];
		$email 			 = $_POST['email'];
		$status 		 = $_POST['status'];
		
		$data = array('kode_customer' => $kode_customer,
					  'nama_customer' => $nama_customer,
					  'alamat_customer' => $alamat_customer,
					  'no_tlp' => $no_tlp,
					  'no_hp' => $no_hp,
					  'email' => $email,
					  'status' => $status); 
		
		$this->view->datainsert=$this->Customer_Service->editdata($data);
   }
 
}