<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Atomizer_Service.php';

class AtomizerController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Atomizer_Service = Atomizer_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('atomizer-layout');
		
		$this->view->Atomizer_Service = $this->Atomizer_Service;
		
		$this->view->data = $this->Atomizer_Service->getlistatomizer();
		$this->view->menu = $this->Atomizer_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Atomizer_Service = $this->Atomizer_Service;
		
		$this->view->supplier=$this->Atomizer_Service->getSupplier();
		$this->view->jenis=$this->Atomizer_Service->getJenis();
		$this->view->warna=$this->Atomizer_Service->getWarna();
		$this->view->seq=$this->Atomizer_Service->getNoSeq();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('atomizer-layout');
		
		$kode_supplier 	 = '';
		$kode_atomizer 	 = '';
		$id_kode_barang  = '';
		$seq_kode_barang = '';
		$merk_atomizer 	 = '';
		$nama_atomizer 	 = '';
		$jenis_atomizer	 = '';
		$kode_warna	 	 = '';
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
		if(isset($_POST['kode_atomizer'])){ $kode_atomizer = $_POST['kode_atomizer'];}
		if(isset($_POST['id_kode_barang'])){ $id_kode_barang = $_POST['id_kode_barang'];}
		if(isset($_POST['seq_kode_barang'])){ $seq_kode_barang = $_POST['seq_kode_barang'];}
		if(isset($_POST['merk_atomizer'])){ $merk_atomizer = $_POST['merk_atomizer'];}
		if(isset($_POST['nama_atomizer'])){ $nama_atomizer = $_POST['nama_atomizer'];}
		if(isset($_POST['jenis_atomizer'])){ $jenis_atomizer = $_POST['jenis_atomizer'];}
		if(isset($_POST['kode_warna'])){ $kode_warna = $_POST['kode_warna'];}
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
		if(isset($_POST['otorisasi_harga'])){ $otorisasi_harga = $_POST['otorisasi_harga'];}
		
		$harga_beli = str_replace(".", "", $harga_beli);
		$hj_agen 	= str_replace(".", "", $hj_agen);
		$hj_retail 	= str_replace(".", "", $hj_retail);
		$hj_whs 	= str_replace(".", "", $hj_whs);
		
		$data = array('kode_supplier' => $kode_supplier,
					  'kode_atomizer' => $kode_atomizer,
					  'id_kode_barang' => $id_kode_barang,
					  'seq_kode_barang' => $seq_kode_barang,
					  'merk_atomizer' => $merk_atomizer,
					  'nama_atomizer' => $nama_atomizer,
					  'jenis_atomizer' => $jenis_atomizer,
					  'kode_warna' => $kode_warna,
					  'berat' => $berat,
					  'stok_pusat' => $stok_pusat,
					  'stok_retail' => $stok_retail,
					  'stok_studio' => $stok_studio,
					  'bad_stock' => $bad_stock,
					  'harga_beli' => $harga_beli,
					  'hj_agen' => $hj_agen,
					  'hj_retail' => $hj_retail,
					  'hj_whs' => $hj_whs,
					  'otorisasi_harga' => $otorisasi_harga,
					  'status' => $status);
		//var_dump($data);
		$this->view->datainsert=$this->Atomizer_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$kode_atomizer = '';
		
		if(isset($_REQUEST['kode_atomizer'])){ $kode_atomizer = $_REQUEST['kode_atomizer'];}
		
		$dataInput = array('kode_atomizer' => $kode_atomizer);
		$hasil = $this->Atomizer_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Atomizer_Service = $this->Atomizer_Service;
		
		$kode_atomizer_data   = $_GET['id'];
		$this->view->kode_atomizer_data = $kode_atomizer_data;
		
		$this->view->data=$this->Atomizer_Service->getDataatomizer($kode_atomizer_data);
		$temp_atomizer = $this->Atomizer_Service->getDataatomizer($kode_atomizer_data);
		$kode_supplier = $temp_atomizer[0]['kode_supplier'];
		$this->view->data2 = $this->Atomizer_Service->getdatasupplierid($kode_supplier);
		
		$this->view->supplier=$this->Atomizer_Service->getSupplier();
		$this->view->warna=$this->Atomizer_Service->getWarna();
		$this->view->seq=$this->Atomizer_Service->getNoSeq();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('atomizer-layout');
		
		$kode_supplier 	 = '';
		$kode_atomizer 	 = '';
		$merk_atomizer 	 = '';
		$nama_atomizer 	 = '';
		$jenis_atomizer	 = '';
		$kode_warna	 	 = '';
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
		if(isset($_POST['kode_atomizer'])){ $kode_atomizer = $_POST['kode_atomizer'];}
		if(isset($_POST['merk_atomizer'])){ $merk_atomizer = $_POST['merk_atomizer'];}
		if(isset($_POST['nama_atomizer'])){ $nama_atomizer = $_POST['nama_atomizer'];}
		if(isset($_POST['jenis_atomizer'])){ $jenis_atomizer = $_POST['jenis_atomizer'];}
		if(isset($_POST['kode_warna'])){ $kode_warna = $_POST['kode_warna'];}
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
					  'kode_atomizer' => $kode_atomizer,
					  'merk_atomizer' => $merk_atomizer,
					  'nama_atomizer' => $nama_atomizer,
					  'jenis_atomizer' => $jenis_atomizer,
					  'kode_warna' => $kode_warna,
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
		
		$this->view->datainsert=$this->Atomizer_Service->editdata($data);
   }
   
   public function cekseqAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$id_kode_barang = '';
		if(isset($_REQUEST['id_kode_barang'])){ $id_kode_barang = $_REQUEST['id_kode_barang'];}
		
		$this->view->id_kode_barang = $this->Atomizer_Service->getSeq($id_kode_barang);
	}
 
}