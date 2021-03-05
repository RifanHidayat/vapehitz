<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Sopretail_Service.php';

class SopretailController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Sopretail_Service = Sopretail_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('sopretail-layout');
		
		$this->view->Sopretail_Service = $this->Sopretail_Service;
		
		$this->view->data = $this->Sopretail_Service->getlistSOP();
		$this->view->menu = $this->Sopretail_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopretail_Service = $this->Sopretail_Service;
		
		$this->view->supplier=$this->Sopretail_Service->getSupplier();
		$this->view->warna=$this->Sopretail_Service->getWarna();
		$this->view->seq=$this->Sopretail_Service->getNoSeq();
		$this->view->rek=$this->Sopretail_Service->getRekening();
    }
	
	public function dataatomizerAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopretail_Service = $this->Sopretail_Service;
		
		$this->view->data = $this->Sopretail_Service->getlistatomizer();
    }
	
	public function dataaksesorisAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopretail_Service = $this->Sopretail_Service;
		
		$this->view->data = $this->Sopretail_Service->getlistaccessories();
    }
	
	public function datadeviceAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopretail_Service = $this->Sopretail_Service;
		
		$this->view->data = $this->Sopretail_Service->getlistdevice();
    }
	
	public function dataliquidAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Sopretail_Service = $this->Sopretail_Service;
		
		$this->view->data = $this->Sopretail_Service->getlistliquid();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('sopretail-layout');
		
		$no_sop 		 = '';
		$tgl_sop	 	 = '';
		$seq		 	 = '';
		$kategori		 = '';
		
		$kode_barang	 = '';
		$stok_retail	 = '';
		$real_stock		 = '';
		$selisih		 = '';
		$ket			 = '';
		
		$nama_tabel = '';
		$kode = '';
		
		if(isset($_POST['no_sop'])){ $no_sop = $_POST['no_sop'];}
		if(isset($_POST['tgl_sop'])){ $tgl_sop = $_POST['tgl_sop'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		if(isset($_POST['kategori'])){ $kategori = $_POST['kategori'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_retail'])){ $stok_retail = $_POST['stok_retail'];}
		if(isset($_POST['real_stock'])){ $real_stock = $_POST['real_stock'];}
		if(isset($_POST['selisih'])){ $selisih = $_POST['selisih'];}
		if(isset($_POST['ket'])){ $ket = $_POST['ket'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_sop = str_replace('/', '-', $tgl_sop);
		$tgl_sop = date("Y-m-d H:i", strtotime($tgl_sop));
		
		$data = array('no_sop' => $no_sop,
					  'tgl_sop' => $tgl_sop,
					  'seq' => $seq,
					  'kategori' => $kategori,
					  'kode_barang' => $kode_barang,
					  'stok_retail' => $stok_retail,
					  'real_stock' => $real_stock,
					  'selisih' => $selisih,
					  'ket' => $ket,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		//var_dump($data);
		$this->view->datainsert=$this->Sopretail_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$no_sop = '';
		
		if(isset($_REQUEST['no_sop'])){ $no_sop = $_REQUEST['no_sop'];}
		
		$dataInput = array('no_sop' => $no_sop);
		$hasil = $this->Sopretail_Service->hapusData($dataInput);

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
		
		$this->view->Sopretail_Service = $this->Sopretail_Service;
		
		$this->view->data=$this->Sopretail_Service->getDatasopretail($no_sop_data);
		
		$this->view->data3=$this->Sopretail_Service->getDataDetailsopretail($no_sop_data);
		
		$this->view->supplier=$this->Sopretail_Service->getSupplier();
		$this->view->warna=$this->Sopretail_Service->getWarna();
		$this->view->seq=$this->Sopretail_Service->getNoSeq();
		$this->view->rek=$this->Sopretail_Service->getRekening();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('sopretail-layout');
		
		$no_sop 		 = '';
		$tgl_sop	 	 = '';
		$seq		 	 = '';
		$kategori		 = '';
		
		$kode_barang	 = '';
		$stok_retail	 = '';
		$real_stock		 = '';
		$selisih		 = '';
		$ket			 = '';
		
		$nama_tabel = '';
		$kode = '';
		
		if(isset($_POST['no_sop'])){ $no_sop = $_POST['no_sop'];}
		if(isset($_POST['tgl_sop'])){ $tgl_sop = $_POST['tgl_sop'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		if(isset($_POST['kategori'])){ $kategori = $_POST['kategori'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_retail'])){ $stok_retail = $_POST['stok_retail'];}
		if(isset($_POST['real_stock'])){ $real_stock = $_POST['real_stock'];}
		if(isset($_POST['selisih'])){ $selisih = $_POST['selisih'];}
		if(isset($_POST['ket'])){ $ket = $_POST['ket'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_sop = str_replace('/', '-', $tgl_sop);
		$tgl_sop = date("Y-m-d H:i", strtotime($tgl_sop));
		
		$data = array('no_sop' => $no_sop,
					  'tgl_sop' => $tgl_sop,
					  'seq' => $seq,
					  'kategori' => $kategori,
					  'kode_barang' => $kode_barang,
					  'stok_retail' => $stok_retail,
					  'real_stock' => $real_stock,
					  'selisih' => $selisih,
					  'ket' => $ket,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Sopretail_Service->editdata($data);
   }
 
}