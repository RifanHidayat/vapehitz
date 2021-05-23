<?php
class Salecentral_Service
{
	private static $instance;
	private function __construct()
	{
	}

	public static function getInstance()
	{
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}

	public function getmenu()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT * from menu where source = 'salecentral' ";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getDataUser($user_id, $password)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT count(a.user_id) as count 
					 FROM user a, groups b
					 where a.group = b.id
					 AND b.permission like '%approvalSaleStudio%' 
					 AND user_id='" . $user_id . "'
					 AND password='" . $password . "'";
			$result = $db->fetchOne($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getNoSeq()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "select max(seq) FROM salecentral";
			$result = $db->fetchOne($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getNoSeq2($kode_inv)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "select max(seq) FROM salecentral where kode_inv = '$kode_inv'";
			$result = $db->fetchOne($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getlistliquid()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT * from liquid order by kode_barang ASC ";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getCustomer()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "select * FROM customer where status = '1' Order by kode_customer Asc";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getWarna()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "select * FROM warna Order by kode_warna Asc";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getdatacustomerid($kode_customer)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "select * FROM customer where kode_customer = '$kode_customer'";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getdatasalesid($kode_sales)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "select * FROM sales where kode_sales = '$kode_sales'";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getdatabarangid($kode_barang)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "select nama_barang as nama_barang, merk_barang as merk, berat, on_hand, stok_pusat FROM liquid where kode_barang = '$kode_barang'
					 union
					 select nama_device as nama_barang, merk_device as merk, berat, on_hand, stok_pusat FROM device where kode_device = '$kode_barang'
					 union
					 select nama_aksesoris as nama_barang, merk_aksesoris as merk, berat, on_hand, stok_pusat FROM accessories where kode_aksesoris = '$kode_barang'
					 union
					 select nama_atomizer as nama_barang, merk_atomizer as merk, berat, on_hand, stok_pusat FROM atomizer where kode_atomizer = '$kode_barang'
					 ";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getlistSaleCentral()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT * from salecentral order by no_invoice ASC ";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getDataSaleCentral($no_invoice_data)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT * from salecentral where no_invoice = '$no_invoice_data'";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getDataDetailSaleCentral($no_invoice_data)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT * from sub_salecentral where no_invoice = '$no_invoice_data' order by kode_subsale Asc";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getDataDetailSaleCentralNew($no_invoice_data)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT jenis_barang AS nama_tabel, kode_barang, harga_jual AS hj_retail, qty, free, sub_total AS subTotal, sub_total_berat AS berat, from sub_salecentral where no_invoice = '$no_invoice_data'  order by kode_subsale Asc";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function insertdata(array $data)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
			$db->beginTransaction();

			$insdata = array(
				"no_invoice" => $data['no_invoice'],
				"tgl_invoice" => $data['tgl_invoice'],
				"kode_customer" => $data['kode_customer'],
				"shipment" => $data['shipment'],
				"nama_kurir" => $data['nama_kurir'],
				"total_berat" => $data['total_berat'],
				"total_biaya" => $data['total_biaya'],
				"diskon" => $data['diskon'],
				"jenis_diskon" => $data['jenis_diskon'],
				"sub_total" => $data['sub_total'],
				"biaya_lain" => $data['biaya_lain'],
				"ket_biaya_lain" => $data['ket_biaya_lain'],
				"deposit" => $data['deposit'],
				"biaya_kirim" => $data['biaya_kirim'],
				"net_total" => $data['net_total'],
				"metode_penerimaan" => $data['metode_penerimaan'],
				"jml_penerimaan" => $data['jml_penerimaan'],
				"metode_penerimaan2" => $data['metode_penerimaan2'],
				"jml_penerimaan2" => $data['jml_penerimaan2'],
				"jml_bayar" => $data['jml_bayar'],
				"sisa_bayar" => $data['sisa_bayar'],
				"nama_penerima" => $data['nama_penerima'],
				"alamat_penerima" => $data['alamat_penerima'],
				"keterangan" => $data['keterangan'],
				"seq" => $data['seq'],
				"termin_hutang" => $data['termin_hutang'],
				"kode_inv" => $data['kode_inv']
			);




			$db->insert('salecentral', $insdata);


			if (count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> '') {
				for ($x = 0; $x < count($data['kode_barang']); $x++) {
					$kode_barang	 = $data['kode_barang'][$x];
					$hj_retail		 = $data['hj_retail'][$x];
					$qty			 = $data['qty'][$x];
					$free			 = $data['free'][$x];
					$sub_total_barang		 = $data['sub_total_barang'][$x];
					$sub_total_berat = $data['sub_total_berat'][$x];

					$nama_tabel 	 = $data['nama_tabel'][$x];
					$on_hand 		 = $data['on_hand'][$x];
					$hj_retail_baru  = $data['hj_retail_baru'][$x];
					$kode 			 = $data['kode'][$x];

					$insdata2 = array(
						"kode_barang" => $kode_barang,
						"no_invoice" => $data['no_invoice'],
						"harga_jual" => $hj_retail,
						"qty" => $qty,
						"free" => $free,
						"sub_total" => $sub_total_barang,
						"sub_total_berat" => $sub_total_berat,
						"jenis_barang" => $nama_tabel,
						"kode_jenis_barang" => $kode
					);

					$db->insert('sub_salecentral', $insdata2);

					$insdata3 = array("on_hand" => $on_hand);

					$where = "$kode = '" . $kode_barang . "'";

					$db->update($nama_tabel, $insdata3, $where);
				}
			}

			/* $insdata4 = array("no_order" => $data['no_order'],
						 "tgl_pembayaran" => $data['tgl_order'],
						 "jumlah_pembayaran" => $data['jml_bayar_dp'],
						 "sisa_pembayaran" => $data['sisa_bayar'],
						 "metode_pembayaran" => $data['metode_bayar2'],
						 "no_rekening" => $data['no_rek']);
					
		$db->insert('hutang',$insdata4); */

			$db->commit();
			return 'sukses';
		} catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage() . '<br>';
			return 'gagal';
		}
	}

