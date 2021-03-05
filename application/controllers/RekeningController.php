<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Rekening_Service.php';

class RekeningController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Rekening_Service = Rekening_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('rekening-layout');
		
		$this->view->Rekening_Service = $this->Rekening_Service;
		
		$this->view->data = $this->Rekening_Service->getlistliquid();
		$this->view->menu = $this->Rekening_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Rekening_Service = $this->Rekening_Service;
		
		$this->view->supplier=$this->Rekening_Service->getSupplier();
		$this->view->rasa=$this->Rekening_Service->getRasa();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('rekening-layout');
		
		$no_id	 	 = '';
		$nama_bank	 = '';
		$no_rekening = '';
		$atas_nama	 = '';
		$status		 = '';
		$action		 = '';
		
		if(isset($_POST['no_id'])){ $no_id = $_POST['no_id'];}
		if(isset($_POST['nama_bank'])){ $nama_bank = $_POST['nama_bank'];}
		if(isset($_POST['no_rekening'])){ $no_rekening = $_POST['no_rekening'];}
		if(isset($_POST['atas_nama'])){ $atas_nama = $_POST['atas_nama'];}
		if(isset($_POST['status'])){ $status = $_POST['status'];}
		if(isset($_POST['action'])){ $action = $_POST['action'];}
		
		$no_rekening = str_replace(".", "", $no_rekening);
		
		$data = array('no_id' => $no_id,
					  'nama_bank' => $nama_bank,
					  'no_rekening' => $no_rekening,
					  'atas_nama' => $atas_nama,
					  'status' => $status); 
		if($action == 'tambah'){
			$this->view->datainsert=$this->Rekening_Service->insertdata($data);
		} else {
			$this->view->datainsert=$this->Rekening_Service->editdata($data);
		}
			
   }
   
   public function hapusdataAction(){
		$no_id = '';
		
		if(isset($_REQUEST['no_id'])){ $no_id = $_REQUEST['no_id'];}
		
		$dataInput = array('no_id' => $no_id);
		$hasil = $this->Rekening_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
		$this->_helper->layout->setLayout('target-column');
		
        $no_id = '';
		if(isset($_REQUEST['no_id'])){ $no_id = $_REQUEST['no_id'];}
		
		$this->view->data=$this->Rekening_Service->getDataLiquid($no_id);
		
		$this->view->Rekening_Service = $this->Rekening_Service;
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('rekening-layout');
		
		$kode_supplier 	 = '';
		$no_rekening	 = '';
		$no_id 	 		 = '';
		$merk_barang 	 = '';
		$nama_barang 	 = '';
		$kode_rasa	 	 = '';
		$nic		 	 = '';
		$berat 	  		 = '';
		$stok_pusat  	 = '';
		$stok_retail 	 = '';
		$stok_studio 	 = '';
		$bad_stock    	 = '';
		$harga_beli  	 = '';
		$hj_agen 	  	 = '';
		$hj_retail 	  	 = '';
		$hj_whs 		 = '';
		$status 		 = '';
		
		if(isset($_POST['kode_supplier2'])){ $kode_supplier = $_POST['kode_supplier2'];}
		if(isset($_POST['no_rekening'])){ $no_rekening = $_POST['no_rekening'];}
		if(isset($_POST['no_id'])){ $no_id = $_POST['no_id'];}
		if(isset($_POST['merk_barang'])){ $merk_barang = $_POST['merk_barang'];}
		if(isset($_POST['nama_barang'])){ $nama_barang = $_POST['nama_barang'];}
		if(isset($_POST['kode_rasa'])){ $kode_rasa = $_POST['kode_rasa'];}
		if(isset($_POST['nic'])){ $nic = $_POST['nic'];}
		if(isset($_POST['berat'])){ $berat = $_POST['berat'];}
		if(isset($_POST['stok_pusat'])){ $stok_pusat = $_POST['stok_pusat'];}
		if(isset($_POST['stok_retail'])){ $stok_retail = $_POST['stok_retail'];}
		if(isset($_POST['stok_studio'])){ $stok_studio = $_POST['stok_studio'];}
		if(isset($_POST['bad_stock'])){ $bad_stock = $_POST['bad_stock'];}
		if(isset($_POST['harga_beli'])){ $harga_beli = $_POST['harga_beli'];}
		if(isset($_POST['hj_agen'])){ $hj_agen = $_POST['hj_agen'];}
		if(isset($_POST['hj_retail'])){ $hj_retail = $_POST['hj_retail'];}
		if(isset($_POST['hj_whs'])){ $hj_whs = $_POST['hj_whs'];}
		if(isset($_POST['status'])){ $status = $_POST['status'];}
		
		$harga_beli = str_replace(".", "", $harga_beli);
		$hj_agen 	= str_replace(".", "", $hj_agen);
		$hj_retail 	= str_replace(".", "", $hj_retail);
		$hj_whs 	= str_replace(".", "", $hj_whs);
		
		$data = array('kode_supplier' => $kode_supplier,
					  'no_rekening' => $no_rekening,
					  'no_id' => $no_id,
					  'merk_barang' => $merk_barang,
					  'nama_barang' => $nama_barang,
					  'kode_rasa' => $kode_rasa,
					  'nic' => $nic,
					  'berat' => $berat,
					  'stok_pusat' => $stok_pusat,
					  'stok_retail' => $stok_retail,
					  'stok_studio' => $stok_studio,
					  'bad_stock' => $bad_stock,
					  'harga_beli' => $harga_beli,
					  'hj_agen' => $hj_agen,
					  'hj_retail' => $hj_retail,
					  'hj_whs' => $hj_whs,
					  'status' => $status); 
		
		$this->view->datainsert=$this->Rekening_Service->editdata($data);
   }
 
	public function cekseqAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$id_no_id = '';
		if(isset($_REQUEST['id_no_id'])){ $id_no_id = $_REQUEST['id_no_id'];}
		
		$this->view->id_no_id = $this->Rekening_Service->getSeq($id_no_id);
	}
 
}