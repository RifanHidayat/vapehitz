<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Ordercentral_Service.php';

class OrdercentralController extends Zend_Controller_Action
{

	public function init()
	{
		$registry = Zend_Registry::getInstance();
		$this->auth = Zend_Auth::getInstance();
		$this->Home_Service = Home_Service::getInstance();
		$this->Ordercentral_Service = Ordercentral_Service::getInstance();
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$sessionlogin->setExpirationSeconds(9000);
		$this->view->email = $sessionlogin->email;
		$this->view->nama = $sessionlogin->nama;
		$this->view->active = $sessionlogin->active;
		$this->view->permission = $sessionlogin->permission;
	}

	public function indexAction()
	{
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;

		$this->_helper->layout->setLayout('ordercentral-layout');
		$this->view->Ordercentral_Service = $this->Ordercentral_Service;
		$this->view->data = $this->Ordercentral_Service->getlistOrderCentral();
		$this->view->menu = $this->Ordercentral_Service->getmenu();
		$this->view->rek = $this->Ordercentral_Service->getRekening();
		$this->view->cash = $this->Ordercentral_Service->getCash();
	}

	public function tambahAction()
	{
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		$this->_helper->layout->setLayout('target-column');
		$this->view->Ordercentral_Service = $this->Ordercentral_Service;
		$this->view->supplier = $this->Ordercentral_Service->getSupplier();
		$this->view->warna = $this->Ordercentral_Service->getWarna();
		$this->view->seq = $this->Ordercentral_Service->getNoSeq();
		$this->view->rek = $this->Ordercentral_Service->getRekening();
		$this->view->cash = $this->Ordercentral_Service->getCash();

		// $this->view->customer = $this->Ordercentral_Service->getCustomer();
		$now = date('dmy');
		$kode_inv = $now;
		// $this->view->seq = $this->Ordercentral_Service->getNoSeq2($kode_inv);
		$this->view->liquids = $this->Ordercentral_Service->getlistliquid();
		$this->view->devices = $this->Ordercentral_Service->getlistdevice();
		$this->view->accessories = $this->Ordercentral_Service->getlistaccessories();
		$this->view->atomizers = $this->Ordercentral_Service->getlistatomizer();
	}

	public function tambahdataAction()
	{
		$this->_helper->layout->setLayout('target-column');
		$this->view->Ordercentral_Service = $this->Ordercentral_Service;
		$this->view->supplier = $this->Ordercentral_Service->getSupplier();
		$this->view->warna = $this->Ordercentral_Service->getWarna();
		$this->view->seq = $this->Ordercentral_Service->getNoSeq();
		$this->view->rek = $this->Ordercentral_Service->getRekening();
		$this->view->cash = $this->Ordercentral_Service->getCash();
	}

	public function dataatomizerAction()
	{
		$this->_helper->layout->setLayout('target-column');

		$this->view->Ordercentral_Service = $this->Ordercentral_Service;

		$this->view->data = $this->Ordercentral_Service->getlistatomizer();
		$this->view->rek = $this->Ordercentral_Service->getRekening();
		$this->view->cash = $this->Ordercentral_Service->getCash();
	}

	public function dataaksesorisAction()
	{
		$this->_helper->layout->setLayout('target-column');

		$this->view->Ordercentral_Service = $this->Ordercentral_Service;

		$this->view->data = $this->Ordercentral_Service->getlistaccessories();

		$this->view->rek = $this->Ordercentral_Service->getRekening();
		$this->view->cash = $this->Ordercentral_Service->getCash();
	}

	public function datadeviceAction()
	{
		$this->_helper->layout->setLayout('target-column');

		$this->view->Ordercentral_Service = $this->Ordercentral_Service;

		$this->view->data = $this->Ordercentral_Service->getlistdevice();


		$this->view->rek = $this->Ordercentral_Service->getRekening();
		$this->view->cash = $this->Ordercentral_Service->getCash();
	}

	public function dataliquidAction()
	{
		$this->_helper->layout->setLayout('target-column');
		$this->view->Ordercentral_Service = $this->Ordercentral_Service;
		$this->view->data = $this->Ordercentral_Service->getlistliquid();

		$this->view->rek = $this->Ordercentral_Service->getRekening();
		$this->view->cash = $this->Ordercentral_Service->getCash();
	}

