<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Sopgudang_Service.php';

class SopgudangController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Sopgudang_Service = Sopgudang_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('sopgudang-layout');
		
		$this->view->Sopgudang_Service = $this->Sopgudang_Service;
		
		$this->view->data = $this->Sopgudang_Service->getlistSOP();
		$this->view->menu = $this->Sopgudang_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopgudang_Service = $this->Sopgudang_Service;
		
		$this->view->supplier=$this->Sopgudang_Service->getSupplier();
		$this->view->warna=$this->Sopgudang_Service->getWarna();
		$this->view->seq=$this->Sopgudang_Service->getNoSeq();
		$this->view->rek=$this->Sopgudang_Service->getRekening();
    }
	
	public function dataatomizerAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopgudang_Service = $this->Sopgudang_Service;
		
		$this->view->data = $this->Sopgudang_Service->getlistatomizer();
    }
	
	public function dataaksesorisAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopgudang_Service = $this->Sopgudang_Service;
		
		$this->view->data = $this->Sopgudang_Service->getlistaccessories();
    }
	
	public function datadeviceAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopgudang_Service = $this->Sopgudang_Service;
		
		$this->view->data = $this->Sopgudang_Service->getlistdevice();
    }
	
	public function dataliquidAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopgudang_Service = $this->Sopgudang_Service;
		
		$this->view->data = $this->Sopgudang_Service->getlistliquid();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('sopgudang-layout');
		
		$no_sop 		 = '';
		$tgl_sop	 	 = '';
		$seq		 	 = '';
		$kategori		 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$good_stock		 = '';
		$bad_stock		 = '';
		$selisih		 = '';
		$ket			 = '';
		
		$nama_tabel = '';
		$bad_stock_baru = '';
		$bad_stock_awal = '';
		$kode = '';
		
		if(isset($_POST['no_sop'])){ $no_sop = $_POST['no_sop'];}
		if(isset($_POST['tgl_sop'])){ $tgl_sop = $_POST['tgl_sop'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		if(isset($_POST['kategori'])){ $kategori = $_POST['kategori'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['good_stock'])){ $good_stock = $_POST['good_stock'];}
		if(isset($_POST['bad_stock'])){ $bad_stock = $_POST['bad_stock'];}
		if(isset($_POST['selisih'])){ $selisih = $_POST['selisih'];}
		if(isset($_POST['ket'])){ $ket = $_POST['ket'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['bad_stock_baru'])){ $bad_stock_baru = $_POST['bad_stock_baru'];}
		if(isset($_POST['bad_stock_awal'])){ $bad_stock_awal = $_POST['bad_stock_awal'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_sop = str_replace('/', '-', $tgl_sop);
		$tgl_sop = date("Y-m-d H:i", strtotime($tgl_sop));
		
		$data = array('no_sop' => $no_sop,
					  'tgl_sop' => $tgl_sop,
					  'seq' => $seq,
					  'kategori' => $kategori,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'good_stock' => $good_stock,
					  'bad_stock' => $bad_stock,
					  'selisih' => $selisih,
					  'ket' => $ket,
					  'nama_tabel' => $nama_tabel,
					  'bad_stock_baru' => $bad_stock_baru,
					  'bad_stock_awal' => $bad_stock_awal,
					  'kode' => $kode);
		//var_dump($data);
		$this->view->datainsert=$this->Sopgudang_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$no_sop = '';
		
		if(isset($_REQUEST['no_sop'])){ $no_sop = $_REQUEST['no_sop'];}
		
		$dataInput = array('no_sop' => $no_sop);
		$hasil = $this->Sopgudang_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_sop_data   = $_GET['id'];
		$this->view->no_sop_data = $no_sop_data;
		
		$this->view->Sopgudang_Service = $this->Sopgudang_Service;
		
		$this->view->data=$this->Sopgudang_Service->getDataSopGudang($no_sop_data);
		
		$this->view->data3=$this->Sopgudang_Service->getDataDetailSopGudang($no_sop_data);
		
		$this->view->supplier=$this->Sopgudang_Service->getSupplier();
		$this->view->warna=$this->Sopgudang_Service->getWarna();
		$this->view->seq=$this->Sopgudang_Service->getNoSeq();
		$this->view->rek=$this->Sopgudang_Service->getRekening();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('sopgudang-layout');
		
		$no_sop 		 = '';
		$tgl_sop	 	 = '';
		$seq		 	 = '';
		$kategori		 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$good_stock		 = '';
		$bad_stock		 = '';
		$selisih		 = '';
		$ket			 = '';
		
		$nama_tabel = '';
		$bad_stock_baru = '';
		$bad_stock_awal = '';
		$kode = '';
		
		if(isset($_POST['no_sop'])){ $no_sop = $_POST['no_sop'];}
		if(isset($_POST['tgl_sop'])){ $tgl_sop = $_POST['tgl_sop'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		if(isset($_POST['kategori'])){ $kategori = $_POST['kategori'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['good_stock'])){ $good_stock = $_POST['good_stock'];}
		if(isset($_POST['bad_stock'])){ $bad_stock = $_POST['bad_stock'];}
		if(isset($_POST['selisih'])){ $selisih = $_POST['selisih'];}
		if(isset($_POST['ket'])){ $ket = $_POST['ket'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['bad_stock_baru'])){ $bad_stock_baru = $_POST['bad_stock_baru'];}
		if(isset($_POST['bad_stock_awal'])){ $bad_stock_awal = $_POST['bad_stock_awal'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_sop = str_replace('/', '-', $tgl_sop);
		$tgl_sop = date("Y-m-d H:i", strtotime($tgl_sop));
		
		$data = array('no_sop' => $no_sop,
					  'tgl_sop' => $tgl_sop,
					  'seq' => $seq,
					  'kategori' => $kategori,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'good_stock' => $good_stock,
					  'bad_stock' => $bad_stock,
					  'selisih' => $selisih,
					  'ket' => $ket,
					  'nama_tabel' => $nama_tabel,
					  'bad_stock_baru' => $bad_stock_baru,
					  'bad_stock_awal' => $bad_stock_awal,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Sopgudang_Service->editdata($data);
   }
 
}