	public function insertdatanew(array $data)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
			$db->beginTransaction();

			$insdata = array(
				"no_invoice" => $data['no_invoice'],
				"tgl_invoice" => $data['tgl_invoice'],
				"kode_customer" => $data['kode_customer'],
				"shipment" => $data['shipment'],
				"nama_kurir" => $data['nama_kurir'],
				"total_berat" => $data['total_berat'],
				"total_biaya" => $data['total_biaya'],
				"diskon" => $data['diskon'],
				"jenis_diskon" => $data['jenis_diskon'],
				"sub_total" => $data['sub_total'],
				"biaya_lain" => $data['biaya_lain'],
				"ket_biaya_lain" => $data['ket_biaya_lain'],
				"deposit" => $data['deposit'],
				"biaya_kirim" => $data['biaya_kirim'],
				"net_total" => $data['net_total'],
				"metode_penerimaan" => $data['metode_penerimaan'],
				"jml_penerimaan" => $data['jml_penerimaan'],
				"metode_penerimaan2" => $data['metode_penerimaan2'],
				"jml_penerimaan2" => $data['jml_penerimaan2'],
				"jml_bayar" => $data['jml_bayar'],
				"sisa_bayar" => $data['sisa_bayar'],
				"nama_penerima" => $data['nama_penerima'],
				"alamat_penerima" => $data['alamat_penerima'],
				"keterangan" => $data['keterangan'],
				"seq" => $data['seq'],
				"termin_hutang" => $data['termin_hutang'],
				"kode_inv" => $data['kode_inv']
			);

			$db->insert('salecentral', $insdata);


