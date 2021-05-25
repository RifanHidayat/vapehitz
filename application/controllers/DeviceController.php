<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Device_Service.php';
require './../vendor/autoload.php';

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DeviceController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Device_Service = Device_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('device-layout');
		
		$this->view->Device_Service = $this->Device_Service;
		
		$this->view->data = $this->Device_Service->getlistdevice();
		$this->view->menu = $this->Device_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Device_Service = $this->Device_Service;
		
		$this->view->supplier=$this->Device_Service->getSupplier();
		$this->view->jenis=$this->Device_Service->getJenis();
		$this->view->warna=$this->Device_Service->getWarna();
		$this->view->seq=$this->Device_Service->getNoSeq();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('device-layout');
		
		$kode_supplier   = '';
		$jenis_device    = '';
		$kode_device 	 = '';
		$id_kode_barang  = '';
		$seq_kode_barang = '';
		$merk_device 	 = '';
		$nama_device 	 = '';
		$kode_warna	 	 = '';
		$ket			 = '';
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
		if(isset($_POST['jenis_device'])){ $jenis_device = $_POST['jenis_device'];}
		if(isset($_POST['kode_device'])){ $kode_device = $_POST['kode_device'];}
		if(isset($_POST['id_kode_barang'])){ $id_kode_barang = $_POST['id_kode_barang'];}
		if(isset($_POST['seq_kode_barang'])){ $seq_kode_barang = $_POST['seq_kode_barang'];}
		if(isset($_POST['merk_device'])){ $merk_device = $_POST['merk_device'];}
		if(isset($_POST['nama_device'])){ $nama_device = $_POST['nama_device'];}
		if(isset($_POST['kode_warna'])){ $kode_warna = $_POST['kode_warna'];}
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
		if(isset($_POST['otorisasi_harga'])){ $otorisasi_harga = $_POST['otorisasi_harga'];}
		
		$harga_beli = str_replace(".", "", $harga_beli);
		$hj_agen 	= str_replace(".", "", $hj_agen);
		$hj_retail 	= str_replace(".", "", $hj_retail);
		$hj_whs 	= str_replace(".", "", $hj_whs);
		
		$data = array('kode_supplier' => $kode_supplier,
					  'jenis_device' => $jenis_device,
					  'kode_device' => $kode_device,
					  'id_kode_barang' => $id_kode_barang,
					  'seq_kode_barang' => $seq_kode_barang,
					  'merk_device' => $merk_device,
					  'nama_device' => $nama_device,
					  'kode_warna' => $kode_warna,
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
					  'otorisasi_harga' => $otorisasi_harga,
					  'status' => $status);
		//var_dump($data);
		$this->view->datainsert=$this->Device_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$kode_device = '';
		
		if(isset($_REQUEST['kode_device'])){ $kode_device = $_REQUEST['kode_device'];}
		
		$dataInput = array('kode_device' => $kode_device);
		$hasil = $this->Device_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Device_Service = $this->Device_Service;
		
		$kode_device_data   = $_GET['id'];
		$this->view->kode_device_data = $kode_device_data;
		
		$this->view->data=$this->Device_Service->getDataDevice($kode_device_data);
		$temp_device = $this->Device_Service->getDataDevice($kode_device_data);
		$kode_supplier = $temp_device[0]['kode_supplier'];
		$this->view->data2 = $this->Device_Service->getdatasupplierid($kode_supplier);
		
		$this->view->supplier=$this->Device_Service->getSupplier();
		$this->view->warna=$this->Device_Service->getWarna();
		$this->view->seq=$this->Device_Service->getNoSeq();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('device-layout');
		
		$kode_supplier   = '';
		$jenis_device    = '';
		$kode_device 	 = '';
		$merk_device 	 = '';
		$nama_device 	 = '';
		$kode_warna	 	 = '';
		$ket			 = '';
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
		if(isset($_POST['jenis_device'])){ $jenis_device = $_POST['jenis_device'];}
		if(isset($_POST['kode_device'])){ $kode_device = $_POST['kode_device'];}
		if(isset($_POST['merk_device'])){ $merk_device = $_POST['merk_device'];}
		if(isset($_POST['nama_device'])){ $nama_device = $_POST['nama_device'];}
		if(isset($_POST['kode_warna'])){ $kode_warna = $_POST['kode_warna'];}
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
					  'jenis_device' => $jenis_device,
					  'kode_device' => $kode_device,
					  'merk_device' => $merk_device,
					  'nama_device' => $nama_device,
					  'kode_warna' => $kode_warna,
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
		
		$this->view->datainsert=$this->Device_Service->editdata($data);
   }
   
   public function cekseqAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$id_kode_barang = '';
		if(isset($_REQUEST['id_kode_barang'])){ $id_kode_barang = $_REQUEST['id_kode_barang'];}
		
		$this->view->id_kode_barang = $this->Device_Service->getSeq($id_kode_barang);
	}

	
	public function excelAction(){
		// $this->_helper->viewRenderer->setNoRender(true);
    $sessionlogin = new Zend_Session_Namespace('sessionlogin');
    $this->view->permission = $sessionlogin->permission;
    $this->_helper->layout->setLayout('target-column');
		$this->view->Device_Service = $this->Device_Service;

		$this->view->data = $this->Device_Service->getlistdevice();
    // echo 'eds';
	}
 
}