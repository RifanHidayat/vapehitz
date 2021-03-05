<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Badstockgudang_Service.php';

class BadstockgudangController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Badstockgudang_Service = Badstockgudang_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('badstockgudang-layout');
		
		$this->view->Badstockgudang_Service = $this->Badstockgudang_Service;
		
		$this->view->data = $this->Badstockgudang_Service->getlist();
		$this->view->menu = $this->Badstockgudang_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Badstockgudang_Service = $this->Badstockgudang_Service;
		
		$this->view->supplier=$this->Badstockgudang_Service->getSupplier();
		$this->view->warna=$this->Badstockgudang_Service->getWarna();
		$this->view->seq=$this->Badstockgudang_Service->getNoSeq();
		$this->view->rek=$this->Badstockgudang_Service->getRekening();
    }
	
	public function dataatomizerAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Badstockgudang_Service = $this->Badstockgudang_Service;
		
		$this->view->data = $this->Badstockgudang_Service->getlistatomizer();
    }
	
	public function dataaksesorisAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Badstockgudang_Service = $this->Badstockgudang_Service;
		
		$this->view->data = $this->Badstockgudang_Service->getlistaccessories();
    }
	
	public function datadeviceAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Badstockgudang_Service = $this->Badstockgudang_Service;
		
		$this->view->data = $this->Badstockgudang_Service->getlistdevice();
    }
	
	public function dataliquidAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Badstockgudang_Service = $this->Badstockgudang_Service;
		
		$this->view->data = $this->Badstockgudang_Service->getlistliquid();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('badstockgudang-layout');
		
		$no_proses 		 = '';
		$tgl_proses	 	 = '';
		$seq		 	 = '';
		$nama_file		 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$qty		 	 = '';
		$bad_stock		 = '';
		$sisa		 	 = '';
		
		$nama_tabel 	 = '';
		$kode 			 = '';
		
		if(isset($_POST['no_proses'])){ $no_proses = $_POST['no_proses'];}
		if(isset($_POST['tgl_proses'])){ $tgl_proses = $_POST['tgl_proses'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['bad_stock'])){ $bad_stock = $_POST['bad_stock'];}
		if(isset($_POST['sisa'])){ $sisa = $_POST['sisa'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_proses = str_replace('/', '-', $tgl_proses);
		$tgl_proses = date("Y-m-d H:i", strtotime($tgl_proses));
		
		if (array_key_exists("nama_file",$_FILES)) {
																
					$target = 'upload/bad_stock/';
					
					$path = $_FILES['nama_file']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					
					$no_proses2 = str_replace("/","_",$no_proses);
					
					$nama_file = "File_".$no_proses2.".".$ext;
					
					$temp = $target;
					$tmp = $_FILES['nama_file']['tmp_name'];
					$temp = $temp . basename($nama_file);
										
					move_uploaded_file($tmp, $temp);
					$temp = '';
					$tmp = '';
		}
		
		$data = array('no_proses' => $no_proses,
					  'tgl_proses' => $tgl_proses,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'qty' => $qty,
					  'bad_stock' => $bad_stock,
					  'sisa' => $sisa,
					  'nama_file' => $nama_file,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		//var_dump($data);
		$this->view->datainsert=$this->Badstockgudang_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$no_proses = '';
		
		if(isset($_REQUEST['no_proses'])){ $no_proses = $_REQUEST['no_proses'];}
		
		$dataInput = array('no_proses' => $no_proses);
		$hasil = $this->Badstockgudang_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_proses_data   = $_GET['id'];
		$this->view->no_proses_data = $no_proses_data;
		
		$this->view->Badstockgudang_Service = $this->Badstockgudang_Service;
		
		$this->view->data=$this->Badstockgudang_Service->getDataBadStockGudang($no_proses_data);
		
		$this->view->data3=$this->Badstockgudang_Service->getDataDetailBadStockGudang($no_proses_data);
		
		$this->view->supplier=$this->Badstockgudang_Service->getSupplier();
		$this->view->warna=$this->Badstockgudang_Service->getWarna();
		$this->view->seq=$this->Badstockgudang_Service->getNoSeq();
		$this->view->rek=$this->Badstockgudang_Service->getRekening();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('badstockgudang-layout');
		
		$no_proses 		 = '';
		$tgl_proses	 	 = '';
		$seq		 	 = '';
		$nama_file		 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$qty		 	 = '';
		$bad_stock		 = '';
		$sisa		 	 = '';
		
		$nama_tabel 	 = '';
		$kode 			 = '';
		
		if(isset($_POST['no_proses'])){ $no_proses = $_POST['no_proses'];}
		if(isset($_POST['tgl_proses'])){ $tgl_proses = $_POST['tgl_proses'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['bad_stock'])){ $bad_stock = $_POST['bad_stock'];}
		if(isset($_POST['sisa'])){ $sisa = $_POST['sisa'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_proses = str_replace('/', '-', $tgl_proses);
		$tgl_proses = date("Y-m-d H:i", strtotime($tgl_proses));
		
		if (array_key_exists("nama_file",$_FILES)) {
																
					$target = 'upload/bad_stock/';
					
					$path = $_FILES['nama_file']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					
					$no_proses2 = str_replace("/","_",$no_proses);
					
					$nama_file = "File_".$no_proses2.".".$ext;
					
					$temp = $target;
					$tmp = $_FILES['nama_file']['tmp_name'];
					$temp = $temp . basename($nama_file);
										
					move_uploaded_file($tmp, $temp);
					$temp = '';
					$tmp = '';
		}
		
		$data = array('no_proses' => $no_proses,
					  'tgl_proses' => $tgl_proses,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'qty' => $qty,
					  'bad_stock' => $bad_stock,
					  'sisa' => $sisa,
					  'nama_file' => $nama_file,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Badstockgudang_Service->editdata($data);
   }
   
   public function approvalAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_proses_data   = $_GET['id'];
		$this->view->no_proses_data = $no_proses_data;
		
		$this->view->Badstockgudang_Service = $this->Badstockgudang_Service;
		
		$this->view->data=$this->Badstockgudang_Service->getDataBadStockGudang($no_proses_data);
		
		$this->view->data3=$this->Badstockgudang_Service->getDataDetailBadStockGudang($no_proses_data);
		
		$this->view->supplier=$this->Badstockgudang_Service->getSupplier();
		$this->view->warna=$this->Badstockgudang_Service->getWarna();
		$this->view->seq=$this->Badstockgudang_Service->getNoSeq();
		$this->view->rek=$this->Badstockgudang_Service->getRekening();
    }
	
	public function kirimdataapproveAction() { 
	
		$this->_helper->layout->setLayout('badstockgudang-layout');
		
		$no_proses 		 = '';
		$tgl_proses	 	 = '';
		$seq		 	 = '';
		$nama_file		 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$qty		 	 = '';
		$bad_stock		 = '';
		$sisa		 	 = '';
		
		$nama_tabel 	 = '';
		$kode 			 = '';
		
		if(isset($_POST['no_proses'])){ $no_proses = $_POST['no_proses'];}
		if(isset($_POST['tgl_proses'])){ $tgl_proses = $_POST['tgl_proses'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['bad_stock'])){ $bad_stock = $_POST['bad_stock'];}
		if(isset($_POST['sisa'])){ $sisa = $_POST['sisa'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_proses = str_replace('/', '-', $tgl_proses);
		$tgl_proses = date("Y-m-d H:i", strtotime($tgl_proses));
		
		if (array_key_exists("nama_file",$_FILES)) {
																
					$target = 'upload/bad_stock/';
					
					$path = $_FILES['nama_file']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					
					$no_proses2 = str_replace("/","_",$no_proses);
					
					$nama_file = "File_".$no_proses2.".".$ext;
					
					$temp = $target;
					$tmp = $_FILES['nama_file']['tmp_name'];
					$temp = $temp . basename($nama_file);
										
					move_uploaded_file($tmp, $temp);
					$temp = '';
					$tmp = '';
		}
		
		$data = array('no_proses' => $no_proses,
					  'tgl_proses' => $tgl_proses,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'qty' => $qty,
					  'bad_stock' => $bad_stock,
					  'sisa' => $sisa,
					  'nama_file' => $nama_file,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Badstockgudang_Service->approvedata($data);
   }
   
   public function kirimdataapprove2Action() { 
	
		$this->_helper->layout->setLayout('badstockgudang-layout');
		
		$no_proses 		 = '';
		$tgl_proses	 	 = '';
		$seq		 	 = '';
		
		$kode_barang	 = '';
		$stok_gudang	 = '';
		$qty		 	 = '';
		$bad_stock		 = '';
		$sisa		 	 = '';
		
		$nama_tabel 	 = '';
		$kode 			 = '';
		
		if(isset($_POST['no_proses'])){ $no_proses = $_POST['no_proses'];}
		if(isset($_POST['tgl_proses'])){ $tgl_proses = $_POST['tgl_proses'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['bad_stock'])){ $bad_stock = $_POST['bad_stock'];}
		if(isset($_POST['sisa'])){ $sisa = $_POST['sisa'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$tgl_proses = str_replace('/', '-', $tgl_proses);
		$tgl_proses = date("Y-m-d H:i", strtotime($tgl_proses));
		
		$data = array('no_proses' => $no_proses,
					  'tgl_proses' => $tgl_proses,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'stok_gudang' => $stok_gudang,
					  'qty' => $qty,
					  'bad_stock' => $bad_stock,
					  'sisa' => $sisa,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Badstockgudang_Service->approvedata2($data);
   }
   
   public function detailAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_proses_data   = $_GET['id'];
		$this->view->no_proses_data = $no_proses_data;
		
		$this->view->Badstockgudang_Service = $this->Badstockgudang_Service;
		
		$this->view->data=$this->Badstockgudang_Service->getDataBadStockGudang($no_proses_data);
		
		$this->view->data3=$this->Badstockgudang_Service->getDataDetailBadStockGudang($no_proses_data);
		
		$this->view->supplier=$this->Badstockgudang_Service->getSupplier();
		$this->view->warna=$this->Badstockgudang_Service->getWarna();
		$this->view->seq=$this->Badstockgudang_Service->getNoSeq();
		$this->view->rek=$this->Badstockgudang_Service->getRekening();
    }
 
}