			if (count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> '') {
				for ($x = 0; $x < count($data['kode_barang']); $x++) {
					$kode_barang	 = $data['kode_barang'][$x];
					$hj_retail		 = $data['hj_retail'][$x];
					$qty			 = $data['qty'][$x];
					$free			 = $data['free'][$x];
					$sub_total_barang		 = $data['sub_total_barang'][$x];
					$sub_total_berat = $data['sub_total_berat'][$x];

					$nama_tabel 	 = $data['nama_tabel'][$x];
					$on_hand 		 = $data['on_hand'][$x];
					$hj_retail_baru  = $data['hj_retail_baru'][$x];
					$kode 			 = $data['kode'][$x];

					$insdata2 = array(
						"kode_barang" => $kode_barang,
						"no_invoice" => $data['no_invoice'],
						"harga_jual" => $hj_retail,
						"qty" => $qty,
						"free" => $free,
						"sub_total" => $sub_total_barang,
						"sub_total_berat" => $sub_total_berat,
						"jenis_barang" => $nama_tabel,
						"kode_jenis_barang" => $kode
					);

					$db->insert('sub_salecentral', $insdata2);

					$insdata3 = array("on_hand" => $on_hand);

					$where = "$kode = '" . $kode_barang . "'";

					$db->update($nama_tabel, $insdata3, $where);
				}
			}

			/* $insdata4 = array("no_order" => $data['no_order'],
						 "tgl_pembayaran" => $data['tgl_order'],
						 "jumlah_pembayaran" => $data['jml_bayar_dp'],
						 "sisa_pembayaran" => $data['sisa_bayar'],
						 "metode_pembayaran" => $data['metode_bayar2'],
						 "no_rekening" => $data['no_rek']);
					
		$db->insert('hutang',$insdata4); */

