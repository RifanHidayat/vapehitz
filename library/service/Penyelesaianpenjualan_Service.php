<?php
class Penyelesaianpenjualan_Service {
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
            $query ="SELECT * from menu where source = 'penyelesaianpenjualan' ";
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
            $query ="select max(seq) FROM retur_penjualan";
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
	
	public function getSupplier() {
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
	
	public function getdatasupplierid($kode_customer) {
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
	
	public function getdatabarangid($kode_barang) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select nama_barang as nama_barang, merk_barang as ket, stok_pusat as stok_gudang FROM liquid where kode_barang = '$kode_barang'
					 union
					 select nama_device as nama_barang, ket as ket, stok_pusat as stok_gudang FROM device where kode_device = '$kode_barang'
					 union
					 select nama_aksesoris as nama_barang, ket as ket, stok_pusat as stok_gudang FROM accessories where kode_aksesoris = '$kode_barang'
					 union
					 select nama_atomizer as nama_barang, merk_atomizer as ket, stok_pusat as stok_gudang FROM atomizer where kode_atomizer = '$kode_barang'
					 ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    
    public function getlistsalecentral() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT a.no_invoice, a.tgl_invoice, a.sisa_bayar,
					 a.kode_customer, b.no_retur, b.tgl_retur 
					 from salecentral a, retur_penjualan b
					 where a.no_invoice = b.no_invoice 
					 and a.sisa_bayar < 0 order by a.no_invoice ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getlistReturPembelian() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT distinct a.no_invoice, a.tgl_invoice, a.sisa_bayar,
					 a.kode_customer, b.no_retur, b.tgl_retur 
					 from salecentral a, retur_penjualan b, selisih_penjualan c
					 where a.no_invoice = b.no_invoice 
					 and b.no_retur = c.no_retur 
					 and a.sisa_bayar = 0
					 order by a.no_invoice ASC";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDatasalecentral($no_retur_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select a.no_retur, a.no_invoice, a.tgl_retur, a.total_qty_retur, 
					 a.total_nominal_retur, b.tgl_invoice, b.kode_customer, b.sisa_bayar, b.net_total
					 from retur_penjualan a, salecentral b, customer c 
					 where a.no_invoice = b.no_invoice 
					 and b.kode_customer = c.kode_customer and
					 a.no_retur = '$no_retur_data'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataDetailsalecentral($no_invoice_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from sub_salecentral where no_invoice = '$no_invoice_data' order by kode_suborder Asc";
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
					
		$db->insert('salecentral',$insdata);
		
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
					
			$db->insert('sub_salecentral',$insdata2);
			
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
		$no_retur = $data['no_retur'];
		
	   $insdata = array("sisa_bayar" => $data['sisa_hutang']);
						 
		$where = "no_invoice = '".$no_invoice."'";
					
		$db->update('salecentral',$insdata,$where);
		
		$insdata2 = array("no_retur" => $data['no_retur'],
						  "no_invoice" => $data['no_invoice'],
						  "tgl_pembayaran" => $data['tgl_pembayaran'],
						  "jumlah_pembayaran" => $data['jml_bayar_dp'],
						  "sisa_pembayaran" => $data['sisa_hutang'],
						  "metode_pembayaran" => $data['metode_bayar2'],
						  "catatan" => $data['catatan'],
						  "no_rekening" => $data['no_rek']);
					
		$db->insert('selisih_penjualan',$insdata2);
		
		
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
            $query ="select * FROM rekening Order by no_id Asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataDetailHutang($no_retur_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from selisih_penjualan where no_retur = '$no_retur_data' order by id_hutang Asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataReturPembelian($no_retur_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT a.no_retur, a.no_invoice, a.tgl_retur, a.total_qty_retur, 
					 a.total_nominal_retur, b.tgl_invoice, b.kode_customer
					 from retur_penjualan a, salecentral b 
					 where a.no_invoice = b.no_invoice
					 and a.no_retur = '$no_retur_data'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataDetailReturPembelian($no_retur_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from sub_returpembelian where no_retur = '$no_retur_data' order by no_subretur Asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
}
?>