<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Volliquid_Service.php';

class VolliquidController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Volliquid_Service = Volliquid_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('volliquid-layout');
		
		$this->view->Volliquid_Service = $this->Volliquid_Service;
		
		$this->view->data = $this->Volliquid_Service->getlistliquid();
		$this->view->menu = $this->Volliquid_Service->getmenu();
		$this->view->seq  = $this->Volliquid_Service->getNoSeq();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Volliquid_Service = $this->Volliquid_Service;
		
		$this->view->supplier=$this->Volliquid_Service->getSupplier();
		$this->view->rasa=$this->Volliquid_Service->getRasa();
		$this->view->seq=$this->Volliquid_Service->getNoSeq();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('volliquid-layout');
		
		$id_volume 	 = '';
		$volume		 = '';
		$status		 = '';
		$seq		 = '';
		$action		 = '';
		
		if(isset($_POST['id_volume'])){ $id_volume = $_POST['id_volume'];}
		if(isset($_POST['volume'])){ $volume = $_POST['volume'];}
		if(isset($_POST['status'])){ $status = $_POST['status'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		if(isset($_POST['action'])){ $action = $_POST['action'];}
		
		$volume = str_replace(".", "", $volume);
		
		$data = array('id_volume' => $id_volume,
					  'volume' => $volume,
					  'seq' => $seq,
					  'status' => $status); 
		if($action == 'tambah'){
			$this->view->datainsert=$this->Volliquid_Service->insertdata($data);
		} else {
			$this->view->datainsert=$this->Volliquid_Service->editdata($data);
		}
			
   }
   
   public function hapusdataAction(){
		$id_volume = '';
		
		if(isset($_REQUEST['id_volume'])){ $id_volume = $_REQUEST['id_volume'];}
		
		$dataInput = array('id_volume' => $id_volume);
		$hasil = $this->Volliquid_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
		$this->_helper->layout->setLayout('target-column');
		
        $id_volume = '';
		if(isset($_REQUEST['id_volume'])){ $id_volume = $_REQUEST['id_volume'];}
		
		$this->view->data=$this->Volliquid_Service->getDataLiquid($id_volume);
		
		$this->view->Volliquid_Service = $this->Volliquid_Service;
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('volliquid-layout');
		
		$kode_supplier 	 = '';
		$volume		     = '';
		$id_volume 	 = '';
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
		if(isset($_POST['volume'])){ $volume = $_POST['volume'];}
		if(isset($_POST['id_volume'])){ $id_volume = $_POST['id_volume'];}
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
					  'volume' => $volume,
					  'id_volume' => $id_volume,
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
		
		$this->view->datainsert=$this->Volliquid_Service->editdata($data);
   }
 
	public function cekseqAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$id_id_volume = '';
		if(isset($_REQUEST['id_id_volume'])){ $id_id_volume = $_REQUEST['id_id_volume'];}
		
		$this->view->id_id_volume = $this->Volliquid_Service->getSeq($id_id_volume);
	}
 
}