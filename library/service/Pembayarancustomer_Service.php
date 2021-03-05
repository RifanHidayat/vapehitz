<?php
class Pembayarancustomer_Service {
    private static $instance;
    private function __construct() {
    }

    public static function getInstance() {
       if (!isset(self::$instance)) {
           $c = __CLASS__;
           self::$instance = new $c;
       }

       return self::$instance;
    }
	
	public function getmenu() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from menu where source = 'pembayarancustomer' ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getNoSeq() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select max(seq) FROM salecentral";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getlistliquid() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from liquid order by kode_barang ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getCustomer() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM customer where status = '1' Order by kode_customer Asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getWarna() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM warna Order by kode_warna Asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getdatacustomerid($kode_customer) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM customer where kode_customer = '$kode_customer'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getdatasalesid($kode_sales) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM sales where kode_sales = '$kode_sales'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getdatabarangid($kode_barang) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select nama_barang as nama_barang, berat, on_hand, stok_pusat FROM liquid where kode_barang = '$kode_barang'
					 union
					 select nama_device as nama_barang, berat, on_hand, stok_pusat FROM device where kode_device = '$kode_barang'
					 union
					 select nama_aksesoris as nama_barang, berat, on_hand, stok_pusat FROM accessories where kode_aksesoris = '$kode_barang'
					 union
					 select nama_atomizer as nama_barang, berat, on_hand, stok_pusat FROM atomizer where kode_atomizer = '$kode_barang'
					 ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    
    public function getlistSaleCentral() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from salecentral where status = 'Approve' order by no_invoice ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataSaleCentral($no_invoice_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from salecentral where no_invoice = '$no_invoice_data'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataDetailSaleCentral($no_invoice_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from sub_salecentral where no_invoice = '$no_invoice_data' order by kode_subsale Asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function insertdata(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		$insdata = array("no_invoice" => $data['no_invoice'],
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
						 "kode_inv" => $data['kode_inv']);

		$insdata_transaksi= array(
					     "deskripsi" => "Transaksi pembayaran pelanggan  \n".$data['no_invoice'],
					     "tgl_transaksi" => $data['tgl_invoice'],
					     "nominal" => $data['jml_bayar_dp'],
					     "type" => "Cash In",
					     "nama_table" => "pembayarancustomer",
					     "id_table" => $data['no_invoice'],
					     "id_akun" => $data['no_rek']);

					
		$db->insert('salecentral',$insdata);
		$db->insert('transaksi',$insdata_transaksi);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang	 = $data['kode_barang'][$x];
				$hj_retail		 = $data['hj_retail'][$x];
				$qty			 = $data['qty'][$x];
				$free			 = $data['free'][$x];
				$sub_total		 = $data['sub_total'][$x];
				$sub_total_berat = $data['sub_total_berat'][$x];
				
				$nama_tabel 	 = $data['nama_tabel'][$x];
				$on_hand 		 = $data['on_hand'][$x];
				$hj_retail_baru  = $data['hj_retail_baru'][$x];
				$kode 			 = $data['kode'][$x];
				
			$insdata2 = array("kode_barang" => $kode_barang,
							  "no_invoice" => $data['no_invoice'],
							  "harga_jual" => $hj_retail,
							  "qty" => $qty,
							  "free" => $free,
						      "sub_total" => $sub_total,
							  "sub_total_berat" => $sub_total_berat,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('sub_salecentral',$insdata2);
			
			$insdata3 = array("on_hand" => $on_hand,
							  "hj_retail" => $hj_retail_baru);
					
			$where = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where);
				
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
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function editdata(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		$no_invoice = $data['no_invoice'];
		
	   $insdata = array("jml_bayar" => $data['total_bayar'],
						"sisa_bayar" => $data['sisa_hutang']);
						 
		$where = "no_invoice = '".$no_invoice."'";
					
		$db->update('salecentral',$insdata,$where);
		
		$insdata2 = array("no_invoice" => $data['no_invoice'],
						 "tgl_pembayaran" => $data['tgl_pembayaran'],
						 "jumlah_pembayaran" => $data['jml_bayar_dp'],
						 "sisa_pembayaran" => $data['sisa_hutang'],
						 "metode_pembayaran" => $data['metode_bayar2'],
						 "catatan" => $data['catatan'],
						 "no_rekening" => $data['no_rek']);

		$insdata_transaksi= array(
					     "deskripsi" => "Transaksi pembayaran pelanggan  \n".$data['no_invoice'],
					     "tgl_transaksi" => $data['tgl_pembayaran'],
					     "nominal" => $data['jml_bayar_dp'],
					     "type" => "Cash In",
					     "nama_table" => "pembayarancustomer",
					     "id_table" => $data['no_invoice'],
					     "id_akun" => $data['no_rek']);


		
		$db->insert('piutang',$insdata2);
		$db->insert('transaksi',$insdata_transaksi);
		
		
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function approvedata(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		$no_invoice = $data['no_invoice'];
		
	   $insdata = array("no_invoice" => $data['no_invoice'],
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
						 "status" => 'Approve');
						 
		$where = "no_invoice = '".$no_invoice."'";
					
		$db->update('salecentral',$insdata,$where);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			
			$db->delete('sub_salecentral', $where);
			
			for($x=0;$x<count($data['kode_barang']);$x++){
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
				
				$sisa_on_hand	 = $on_hand - $qty;
				$sisa_stok_pusat = $stok_gudang - $qty;
				
			$insdata2 = array("kode_barang" => $kode_barang,
							  "no_invoice" => $data['no_invoice'],
							  "harga_jual" => $hj_retail,
							  "qty" => $qty,
							  "free" => $free,
						      "sub_total" => $sub_total,
							  "sub_total_berat" => $sub_total_berat,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('sub_salecentral',$insdata2);
			
			$insdata3 = array("on_hand" => $sisa_on_hand,
							  "stok_pusat" => $sisa_stok_pusat);
					
			$where = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where);
				
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
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function hapusData($dataInput){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		$no_invoice = $dataInput['no_invoice'];
		
	    $where = "no_invoice = '".$no_invoice."'";
				
		$db->delete('salecentral', $where);
		$db->delete('sub_salecentral', $where);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function getlistdevice() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT a.kode_device, a.merk_device, a.nama_device, a.jenis_device, 
					 a.ket, a.on_hand, a.stok_pusat, a.stok_retail, a.stok_studio, a.berat,
					 a.hj_retail, b.nama_warna
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
	
	public function getlistaccessories() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from accessories order by kode_aksesoris ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getlistatomizer() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT a.kode_atomizer, a.merk_atomizer, a.nama_atomizer,
					 a.on_hand, a.stok_pusat, a.stok_retail, a.stok_studio,
					 a.berat, a.hj_retail, b.nama_warna
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
	
	public function getRekening() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM akun where type='Transfer' Order by id Asc ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getCash() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM akun where type='Cash' Order by id Asc ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
	}
	public function getDataDetailPiutang($no_invoice_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from piutang JOIN akun ON piutang.no_rekening=akun.id where no_invoice = '$no_invoice_data' order by id_piutang Asc";
            $result = $db->fetchAll($query);
            return $result; 
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function editdatahistory(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		$no_invoice = $data['no_invoice'];
		$id_piutang = $data['id_piutang'];
		
	   $insdata = array(
		   "jml_bayar" => $data['terbayar'],
		// "jml_bayar" => $data['jumlah_pembayaran'],
						"sisa_bayar" => $data['sisa_pembayaran']);
						 
		$where = "no_invoice = '".$no_invoice."'";
					
		$db->update('salecentral',$insdata,$where);
		
		$insdata2 = array("jumlah_pembayaran" => $data['jumlah_pembayaran'],
						  "sisa_pembayaran" => $data['sisa_pembayaran'],
						  "catatan" => $data['catat']);
		
		$where2 = "id_piutang = '".$id_piutang."'";
					
		$db->update('piutang',$insdata2,$where2);
		
		
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
}
?>