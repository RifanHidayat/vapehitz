<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Pembayaransupplier_Service.php';

class PembayaransupplierController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Pembayaransupplier_Service = Pembayaransupplier_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('pembayaransupplier-layout');
		
		$this->view->Pembayaransupplier_Service = $this->Pembayaransupplier_Service;
		
		$this->view->data = $this->Pembayaransupplier_Service->getlistOrderCentral();
		$this->view->menu = $this->Pembayaransupplier_Service->getmenu();

    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Pembayaransupplier_Service = $this->Pembayaransupplier_Service;
		
		$this->view->supplier=$this->Pembayaransupplier_Service->getSupplier();
		$this->view->warna=$this->Pembayaransupplier_Service->getWarna();
		$this->view->seq=$this->Pembayaransupplier_Service->getNoSeq();
		$this->view->rek=$this->Pembayaransupplier_Service->getRekening();
		$this->view->cash=$this->Pembayaransupplier_Service->getCash();
    }
	
	public function dataatomizerAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Pembayaransupplier_Service = $this->Pembayaransupplier_Service;
		
		$this->view->data = $this->Pembayaransupplier_Service->getlistatomizer();
    }
	
	public function dataaksesorisAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Pembayaransupplier_Service = $this->Pembayaransupplier_Service;
		
		$this->view->data = $this->Pembayaransupplier_Service->getlistaccessories();
    }
	
	public function datadeviceAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Pembayaransupplier_Service = $this->Pembayaransupplier_Service;
		
		$this->view->data = $this->Pembayaransupplier_Service->getlistdevice();
    }
	
	public function dataliquidAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Pembayaransupplier_Service = $this->Pembayaransupplier_Service;
		
		$this->view->data = $this->Pembayaransupplier_Service->getlistliquid();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('pembayaransupplier-layout');
		
		$kode_supplier 	 = '';
		$no_order 		 = '';
		$tgl_order	 	 = '';
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
		if(isset($_POST['no_order'])){ $no_order = $_POST['no_order'];}
		if(isset($_POST['tgl_order'])){ $tgl_order = $_POST['tgl_order'];}
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
					  'no_order' => $no_order,
					  'tgl_order' => $tgl_order,
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
		$this->view->datainsert=$this->Pembayaransupplier_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$no_order = '';
		
		if(isset($_REQUEST['no_order'])){ $no_order = $_REQUEST['no_order'];}
		
		$dataInput = array('no_order' => $no_order);
		$hasil = $this->Pembayaransupplier_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_order_data   = $_GET['id'];
		$this->view->no_order_data = $no_order_data;
		
		$this->view->Pembayaransupplier_Service = $this->Pembayaransupplier_Service;
		
		$this->view->data=$this->Pembayaransupplier_Service->getDataOrderCentral($no_order_data);
		$temp_ordercentral = $this->Pembayaransupplier_Service->getDataOrderCentral($no_order_data);
		$kode_supplier = $temp_ordercentral[0]['kode_supplier'];
		$this->view->data2 = $this->Pembayaransupplier_Service->getdatasupplierid($kode_supplier);
		
		$this->view->data3=$this->Pembayaransupplier_Service->getDataDetailOrderCentral($no_order_data);
		
		$this->view->data4=$this->Pembayaransupplier_Service->getDataDetailHutang($no_order_data);
		
		$this->view->supplier=$this->Pembayaransupplier_Service->getSupplier();
		$this->view->warna=$this->Pembayaransupplier_Service->getWarna();
		$this->view->seq=$this->Pembayaransupplier_Service->getNoSeq();
		$this->view->rek=$this->Pembayaransupplier_Service->getRekening();
		$this->view->cash=$this->Pembayaransupplier_Service->getCash();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('pembayaransupplier-layout');
		
		$no_order 		 = '';
		$tgl_pembayaran	 = date("Y-m-d");
		$jml_bayar_dp	 = '';
		$total_bayar	 = '';
		$sisa_hutang	 = '';
		$metode_bayar2	 = '';
		$no_rek			 = '';
		$cash			 = '';
		$id_akun	     = '';
		$catatan		 = '';
		
		if(isset($_POST['no_order'])){ $no_order = $_POST['no_order'];}
		if(isset($_POST['jml_bayar_dp'])){ $jml_bayar_dp = $_POST['jml_bayar_dp'];}
		if(isset($_POST['total_bayar'])){ $total_bayar = $_POST['total_bayar'];}
		if(isset($_POST['sisa_hutang'])){ $sisa_hutang = $_POST['sisa_hutang'];}
		if(isset($_POST['metode_bayar2'])){ $metode_bayar2 = $_POST['metode_bayar2'];}
		if(isset($_POST['no_rek'])){ $no_rek = $_POST['no_rek'];}
	
		if(isset($_POST['catatan'])){ $catatan = $_POST['catatan'];}
		if(isset($_POST['cash'])){ $cash = $_POST['cash'];}

		if (($no_rek==0) || ($no_rek=="")){
			$id_akun=$cash;

		}else{
				$id_akun=$no_rek;

		}
		
		$jml_bayar_dp= str_replace(".", "", $jml_bayar_dp);
		$total_bayar= str_replace(".", "", $total_bayar);
		$sisa_hutang= str_replace(".", "", $sisa_hutang);
		
		$data = array('no_order' => $no_order,
					  'jml_bayar_dp' => $jml_bayar_dp,
					  'total_bayar' => $total_bayar,
					  'sisa_hutang' => $sisa_hutang,
					  'metode_bayar2' => $metode_bayar2,
					  'no_rek' => $id_akun,
					  'catatan' => $catatan,
					  'tgl_pembayaran' => $tgl_pembayaran);
		
		$this->view->datainsert=$this->Pembayaransupplier_Service->editdata($data);
   }
   
   public function detailAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_order_data   = $_GET['id'];
		$this->view->no_order_data = $no_order_data;
		
		$this->view->Pembayaransupplier_Service = $this->Pembayaransupplier_Service;
		
		$this->view->data=$this->Pembayaransupplier_Service->getDataOrderCentral($no_order_data);
		$temp_ordercentral = $this->Pembayaransupplier_Service->getDataOrderCentral($no_order_data);
		$kode_supplier = $temp_ordercentral[0]['kode_supplier'];
		$this->view->data2 = $this->Pembayaransupplier_Service->getdatasupplierid($kode_supplier);
		
		$this->view->data3=$this->Pembayaransupplier_Service->getDataDetailOrderCentral($no_order_data);
		
		$this->view->data4=$this->Pembayaransupplier_Service->getDataDetailHutang($no_order_data);
		
		$this->view->supplier=$this->Pembayaransupplier_Service->getSupplier();
		$this->view->warna=$this->Pembayaransupplier_Service->getWarna();
		$this->view->seq=$this->Pembayaransupplier_Service->getNoSeq();
		$this->view->rek=$this->Pembayaransupplier_Service->getRekening();
    }
	
	public function kirimdataedithistoryAction() { 
	
		//$this->_helper->layout->setLayout('pembayaransupplier-layout');
		$this->_helper->layout->setLayout('target-column');
		
		$no_order 		 	= '';
		$id_hutang	 	 	= '';
		$jumlah_pembayaran	= '';
		$sisa_pembayaran	= '';
		$terbayar	 		= '';
		$catat	 			= '';
		
		if(isset($_POST['no_order'])){ $no_order = $_POST['no_order'];}
		if(isset($_POST['id_hutang'])){ $id_hutang = $_POST['id_hutang'];}
		if(isset($_POST['jumlah_pembayaran'])){ $jumlah_pembayaran = $_POST['jumlah_pembayaran'];}
		if(isset($_POST['sisa_pembayaran'])){ $sisa_pembayaran = $_POST['sisa_pembayaran'];}
		if(isset($_POST['terbayar'])){ $terbayar = $_POST['terbayar'];}
		if(isset($_POST['catat'])){ $catat = $_POST['catat'];}
		
		$jumlah_pembayaran= str_replace(".", "", $jumlah_pembayaran);
		$sisa_pembayaran= str_replace(".", "", $sisa_pembayaran);
		$terbayar= str_replace(".", "", $terbayar);
		
		$data = array('no_order' => $no_order,
					  'id_hutang' => $id_hutang,
					  'jumlah_pembayaran' => $jumlah_pembayaran,
					  'sisa_pembayaran' => $sisa_pembayaran,
					  'terbayar' => $terbayar,
					  'no_rek' => $no_rek,
					  'catat' => $catat);
		
		$this->view->datainsert=$this->Pembayaransupplier_Service->editdatahistory($data);
   }
 
}