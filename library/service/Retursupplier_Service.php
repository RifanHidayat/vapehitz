<?php
class Retursupplier_Service {
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
            $query ="SELECT * from menu where source = 'retursupplier' ";
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
            $query ="select max(seq) FROM retur_pembelian";
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
            $query ="select * FROM supplier Order by kode_supplier Asc";
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
	
	public function getdatasupplierid($kode_supplier) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM supplier where kode_supplier = '$kode_supplier'";
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
    
    public function getlistOrderCentral() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from ordercentral order by no_order ASC ";
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
            $query ="select a.no_retur, a.no_order, a.tgl_retur, a.total_qty_retur, 
					 a.total_nominal_retur, b.tgl_order, b.kode_supplier, c.tipe 
					 from retur_pembelian a, ordercentral b, supplier c 
					 where a.no_order = b.no_order 
					 and b.kode_supplier = c.kode_supplier";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataOrderCentral($no_order_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from ordercentral where no_order = '$no_order_data'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataDetailOrderCentral($no_order_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from sub_ordercentral where no_order = '$no_order_data' order by kode_suborder Asc";
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
		
		$insdata = array("kode_supplier" => $data['kode_supplier'],
						 "no_order" => $data['no_order'],
						 "tgl_order" => $data['tgl_order'],
						 "seq" => $data['seq'],
						 "total" => $data['total'],
						 "biaya_kirim" => $data['biaya_kirim'],
						 "diskon" => $data['diskon'],
						 "net_total" => $data['net_total'],
						 "jml_bayar_dp" => $data['jml_bayar_dp'],
						 "sisa_bayar" => $data['sisa_bayar'],
						 "metode_bayar2" => $data['metode_bayar2'],
						 "no_rekening" => $data['no_rek']);
					
		$db->insert('ordercentral',$insdata);
		
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
						 "no_order" => $data['no_order'],
						 "harga_beli" => $harga_beli,
						 "qty" => $qty,
						 "sub_total" => $sub_total,
						 "jenis_barang" => $nama_tabel,
						 "kode_jenis_barang" => $kode);
					
			$db->insert('sub_ordercentral',$insdata2);
			
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
					
			$where = "no_order = '".$no_order."'";
					
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
		
		$no_order = $data['no_order'];
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang = $data['kode_barang'][$x];
				$nama_tabel = $data['nama_tabel'][$x];
				$stok_gudang = $data['stok_gudang'][$x];
				$kode = $data['kode'][$x];
				$kode_suborder = $data['kode_suborder'][$x];
				$qty = $data['qty'][$x];
				$sub_total = $data['sub_total'][$x];
				$qty_retur = $data['qty_retur'][$x];
				$harga_beli = $data['harga_beli'][$x];
				$nominal_retur = $data['nominal_retur'][$x];
				$alasan = $data['alasan'][$x];
				/* $jenis_barang = $data['nama_tabel'][$x];
				$kode_jenis_barang = $data['kode'][$x]; */
			
			$insdata = array("stok_pusat" => $stok_gudang);		
			$where = "$kode = '".$kode_barang."'";
			$db->update($nama_tabel,$insdata,$where);
			
			/* $insdata2 = array("qty" => $qty,
							  "sub_total" => $sub_total);
			$where2 = "kode_suborder = '".$kode_suborder."'";
			$db->update('sub_ordercentral',$insdata2,$where2); */
			
			
			$insdata3 = array("no_retur" => $data['no_retur'],
							  "kode_barang" => $kode_barang,
							  "qty" => $qty,
							  "harga_beli" => $harga_beli,
							  "sub_total" => $sub_total,
							  "qty_retur" => $qty_retur,
							  "nominal_retur" => $nominal_retur,
							  "alasan" => $alasan,
							  "jenis_barang" => $nama_tabel,
					
							  "kode_jenis_barang" => $kode);
			

					
			$db->insert('sub_returpembelian',$insdata3);
				
			}
		}
		
		$insdata4 = array("sisa_bayar" => $data['selisih']);
						 
		$where4 = "no_order = '".$no_order."'";
					
		$db->update('ordercentral',$insdata4,$where4);
		
		
		$insdata5 = array("no_retur" => $data['no_retur'],
						 "no_order" => $data['no_order'],
						 "total_qty_retur" => $data['total_qty_retur'],
						 "total_nominal_retur" => $data['total_nominal_retur'],
						 "seq" => $data['seq'],
						 "metode_bayar"=>"ma",
						 "id_akun"=>$data["id_akun"],
						 "tgl_retur" => $data['tgl_retur']);
			$insdata_transaksi= array(
					     "deskripsi" => "Transaksi Retur Supplier \n".$data['no_retur'],
					     "tgl_transaksi" => $data['tgl_retur'],
					     "nominal" => $data['total_nominal_retur'],
					     "type" => "Cash In",
					     "nama_table" => "retur_pembelian",
					     "id_table" => $data['no_retur'],
					     "id_akun" => $data['id_akun']);

					
		$db->insert('retur_pembelian',$insdata5);
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
		
		$no_order = $dataInput['no_order'];
		
	    $where = "no_order = '".$no_order."'";
				
		$db->delete('ordercentral', $where);
		$db->delete('sub_ordercentral', $where);
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
	
	
	
	public function getDataDetailHutang($no_order_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from hutang where no_order = '$no_order_data' order by id_hutang Asc";
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
            $query ="SELECT a.no_retur, a.no_order, a.tgl_retur, a.total_qty_retur, 
					 a.total_nominal_retur, b.tgl_order, b.kode_supplier
					 from retur_pembelian a, ordercentral b 
					 where a.no_order = b.no_order
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