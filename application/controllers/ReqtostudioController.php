<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Reqtostudio_Service.php';

class ReqtostudioController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Reqtostudio_Service = Reqtostudio_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('reqtostudio-layout');
		
		$this->view->Reqtostudio_Service = $this->Reqtostudio_Service;
		
		$this->view->data = $this->Reqtostudio_Service->getlist();
		$this->view->menu = $this->Reqtostudio_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Reqtostudio_Service = $this->Reqtostudio_Service;
		
		$this->view->supplier=$this->Reqtostudio_Service->getSupplier();
		$this->view->warna=$this->Reqtostudio_Service->getWarna();
		$this->view->seq=$this->Reqtostudio_Service->getNoSeq();
		$this->view->rek=$this->Reqtostudio_Service->getRekening();
    }
	
	public function dataatomizerAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Reqtostudio_Service = $this->Reqtostudio_Service;
		
		$this->view->data = $this->Reqtostudio_Service->getlistatomizer();
    }
	
	public function dataaksesorisAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Reqtostudio_Service = $this->Reqtostudio_Service;
		
		$this->view->data = $this->Reqtostudio_Service->getlistaccessories();
    }
	
	public function datadeviceAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Reqtostudio_Service = $this->Reqtostudio_Service;
		
		$this->view->data = $this->Reqtostudio_Service->getlistdevice();
    }
	
	public function dataliquidAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Reqtostudio_Service = $this->Reqtostudio_Service;
		
		$this->view->data = $this->Reqtostudio_Service->getlistliquid();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('reqtostudio-layout');
		
		$no_request 	 = '';
		$tgl_request	 = '';
		$seq		 	 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$stok_studio	 = '';
		$qty		 	 = '';
		
		$nama_tabel 	 = '';
		$kode 			 = '';
		
		if(isset($_POST['no_request'])){ $no_request = $_POST['no_request'];}
		if(isset($_POST['tgl_request'])){ $tgl_request = $_POST['tgl_request'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['stok_studio'])){ $stok_studio = $_POST['stok_studio'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_request = str_replace('/', '-', $tgl_request);
		$tgl_request = date("Y-m-d H:i", strtotime($tgl_request));
		
		$data = array('no_request' => $no_request,
					  'tgl_request' => $tgl_request,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'stok_studio' => $stok_studio,
					  'qty' => $qty,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		//var_dump($data);
		$this->view->datainsert=$this->Reqtostudio_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$no_request = '';
		
		if(isset($_REQUEST['no_request'])){ $no_request = $_REQUEST['no_request'];}
		
		$dataInput = array('no_request' => $no_request);
		$hasil = $this->Reqtostudio_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_request_data   = $_GET['id'];
		$this->view->no_request_data = $no_request_data;
		
		$this->view->Reqtostudio_Service = $this->Reqtostudio_Service;
		
		$this->view->data=$this->Reqtostudio_Service->getDatareqtostudio($no_request_data);
		
		$this->view->data3=$this->Reqtostudio_Service->getDataDetailreqtostudio($no_request_data);
		
		$this->view->supplier=$this->Reqtostudio_Service->getSupplier();
		$this->view->warna=$this->Reqtostudio_Service->getWarna();
		$this->view->seq=$this->Reqtostudio_Service->getNoSeq();
		$this->view->rek=$this->Reqtostudio_Service->getRekening();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('reqtostudio-layout');
		
		$no_request 	 = '';
		$tgl_request	 = '';
		$seq		 	 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$stok_studio	 = '';
		$qty		 	 = '';
		
		$nama_tabel 	 = '';
		$kode 			 = '';
		
		if(isset($_POST['no_request'])){ $no_request = $_POST['no_request'];}
		if(isset($_POST['tgl_request'])){ $tgl_request = $_POST['tgl_request'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['stok_studio'])){ $stok_studio = $_POST['stok_studio'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_request = str_replace('/', '-', $tgl_request);
		$tgl_request = date("Y-m-d H:i", strtotime($tgl_request));
		
		$data = array('no_request' => $no_request,
					  'tgl_request' => $tgl_request,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'stok_studio' => $stok_studio,
					  'qty' => $qty,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Reqtostudio_Service->editdata($data);
   }
   
   public function approvalAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_request_data   = $_GET['id'];
		$this->view->no_request_data = $no_request_data;
		
		$this->view->Reqtostudio_Service = $this->Reqtostudio_Service;
		
		$this->view->data=$this->Reqtostudio_Service->getDatareqtostudio($no_request_data);
		
		$this->view->data3=$this->Reqtostudio_Service->getDataDetailreqtostudio($no_request_data);
		
		$this->view->supplier=$this->Reqtostudio_Service->getSupplier();
		$this->view->warna=$this->Reqtostudio_Service->getWarna();
		$this->view->seq=$this->Reqtostudio_Service->getNoSeq();
		$this->view->rek=$this->Reqtostudio_Service->getRekening();
    }
	
	public function kirimdataapproveAction() { 
	
		$this->_helper->layout->setLayout('reqtostudio-layout');
		
		$no_request 	 = '';
		$tgl_request	 = '';
		$seq		 	 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$stok_studio	 = '';
		$qty		 	 = '';
		
		$nama_tabel 	 = '';
		$kode 			 = '';
		
		if(isset($_POST['no_request'])){ $no_request = $_POST['no_request'];}
		if(isset($_POST['tgl_request'])){ $tgl_request = $_POST['tgl_request'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['stok_studio'])){ $stok_studio = $_POST['stok_studio'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_request = str_replace('/', '-', $tgl_request);
		$tgl_request = date("Y-m-d H:i", strtotime($tgl_request));
		
		$data = array('no_request' => $no_request,
					  'tgl_request' => $tgl_request,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'stok_studio' => $stok_studio,
					  'qty' => $qty,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Reqtostudio_Service->approvedata($data);
   }
   
   public function kirimdataapprove2Action() { 
	
		$this->_helper->layout->setLayout('reqtostudio-layout');
		
		$no_request 	 = '';
		$tgl_request	 = '';
		$seq		 	 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$stok_studio	 = '';
		$qty		 	 = '';
		
		$nama_tabel 	 = '';
		$kode 			 = '';
		
		if(isset($_POST['no_request'])){ $no_request = $_POST['no_request'];}
		if(isset($_POST['tgl_request'])){ $tgl_request = $_POST['tgl_request'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['stok_studio'])){ $stok_studio = $_POST['stok_studio'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_request = str_replace('/', '-', $tgl_request);
		$tgl_request = date("Y-m-d H:i", strtotime($tgl_request));
		
		$data = array('no_request' => $no_request,
					  'tgl_request' => $tgl_request,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'stok_studio' => $stok_studio,
					  'qty' => $qty,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Reqtostudio_Service->approvedata2($data);
   }
   
   public function detailAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_request_data   = $_GET['id'];
		$this->view->no_request_data = $no_request_data;
		
		$this->view->Reqtostudio_Service = $this->Reqtostudio_Service;
		
		$this->view->data=$this->Reqtostudio_Service->getDatareqtostudio($no_request_data);
		
		$this->view->data3=$this->Reqtostudio_Service->getDataDetailreqtostudio($no_request_data);
		
		$this->view->supplier=$this->Reqtostudio_Service->getSupplier();
		$this->view->warna=$this->Reqtostudio_Service->getWarna();
		$this->view->seq=$this->Reqtostudio_Service->getNoSeq();
		$this->view->rek=$this->Reqtostudio_Service->getRekening();
    }
 
}