	public function tesresponseAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);

		$body = json_decode($this->getRequest()->getRawBody());

		// 'kode_barang' => $kode_barang,
		// 'hj_retail' => $hj_retail,
		// 'qty' => $qty,
		// 'free' => $free,
		// 'sub_total_barang' => $sub_total_barang,
		// 'sub_total_berat' => $sub_total_berat,
		// 'nama_tabel' => $nama_tabel, // Jenis brang
		// 'on_hand' => $on_hand,
		// 'hj_retail_baru' => $hj_retail_baru,
		// 'kode' => $kode

		$kode_barang = [];
		$hj_retail = [];
		$qty = [];
		$free = [];
		$sub_total_barang = [];
		$sub_total_berat = [];
		$nama_tabel = [];
		$on_hand = [];
		$hj_retail_baru = [];
		$kode = [];
		$stok_gudang_baru = [];

		if (count($body->keranjang) > 0) {
			foreach ($body->keranjang as $keranjang) {
				array_push($kode_barang, $keranjang->kode_barang);
				array_push($hj_retail, $keranjang->hj_retail);
				array_push($qty, $keranjang->qty);
				array_push($free, $keranjang->free);
				array_push($sub_total_barang, $keranjang->subTotal);
				array_push($sub_total_berat, $keranjang->berat);
				array_push($nama_tabel, $keranjang->nama_tabel);
				array_push($on_hand, $keranjang->on_hand);
				array_push($hj_retail_baru, $keranjang->hj_retail);
				array_push($kode, $keranjang->kode);
				array_push($stok_gudang_baru, $keranjang->stok_pusat + $keranjang->qty);
			}
		}

		$data = array(
			'kode_supplier' => $body->kode_supplier,
			'no_order' => $body->no_order,
			'tgl_order' => $body->tgl_order,
			'seq' => $body->seq,
			'total' => $body->total_biaya,
			'biaya_kirim' => $body->biaya_kirim,
			'diskon' => $body->diskon,
			'jenis_diskon' => $body->jenis_diskon,
			'net_total' => $body->net_total,
			'jml_bayar_dp' => $body->jml_bayar,
			'sisa_bayar' => $body->sisa_bayar,
			'metode_bayar2' => 'Transfer',
			'no_rek' => $body->metode_penerimaan,
			'keterangan' => $body->keterangan,
			// 'kode_inv' => date('dmy'),
			// 'termin_hutang' => $body->termin_hutang,
			// 'shipment' => $body->shipment,
			// 'nama_kurir' => $body->nama_kurir,
			// 'total_berat' => $body->total_berat,
			// 'metode_penerimaan' => $body->metode_penerimaan,
			// 'jml_penerimaan' => $body->jml_penerimaan,
			// 'metode_penerimaan2' => $body->metode_penerimaan2,
			// 'jml_penerimaan2' => $body->jml_penerimaan2,
			// 'nama_penerima' => $body->nama_penerima,
			// 'alamat_penerima' => $body->alamat_penerima,
			// 'kode_barang' => $kode_barang
			// 'sub_total' => $body->sub_total,
			// 'biaya_lain' => $body->biaya_lain,
			// 'ket_biaya_lain' => $body->ket_biaya_lain,
			// 'deposit' => $body->deposit,

			// PER ITEM
			// 'free' => $free,
			// 'sub_total_berat' => $sub_total_berat,
			// 'on_hand' => $on_hand,
			'kode_barang' => $kode_barang,
			'harga_beli' => $hj_retail,
			'qty' => $qty,
			'sub_total' => $sub_total_barang,
			'nama_tabel' => $nama_tabel, // Jenis barang
			'stok_gudang_baru' => $stok_gudang_baru,
			'harga_beli_baru' => $hj_retail_baru,
			'kode' => $kode
		);
		//var_dump($data);

		// $this->getResponse()->setHttpResponseCode(200);
		// $this->_helper->json->sendJson(([
		//     'request' => $nama_tabel,
		//     'status' => 'OK',
		//     'message' => 'Berhasil disimpan',
		//     'status' => 200,
		//     'error' => false
		// ]));

		try {
			$this->view->result = $this->Ordercentral_Service->insertdata($data);

			if ($this->view->result == 'sukses') {
				$this->getResponse()->setHttpResponseCode(200);
				$this->_helper->json->sendJson(([
					'status' => 'OK',
					'message' => 'Berhasil disimpan',
					'status' => 200,
					'error' => false
				]));
			} else {
				$this->getResponse()->setHttpResponseCode(500);
				$this->_helper->json->sendJson([
					'status' => 'OK',
					'message' => 'Gagal disimpan',
					'status' => 200,
					'error' => false
				]);
			}
			//code...
		} catch (\Exception $e) {
			//throw $th;
			$this->getResponse()->setHttpResponseCode(500);
			$this->_helper->json->sendJson(json_encode($e));
		}
		// echo json_encode(['status' => 'ok']);
		// echo 'tes';
		// $this->getResponse()->setHttpResponseCode(200);


	}

	public function kirimdataAction()
	{
		$this->_helper->layout->setLayout('ordercentral-layout');

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
		$id_akun = '';
		$cash   = '';

		if (isset($_POST['kode_supplier2'])) {
			$kode_supplier = $_POST['kode_supplier2'];
		}
		if (isset($_POST['no_order'])) {
			$no_order = $_POST['no_order'];
		}
		if (isset($_POST['tgl_order'])) {
			$tgl_order = $_POST['tgl_order'];
		}
		if (isset($_POST['seq'])) {
			$seq = $_POST['seq'];
		}
		if (isset($_POST['total'])) {
			$total = $_POST['total'];
		}
		if (isset($_POST['biaya_kirim'])) {
			$biaya_kirim = $_POST['biaya_kirim'];
		}
		if (isset($_POST['diskon'])) {
			$diskon = $_POST['diskon'];
		}
		if (isset($_POST['net_total'])) {
			$net_total = str_replace(".", "", $_POST['net_total']);
		}
		if (isset($_POST['jml_bayar_dp'])) {
			$jml_bayar_dp = $_POST['jml_bayar_dp'];
		}
		if (isset($_POST['sisa_bayar'])) {
			$sisa_bayar = $_POST['sisa_bayar'];
		}
		if (isset($_POST['metode_bayar2'])) {
			$metode_bayar2 = $_POST['metode_bayar2'];
		}
		if (isset($_POST['no_rek'])) {
			$no_rek = $_POST['no_rek'];
		}

		if (isset($_POST['kode_barang'])) {
			$kode_barang = $_POST['kode_barang'];
		}
		if (isset($_POST['harga_beli'])) {
			$harga_beli = $_POST['harga_beli'];
		}
		if (isset($_POST['qty'])) {
			$qty = $_POST['qty'];
		}
		if (isset($_POST['sub_total'])) {
			$sub_total = $_POST['sub_total'];
		}

		if (isset($_POST['nama_tabel'])) {
			$nama_tabel = $_POST['nama_tabel'];
		}
		if (isset($_POST['stok_gudang_baru'])) {
			$stok_gudang_baru = $_POST['stok_gudang_baru'];
		}
		if (isset($_POST['harga_beli_baru'])) {
			$harga_beli_baru = $_POST['harga_beli_baru'];
		}
		if (isset($_POST['kode'])) {
			$kode = $_POST['kode'];
		}
		if (isset($_POST['cash'])) {
			$cash = $_POST['cash'];
		}

		$tgl_order = str_replace('/', '-', $tgl_order);
		$tgl_order = date("Y-m-d H:i", strtotime($tgl_order));

		$total = str_replace(".", "", $total);
		$biaya_kirim = str_replace(".", "", $biaya_kirim);
		$diskon = str_replace(".", "", $diskon);
		$net_total = str_replace(".", "", $net_total);
		$jml_bayar_dp = str_replace(".", "", $jml_bayar_dp);
		$sisa_bayar = str_replace(".", "", $sisa_bayar);
		$harga_beli = str_replace(".", "", $harga_beli);
		$sub_total = str_replace(".", "", $sub_total);
		//$harga_beli_baru= str_replace(".", "", $harga_beli_baru);
		if (isset($_POST['cash'])) {
			$cash = $_POST['cash'];
		}

		if (($no_rek == 0) || ($no_rek == "")) {
			$id_akun = $cash;
		} else {
			$id_akun = $no_rek;
		}


		$data = array(
			'kode_supplier' => $kode_supplier,
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
			'no_rek' => $id_akun,
			//
			'kode_barang' => $kode_barang,
			'harga_beli' => $harga_beli,
			'qty' => $qty,
			'sub_total' => $sub_total,
			'nama_tabel' => $nama_tabel,
			'stok_gudang_baru' => $stok_gudang_baru,
			'harga_beli_baru' => $harga_beli_baru,
			'kode' => $kode
		);
		//var_dump($data);
		$this->view->datainsert = $this->Ordercentral_Service->insertdata($data);
	}

	public function hapusdataAction()
	{
		$no_order = '';

		if (isset($_REQUEST['no_order'])) {
			$no_order = $_REQUEST['no_order'];
		}

		$no_order_data = $no_order;
		$data = $this->Ordercentral_Service->getDataOrderCentral($no_order_data);
		$data3 = $this->Ordercentral_Service->getDataDetailOrderCentral($no_order_data);

		for ($d = 0; $d < count($data3); $d++) {

			$kode_barang 	= $data3[$d]['kode_barang'];
			$harga_beli 	= number_format($data3[$d]['harga_beli'], 0, ",", ".");
			$harga_beli2 	= $data3[$d]['harga_beli'];
			$qty 			= $data3[$d]['qty'];
			$sub_total		= number_format($data3[$d]['sub_total'], 0, ",", ".");
			$jenis_barang	= $data3[$d]['jenis_barang'];
			$kode_jenis_barang = $data3[$d]['kode_jenis_barang'];

			$barang = $this->Ordercentral_Service->getdatabarangid($kode_barang);
			$nama_barang  = $barang[0]['nama_barang'];
			$ket		  = $barang[0]['ket'];
			$stok_gudang  = $barang[0]['stok_gudang'];

			$hitung_stok =  $stok_gudang - $qty;

			$dataupdate = array(
				'kode_barang' => $kode_barang,
				'nama_tabel' => $jenis_barang,
				'hitung_stok' => $hitung_stok,
				'kode' => $kode_jenis_barang
			);

			$aksi = $this->Ordercentral_Service->updateData($dataupdate);
		}

		$dataInput = array('no_order' => $no_order);
		$hasil = $this->Ordercentral_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}

	public function editdataAction()
	{
		$this->_helper->layout->setLayout('target-column');

		$no_order_data   = $_GET['id'];
		$this->view->no_order_data = $no_order_data;

		$this->view->Ordercentral_Service = $this->Ordercentral_Service;

		$this->view->data = $this->Ordercentral_Service->getDataOrderCentral($no_order_data);
		$temp_ordercentral = $this->Ordercentral_Service->getDataOrderCentral($no_order_data);
		$kode_supplier = $temp_ordercentral[0]['kode_supplier'];
		$this->view->data2 = $this->Ordercentral_Service->getdatasupplierid($kode_supplier);

		$this->view->data3 = $this->Ordercentral_Service->getDataDetailOrderCentral($no_order_data);

		$this->view->supplier = $this->Ordercentral_Service->getSupplier();
		$this->view->warna = $this->Ordercentral_Service->getWarna();
		$this->view->seq = $this->Ordercentral_Service->getNoSeq();
		$this->view->rek = $this->Ordercentral_Service->getRekening();
		$this->view->cash = $this->Ordercentral_Service->getCash();
	}

	public function kirimdataeditAction()
	{

		$this->_helper->layout->setLayout('ordercentral-layout');

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

		$id_akun = '';
		$cash   = '';

		if (isset($_POST['kode_supplier2'])) {
			$kode_supplier = $_POST['kode_supplier2'];
		}
		if (isset($_POST['no_order'])) {
			$no_order = $_POST['no_order'];
		}
		if (isset($_POST['tgl_order'])) {
			$tgl_order = $_POST['tgl_order'];
		}
		if (isset($_POST['seq'])) {
			$seq = $_POST['seq'];
		}
		if (isset($_POST['total'])) {
			$total = $_POST['total'];
		}
		if (isset($_POST['biaya_kirim'])) {
			$biaya_kirim = $_POST['biaya_kirim'];
		}
		if (isset($_POST['diskon'])) {
			$diskon = $_POST['diskon'];
		}
		if (isset($_POST['net_total'])) {
			$net_total = str_replace(".", "", $_POST['net_total']);
		}
		if (isset($_POST['jml_bayar_dp'])) {
			$jml_bayar_dp = $_POST['jml_bayar_dp'];
		}
		if (isset($_POST['sisa_bayar'])) {
			$sisa_bayar = $_POST['sisa_bayar'];
		}
		if (isset($_POST['metode_bayar2'])) {
			$metode_bayar2 = $_POST['metode_bayar2'];
		}
		if (isset($_POST['no_rek'])) {
			$no_rek = $_POST['no_rek'];
		}

		if (isset($_POST['kode_barang'])) {
			$kode_barang = $_POST['kode_barang'];
		}
		if (isset($_POST['harga_beli'])) {
			$harga_beli = $_POST['harga_beli'];
		}
		if (isset($_POST['qty'])) {
			$qty = $_POST['qty'];
		}
		if (isset($_POST['sub_total'])) {
			$sub_total = $_POST['sub_total'];
		}

		if (isset($_POST['nama_tabel'])) {
			$nama_tabel = $_POST['nama_tabel'];
		}
		if (isset($_POST['stok_gudang_baru'])) {
			$stok_gudang_baru = $_POST['stok_gudang_baru'];
		}
		if (isset($_POST['harga_beli_baru'])) {
			$harga_beli_baru = $_POST['harga_beli_baru'];
		}
		if (isset($_POST['kode'])) {
			$kode = $_POST['kode'];
		}
		if (isset($_POST['cash'])) {
			$cash = $_POST['cash'];
		}


		$tgl_order = str_replace('/', '-', $tgl_order);
		$tgl_order = date("Y-m-d H:i", strtotime($tgl_order));

		$total = str_replace(".", "", $total);
		$biaya_kirim = str_replace(".", "", $biaya_kirim);
		$diskon = str_replace(".", "", $diskon);
		$net_total = str_replace(".", "", $net_total);
		$jml_bayar_dp = str_replace(".", "", $jml_bayar_dp);
		$sisa_bayar = str_replace(".", "", $sisa_bayar);
		$harga_beli = str_replace(".", "", $harga_beli);
		$sub_total = str_replace(".", "", $sub_total);
		//$harga_beli_baru= str_replace(".", "", $harga_beli_baru);

		if (($no_rek == 0) || ($no_rek == "")) {
			$id_akun = $cash;
		} else {
			$id_akun = $no_rek;
		}


		$data = array(
			'kode_supplier' => $kode_supplier,
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
			'no_rek' => $id_akun,
			'kode_barang' => $kode_barang,
			'harga_beli' => $harga_beli,
			'qty' => $qty,
			'sub_total' => $sub_total,
			'nama_tabel' => $nama_tabel,
			'stok_gudang_baru' => $stok_gudang_baru,
			'harga_beli_baru' => $harga_beli_baru,
			'kode' => $kode
		);

		$this->view->datainsert = $this->Ordercentral_Service->editdata($data);
	}

	public function detailAction()
	{
		$this->_helper->layout->setLayout('target-column');

		$no_order_data   = $_GET['id'];
		$this->view->no_order_data = $no_order_data;

		$this->view->Ordercentral_Service = $this->Ordercentral_Service;

		$this->view->data = $this->Ordercentral_Service->getDataOrderCentral($no_order_data);
		$temp_ordercentral = $this->Ordercentral_Service->getDataOrderCentral($no_order_data);
		$kode_supplier = $temp_ordercentral[0]['kode_supplier'];
		$this->view->data2 = $this->Ordercentral_Service->getdatasupplierid($kode_supplier);

		$this->view->data3 = $this->Ordercentral_Service->getDataDetailOrderCentral($no_order_data);

		$this->view->supplier = $this->Ordercentral_Service->getSupplier();
		$this->view->warna = $this->Ordercentral_Service->getWarna();
		$this->view->seq = $this->Ordercentral_Service->getNoSeq();
		$this->view->rek = $this->Ordercentral_Service->getRekening();
	}

	public function printordercentralAction()
	{
		$this->_helper->layout->setLayout('target-column');

		$no_order_data   = $_GET['no_order'];
		$this->view->no_order_data = $no_order_data;

		$this->view->Ordercentral_Service = $this->Ordercentral_Service;

		$this->view->data = $this->Ordercentral_Service->getDataOrderCentral($no_order_data);
		$temp_ordercentral = $this->Ordercentral_Service->getDataOrderCentral($no_order_data);
		$kode_supplier = $temp_ordercentral[0]['kode_supplier'];
		$this->view->data2 = $this->Ordercentral_Service->getdatasupplierid($kode_supplier);

		$this->view->data3 = $this->Ordercentral_Service->getDataDetailOrderCentral($no_order_data);

		$this->view->supplier = $this->Ordercentral_Service->getSupplier();
		$this->view->warna = $this->Ordercentral_Service->getWarna();
		$this->view->seq = $this->Ordercentral_Service->getNoSeq();
		$this->view->rek = $this->Ordercentral_Service->getRekening();
	}
}
