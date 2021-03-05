<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Sales_Service.php';

class SalesController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Sales_Service = Sales_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('sales-layout');
		$this->view->data = $this->Sales_Service->getlistsales();
		$this->view->menu = $this->Sales_Service->getmenusupplier();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->seq=$this->Sales_Service->getNoSeq();
    }
	
	public function kirimdataAction() { 
	
		$this->_helper->layout->setLayout('sales-layout');
		
		$kode_sales 	 = $_POST['kode_sales'];
		$nama_sales 	 = $_POST['nama_sales'];
		$alamat_sales = $_POST['alamat_sales'];
		$no_tlp 		 = $_POST['no_tlp'];
		$no_hp 			 = $_POST['no_hp'];
		$email 			 = $_POST['email'];
		$status 		 = $_POST['status'];
		
		$data = array('kode_sales' => $kode_sales,
					  'nama_sales' => $nama_sales,
					  'alamat_sales' => $alamat_sales,
					  'no_tlp' => $no_tlp,
					  'no_hp' => $no_hp,
					  'email' => $email,
					  'status' => $status); 
		
		$this->view->datainsert=$this->Sales_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$kode_sales = '';
		
		if(isset($_REQUEST['kode_sales'])){ $kode_sales = $_REQUEST['kode_sales'];}
		
		$dataInput = array('kode_sales' => $kode_sales);
		$hasil = $this->Sales_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$kode_sales_data   = $_GET['id'];
		$this->view->kode_sales_data = $kode_sales_data;
		
		$this->view->data=$this->Sales_Service->getDataSales($kode_sales_data);
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('sales-layout');
		
		$kode_sales 	 = $_POST['kode_sales'];
		$nama_sales 	 = $_POST['nama_sales'];
		$alamat_sales = $_POST['alamat_sales'];
		$no_tlp 		 = $_POST['no_tlp'];
		$no_hp 			 = $_POST['no_hp'];
		$email 			 = $_POST['email'];
		$status 		 = $_POST['status'];
		
		$data = array('kode_sales' => $kode_sales,
					  'nama_sales' => $nama_sales,
					  'alamat_sales' => $alamat_sales,
					  'no_tlp' => $no_tlp,
					  'no_hp' => $no_hp,
					  'email' => $email,
					  'status' => $status); 
		
		$this->view->datainsert=$this->Sales_Service->editdata($data);
   }
 
}