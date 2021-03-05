<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Accessories_Service.php';

class AccessoriesController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Accessories_Service = Accessories_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('accessories-layout');
		
		$this->view->Accessories_Service = $this->Accessories_Service;
		
		$this->view->data = $this->Accessories_Service->getlistaccessories();
		$this->view->menu = $this->Accessories_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Accessories_Service = $this->Accessories_Service;
		
		$this->view->supplier=$this->Accessories_Service->getSupplier();
		$this->view->jenis=$this->Accessories_Service->getJenis();
		$this->view->rasa=$this->Accessories_Service->getRasa();
		$this->view->seq=$this->Accessories_Service->getNoSeq();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('accessories-layout');
		
		$kode_supplier2  = '';
		$jenis_aksesoris = '';
		$kode_aksesoris  = '';
		$id_kode_barang  = '';
		$seq_kode_barang = '';
		$nama_aksesoris  = '';
		$ket	 		 = '';
		$berat 	  		 = '';
		$stok_pusat 	 = '';
		$stok_retail 	 = '';
		$stok_studio 	 = '';
		$bad_stock    	 = '';
		$harga_beli 	 = '';
		$hj_agen 	  	 = '';
		$hj_retail 	  	 = '';
		$hj_whs 	  	 = '';
		$status 	  	 = '';
		
		if(isset($_POST['kode_supplier2'])){ $kode_supplier = $_POST['kode_supplier2'];}
		if(isset($_POST['jenis_aksesoris'])){ $jenis_aksesoris = $_POST['jenis_aksesoris'];}
		if(isset($_POST['kode_aksesoris'])){ $kode_aksesoris  = $_POST['kode_aksesoris'];}
		if(isset($_POST['id_kode_barang'])){ $id_kode_barang = $_POST['id_kode_barang'];}
		if(isset($_POST['seq_kode_barang'])){ $seq_kode_barang = $_POST['seq_kode_barang'];}
		if(isset($_POST['nama_aksesoris'])){ $nama_aksesoris  = $_POST['nama_aksesoris'];}
		if(isset($_POST['ket'])){ $ket = $_POST['ket'];}
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
					  'jenis_aksesoris' => $jenis_aksesoris,
					  'kode_aksesoris' => $kode_aksesoris,
					  'id_kode_barang' => $id_kode_barang,
					  'seq_kode_barang' => $seq_kode_barang,
					  'nama_aksesoris' => $nama_aksesoris,
					  'ket' => $ket,
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
		//var_dump($data);
		$this->view->datainsert=$this->Accessories_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$kode_aksesoris = '';
		
		if(isset($_REQUEST['kode_aksesoris'])){ $kode_aksesoris = $_REQUEST['kode_aksesoris'];}
		
		$dataInput = array('kode_aksesoris' => $kode_aksesoris);
		$hasil = $this->Accessories_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Accessories_Service = $this->Accessories_Service;
		
		$kode_aksesoris_data   = $_GET['id'];
		$this->view->kode_aksesoris_data = $kode_aksesoris_data;
		
		$this->view->data=$this->Accessories_Service->getDataaccessories($kode_aksesoris_data);
		$temp_accessories = $this->Accessories_Service->getDataaccessories($kode_aksesoris_data);
		$kode_supplier = $temp_accessories[0]['kode_supplier'];
		$this->view->data2 = $this->Accessories_Service->getdatasupplierid($kode_supplier);
		
		$this->view->supplier=$this->Accessories_Service->getSupplier();
		$this->view->rasa=$this->Accessories_Service->getRasa();
		$this->view->seq=$this->Accessories_Service->getNoSeq();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('accessories-layout');
		
		$kode_supplier2  = '';
		$jenis_aksesoris = '';
		$kode_aksesoris  = '';
		$nama_aksesoris  = '';
		$ket	 		 = '';
		$berat 	  		 = '';
		$stok_pusat 	 = '';
		$stok_retail 	 = '';
		$stok_studio 	 = '';
		$bad_stock    	 = '';
		$harga_beli 	 = '';
		$hj_agen 	  	 = '';
		$hj_retail 	  	 = '';
		$hj_whs 	  	 = '';
		$status 	  	 = '';
		
		if(isset($_POST['kode_supplier2'])){ $kode_supplier = $_POST['kode_supplier2'];}
		if(isset($_POST['jenis_aksesoris'])){ $jenis_aksesoris = $_POST['jenis_aksesoris'];}
		if(isset($_POST['kode_aksesoris'])){ $kode_aksesoris  = $_POST['kode_aksesoris'];}
		if(isset($_POST['nama_aksesoris'])){ $nama_aksesoris  = $_POST['nama_aksesoris'];}
		if(isset($_POST['ket'])){ $ket = $_POST['ket'];}
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
					  'jenis_aksesoris' => $jenis_aksesoris,
					  'kode_aksesoris' => $kode_aksesoris,
					  'nama_aksesoris' => $nama_aksesoris,
					  'ket' => $ket,
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
		
		$this->view->datainsert=$this->Accessories_Service->editdata($data);
   }
   
   public function cekseqAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$id_kode_barang = '';
		if(isset($_REQUEST['id_kode_barang'])){ $id_kode_barang = $_REQUEST['id_kode_barang'];}
		
		$this->view->id_kode_barang = $this->Accessories_Service->getSeq($id_kode_barang);
	}
 
}