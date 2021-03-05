<?php
class Saleretail_Service {
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
            $query ="SELECT * from menu where source = 'saleretail' ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataUser($user_id,$password) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');
		
        try {
            $query ="SELECT count(a.user_id) as count 
					 FROM user a, groups b
					 where a.group = b.id
					 AND b.permission like '%approvalSaleStudio%' 
					 AND user_id='".$user_id."'
					 AND password='".$password."'";
            $result = $db->fetchOne($query);
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
            $query ="select max(seq) FROM saleretail";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getNoSeq2($kode_inv) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select max(seq) FROM saleretail where kode_inv = '$kode_inv'";
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
            $query ="select nama_barang as nama_barang, ket, stok_retail, hj_retail FROM liquid where kode_barang = '$kode_barang'
					 union
					 select nama_device as nama_barang, ket, stok_retail, hj_retail FROM device where kode_device = '$kode_barang'
					 union
					 select nama_aksesoris as nama_barang, ket, stok_retail, hj_retail FROM accessories where kode_aksesoris = '$kode_barang'
					 union
					 select nama_atomizer as nama_barang, ket, stok_retail, hj_retail FROM atomizer where kode_atomizer = '$kode_barang'
					 ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    
    public function getlistsaleretail() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from saleretail order by no_invoice ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDatasaleretail($no_invoice_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from saleretail where no_invoice = '$no_invoice_data'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataDetailsaleretail($no_invoice_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from saleretail_sub where no_invoice = '$no_invoice_data' order by kode_subsale Asc";
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
		
		$metode_pembayaran = $data['metode_pembayaran'];
		$uang_kembali = $data['uang_kembali'];
		$biaya_admin = $data['biaya_admin'];
		
		if($data['metode_pembayaran'] == 'Transfer'){
			$uang_kembali = '0';
			$biaya_admin = $data['biaya_admin'];
		}else{
			$biaya_admin = '0';
			$uang_kembali = $data['uang_kembali'];
		}
		
		$insdata = array("no_invoice" => $data['no_invoice'],
						 "tgl_invoice" => $data['tgl_invoice'],
						 "total_biaya" => $data['total_biaya'],
						 "metode_pembayaran" => $data['metode_pembayaran'],
						 "no_rekening" => $data['no_rekening'],
						 "jml_pembayaran" => $data['jml_pembayaran'],
						 "uang_kembali" => $uang_kembali,
						 "biaya_admin" => $biaya_admin,
						 "kode_inv" => $data['kode_inv'],
						 "seq" => $data['seq']);

					$insdata_transaksi= array(
					     "deskripsi" => "Transaksi Sales Retail \n".$data['no_invoice'],
					     "tgl_transaksi" => $data['tgl_invoice'],
					     "nominal" => $data['jml_pembayaran'],
					     "type" => "Cash In",
					     "nama_table" => "saleretail",
					     "id_table" => $data['no_invoice'],
					     "id_akun" => $data['no_rekening']);

					
		$db->insert('saleretail',$insdata);
		$db->insert('transaksi',$insdata_transaksi);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang	 = $data['kode_barang'][$x];
				$hj_retail		 = $data['hj_retail'][$x];
				$discount		 = $data['discount'][$x];
				$stok_retail	 = $data['stok_retail'][$x];
				$qty			 = $data['qty'][$x];
				$sub_total		 = $data['sub_total'][$x];
				
				$nama_tabel 	 = $data['nama_tabel'][$x];
				$kode 			 = $data['kode'][$x];
				
			$insdata2 = array("kode_barang" => $kode_barang,
							  "no_invoice" => $data['no_invoice'],
							  "harga_jual" => $hj_retail,
							  "discount" => $discount,
							  "qty" => $qty,
						      "sub_total" => $sub_total,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('saleretail_sub',$insdata2);
			
			$hitung_stok = $stok_retail - $qty;
			
			$insdata3 = array("stok_retail" => $hitung_stok);
					
			$where = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where);
				
			}
		}
		
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
						 
		$where = "no_invoice = '".$no_invoice."'";
					
		$db->update('saleretail',$insdata,$where);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			
			$db->delete('saleretail_sub', $where);
			
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
					
			$db->insert('saleretail_sub',$insdata2);
			
			$insdata3 = array("on_hand" => $on_hand);
					
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
					
		$db->update('saleretail',$insdata,$where);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			
			$db->delete('saleretail_sub', $where);
			
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
					
			$db->insert('saleretail_sub',$insdata2);
			
			$insdata3 = array("on_hand" => $sisa_on_hand,
							  "stok_pusat" => $sisa_stok_pusat);
					
			$where = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where);
				
			}
		}
		
		$insdata4 = array("no_invoice" => $data['no_invoice'],
						 "tgl_pembayaran" => $data['tgl_invoice'],
						 "jumlah_pembayaran" => $data['jml_bayar'],
						 "sisa_pembayaran" => $data['sisa_bayar'],
						 "metode_pembayaran" => '-',
						 "no_rekening" => '-');
					
		$db->insert('piutang',$insdata4);
		
		
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function approvedata2(array $data){
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
						 "status" => 'Not-Approve');
						 
		$where = "no_invoice = '".$no_invoice."'";
					
		$db->update('saleretail',$insdata,$where);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			
			$db->delete('saleretail_sub', $where);
			
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
					
			$db->insert('saleretail_sub',$insdata2);
			
			$insdata3 = array("on_hand" => $sisa_on_hand);
					
			$where = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where);
				
			}
		}
		
		$insdata4 = array("no_invoice" => $data['no_invoice'],
						 "tgl_pembayaran" => $data['tgl_invoice'],
						 "jumlah_pembayaran" => $data['jml_bayar'],
						 "sisa_pembayaran" => $data['sisa_bayar'],
						 "metode_pembayaran" => '-',
						 "no_rekening" => '-');
					
		$db->insert('piutang',$insdata4);
		
		
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
				
		$db->delete('saleretail', $where);
		$db->delete('saleretail_sub', $where);
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
            $query ="SELECT * from device order by kode_device ASC ";
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
            $query ="SELECT * from atomizer order by kode_atomizer ASC ";
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
	
}
?>