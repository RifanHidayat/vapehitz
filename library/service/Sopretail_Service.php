<?php
class Sopretail_Service {
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
            $query ="SELECT * from menu where source = 'sopretail' ";
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
            $query ="select max(seq) FROM sop_retail";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getrasa($kode_rasa) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select rasa FROM rasa_liquid where kode_rasa = '$kode_rasa'";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getwarna2($kode_warna) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select nama_warna FROM warna where kode_warna = '$kode_warna'";
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
            $query ="select nama_barang, kode_rasa, nic, volume, bad_stock FROM liquid where kode_barang = '$kode_barang'
					 union
					 select nama_device as nama_barang, kode_warna, jenis_device, stok_pusat as stok_retail, bad_stock FROM device where kode_device = '$kode_barang'
					 union
					 select nama_aksesoris as nama_barang, ket, jenis_aksesoris, stok_pusat as stok_retail, bad_stock FROM accessories where kode_aksesoris = '$kode_barang'
					 union
					 select nama_atomizer as nama_barang, kode_warna, jenis_atomizer, stok_pusat as stok_retail, bad_stock FROM atomizer where kode_atomizer = '$kode_barang'
					 ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    
    public function getlistSOP() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from sop_retail order by no_sop ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDatasopretail($no_sop_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from sop_retail where no_sop = '$no_sop_data'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataDetailsopretail($no_sop_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from sop_retail_sub where no_sop = '$no_sop_data' order by kode_subsop Asc";
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
		
		$insdata = array("no_sop" => $data['no_sop'],
						 "tgl_sop" => $data['tgl_sop'],
						 "seq" => $data['seq'],
						 "kategori" => $data['kategori']);
					
		$db->insert('sop_retail',$insdata);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang = $data['kode_barang'][$x];
				$qty_before = $data['stok_retail'][$x];
				$qty_after = $data['real_stock'][$x];
				$selisih = $data['selisih'][$x];
				$ket = $data['ket'][$x];
				
				$nama_tabel = $data['nama_tabel'][$x];
				$kode = $data['kode'][$x];
				
				$qty_before= str_replace(".", "", $qty_before);
				$qty_after= str_replace(".", "", $qty_after);
				$selisih= str_replace(".", "", $selisih);
				
			$insdata2 = array("kode_barang" => $kode_barang,
							  "no_sop" => $data['no_sop'],
							  "qty_before" => $qty_before,
							  "qty_after" => $qty_after,
							  "selisih" => $selisih,
							  "ket" => $ket,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('sop_retail_sub',$insdata2);
			
			$insdata3 = array("stok_retail" => $qty_after);
					
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
		
		$no_sop = $data['no_sop'];
		
	   $insdata = array("tgl_sop" => $data['tgl_sop']);
						 
		$where = "no_sop = '".$no_sop."'";
					
		$db->update('sop_retail',$insdata,$where);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			
			$db->delete('sop_retail_sub', $where);
			
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang = $data['kode_barang'][$x];
				$qty_before = $data['stok_retail'][$x];
				$qty_after = $data['real_stock'][$x];
				//$bad_stock = $data['bad_stock'][$x];
				$selisih = $data['selisih'][$x];
				$ket = $data['ket'][$x];
				
				$nama_tabel = $data['nama_tabel'][$x];
				$bad_stock_baru = $data['bad_stock_baru'][$x];
				$bad_stock_awal = $data['bad_stock_awal'][$x];
				$kode = $data['kode'][$x];
				
				$qty_before= str_replace(".", "", $qty_before);
				$qty_after= str_replace(".", "", $qty_after);
				//$bad_stock= str_replace(".", "", $bad_stock);
				//$bad_stock_baru= str_replace(".", "", $bad_stock_baru);
				//$bad_stock_awal= str_replace(".", "", $bad_stock_awal);
				$selisih= str_replace(".", "", $selisih);
				
				/* if($bad_stock_baru == '0'){
					$bad_stock_baru = $bad_stock_awal + $bad_stock;
				} else {
					$bad_stock_baru = $bad_stock_baru;
				} */
				
			$insdata2 = array("kode_barang" => $kode_barang,
							  "no_sop" => $data['no_sop'],
							  "qty_before" => $qty_before,
							  "qty_after" => $qty_after,
							  "selisih" => $selisih,
							  "ket" => $ket,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('sop_retail_sub',$insdata2);
			
			$insdata3 = array("stok_retail" => $qty_after);
					
			$where2 = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where2);
				
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
	
	public function hapusData($dataInput){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		$no_sop = $dataInput['no_sop'];
		
	    $where = "no_sop = '".$no_sop."'";
				
		$db->delete('sop_retail', $where);
		$db->delete('sop_retail_sub', $where);
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
	
}
?>