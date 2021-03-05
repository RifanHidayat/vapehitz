<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Retursaleretail_Service.php';

class RetursaleretailController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Retursaleretail_Service = Retursaleretail_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('retursaleretail-layout');
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->data = $this->Retursaleretail_Service->getlistsaleretail();
		$this->view->menu = $this->Retursaleretail_Service->getmenu();
    }
	
	public function historyAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->data = $this->Retursaleretail_Service->getlistReturPenjualan();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->supplier=$this->Retursaleretail_Service->getCustomer();
		$this->view->warna=$this->Retursaleretail_Service->getWarna();
		$this->view->seq=$this->Retursaleretail_Service->getNoSeq();
		$this->view->rek=$this->Retursaleretail_Service->getRekening();
		$this->view->cash=$this->Retursaleretail_Service->getCash();
    }
	
	public function dataatomizerAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->data = $this->Retursaleretail_Service->getlistatomizer();
    }
	
	public function dataaksesorisAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->data = $this->Retursaleretail_Service->getlistaccessories();
    }
	
	public function datadeviceAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->data = $this->Retursaleretail_Service->getlistdevice();
    }
	
	public function databarangAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$no_invoice_data = '';
		
		if(isset($_REQUEST['no_invoice'])){ $no_invoice_data = $_REQUEST['no_invoice'];}
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->data = $this->Retursaleretail_Service->getDataDetailsaleretail($no_invoice_data);
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('retursaleretail-layout');
		
		$kode_customer 	 = '';
		$no_invoice 	 = '';
		$tgl_invoice	 = '';
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
		
		if(isset($_POST['kode_customer2'])){ $kode_customer = $_POST['kode_customer2'];}
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
		
		$data = array('kode_customer' => $kode_customer,
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
		$this->view->datainsert=$this->Retursaleretail_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$no_invoice = '';
		
		if(isset($_REQUEST['no_invoice'])){ $no_invoice = $_REQUEST['no_invoice'];}
		
		$dataInput = array('no_invoice' => $no_invoice);
		$hasil = $this->Retursaleretail_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_invoice_data   = $_GET['id'];
		$this->view->no_invoice_data = $no_invoice_data;
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->data=$this->Retursaleretail_Service->getDatasaleretail($no_invoice_data);
		$temp_ordercentral = $this->Retursaleretail_Service->getDatasaleretail($no_invoice_data);
		//$kode_customer = $temp_ordercentral[0]['kode_customer'];
		//$this->view->data2 = $this->Retursaleretail_Service->getdatacustomerid($kode_customer);
		
		$this->view->data3=$this->Retursaleretail_Service->getDataDetailsaleretail($no_invoice_data);
		
		$this->view->data4=$this->Retursaleretail_Service->getDataDetailHutang($no_invoice_data);
		
		$this->view->supplier=$this->Retursaleretail_Service->getCustomer();
		$this->view->warna=$this->Retursaleretail_Service->getWarna();
		$this->view->seq=$this->Retursaleretail_Service->getNoSeq();
		$this->view->rek=$this->Retursaleretail_Service->getRekening();
		$this->view->cash=$this->Retursaleretail_Service->getCash();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('retursaleretail-layout');
		
		$no_invoice 	= '';
		$kode_subsale 	= '';
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
		$harga_jual = '';
		$alasan = '';
		$nama_tabel = '';
		$kode = '';

		$cash = '';
		$no_rek = '';
		$metode_bayar = '';
		$id_akun = '';
		
		
		if(isset($_POST['no_invoice'])){ $no_invoice = $_POST['no_invoice'];}
		if(isset($_POST['kode_subsale'])){ $kode_subsale = $_POST['kode_subsale'];}
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
		if(isset($_POST['harga_jual'])){ $harga_jual = $_POST['harga_jual'];}
		if(isset($_POST['alasan'])){ $alasan = $_POST['alasan'];}
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}

		if(isset($_POST['metode_bayar'])){ $metode_bayar = $_POST['metode_bayar'];}
		if(isset($_POST['cash'])){ $cash = $_POST['cash'];}
		if(isset($_POST['no_rek'])){ $no_rek = $_POST['no_rek'];}
		
		$sub_total= str_replace(".", "", $sub_total);
		$total_baru= str_replace(".", "", $total_baru);
		$net_total_baru= str_replace(".", "", $net_total_baru);
		$nominal_retur= str_replace(".", "", $nominal_retur);
		$total_nominal_retur= str_replace(".", "", $total_nominal_retur);
		$harga_jual= str_replace(".", "", $harga_jual);
		
		$tgl_retur = str_replace('/', '-', $tgl_retur);
		$tgl_retur = date("Y-m-d H:i", strtotime($tgl_retur));
		
		if (($no_rek==0) || ($no_rek=="")){
			$id_akun=$cash;

		}else{
				$id_akun=$no_rek;

		}
		
		$data = array('no_invoice' => $no_invoice,
					  'kode_subsale' => $kode_subsale,
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
					  'harga_jual' => $harga_jual,
					  'alasan' => $alasan,
					  'nama_tabel' => $nama_tabel,
					  'metode_bayar'=>$metode_bayar,
					  'id_akun'=> $id_akun,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Retursaleretail_Service->editdata($data);
   }
   
   public function detailAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_invoice_data   = $_GET['id'];
		$this->view->no_invoice_data = $no_invoice_data;
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->data=$this->Retursaleretail_Service->getDatasaleretail($no_invoice_data);
		$temp_saleretail = $this->Retursaleretail_Service->getDatasaleretail($no_invoice_data);
		//$kode_customer = $temp_saleretail[0]['kode_customer'];
		//$this->view->data2 = $this->Retursaleretail_Service->getdatacustomerid($kode_customer);
		
		$this->view->data3=$this->Retursaleretail_Service->getDataDetailsaleretail($no_invoice_data);
		
		$this->view->data4=$this->Retursaleretail_Service->getDataDetailHutang($no_invoice_data);
		
		$this->view->supplier=$this->Retursaleretail_Service->getCustomer();
		$this->view->warna=$this->Retursaleretail_Service->getWarna();
		$this->view->seq=$this->Retursaleretail_Service->getNoSeq();
		$this->view->rek=$this->Retursaleretail_Service->getRekening();
		$this->view->cash=$this->Retursaleretail_Service->getCash();
    }
	
	public function detailreturAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_retur_data   = $_GET['id'];
		$this->view->no_retur_data = $no_retur_data;
		
		$this->view->Retursaleretail_Service = $this->Retursaleretail_Service;
		
		$this->view->data=$this->Retursaleretail_Service->getDataReturPenjualan($no_retur_data);
		$temp_saleretail = $this->Retursaleretail_Service->getDataReturPenjualan($no_retur_data);
		//$kode_customer = $temp_saleretail[0]['kode_customer'];
		//$this->view->data2 = $this->Retursaleretail_Service->getdatacustomerid($kode_customer);
		
		$this->view->data3=$this->Retursaleretail_Service->getDataDetailReturPenjualan($no_retur_data);
		
		$this->view->supplier=$this->Retursaleretail_Service->getCustomer();
		$this->view->warna=$this->Retursaleretail_Service->getWarna();
		$this->view->seq=$this->Retursaleretail_Service->getNoSeq();
		$this->view->rek=$this->Retursaleretail_Service->getRekening();
		$this->view->cash=$this->Retursaleretail_Service->getCash();
    }
 
}