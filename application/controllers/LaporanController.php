<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Laporan_Service.php';

class LaporanController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Laporan_Service = Laporan_Service::getInstance();
	$sessionlogin = new Zend_Session_Namespace('sessionlogin');
	$sessionlogin->setExpirationSeconds(9000) ;	
	$this->view->email = $sessionlogin->email;
	$this->view->nama = $sessionlogin->nama;
	$this->view->active = $sessionlogin->active;
	$this->view->permission = $sessionlogin->permission;
	}

    /* public function indexAction() {
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
        $this->_helper->layout->setLayout('laporan-layout');
		
		$kata_kunci = '';
		$perioddate = '';
		$sortBy = '';	
		$sortOrd = '';	
		$currentPage = '';		
		
		if(isset($_REQUEST['kata_kunci'])){ $kata_kunci = $_REQUEST['kata_kunci'];}
		if(isset($_REQUEST['perioddate'])){ 
			$perioddate = $_REQUEST['perioddate'];
			$perioddate2 = explode(" - ", $perioddate);

			$d_ads_start = $perioddate2[0];
			$d_ads_start = str_replace('/', '-', $d_ads_start);
			$d_ads_start = date("Y-m-d", strtotime($d_ads_start));

			$d_ads_finish = $perioddate2[1];
			$d_ads_finish = str_replace('/', '-', $d_ads_finish);
			$d_ads_finish = date("Y-m-d", strtotime($d_ads_finish));
		}
		
		$param1 = ''; 	$param2 = '';	$param3 = '';	$param4 = '';
		
		if(isset($_REQUEST['sortBy'])){ $sortBy = $_REQUEST['sortBy'];}
		if(isset($_REQUEST['sortOrd'])){ $sortOrd = $_REQUEST['sortOrd'];}
		if(isset($_REQUEST['currentPage'])){ $currentPage = $_REQUEST['currentPage'];}
		
		if(isset($_REQUEST['param1'])){ $param1 = $_REQUEST['param1'];}
		if(isset($_REQUEST['param2'])){ $param2 = $_REQUEST['param2'];}
		if(isset($_REQUEST['param3'])){ $param3 = $_REQUEST['param3'];}
		if(isset($_REQUEST['param4'])){ $param4 = $_REQUEST['param4'];}
		
		if($param1){ $kata_kunci = $param1;}
		if($param2){ $sortBy = $param2;}
		if($param3){ $sortOrd = $param3;}
		if($param4){ $perioddate = $param4;}
		
		if(!$sortBy){
			$sortBy = 'kode_supplier'; 
		}
		if(!$sortOrd){
			$sortOrd = 'asc';
		}
		
		$this->view->sortBy = $sortBy;
		$this->view->sortOrd = $sortOrd;	
		
		$dataInput = array('kata_kunci' 	=> $kata_kunci,
						   'd_ads_start' 	=> $d_ads_start,
						   'd_ads_finish'	=> $d_ads_finish);
		
		$pageRows = 10;
		$pageNum = 1;
		if(ISSET($_REQUEST['currentPage'])){$pageNum = $_REQUEST['currentPage'];}
		$this->view->numPage = $pageNum;
		$offset = ($pageNum - 1) * $pageRows;
		$this->view->nomer= $offset;  	
		
		$this->view->total = $this->Laporan_Service->getlistsupplier($dataInput,0,0);
		$this->view->data = $this->Laporan_Service->getlistsupplier($dataInput, $pageRows, $offset);
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->kata_kunci = $kata_kunci;	
		$this->view->perioddate = $perioddate;	
		
		//$this->view->data = $this->Laporan_Service->getlistsupplier();
		$this->view->menu = $this->Laporan_Service->getmenusupplier();
    } */
	
	public function indexAction() {
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
        $this->_helper->layout->setLayout('laporan-layout');
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->data = $this->Laporan_Service->getlistsupplier();
		$this->view->data2 = $this->Laporan_Service->getlistsales();
		$this->view->data3 = $this->Laporan_Service->getlistcustomer();
		$this->view->data4 = $this->Laporan_Service->getlistliquid();
		$this->view->data5 = $this->Laporan_Service->getlistdevice();
		$this->view->data6 = $this->Laporan_Service->getlistaccessories();
		$this->view->data7 = $this->Laporan_Service->getlistatomizer();
		$this->view->data8 = $this->Laporan_Service->getlistOrderCentral();
		$this->view->data9 = $this->Laporan_Service->getlistReturPembelian();
		$this->view->data10 = $this->Laporan_Service->getlistSaleCentral();
		$this->view->menu = $this->Laporan_Service->getmenusupplier();
    }

	public function supplierAction()
	{
		$this->_helper->layout->setLayout('target-column');
		
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->data = $this->Laporan_Service->getlistsupplier();
	}
	
	public function xlssupplierAction() {
		$this->_helper->layout->setLayout('target-column');
		$proses = 'xls';
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->data = $this->Laporan_Service->getlistsupplier();
		$this->view->menu = $this->Laporan_Service->getmenusupplier();
		
		$this->render('xlssupplier');
    }
	
	public function pdfsupplierAction() {
		$this->_helper->layout->setLayout('target-column');
		
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->data = $this->Laporan_Service->getlistsupplier();
    }
	
	public function xlssalesAction() {
		$this->_helper->layout->setLayout('target-column');
		$proses = 'xls';
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->data2 = $this->Laporan_Service->getlistsales();
		$this->view->menu = $this->Laporan_Service->getmenusupplier();
		
		$this->render('xlssales');
    }
	
	public function pdfsalesAction() {
		$this->_helper->layout->setLayout('target-column');
		
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->data2 = $this->Laporan_Service->getlistsales();
    }
	
	public function xlscustomerAction() {
		$this->_helper->layout->setLayout('target-column');
		$proses = 'xls';
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->data3 = $this->Laporan_Service->getlistcustomer();
		$this->view->menu = $this->Laporan_Service->getmenusupplier();
		
		$this->render('xlscustomer');
    }
	
	public function pdfcustomerAction() {
		$this->_helper->layout->setLayout('target-column');
		
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->data3 = $this->Laporan_Service->getlistcustomer();
    }
	
	public function xlsliquidAction() {
		$this->_helper->layout->setLayout('target-column');
		$proses = 'xls';
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->data4 = $this->Laporan_Service->getlistliquid();
		$this->view->menu = $this->Laporan_Service->getmenusupplier();
		
		$this->render('xlsliquid');
    }
	
	public function pdfliquidAction() {
		$this->_helper->layout->setLayout('target-column');
		
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->data4 = $this->Laporan_Service->getlistliquid();
    }
	
	public function xlsdeviceAction() {
		$this->_helper->layout->setLayout('target-column');
		$proses = 'xls';
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->data5 = $this->Laporan_Service->getlistdevice();
		$this->view->menu = $this->Laporan_Service->getmenusupplier();
		
		$this->render('xlsdevice');
    }
	
	public function pdfdeviceAction() {
		$this->_helper->layout->setLayout('target-column');
		
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->data5 = $this->Laporan_Service->getlistdevice();
    }
	
	public function xlsaksesorisAction() {
		$this->_helper->layout->setLayout('target-column');
		$proses = 'xls';
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->data6 = $this->Laporan_Service->getlistaccessories();
		$this->view->menu = $this->Laporan_Service->getmenusupplier();
		
		$this->render('xlsaksesoris');
    }
	
	public function pdfaksesorisAction() {
		$this->_helper->layout->setLayout('target-column');
		
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->data6 = $this->Laporan_Service->getlistaccessories();
    }
	
	public function xlsatomizerAction() {
		$this->_helper->layout->setLayout('target-column');
		$proses = 'xls';
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->data7 = $this->Laporan_Service->getlistatomizer();
		$this->view->menu = $this->Laporan_Service->getmenusupplier();
		
		$this->render('xlsatomizer');
    }
	
	public function pdfatomizerAction() {
		$this->_helper->layout->setLayout('target-column');
		
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->view->Laporan_Service = $this->Laporan_Service;
		
		$this->view->data7 = $this->Laporan_Service->getlistatomizer();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->seq=$this->Laporan_Service->getNoSeq();
    }
	
	public function kirimdataAction() { 
	
		$this->_helper->layout->setLayout('laporan-layout');
		
		$kode_supplier 	 = $_POST['kode_supplier'];
		$nama_supplier 	 = $_POST['nama_supplier'];
		$alamat_supplier = $_POST['alamat_supplier'];
		$no_tlp 		 = $_POST['no_tlp'];
		$no_hp 			 = $_POST['no_hp'];
		$email 			 = $_POST['email'];
		$tipe 			 = $_POST['tipe'];
		$status 		 = $_POST['status'];
		
		$data = array('kode_supplier' => $kode_supplier,
					  'nama_supplier' => $nama_supplier,
					  'alamat_supplier' => $alamat_supplier,
					  'no_tlp' => $no_tlp,
					  'no_hp' => $no_hp,
					  'email' => $email,
					  'tipe' => $tipe,
					  'status' => $status); 
		
		$this->view->datainsert=$this->Laporan_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$kode_supplier = '';
		
		if(isset($_REQUEST['kode_supplier'])){ $kode_supplier = $_REQUEST['kode_supplier'];}
		
		$dataInput = array('kode_supplier' => $kode_supplier);
		$hasil = $this->Laporan_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$kode_supplier_data   = $_GET['id'];
		$this->view->kode_supplier_data = $kode_supplier_data;
		
		$this->view->data=$this->Laporan_Service->getDataSupplier($kode_supplier_data);
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('laporan-layout');
		
		$kode_supplier 	 = $_POST['kode_supplier'];
		$nama_supplier 	 = $_POST['nama_supplier'];
		$alamat_supplier = $_POST['alamat_supplier'];
		$no_tlp 		 = $_POST['no_tlp'];
		$no_hp 			 = $_POST['no_hp'];
		$email 			 = $_POST['email'];
		$tipe 			 = $_POST['tipe'];
		$status 		 = $_POST['status'];
		
		$data = array('kode_supplier' => $kode_supplier,
					  'nama_supplier' => $nama_supplier,
					  'alamat_supplier' => $alamat_supplier,
					  'no_tlp' => $no_tlp,
					  'no_hp' => $no_hp,
					  'email' => $email,
					  'tipe' => $tipe,
					  'status' => $status); 
		
		$this->view->datainsert=$this->Laporan_Service->editdata($data);
   }
 
}