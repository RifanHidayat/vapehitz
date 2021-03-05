<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Penyelesaianpenjualan_Service.php';

class PenyelesaianpenjualanController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Penyelesaianpenjualan_Service = Penyelesaianpenjualan_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('penyelesaianpenjualan-layout');
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->data = $this->Penyelesaianpenjualan_Service->getlistsalecentral();
		$this->view->menu = $this->Penyelesaianpenjualan_Service->getmenu();
    }
	
	public function historyAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->data = $this->Penyelesaianpenjualan_Service->getlistReturPembelian();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->supplier=$this->Penyelesaianpenjualan_Service->getSupplier();
		$this->view->warna=$this->Penyelesaianpenjualan_Service->getWarna();
		$this->view->seq=$this->Penyelesaianpenjualan_Service->getNoSeq();
		$this->view->rek=$this->Penyelesaianpenjualan_Service->getRekening();
    }
	
	public function dataatomizerAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->data = $this->Penyelesaianpenjualan_Service->getlistatomizer();
    }
	
	public function dataaksesorisAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->data = $this->Penyelesaianpenjualan_Service->getlistaccessories();
    }
	
	public function datadeviceAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->data = $this->Penyelesaianpenjualan_Service->getlistdevice();
    }
	
	public function databarangAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$no_invoice_data = '';
		
		if(isset($_REQUEST['no_invoice'])){ $no_invoice_data = $_REQUEST['no_invoice'];}
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->data = $this->Penyelesaianpenjualan_Service->getDataDetailsalecentral($no_invoice_data);
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('penyelesaianpenjualan-layout');
		
		$kode_supplier 	 = '';
		$no_invoice 		 = '';
		$tgl_invoice	 	 = '';
		$seq		 	 = '';
		$total		 	 = '';
		$biaya_kirim 	 = '';
		$diskon		 	 = '';
		$net_total	 	 = '';
		$jml_bayar_dp	 = '';
		$sisa_bayar		 = '';
		$metode_bayar2	 = '';
		$no_rek			 = '';
		
		$kode_barang	 = '';
		$harga_beli		 = '';
		$qty			 = '';
		$sub_total		 = '';
		
		$nama_tabel = '';
		$stok_gudang_baru = '';
		$harga_beli_baru = '';
		$kode = '';
		
		if(isset($_POST['kode_supplier2'])){ $kode_supplier = $_POST['kode_supplier2'];}
		if(isset($_POST['no_invoice'])){ $no_invoice = $_POST['no_invoice'];}
		if(isset($_POST['tgl_invoice'])){ $tgl_invoice = $_POST['tgl_invoice'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		if(isset($_POST['total'])){ $total = $_POST['total'];}
		if(isset($_POST['biaya_kirim'])){ $biaya_kirim = $_POST['biaya_kirim'];}
		if(isset($_POST['diskon'])){ $diskon = $_POST['diskon'];}
		if(isset($_POST['net_total'])){ $net_total = str_replace(".", "", $_POST['net_total']);}
		if(isset($_POST['jml_bayar_dp'])){ $jml_bayar_dp = $_POST['jml_bayar_dp'];}
		if(isset($_POST['sisa_bayar'])){ $sisa_bayar = $_POST['sisa_bayar'];}
		if(isset($_POST['metode_bayar2'])){ $metode_bayar2 = $_POST['metode_bayar2'];}
		if(isset($_POST['no_rek'])){ $no_rek = $_POST['no_rek'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['harga_beli'])){ $harga_beli = $_POST['harga_beli'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['sub_total'])){ $sub_total = $_POST['sub_total'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['stok_gudang_baru'])){ $stok_gudang_baru = $_POST['stok_gudang_baru'];}
		if(isset($_POST['harga_beli_baru'])){ $harga_beli_baru = $_POST['harga_beli_baru'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$total= str_replace(".", "", $total);
		$biaya_kirim= str_replace(".", "", $biaya_kirim);
		$diskon= str_replace(".", "", $diskon);
		$net_total= str_replace(".", "", $net_total);
		$jml_bayar_dp= str_replace(".", "", $jml_bayar_dp);
		$sisa_bayar= str_replace(".", "", $sisa_bayar);
		$harga_beli= str_replace(".", "", $harga_beli);
		$sub_total= str_replace(".", "", $sub_total);
		//$harga_beli_baru= str_replace(".", "", $harga_beli_baru);
		
		$data = array('kode_supplier' => $kode_supplier,
					  'no_invoice' => $no_invoice,
					  'tgl_invoice' => $tgl_invoice,
					  'seq' => $seq,
					  'total' => $total,
					  'biaya_kirim' => $biaya_kirim,
					  'diskon' => $diskon,
					  'net_total' => $net_total,
					  'jml_bayar_dp' => $jml_bayar_dp,
					  'sisa_bayar' => $sisa_bayar,
					  'metode_bayar2' => $metode_bayar2,
					  'no_rek' => $no_rek,
					  'kode_barang' => $kode_barang,
					  'harga_beli' => $harga_beli,
					  'qty' => $qty,
					  'sub_total' => $sub_total,
					  'nama_tabel' => $nama_tabel,
					  'stok_gudang_baru' => $stok_gudang_baru,
					  'harga_beli_baru' => $harga_beli_baru,
					  'kode' => $kode);
		//var_dump($data);
		$this->view->datainsert=$this->Penyelesaianpenjualan_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$no_invoice = '';
		
		if(isset($_REQUEST['no_invoice'])){ $no_invoice = $_REQUEST['no_invoice'];}
		
		$dataInput = array('no_invoice' => $no_invoice);
		$hasil = $this->Penyelesaianpenjualan_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_retur_data   = $_GET['id'];
		$this->view->no_retur_data = $no_retur_data;
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->data=$this->Penyelesaianpenjualan_Service->getDatasalecentral($no_retur_data);
		
		//$this->view->data3=$this->Penyelesaianpenjualan_Service->getDataDetailsalecentral($no_retur_data);
		
		$this->view->data4=$this->Penyelesaianpenjualan_Service->getDataDetailHutang($no_retur_data);
		
		$this->view->supplier=$this->Penyelesaianpenjualan_Service->getSupplier();
		$this->view->warna=$this->Penyelesaianpenjualan_Service->getWarna();
		$this->view->seq=$this->Penyelesaianpenjualan_Service->getNoSeq();
		$this->view->rek=$this->Penyelesaianpenjualan_Service->getRekening();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('penyelesaianpenjualan-layout');
		
		$no_invoice 	 = '';
		$no_retur 		 = '';
		$tgl_pembayaran	 = date("Y-m-d");
		$jml_bayar_dp	 = '';
		$total_bayar	 = '';
		$sisa_hutang	 = '';
		$metode_bayar2	 = '';
		$no_rek			 = '';
		$catatan		 = '';
		
		if(isset($_POST['no_invoice'])){ $no_invoice = $_POST['no_invoice'];}
		if(isset($_POST['no_retur'])){ $no_retur = $_POST['no_retur'];}
		if(isset($_POST['jml_bayar_dp'])){ $jml_bayar_dp = $_POST['jml_bayar_dp'];}
		if(isset($_POST['total_bayar'])){ $total_bayar = $_POST['total_bayar'];}
		if(isset($_POST['sisa_hutang'])){ $sisa_hutang = $_POST['sisa_hutang'];}
		if(isset($_POST['metode_bayar2'])){ $metode_bayar2 = $_POST['metode_bayar2'];}
		if(isset($_POST['no_rek'])){ $no_rek = $_POST['no_rek'];}
		if(isset($_POST['catatan'])){ $catatan = $_POST['catatan'];}
		
		$jml_bayar_dp= str_replace(".", "", $jml_bayar_dp);
		$total_bayar= str_replace(".", "", $total_bayar);
		$sisa_hutang= str_replace(".", "", $sisa_hutang);
		
		$data = array('no_invoice' => $no_invoice,
					  'no_retur' => $no_retur,
					  'jml_bayar_dp' => $jml_bayar_dp,
					  'total_bayar' => $total_bayar,
					  'sisa_hutang' => $sisa_hutang,
					  'metode_bayar2' => $metode_bayar2,
					  'no_rek' => $no_rek,
					  'catatan' => $catatan,
					  'tgl_pembayaran' => $tgl_pembayaran);
		
		$this->view->datainsert=$this->Penyelesaianpenjualan_Service->editdata($data);
   }
   
   public function detailAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_retur_data   = $_GET['id'];
		$this->view->no_retur_data = $no_retur_data;
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->data=$this->Penyelesaianpenjualan_Service->getDatasalecentral($no_retur_data);
		
		//$this->view->data3=$this->Penyelesaianpenjualan_Service->getDataDetailsalecentral($no_retur_data);
		
		$this->view->data4=$this->Penyelesaianpenjualan_Service->getDataDetailHutang($no_retur_data);
		
		$this->view->supplier=$this->Penyelesaianpenjualan_Service->getSupplier();
		$this->view->warna=$this->Penyelesaianpenjualan_Service->getWarna();
		$this->view->seq=$this->Penyelesaianpenjualan_Service->getNoSeq();
		$this->view->rek=$this->Penyelesaianpenjualan_Service->getRekening();
    }
	
	public function detailreturAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_retur_data   = $_GET['id'];
		$this->view->no_retur_data = $no_retur_data;
		
		$this->view->Penyelesaianpenjualan_Service = $this->Penyelesaianpenjualan_Service;
		
		$this->view->data=$this->Penyelesaianpenjualan_Service->getDataReturPembelian($no_retur_data);
		$temp_salecentral = $this->Penyelesaianpenjualan_Service->getDataReturPembelian($no_retur_data);
		$kode_supplier = $temp_salecentral[0]['kode_supplier'];
		$this->view->data2 = $this->Penyelesaianpenjualan_Service->getdatasupplierid($kode_supplier);
		
		$this->view->data3=$this->Penyelesaianpenjualan_Service->getDataDetailReturPembelian($no_retur_data);
		
		$this->view->supplier=$this->Penyelesaianpenjualan_Service->getSupplier();
		$this->view->warna=$this->Penyelesaianpenjualan_Service->getWarna();
		$this->view->seq=$this->Penyelesaianpenjualan_Service->getNoSeq();
		$this->view->rek=$this->Penyelesaianpenjualan_Service->getRekening();
    }
 
}