			$db->commit();
			return 'sukses';
		} catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage() . '<br>';
			return 'gagal';
		}
	}

	public function editdata(array $data)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
			$db->beginTransaction();

			$no_invoice = $data['no_invoice'];

			$insdata = array(
				"no_invoice" => $data['no_invoice'],
				"tgl_invoice" => $data['tgl_invoice'],
				"kode_customer" => $data['kode_customer'],
				"shipment" => $data['shipment'],
				"nama_kurir" => $data['nama_kurir'],
				"total_berat" => $data['total_berat'],
				"total_biaya" => $data['total_biaya'],
				"diskon" => $data['diskon'],
				"jenis_diskon" => $data['jenis_diskon'],
				"sub_total" => $data['sub_total'],
				"biaya_lain" => $data['biaya_lain'],
				"ket_biaya_lain" => $data['ket_biaya_lain'],
				"deposit" => $data['deposit'],
				"biaya_kirim" => $data['biaya_kirim'],
				"net_total" => $data['net_total'],
				"metode_penerimaan" => $data['metode_penerimaan'],
				"jml_penerimaan" => $data['jml_penerimaan'],
				"metode_penerimaan2" => $data['metode_penerimaan2'],
				"jml_penerimaan2" => $data['jml_penerimaan2'],
				"jml_bayar" => $data['jml_bayar'],
				"sisa_bayar" => $data['sisa_bayar'],
				"nama_penerima" => $data['nama_penerima'],
				"alamat_penerima" => $data['alamat_penerima'],
				"keterangan" => $data['keterangan'],
				"seq" => $data['seq'],
				"termin_hutang" => $data['termin_hutang'],
				"kode_inv" => $data['kode_inv']
			);


			$where = "no_invoice = '" . $no_invoice . "'";

			$insdata_transaksi1 = array(
				"deskripsi" => "Transaksi Penjualan \n" . $data['no_invoice'],
				"tgl_transaksi" => $data['tgl_invoice'],
				"nominal" => $data['jml_penerimaan'],
				"type" => "Cash In",
				"nama_table" => "salescentral",
				"id_table" => $data['no_invoice'],
				"id_akun" => $data['metode_penerimaan']
			);
			$insdata_transaksi2 = array(
				"deskripsi" => "Transaksi Penjualan \n" . $data['no_invoice'],
				"tgl_transaksi" => $data['tgl_invoice'],
				"nominal" => $data['jml_penerimaan2'],
				"type" => "Cash In",
				"nama_table" => "salescentral",
				"id_table" => $data['no_invoice'],
				"id_akun" => $data['metode_penerimaan2']
			);




			$where_transaksi = "id_table = '" . $no_invoice . "'";

			$db->delete('transaksi', $where_transaksi);
			$db->update('salecentral', $insdata, $where);
			$db->insert('transaksi', $insdata_transaksi1);
			$db->insert('transaksi', $insdata_transaksi2);

			if (count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> '') {

				$db->delete('sub_salecentral', $where);

				for ($x = 0; $x < count($data['kode_barang']); $x++) {
					$kode_barang	 = $data['kode_barang'][$x];
					$hj_retail		 = $data['hj_retail'][$x];
					$qty			 = $data['qty'][$x];
					$free			 = $data['free'][$x];
					$sub_total_barang		 = $data['sub_total_barang'][$x];
					$sub_total_berat = $data['sub_total_berat'][$x];

					$nama_tabel 	 = $data['nama_tabel'][$x];
					$on_hand 		 = $data['on_hand'][$x];
					$hj_retail_baru  = $data['hj_retail_baru'][$x];
					$kode 			 = $data['kode'][$x];

					$insdata2 = array(
						"kode_barang" => $kode_barang,
						"no_invoice" => $data['no_invoice'],
						"harga_jual" => $hj_retail,
						"qty" => $qty,
						"free" => $free,
						"sub_total" => $sub_total_barang,
						"sub_total_berat" => $sub_total_berat,
						"jenis_barang" => $nama_tabel,
						"kode_jenis_barang" => $kode
					);

					$db->insert('sub_salecentral', $insdata2);

					$insdata3 = array("on_hand" => $on_hand);

					$where = "$kode = '" . $kode_barang . "'";

					$db->update($nama_tabel, $insdata3, $where);
				}
			}

			/* $insdata4 = array("tgl_pembayaran" => $data['tgl_order'],
						 "jumlah_pembayaran" => $data['jml_bayar_dp'],
						 "sisa_pembayaran" => $data['sisa_bayar'],
						 "metode_pembayaran" => $data['metode_bayar2'],
						 "no_rekening" => $data['no_rek']);
					
		$where4 = "no_order = '".$no_order."'";
					
		$db->update('hutang',$insdata4,$where4); */


			$db->commit();
			return 'sukses';
		} catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage() . '<br>';
			return 'gagal';
		}
	}

	public function approvedata(array $data)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
			$db->beginTransaction();

			$no_invoice = $data['no_invoice'];

			$insdata = array(
				"no_invoice" => $data['no_invoice'],
				"tgl_invoice" => $data['tgl_invoice'],
				"kode_customer" => $data['kode_customer'],
				"shipment" => $data['shipment'],
				"nama_kurir" => $data['nama_kurir'],
				"total_berat" => $data['total_berat'],
				"total_biaya" => $data['total_biaya'],
				"diskon" => $data['diskon'],
				"biaya_kirim" => $data['biaya_kirim'],
				"net_total" => $data['net_total'],
				"metode_penerimaan" => $data['metode_penerimaan'],
				"jml_penerimaan" => $data['jml_penerimaan'],
				"metode_penerimaan2" => $data['metode_penerimaan2'],
				"jml_penerimaan2" => $data['jml_penerimaan2'],
				"jml_bayar" => $data['jml_bayar'],
				"sisa_bayar" => $data['sisa_bayar'],
				"nama_penerima" => $data['nama_penerima'],
				"alamat_penerima" => $data['alamat_penerima'],
				"keterangan" => $data['keterangan'],
				"seq" => $data['seq'],
				"kode_inv" => $data['kode_inv'],
				"status" => 'Approve'
			);

			$where = "no_invoice = '" . $no_invoice . "'";

			$insdata_transaksi1 = array(
				"deskripsi" => "Transaksi Penjualan \n" . $no_invoice,
				"tgl_transaksi" => $data['tgl_invoice'],
				"nominal" => $data['jml_penerimaan'],
				"type" => "Cash In",
				"nama_table" => "salecentral",
				"id_table" => $no_invoice,
				"id_akun" => $data['metode_penerimaan']
			);
			$insdata_transaksi2 = array(
				"deskripsi" => "Transaksi Penjualan \n" . $no_invoice,
				"tgl_transaksi" => $data['tgl_invoice'],
				"nominal" => $data['jml_penerimaan2'],
				"type" => "Cash In",
				"nama_table" => "salecentral",
				"id_table" => $no_invoice,
				"id_akun" => $data['metode_penerimaan2']
			);

			$db->update('salecentral', $insdata, $where);
			$db->insert('transaksi', $insdata_transaksi1);
			$db->insert('transaksi', $insdata_transaksi2);

			if (count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> '') {

				$db->delete('sub_salecentral', $where);

				for ($x = 0; $x < count($data['kode_barang']); $x++) {
					$kode_barang	 = $data['kode_barang'][$x];
					$hj_retail		 = $data['hj_retail'][$x];
					$qty			 = $data['qty'][$x];
					$free			 = $data['free'][$x];
					$sub_total		 = $data['sub_total'][$x];
					$sub_total_berat = $data['sub_total_berat'][$x];
					$stok_gudang 	 = $data['stok_gudang'][$x];

					$nama_tabel 	 = $data['nama_tabel'][$x];
					$on_hand 		 = $data['on_hand'][$x];
					$hj_retail_baru  = $data['hj_retail_baru'][$x];
					$kode 			 = $data['kode'][$x];

					$sisa_on_hand	 = $on_hand - ($qty + $free);
					$sisa_stok_pusat = $stok_gudang - ($qty + $free);

					$insdata2 = array(
						"kode_barang" => $kode_barang,
						"no_invoice" => $data['no_invoice'],
						"harga_jual" => $hj_retail,
						"qty" => $qty,
						"free" => $free,
						"sub_total" => $sub_total,
						"sub_total_berat" => $sub_total_berat,
						"jenis_barang" => $nama_tabel,
						"kode_jenis_barang" => $kode
					);

					$db->insert('sub_salecentral', $insdata2);

					$insdata3 = array(
						"on_hand" => $sisa_on_hand,
						"stok_pusat" => $sisa_stok_pusat
					);

					$where = "$kode = '" . $kode_barang . "'";

					$db->update($nama_tabel, $insdata3, $where);
				}
			}

			$insdata4 = array(
				"no_invoice" => $data['no_invoice'],
				"tgl_pembayaran" => $data['tgl_invoice'],
				"jumlah_pembayaran" => $data['jml_bayar'],
				"sisa_pembayaran" => $data['sisa_bayar'],
				"metode_pembayaran" => '-',
				"no_rekening" => '-'
			);

			$db->insert('piutang', $insdata4);


			$db->commit();
			return 'sukses';
		} catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage() . '<br>';
			return 'gagal';
		}
	}

	public function approvedata2(array $data)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
			$db->beginTransaction();

			$no_invoice = $data['no_invoice'];

			$insdata = array(
				"no_invoice" => $data['no_invoice'],
				"tgl_invoice" => $data['tgl_invoice'],
				"kode_customer" => $data['kode_customer'],
				"shipment" => $data['shipment'],
				"nama_kurir" => $data['nama_kurir'],
				"total_berat" => $data['total_berat'],
				"total_biaya" => $data['total_biaya'],
				"diskon" => $data['diskon'],
				"biaya_kirim" => $data['biaya_kirim'],
				"net_total" => $data['net_total'],
				"metode_penerimaan" => $data['metode_penerimaan'],
				"jml_penerimaan" => $data['jml_penerimaan'],
				"metode_penerimaan2" => $data['metode_penerimaan2'],
				"jml_penerimaan2" => $data['jml_penerimaan2'],
				"jml_bayar" => $data['jml_bayar'],
				"sisa_bayar" => $data['sisa_bayar'],
				"nama_penerima" => $data['nama_penerima'],
				"alamat_penerima" => $data['alamat_penerima'],
				"keterangan" => $data['keterangan'],
				"seq" => $data['seq'],
				"kode_inv" => $data['kode_inv'],
				"status" => 'Not-Approve'
			);

			$where = "no_invoice = '" . $no_invoice . "'";

			$db->update('salecentral', $insdata, $where);

			if (count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> '') {

				$db->delete('sub_salecentral', $where);

				for ($x = 0; $x < count($data['kode_barang']); $x++) {
					$kode_barang	 = $data['kode_barang'][$x];
					$hj_retail		 = $data['hj_retail'][$x];
					$qty			 = $data['qty'][$x];
					$free			 = $data['free'][$x];
					$sub_total		 = $data['sub_total'][$x];
					$sub_total_berat = $data['sub_total_berat'][$x];
					$stok_gudang 	 = $data['stok_gudang'][$x];

					$nama_tabel 	 = $data['nama_tabel'][$x];
					$on_hand 		 = $data['on_hand'][$x];
					$hj_retail_baru  = $data['hj_retail_baru'][$x];
					$kode 			 = $data['kode'][$x];

					$sisa_on_hand	 = $on_hand - ($qty + $free);
					$sisa_stok_pusat = $stok_gudang - ($qty + $free);

					$insdata2 = array(
						"kode_barang" => $kode_barang,
						"no_invoice" => $data['no_invoice'],
						"harga_jual" => $hj_retail,
						"qty" => $qty,
						"free" => $free,
						"sub_total" => $sub_total,
						"sub_total_berat" => $sub_total_berat,
						"jenis_barang" => $nama_tabel,
						"kode_jenis_barang" => $kode
					);

					$db->insert('sub_salecentral', $insdata2);

					$insdata3 = array("on_hand" => $sisa_on_hand);

					$where = "$kode = '" . $kode_barang . "'";

					$db->update($nama_tabel, $insdata3, $where);
				}
			}

			$insdata4 = array(
				"no_invoice" => $data['no_invoice'],
				"tgl_pembayaran" => $data['tgl_invoice'],
				"jumlah_pembayaran" => $data['jml_bayar'],
				"sisa_pembayaran" => $data['sisa_bayar'],
				"metode_pembayaran" => '-',
				"no_rekening" => '-'
			);

			$db->insert('piutang', $insdata4);


			$db->commit();
			return 'sukses';
		} catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage() . '<br>';
			return 'gagal';
		}
	}

	public function hapusData($dataInput)
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
			$db->beginTransaction();

			$no_invoice = $dataInput['no_invoice'];

			$where = "no_invoice = '" . $no_invoice . "'";
			$where_transaksi = "id_table = '" . $no_invoice . "'";

			$db->delete('salecentral', $where);
			$db->delete('sub_salecentral', $where);

			$db->delete('transaksi', $where_transaksi);
			$db->commit();
			return 'sukses';
		} catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage() . '<br>';
			return 'gagal';
		}
	}

	public function getlistdevice()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT a.kode_device, a.merk_device, a.nama_device, a.jenis_device, 
					 a.ket, a.on_hand, a.stok_pusat, a.stok_retail, a.stok_studio, a.berat,
					 a.hj_retail, b.nama_warna, a.otorisasi_harga
					 from device a, warna b
					 where a.kode_warna = b.kode_warna
					 order by a.kode_device ASC ";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getlistaccessories()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT * from accessories order by kode_aksesoris ASC ";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getlistatomizer()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "SELECT a.kode_atomizer, a.merk_atomizer, a.nama_atomizer,
					 a.on_hand, a.stok_pusat, a.stok_retail, a.stok_studio,
					 a.berat, a.hj_retail, b.nama_warna, a.otorisasi_harga
					 from atomizer a, warna b
					 where a.kode_warna = b.kode_warna
					 order by a.kode_atomizer ASC ";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}

	public function getRekening()
	{
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');

		try {
			$query = "select * FROM akun Order by id Asc ";
			$result = $db->fetchAll($query);
			return $result;
		} catch (Exception $e) {
			echo $e->getMessage() . '<br>';
			return $e->getMessage(); //'Data tidak ada <br>';
		}
	}
}
