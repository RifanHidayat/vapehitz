<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Salestudio_Service.php';

class SalestudioController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Salestudio_Service = Salestudio_Service::getInstance();
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
		
        $this->_helper->layout->setLayout('salestudio-layout');
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->data = $this->Salestudio_Service->getlistsalestudio();
		$this->view->menu = $this->Salestudio_Service->getmenu();
    }
	
	public function cekdatauserAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$user_id = '';
		$password = '';
		
		if(isset($_REQUEST['user_id'])){ $user_id = $_REQUEST['user_id'];}
		if(isset($_REQUEST['password'])){ $password = $_REQUEST['password'];}
		
		$password=md5($password);
		
		$this->view->user = $this->Salestudio_Service->getDataUser($user_id,$password);
	}
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->customer=$this->Salestudio_Service->getCustomer();
		$this->view->warna=$this->Salestudio_Service->getWarna();
		$now = date('dmy');
		$kode_inv = $now;
		$this->view->seq=$this->Salestudio_Service->getNoSeq2($kode_inv);
		$this->view->rek=$this->Salestudio_Service->getRekening();
		$this->view->cash=$this->Salestudio_Service->getCash();
    }
	
	public function dataatomizerAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->data = $this->Salestudio_Service->getlistatomizer();
    }
	
	public function dataaksesorisAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->data = $this->Salestudio_Service->getlistaccessories();
    }
	
	public function datadeviceAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->data = $this->Salestudio_Service->getlistdevice();
    }
	
	public function dataliquidAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->data = $this->Salestudio_Service->getlistliquid();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('salestudio-layout');
		
		$no_invoice 	 	= '';
		$tgl_invoice	 	= '';
		$total_biaya	 	= '';
		$metode_pembayaran	= '';
		$no_rekening	 	= '';
		$jml_pembayaran 	= '';
		$uang_kembali		= '';
		$biaya_admin	 	= '';
		$kode_inv 		 	= date('dmy');
		$seq		 	 	= ''; 
		
		$kode_barang	 	= '';
		$hj_whs		 	= '';
		$discount			= '';
		$stok_studio		= '';
		$qty			 	= '';
		$sub_total		 	= '';
			
		$nama_tabel 	 	= '';
		$kode 				= '';
		$id_akun 			= '';
		$no_rek 			= '';
		$cash 				= '';
		
		if(isset($_POST['no_invoice'])){ $no_invoice = $_POST['no_invoice'];}
		if(isset($_POST['tgl_invoice'])){ $tgl_invoice = $_POST['tgl_invoice'];}
		if(isset($_POST['total_biaya'])){ $total_biaya = $_POST['total_biaya'];}
		if(isset($_POST['metode_pembayaran'])){ $metode_pembayaran = $_POST['metode_pembayaran'];}
		// if(isset($_POST['no_rekening'])){ $no_rekening = $_POST['no_rekening'];}
		if(isset($_POST['jml_pembayaran'])){ $jml_pembayaran = $_POST['jml_pembayaran'];}
		if(isset($_POST['uang_kembali'])){ $uang_kembali = $_POST['uang_kembali'];}
		if(isset($_POST['biaya_admin'])){ $biaya_admin = $_POST['biaya_admin'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['hj_whs'])){ $hj_whs = $_POST['hj_whs'];}
		if(isset($_POST['discount'])){ $discount = $_POST['discount'];}
		if(isset($_POST['stok_studio'])){ $stok_studio = $_POST['stok_studio'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['sub_total'])){ $sub_total = $_POST['sub_total'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		if(isset($_POST['no_rek'])){ $no_rek = $_POST['no_rek'];}
		if(isset($_POST['cash'])){ $cash = $_POST['cash'];}
		
		$tgl_invoice = str_replace('/', '-', $tgl_invoice);
		$tgl_invoice = date("Y-m-d H:i", strtotime($tgl_invoice));
		
		$total_biaya= str_replace(".", "", $total_biaya);
		$jml_pembayaran= str_replace(".", "", $jml_pembayaran);
		$uang_kembali= str_replace(".", "", $uang_kembali);
		$biaya_admin= str_replace(".", "", $biaya_admin);
		$hj_whs= str_replace(".", "", $hj_whs);
		$discount= str_replace(".", "", $discount);
		$stok_studio= str_replace(".", "", $stok_studio);
		$qty= str_replace(".", "", $qty);
		$sub_total= str_replace(".", "", $sub_total);

		if (($no_rek==0) || ($no_rek=="")){
			$id_akun=$cash;

		}else{
				$id_akun=$no_rek;

		}
		
		
		$data = array('no_invoice' => $no_invoice,
					  'tgl_invoice' => $tgl_invoice,
					  'total_biaya' => $total_biaya,
					  'metode_pembayaran' => $metode_pembayaran,
					  'no_rekening' => $id_akun,
					  'jml_pembayaran' => $jml_pembayaran,
					  'uang_kembali' => $uang_kembali,
					  'biaya_admin' => $biaya_admin,
					  'kode_inv' => $kode_inv,
					  'seq' => $seq,
					  'kode_barang' => $kode_barang,
					  'hj_whs' => $hj_whs,
					  'discount' => $discount,
					  'stok_studio' => $stok_studio,
					  'qty' => $qty,
					  'sub_total' => $sub_total,
					  'nama_tabel' => $nama_tabel,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Salestudio_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$no_invoice = '';
		
		if(isset($_REQUEST['no_invoice'])){ $no_invoice = $_REQUEST['no_invoice'];}
		
		$dataInput = array('no_invoice' => $no_invoice);
		$hasil = $this->Salestudio_Service->hapusData($dataInput);

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
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->data=$this->Salestudio_Service->getDatasalestudio($no_invoice_data);
		$temp_salestudio = $this->Salestudio_Service->getDatasalestudio($no_invoice_data);
		$kode_customer = $temp_salestudio[0]['kode_customer'];
		$this->view->data2 = $this->Salestudio_Service->getdatacustomerid($kode_customer);
		
		$this->view->data3=$this->Salestudio_Service->getDataDetailsalestudio($no_invoice_data);
		
		$this->view->customer=$this->Salestudio_Service->getCustomer();
		$this->view->warna=$this->Salestudio_Service->getWarna();
		$this->view->seq=$this->Salestudio_Service->getNoSeq();
		$this->view->rek=$this->Salestudio_Service->getRekening();
		$this->view->cash=$this->Salestudio_Service->getCash();
    }
	
	public function detailAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_invoice_data   = $_GET['id'];
		$this->view->no_invoice_data = $no_invoice_data;
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->data=$this->Salestudio_Service->getDatasalestudio($no_invoice_data);
		/* $temp_salestudio = $this->Salestudio_Service->getDatasalestudio($no_invoice_data);
		$kode_customer = $temp_salestudio[0]['kode_customer'];
		$this->view->data2 = $this->Salestudio_Service->getdatacustomerid($kode_customer); */
		
		$this->view->data3=$this->Salestudio_Service->getDataDetailsalestudio($no_invoice_data);
		
		$this->view->customer=$this->Salestudio_Service->getCustomer();
		$this->view->warna=$this->Salestudio_Service->getWarna();
		$this->view->seq=$this->Salestudio_Service->getNoSeq();
		$this->view->rek=$this->Salestudio_Service->getRekening();
		$this->view->cash=$this->Salestudio_Service->getCash();
    }
	
	public function printsalestudioAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_invoice_data   = $_GET['no_invoice'];
		$this->view->no_invoice_data = $no_invoice_data;
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->data=$this->Salestudio_Service->getDatasalestudio($no_invoice_data);
		/* $temp_salestudio = $this->Salestudio_Service->getDatasalestudio($no_invoice_data);
		$kode_customer = $temp_salestudio[0]['kode_customer'];
		$this->view->data2 = $this->Salestudio_Service->getdatacustomerid($kode_customer); */
		
		$this->view->data3=$this->Salestudio_Service->getDataDetailsalestudio($no_invoice_data);
		
		$this->view->customer=$this->Salestudio_Service->getCustomer();
		$this->view->warna=$this->Salestudio_Service->getWarna();
		$this->view->seq=$this->Salestudio_Service->getNoSeq();
		$this->view->rek=$this->Salestudio_Service->getRekening();
		$this->view->cash=$this->Salestudio_Service->getCash();
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('salestudio-layout');
		
		$no_invoice 	 	= '';
		$tgl_invoice	 	= '';
		$kode_customer   	= '';
		$shipment		 	= '';
		$nama_kurir		 	= '';
		$total_berat	 	= '';
		$total_biaya	 	= '';
		$diskon		 	 	= '';
		$biaya_kirim 	 	= '';
		$net_total	 	 	= '';
		$metode_penerimaan	= '';
		$jml_penerimaan 	= '';
		$metode_penerimaan2	= '';
		$jml_penerimaan2 	= '';
		$jml_bayar		 	= '';
		$sisa_bayar		 	= '';
		$nama_penerima	 	= '';
		$alamat_penerima 	= '';
		$keterangan		 	= '';
		$seq		 	 	= ''; 
		$kode_inv 		 	= date('dmy');
		
		$kode_barang	 	= '';
		$hj_whs		 	= '';
		$qty			 	= '';
		$free			 	= '';
		$sub_total		 	= '';
		$sub_total_berat 	= '';
			
		$nama_tabel 	 	= '';
		$on_hand 		 	= '';
		$hj_whs_baru  	= '';
		$kode 				= '';
		
		if(isset($_POST['no_invoice'])){ $no_invoice = $_POST['no_invoice'];}
		if(isset($_POST['tgl_invoice'])){ $tgl_invoice = $_POST['tgl_invoice'];}
		if(isset($_POST['kode_customer2'])){ $kode_customer = $_POST['kode_customer2'];}
		if(isset($_POST['shipment'])){ $shipment = $_POST['shipment'];}
		if(isset($_POST['nama_kurir'])){ $nama_kurir = $_POST['nama_kurir'];}
		if(isset($_POST['total_berat'])){ $total_berat = $_POST['total_berat'];}
		if(isset($_POST['total_biaya'])){ $total_biaya = $_POST['total_biaya'];}
		if(isset($_POST['diskon'])){ $diskon = $_POST['diskon'];}
		if(isset($_POST['biaya_kirim'])){ $biaya_kirim = $_POST['biaya_kirim'];}
		if(isset($_POST['net_total'])){ $net_total = $_POST['net_total'];}
		if(isset($_POST['metode_penerimaan'])){ $metode_penerimaan = $_POST['metode_penerimaan'];}
		if(isset($_POST['jml_penerimaan'])){ $jml_penerimaan = $_POST['jml_penerimaan'];}
		if(isset($_POST['metode_penerimaan2'])){ $metode_penerimaan2 = $_POST['metode_penerimaan2'];}
		if(isset($_POST['jml_penerimaan2'])){ $jml_penerimaan2 = $_POST['jml_penerimaan2'];}
		if(isset($_POST['jml_bayar'])){ $jml_bayar = $_POST['jml_bayar'];}
		if(isset($_POST['sisa_bayar'])){ $sisa_bayar = $_POST['sisa_bayar'];}
		if(isset($_POST['nama_penerima'])){ $nama_penerima = $_POST['nama_penerima'];}
		if(isset($_POST['alamat_penerima'])){ $alamat_penerima = $_POST['alamat_penerima'];}
		if(isset($_POST['keterangan'])){ $keterangan = $_POST['keterangan'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['hj_whs'])){ $hj_whs = $_POST['hj_whs'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['free'])){ $free = $_POST['free'];}
		if(isset($_POST['sub_total'])){ $sub_total = $_POST['sub_total'];}
		if(isset($_POST['sub_total_berat'])){ $sub_total_berat = $_POST['sub_total_berat'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['on_hand'])){ $on_hand = $_POST['on_hand'];}
		if(isset($_POST['hj_whs_baru'])){ $hj_whs_baru = $_POST['hj_whs_baru'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$total_berat= str_replace(".", "", $total_berat);
		$total_biaya= str_replace(".", "", $total_biaya);
		$biaya_kirim= str_replace(".", "", $biaya_kirim);
		$diskon= str_replace(".", "", $diskon);
		$net_total= str_replace(".", "", $net_total);
		$jml_penerimaan= str_replace(".", "", $jml_penerimaan);
		$jml_penerimaan2= str_replace(".", "", $jml_penerimaan2);
		$jml_bayar= str_replace(".", "", $jml_bayar);
		$sisa_bayar= str_replace(".", "", $sisa_bayar);
		$hj_whs= str_replace(".", "", $hj_whs);
		$qty= str_replace(".", "", $qty);
		$free= str_replace(".", "", $free);
		$sub_total= str_replace(".", "", $sub_total);
		$sub_total_berat= str_replace(".", "", $sub_total_berat);
		$on_hand= str_replace(".", "", $on_hand);
		
		$data = array('no_invoice' => $no_invoice,
					  'tgl_invoice' => $tgl_invoice,
					  'kode_customer' => $kode_customer,
					  'shipment' => $shipment,
					  'nama_kurir' => $nama_kurir,
					  'total_berat' => $total_berat,
					  'total_biaya' => $total_biaya,
					  'diskon' => $diskon,
					  'biaya_kirim' => $biaya_kirim,
					  'net_total' => $net_total,
					  'metode_penerimaan' => $metode_penerimaan,
					  'jml_penerimaan' => $jml_penerimaan,
					  'metode_penerimaan2' => $metode_penerimaan2,
					  'jml_penerimaan2' => $jml_penerimaan2,
					  'jml_bayar' => $jml_bayar,
					  'sisa_bayar' => $sisa_bayar,
					  'nama_penerima' => $nama_penerima,
					  'alamat_penerima' => $alamat_penerima,
					  'keterangan' => $keterangan,
					  'seq' => $seq,
					  'kode_inv' => $kode_inv,
					  'kode_barang' => $kode_barang,
					  'hj_whs' => $hj_whs,
					  'qty' => $qty,
					  'free' => $free,
					  'sub_total' => $sub_total,
					  'sub_total_berat' => $sub_total_berat,
					  'nama_tabel' => $nama_tabel,
					  'on_hand' => $on_hand,
					  'hj_whs_baru' => $hj_whs_baru,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Salestudio_Service->editdata($data);
   }
   
   public function approvalAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$no_invoice_data   = $_GET['id'];
		$this->view->no_invoice_data = $no_invoice_data;
		
		$this->view->Salestudio_Service = $this->Salestudio_Service;
		
		$this->view->data=$this->Salestudio_Service->getDatasalestudio($no_invoice_data);
		$temp_salestudio = $this->Salestudio_Service->getDatasalestudio($no_invoice_data);
		$kode_customer = $temp_salestudio[0]['kode_customer'];
		$this->view->data2 = $this->Salestudio_Service->getdatacustomerid($kode_customer);
		
		$this->view->data3=$this->Salestudio_Service->getDataDetailsalestudio($no_invoice_data);
		
		$this->view->customer=$this->Salestudio_Service->getCustomer();
		$this->view->warna=$this->Salestudio_Service->getWarna();
		$this->view->seq=$this->Salestudio_Service->getNoSeq();
		$this->view->rek=$this->Salestudio_Service->getRekening();
		$this->view->cash=$this->Salestudio_Service->getCash();
    }
	
	public function kirimdataapproveAction() { 
	
		$this->_helper->layout->setLayout('salestudio-layout');
		
		$no_invoice 	 	= '';
		$tgl_invoice	 	= '';
		$kode_customer   	= '';
		$shipment		 	= '';
		$nama_kurir		 	= '';
		$total_berat	 	= '';
		$total_biaya	 	= '';
		$diskon		 	 	= '';
		$biaya_kirim 	 	= '';
		$net_total	 	 	= '';
		$metode_penerimaan	= '';
		$jml_penerimaan 	= '';
		$metode_penerimaan2	= '';
		$jml_penerimaan2 	= '';
		$jml_bayar		 	= '';
		$sisa_bayar		 	= '';
		$nama_penerima	 	= '';
		$alamat_penerima 	= '';
		$keterangan		 	= '';
		$seq		 	 	= ''; 
		$kode_inv 		 	= date('dmy');
		
		$kode_barang	 	= '';
		$hj_whs		 	= '';
		$qty			 	= '';
		$free			 	= '';
		$sub_total		 	= '';
		$sub_total_berat 	= '';
		$stok_gudang		= '';
			
		$nama_tabel 	 	= '';
		$on_hand 		 	= '';
		$hj_whs_baru  	= '';
		$kode 				= '';
		
		if(isset($_POST['no_invoice'])){ $no_invoice = $_POST['no_invoice'];}
		if(isset($_POST['tgl_invoice'])){ $tgl_invoice = $_POST['tgl_invoice'];}
		if(isset($_POST['kode_customer2'])){ $kode_customer = $_POST['kode_customer2'];}
		if(isset($_POST['shipment'])){ $shipment = $_POST['shipment'];}
		if(isset($_POST['nama_kurir'])){ $nama_kurir = $_POST['nama_kurir'];}
		if(isset($_POST['total_berat'])){ $total_berat = $_POST['total_berat'];}
		if(isset($_POST['total_biaya'])){ $total_biaya = $_POST['total_biaya'];}
		if(isset($_POST['diskon'])){ $diskon = $_POST['diskon'];}
		if(isset($_POST['biaya_kirim'])){ $biaya_kirim = $_POST['biaya_kirim'];}
		if(isset($_POST['net_total'])){ $net_total = $_POST['net_total'];}
		if(isset($_POST['metode_penerimaan'])){ $metode_penerimaan = $_POST['metode_penerimaan'];}
		if(isset($_POST['jml_penerimaan'])){ $jml_penerimaan = $_POST['jml_penerimaan'];}
		if(isset($_POST['metode_penerimaan2'])){ $metode_penerimaan2 = $_POST['metode_penerimaan2'];}
		if(isset($_POST['jml_penerimaan2'])){ $jml_penerimaan2 = $_POST['jml_penerimaan2'];}
		if(isset($_POST['jml_bayar'])){ $jml_bayar = $_POST['jml_bayar'];}
		if(isset($_POST['sisa_bayar'])){ $sisa_bayar = $_POST['sisa_bayar'];}
		if(isset($_POST['nama_penerima'])){ $nama_penerima = $_POST['nama_penerima'];}
		if(isset($_POST['alamat_penerima'])){ $alamat_penerima = $_POST['alamat_penerima'];}
		if(isset($_POST['keterangan'])){ $keterangan = $_POST['keterangan'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['hj_whs'])){ $hj_whs = $_POST['hj_whs'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['free'])){ $free = $_POST['free'];}
		if(isset($_POST['sub_total'])){ $sub_total = $_POST['sub_total'];}
		if(isset($_POST['sub_total_berat'])){ $sub_total_berat = $_POST['sub_total_berat'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['on_hand'])){ $on_hand = $_POST['on_hand'];}
		if(isset($_POST['hj_whs_baru'])){ $hj_whs_baru = $_POST['hj_whs_baru'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$total_berat= str_replace(".", "", $total_berat);
		$total_biaya= str_replace(".", "", $total_biaya);
		$biaya_kirim= str_replace(".", "", $biaya_kirim);
		$diskon= str_replace(".", "", $diskon);
		$net_total= str_replace(".", "", $net_total);
		$jml_penerimaan= str_replace(".", "", $jml_penerimaan);
		$jml_penerimaan2= str_replace(".", "", $jml_penerimaan2);
		$jml_bayar= str_replace(".", "", $jml_bayar);
		$sisa_bayar= str_replace(".", "", $sisa_bayar);
		$hj_whs= str_replace(".", "", $hj_whs);
		$qty= str_replace(".", "", $qty);
		$free= str_replace(".", "", $free);
		$sub_total= str_replace(".", "", $sub_total);
		$sub_total_berat= str_replace(".", "", $sub_total_berat);
		$on_hand= str_replace(".", "", $on_hand);
		$stok_gudang= str_replace(".", "", $stok_gudang);
		
		$data = array('no_invoice' => $no_invoice,
					  'tgl_invoice' => $tgl_invoice,
					  'kode_customer' => $kode_customer,
					  'shipment' => $shipment,
					  'nama_kurir' => $nama_kurir,
					  'total_berat' => $total_berat,
					  'total_biaya' => $total_biaya,
					  'diskon' => $diskon,
					  'biaya_kirim' => $biaya_kirim,
					  'net_total' => $net_total,
					  'metode_penerimaan' => $metode_penerimaan,
					  'jml_penerimaan' => $jml_penerimaan,
					  'metode_penerimaan2' => $metode_penerimaan2,
					  'jml_penerimaan2' => $jml_penerimaan2,
					  'jml_bayar' => $jml_bayar,
					  'sisa_bayar' => $sisa_bayar,
					  'nama_penerima' => $nama_penerima,
					  'alamat_penerima' => $alamat_penerima,
					  'keterangan' => $keterangan,
					  'seq' => $seq,
					  'kode_inv' => $kode_inv,
					  'kode_barang' => $kode_barang,
					  'hj_whs' => $hj_whs,
					  'qty' => $qty,
					  'free' => $free,
					  'sub_total' => $sub_total,
					  'sub_total_berat' => $sub_total_berat,
					  'stok_gudang' => $stok_gudang,
					  'nama_tabel' => $nama_tabel,
					  'on_hand' => $on_hand,
					  'hj_whs_baru' => $hj_whs_baru,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Salestudio_Service->approvedata($data);
   }
   
   public function kirimdataapprove2Action() { 
	
		$this->_helper->layout->setLayout('salestudio-layout');
		
		$no_invoice 	 	= '';
		$tgl_invoice	 	= '';
		$kode_customer   	= '';
		$shipment		 	= '';
		$nama_kurir		 	= '';
		$total_berat	 	= '';
		$total_biaya	 	= '';
		$diskon		 	 	= '';
		$biaya_kirim 	 	= '';
		$net_total	 	 	= '';
		$metode_penerimaan	= '';
		$jml_penerimaan 	= '';
		$metode_penerimaan2	= '';
		$jml_penerimaan2 	= '';
		$jml_bayar		 	= '';
		$sisa_bayar		 	= '';
		$nama_penerima	 	= '';
		$alamat_penerima 	= '';
		$keterangan		 	= '';
		$seq		 	 	= ''; 
		$kode_inv 		 	= date('dmy');
		
		$kode_barang	 	= '';
		$hj_whs		 	= '';
		$qty			 	= '';
		$free			 	= '';
		$sub_total		 	= '';
		$sub_total_berat 	= '';
		$stok_gudang		= '';
			
		$nama_tabel 	 	= '';
		$on_hand 		 	= '';
		$hj_whs_baru  	= '';
		$kode 				= '';
		
		if(isset($_POST['no_invoice'])){ $no_invoice = $_POST['no_invoice'];}
		if(isset($_POST['tgl_invoice'])){ $tgl_invoice = $_POST['tgl_invoice'];}
		if(isset($_POST['kode_customer2'])){ $kode_customer = $_POST['kode_customer2'];}
		if(isset($_POST['shipment'])){ $shipment = $_POST['shipment'];}
		if(isset($_POST['nama_kurir'])){ $nama_kurir = $_POST['nama_kurir'];}
		if(isset($_POST['total_berat'])){ $total_berat = $_POST['total_berat'];}
		if(isset($_POST['total_biaya'])){ $total_biaya = $_POST['total_biaya'];}
		if(isset($_POST['diskon'])){ $diskon = $_POST['diskon'];}
		if(isset($_POST['biaya_kirim'])){ $biaya_kirim = $_POST['biaya_kirim'];}
		if(isset($_POST['net_total'])){ $net_total = $_POST['net_total'];}
		if(isset($_POST['metode_penerimaan'])){ $metode_penerimaan = $_POST['metode_penerimaan'];}
		if(isset($_POST['jml_penerimaan'])){ $jml_penerimaan = $_POST['jml_penerimaan'];}
		if(isset($_POST['metode_penerimaan2'])){ $metode_penerimaan2 = $_POST['metode_penerimaan2'];}
		if(isset($_POST['jml_penerimaan2'])){ $jml_penerimaan2 = $_POST['jml_penerimaan2'];}
		if(isset($_POST['jml_bayar'])){ $jml_bayar = $_POST['jml_bayar'];}
		if(isset($_POST['sisa_bayar'])){ $sisa_bayar = $_POST['sisa_bayar'];}
		if(isset($_POST['nama_penerima'])){ $nama_penerima = $_POST['nama_penerima'];}
		if(isset($_POST['alamat_penerima'])){ $alamat_penerima = $_POST['alamat_penerima'];}
		if(isset($_POST['keterangan'])){ $keterangan = $_POST['keterangan'];}
		if(isset($_POST['seq'])){ $seq = $_POST['seq'];}
		
		if(isset($_POST['kode_barang'])){ $kode_barang = $_POST['kode_barang'];}
		if(isset($_POST['hj_whs'])){ $hj_whs = $_POST['hj_whs'];}
		if(isset($_POST['qty'])){ $qty = $_POST['qty'];}
		if(isset($_POST['free'])){ $free = $_POST['free'];}
		if(isset($_POST['sub_total'])){ $sub_total = $_POST['sub_total'];}
		if(isset($_POST['sub_total_berat'])){ $sub_total_berat = $_POST['sub_total_berat'];}
		if(isset($_POST['stok_gudang'])){ $stok_gudang = $_POST['stok_gudang'];}
		
		if(isset($_POST['nama_tabel'])){ $nama_tabel = $_POST['nama_tabel'];}
		if(isset($_POST['on_hand'])){ $on_hand = $_POST['on_hand'];}
		if(isset($_POST['hj_whs_baru'])){ $hj_whs_baru = $_POST['hj_whs_baru'];}
		if(isset($_POST['kode'])){ $kode = $_POST['kode'];}
		
		$total_berat= str_replace(".", "", $total_berat);
		$total_biaya= str_replace(".", "", $total_biaya);
		$biaya_kirim= str_replace(".", "", $biaya_kirim);
		$diskon= str_replace(".", "", $diskon);
		$net_total= str_replace(".", "", $net_total);
		$jml_penerimaan= str_replace(".", "", $jml_penerimaan);
		$jml_penerimaan2= str_replace(".", "", $jml_penerimaan2);
		$jml_bayar= str_replace(".", "", $jml_bayar);
		$sisa_bayar= str_replace(".", "", $sisa_bayar);
		$hj_whs= str_replace(".", "", $hj_whs);
		$qty= str_replace(".", "", $qty);
		$free= str_replace(".", "", $free);
		$sub_total= str_replace(".", "", $sub_total);
		$sub_total_berat= str_replace(".", "", $sub_total_berat);
		$on_hand= str_replace(".", "", $on_hand);
		$stok_gudang= str_replace(".", "", $stok_gudang);
		
		$data = array('no_invoice' => $no_invoice,
					  'tgl_invoice' => $tgl_invoice,
					  'kode_customer' => $kode_customer,
					  'shipment' => $shipment,
					  'nama_kurir' => $nama_kurir,
					  'total_berat' => $total_berat,
					  'total_biaya' => $total_biaya,
					  'diskon' => $diskon,
					  'biaya_kirim' => $biaya_kirim,
					  'net_total' => $net_total,
					  'metode_penerimaan' => $metode_penerimaan,
					  'jml_penerimaan' => $jml_penerimaan,
					  'metode_penerimaan2' => $metode_penerimaan2,
					  'jml_penerimaan2' => $jml_penerimaan2,
					  'jml_bayar' => $jml_bayar,
					  'sisa_bayar' => $sisa_bayar,
					  'nama_penerima' => $nama_penerima,
					  'alamat_penerima' => $alamat_penerima,
					  'keterangan' => $keterangan,
					  'seq' => $seq,
					  'kode_inv' => $kode_inv,
					  'kode_barang' => $kode_barang,
					  'hj_whs' => $hj_whs,
					  'qty' => $qty,
					  'free' => $free,
					  'sub_total' => $sub_total,
					  'sub_total_berat' => $sub_total_berat,
					  'stok_gudang' => $stok_gudang,
					  'nama_tabel' => $nama_tabel,
					  'on_hand' => $on_hand,
					  'hj_whs_baru' => $hj_whs_baru,
					  'kode' => $kode);
		
		$this->view->datainsert=$this->Salestudio_Service->approvedata2($data);
   }
 
}