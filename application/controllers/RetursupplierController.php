<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Retursupplier_Service.php';

class RetursupplierController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Retursupplier_Service = Retursupplier_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('retursupplier-layout');
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->data = $this->Retursupplier_Service->getlistOrderCentral();
		$this->view->menu = $this->Retursupplier_Service->getmenu();
		$this->view->rek=$this->Retursupplier_Service->getRekening();
		$this->view->cash=$this->Retursupplier_Service->getCash();
    }
	
	public function historyAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->data = $this->Retursupplier_Service->getlistReturPembelian();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->supplier=$this->Retursupplier_Service->getSupplier();
		$this->view->warna=$this->Retursupplier_Service->getWarna();
		$this->view->seq=$this->Retursupplier_Service->getNoSeq();
		$this->view->rek=$this->Retursupplier_Service->getRekening();
		$this->view->cash=$this->Retursupplier_Service->getCash();
    }
	
	public function dataatomizerAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->data = $this->Retursupplier_Service->getlistatomizer();
    }
	
	public function dataaksesorisAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->data = $this->Retursupplier_Service->getlistaccessories();
    }
	
	public function datadeviceAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->data = $this->Retursupplier_Service->getlistdevice();
    }
	
	public function databarangAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$no_order_data = '';
		
		if(isset($_REQUEST['no_order'])){ $no_order_data = $_REQUEST['no_order'];}
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->data = $this->Retursupplier_Service->getDataDetailOrderCentral($no_order_data);
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('retursupplier-layout');
		
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
		$this->view->datainsert=$this->Retursupplier_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$no_order = '';
		
		if(isset($_REQUEST['no_order'])){ $no_order = $_REQUEST['no_order'];}
		
		$dataInput = array('no_order' => $no_order);
		$hasil = $this->Retursupplier_Service->hapusData($dataInput);

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
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->data=$this->Retursupplier_Service->getDataOrderCentral($no_order_data);
		$temp_ordercentral = $this->Retursupplier_Service->getDataOrderCentral($no_order_data);
		$kode_supplier = $temp_ordercentral[0]['kode_supplier'];
		$this->view->data2 = $this->Retursupplier_Service->getdatasupplierid($kode_supplier);
		
		$this->view->data3=$this->Retursupplier_Service->getDataDetailOrderCentral($no_order_data);
		
		$this->view->data4=$this->Retursupplier_Service->getDataDetailHutang($no_order_data);
		
		$this->view->supplier=$this->Retursupplier_Service->getSupplier();
		$this->view->warna=$this->Retursupplier_Service->getWarna();
		$this->view->seq=$this->Retursupplier_Service->getNoSeq();
	
		$this->view->rek=$this->Retursupplier_Service->getRekening();
		$this->view->cash=$this->Retursupplier_Service->getCash();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('retursupplier-layout');
		
		$no_order 		= '';
		$kode_suborder 	= '';
		$no_retur 		= '';
		$tgl_retur 		= '';
		$stok_gudang	= '';
		$qty	 		= '';
		$sub_total		= '';
		$total_baru	 	= '';
		$net_total_baru	= '';
		$qty_retur		= '';
		$nominal_retur	= '';
		$total_qty_retur = '';
		$total_nominal_retur = '';
		$seq = '';
		$kode_barang = '';
		$harga_beli = '';
		$alasan = '';
		$nama_tabel = '';
		$kode = '';
		$sisa_bayar = '';
		$sisa_bayar = '';

		$cash = '';
		$no_rek = '';
		$metode_bayar = '';
		$id_akun = '';
		
		if(isset($_POST['no_order'])){ $no_order = $_POST['no_order'];}
		if(isset($_POST['kode_suborder'])){ $kode_suborder = $_POST['kode_suborder'];}
		if(isset($_POST['no_retur'])){ $no_retur = $_POST['no_retur'];}
		if(isset($_POST['tgl_retur'])){ $tgl_retur = $_POST['tgl_retur'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['sub_total'])){ $sub_total = $_POST['sub_total'];}
		if(isset($_POST['total_baru'])){ $total_baru = $_POST['total_baru'];}
		if(isset($_POST['net_total_baru'])){ $net_total_baru = $_POST['net_total_baru'];}
		if(isset($_POST['qty_retur'])){ $qty_retur = $_POST['qty_retur'];}
		if(isset($_POST['nominal_retur'])){ $nominal_retur = $_POST['nominal_retur'];}
		if(isset($_POST['total_qty_retur'])){ $total_qty_retur = $_POST['total_qty_retur'];}
		if(isset($_POST['total_nominal_retur'])){ $total_nominal_retur = $_POST['total_nominal_retur'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['harga_beli'])){ $harga_beli = $_POST['harga_beli'];}
		if(isset($_POST['alasan'])){ $alasan = $_POST['alasan'];}
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		if(isset($_POST['sisa_bayar'])){ $sisa_bayar = $_POST['sisa_bayar'];}
		if(isset($_POST['sisa_bayar'])){ $sisa_bayar = $_POST['sisa_bayar'];}

		if(isset($_POST['metode_bayar'])){ $metode_bayar = $_POST['metode_bayar'];}
		if(isset($_POST['cash'])){ $cash = $_POST['cash'];}
		if(isset($_POST['no_rek'])){ $no_rek = $_POST['no_rek'];}
		
		$tgl_retur = str_replace('/', '-', $tgl_retur);
		$tgl_retur = date("Y-m-d H:i", strtotime($tgl_retur));
		
		$sub_total= str_replace(".", "", $sub_total);
		$total_baru= str_replace(".", "", $total_baru);
		$net_total_baru= str_replace(".", "", $net_total_baru);
		$nominal_retur= str_replace(".", "", $nominal_retur);
		$total_nominal_retur= str_replace(".", "", $total_nominal_retur);
		$harga_beli= str_replace(".", "", $harga_beli);
		$sisa_bayar= str_replace(".", "", $sisa_bayar);
		
		$selisih = $sisa_bayar - $total_nominal_retur;
		if (($no_rek==0) || ($no_rek=="")){
			$id_akun=$cash;

		}else{
				$id_akun=$no_rek;

		}
		
		
		$data = array('no_order' => $no_order,
					  'kode_suborder' => $kode_suborder,
					  'no_retur' => $no_retur,
					  'tgl_retur' => $tgl_retur,
					  'stok_gudang' => $stok_gudang,
					  'qty' => $qty,
					  'sub_total' => $sub_total,
					  'total_baru' => $total_baru,
					  'net_total_baru' => $net_total_baru,
					  'qty_retur' => $qty_retur,
					  'nominal_retur' => $nominal_retur,
					  'total_qty_retur' => $total_qty_retur,
					  'total_nominal_retur' => $total_nominal_retur,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'harga_beli' => $harga_beli,
					  'alasan' => $alasan,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode,
					  'metode_bayar'=>$metode_bayar,
					  'id_akun'=> $id_akun,
					  'selisih' => $selisih);
		
		$this->view->datainsert=$this->Retursupplier_Service->editdata($data);
   }
   
   public function detailAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_order_data   = $_GET['id'];
		$this->view->no_order_data = $no_order_data;
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->data=$this->Retursupplier_Service->getDataOrderCentral($no_order_data);
		$temp_ordercentral = $this->Retursupplier_Service->getDataOrderCentral($no_order_data);
		$kode_supplier = $temp_ordercentral[0]['kode_supplier'];
		$this->view->data2 = $this->Retursupplier_Service->getdatasupplierid($kode_supplier);
		
		$this->view->data3=$this->Retursupplier_Service->getDataDetailOrderCentral($no_order_data);
		
		$this->view->data4=$this->Retursupplier_Service->getDataDetailHutang($no_order_data);
		
		$this->view->supplier=$this->Retursupplier_Service->getSupplier();
		$this->view->warna=$this->Retursupplier_Service->getWarna();
		$this->view->seq=$this->Retursupplier_Service->getNoSeq();
		$this->view->rek=$this->Retursupplier_Service->getRekening();
    }
	
	public function detailreturAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_retur_data   = $_GET['id'];
		$this->view->no_retur_data = $no_retur_data;
		
		$this->view->Retursupplier_Service = $this->Retursupplier_Service;
		
		$this->view->data=$this->Retursupplier_Service->getDataReturPembelian($no_retur_data);
		$temp_ordercentral = $this->Retursupplier_Service->getDataReturPembelian($no_retur_data);
		$kode_supplier = $temp_ordercentral[0]['kode_supplier'];
		$this->view->data2 = $this->Retursupplier_Service->getdatasupplierid($kode_supplier);
		
		$this->view->data3=$this->Retursupplier_Service->getDataDetailReturPembelian($no_retur_data);
		
		$this->view->supplier=$this->Retursupplier_Service->getSupplier();
		$this->view->warna=$this->Retursupplier_Service->getWarna();
		$this->view->seq=$this->Retursupplier_Service->getNoSeq();
		$this->view->rek=$this->Retursupplier_Service->getRekening();
    }
 
}