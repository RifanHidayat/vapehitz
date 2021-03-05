<?php
class Retursaleretail_Service {
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
            $query ="SELECT * from menu where source = 'retursaleretail' ";
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
            $query ="select max(seq) FROM retursaleretail";
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
            $query ="select * FROM customer Order by kode_customer Asc";
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
	
	public function getdatabarangid($kode_barang) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select nama_barang as nama_barang, merk_barang as ket, stok_retail as stok_gudang, bad_stock FROM liquid where kode_barang = '$kode_barang'
					 union
					 select nama_device as nama_barang, ket as ket, stok_retail as stok_gudang, bad_stock FROM device where kode_device = '$kode_barang'
					 union
					 select nama_aksesoris as nama_barang, ket as ket, stok_retail as stok_gudang, bad_stock FROM accessories where kode_aksesoris = '$kode_barang'
					 union
					 select nama_atomizer as nama_barang, merk_atomizer as ket, stok_retail as stok_gudang, bad_stock FROM atomizer where kode_atomizer = '$kode_barang'
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
	
	public function getlistReturPenjualan() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select a.no_retur, a.no_invoice, a.tgl_retur, a.total_qty_retur, 
					 a.total_nominal_retur, b.tgl_invoice
					 from retursaleretail a, saleretail b
					 where a.no_invoice = b.no_invoice";
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
		
		$insdata = array("kode_customer" => $data['kode_customer'],
						 "no_invoice" => $data['no_invoice'],
						 "tgl_invoice" => $data['tgl_invoice'],
						 "seq" => $data['seq'],
						 "total" => $data['total'],
						 "biaya_kirim" => $data['biaya_kirim'],
						 "diskon" => $data['diskon'],
						 "net_total" => $data['net_total'],
						 "jml_bayar_dp" => $data['jml_bayar_dp'],
						 "sisa_bayar" => $data['sisa_bayar'],
						 "metode_bayar2" => $data['metode_bayar2'],
						 "no_rekening" => $data['no_rek']);
					
		$db->insert('saleretail',$insdata);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang = $data['kode_barang'][$x];
				$harga_beli = $data['harga_beli'][$x];
				$qty = $data['qty'][$x];
				$sub_total = $data['sub_total'][$x];
				
				$nama_tabel = $data['nama_tabel'][$x];
				$stok_gudang_baru = $data['stok_gudang_baru'][$x];
				$harga_beli_baru = $data['harga_beli_baru'][$x];
				$kode = $data['kode'][$x];
				
			$insdata2 = array("kode_barang" => $kode_barang,
						 "no_invoice" => $data['no_invoice'],
						 "harga_beli" => $harga_beli,
						 "qty" => $qty,
						 "sub_total" => $sub_total,
						 "jenis_barang" => $nama_tabel,
						 "kode_jenis_barang" => $kode);
					
			$db->insert('saleretail_sub',$insdata2);
			
			$insdata3 = array("stok_pusat" => $stok_gudang_baru,
							  "harga_beli" => $harga_beli_baru);
					
			$where = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where);
				
			}
		}
		
		/* if(count($data['nama_tabel']) <> 0 && trim($data['nama_tabel'][0]) <> ''){
			for($y=0;$y<count($data['nama_tabel']);$y++){
				$nama_tabel = $data['nama_tabel'][$y];
				$stok_gudang_baru = $data['stok_gudang_baru'][$y];
				$harga_beli_baru = $data['harga_beli_baru'][$y];
				$kode = $data['kode'][$y];
				
			$insdata3 = array("stok_pusat" => $stok_gudang_baru,
							  "harga_beli" => $harga_beli_baru);
					
			$where = "no_invoice = '".$no_invoice."'";
					
			$db->update("'".$nama_tabel."'",$insdata3,$where3);
				
			}
		} */
		
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
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang = $data['kode_barang'][$x];
				$nama_tabel = $data['nama_tabel'][$x];
				$stok_gudang = $data['stok_gudang'][$x];
				$kode = $data['kode'][$x];
				$kode_subsale = $data['kode_subsale'][$x];
				$qty = $data['qty'][$x];
				$sub_total = $data['sub_total'][$x];
				$qty_retur = $data['qty_retur'][$x];
				$harga_jual = $data['harga_jual'][$x];
				$nominal_retur = $data['nominal_retur'][$x];
				$alasan = $data['alasan'][$x];
				$bad_stock = $data['bad_stock'][$x];
				
			/* if($alasan = 'cacat/rusak'){
				$stok_gudang = $stok_gudang;
				$bad_stock = $bad_stock + $qty_retur;
			} else if($alasan = 'tidak sesuai'){
				$stok_gudang = $stok_gudang + $qty_retur;
				$bad_stock = $bad_stock;
			} */
				
			
			$insdata = array("stok_retail" => $stok_gudang);		
			$where = "$kode = '".$kode_barang."'";
			$db->update($nama_tabel,$insdata,$where);
			
			/* $insdata2 = array("qty" => $qty,
							  "sub_total" => $sub_total);
			$where2 = "kode_subsale = '".$kode_subsale."'";
			$db->update('saleretail_sub',$insdata2,$where2); */
			
			
			$insdata3 = array("no_retur" => $data['no_retur'],
							  "kode_barang" => $kode_barang,
							  "qty" => $qty,
							  "harga_jual" => $harga_jual,
							  "sub_total" => $sub_total,
							  "qty_retur" => $qty_retur,
							  "nominal_retur" => $nominal_retur,
							  "alasan" => $alasan,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('retursaleretail_sub',$insdata3);
				
			}
		}
		
		/* $insdata4 = array("total_biaya" => $data['total_baru']);
						 
		$where4 = "no_invoice = '".$no_invoice."'";
					
		$db->update('saleretail',$insdata4,$where4); */ 
		
		
		$insdata5 = array("no_retur" => $data['no_retur'],
						 "no_invoice" => $data['no_invoice'],
						 "total_qty_retur" => $data['total_qty_retur'],
						 "total_nominal_retur" => $data['total_nominal_retur'],
						 "seq" => $data['seq'],
						 "id_akun" => $data['id_akun'],
						 "metode_bayar" => $data['metode_bayar'],
						 "tgl_retur" => $data['tgl_retur']);

		   $insdata_transaksi= array(
                         "deskripsi" => "Retur Sales Retail \n".$data['no_retur'],
                         "tgl_transaksi" => $data['tgl_retur'],
                         "nominal" => $data['total_nominal_retur'],
                         "type" => "Cash Out",
                         "nama_table" => "retursaleretail",
                         "id_table" => $data['no_retur'],
                         "id_akun" => $data['id_akun']);
					
		$db->insert('retursaleretail',$insdata5);
		$db->insert('transaksi',$insdata_transaksi);
		
		
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
	
	
	public function getDataDetailHutang($no_invoice_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from piutang where no_invoice = '$no_invoice_data' order by id_piutang Asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataReturPenjualan($no_retur_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT a.no_retur, a.no_invoice, a.tgl_retur, a.total_qty_retur, 
					 a.total_nominal_retur, b.tgl_invoice
					 from retursaleretail a, saleretail b 
					 where a.no_invoice = b.no_invoice
					 and a.no_retur = '$no_retur_data'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataDetailReturPenjualan($no_retur_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from retursaleretail_sub where no_retur = '$no_retur_data' order by no_subretur Asc";
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
	
}
?>