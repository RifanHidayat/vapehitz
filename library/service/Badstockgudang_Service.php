<?php
class Badstockgudang_Service {
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
            $query ="SELECT * from menu where source = 'badstockgudang' ";
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
		$curYear = date('Y');
        try {
            $query ="select max(seq) FROM badstockgudang where tahun = '$curYear'";
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
            $query ="select nama_barang, ket, nic, stok_pusat as stok_gudang, bad_stock FROM liquid where kode_barang = '$kode_barang'
					 union
					 select nama_device as nama_barang, ket, jenis_device, stok_pusat as stok_gudang, bad_stock FROM device where kode_device = '$kode_barang'
					 union
					 select nama_aksesoris as nama_barang, ket, jenis_aksesoris, stok_pusat as stok_gudang, bad_stock FROM accessories where kode_aksesoris = '$kode_barang'
					 union
					 select nama_atomizer as nama_barang, ket, jenis_atomizer, stok_pusat as stok_gudang, bad_stock FROM atomizer where kode_atomizer = '$kode_barang'
					 ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    
    public function getlist() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from badstockgudang order by no_proses ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataBadStockGudang($no_proses_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from badstockgudang where no_proses = '$no_proses_data'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataDetailBadStockGudang($no_proses_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from sub_badstockgudang where no_proses = '$no_proses_data' order by kode_subproses Asc";
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
		$curYear = date('Y');
		$insdata = array("no_proses" => $data['no_proses'],
						 "tgl_proses" => $data['tgl_proses'],
						 "status" => 'Dalam Proses',
						 "nama_file" => $data['nama_file'],
						 "seq" => $data['seq'],
						 "tahun" => $curYear);
					
		$db->insert('badstockgudang',$insdata);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang = $data['kode_barang'][$x];
				$stok_gudang = $data['stok_gudang'][$x];
				$qty = $data['qty'][$x];
				$bad_stock = $data['bad_stock'][$x];
				$sisa = $data['sisa'][$x];
				
				$nama_tabel = $data['nama_tabel'][$x];
				$kode = $data['kode'][$x];
				
				$stok_gudang= str_replace(".", "", $stok_gudang);
				$qty= str_replace(".", "", $qty);
				$bad_stock= str_replace(".", "", $bad_stock);
				$sisa= str_replace(".", "", $sisa);
				
			$insdata2 = array("kode_barang" => $kode_barang,
							  "no_proses" => $data['no_proses'],
							  "stok_pusat" => $stok_gudang,
							  "bad_stock" => $bad_stock,
							  "qty" => $qty,
							  "sisa" => $sisa,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('sub_badstockgudang',$insdata2);
			
			/* $insdata3 = array("stok_pusat" => $qty_after,
							  "bad_stock" => $bad_stock_baru);
					
			$where = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where); */
				
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
		
		$no_proses = $data['no_proses'];
		$nama_file = $data['nama_file'];
		
		if($nama_file){
			$insdata = array("tgl_proses" => $data['tgl_proses'],
							 "nama_file" => $data['nama_file']);
		} else {
			$insdata = array("tgl_proses" => $data['tgl_proses']);
		}
						 
		$where = "no_proses = '".$no_proses."'";
					
		$db->update('badstockgudang',$insdata,$where);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			
			$db->delete('sub_badstockgudang', $where);
			
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang = $data['kode_barang'][$x];
				$stok_gudang = $data['stok_gudang'][$x];
				$qty = $data['qty'][$x];
				$bad_stock = $data['bad_stock'][$x];
				$sisa = $data['sisa'][$x];
				
				$nama_tabel = $data['nama_tabel'][$x];
				$kode = $data['kode'][$x];
				
				$stok_gudang= str_replace(".", "", $stok_gudang);
				$qty= str_replace(".", "", $qty);
				$bad_stock= str_replace(".", "", $bad_stock);
				$sisa= str_replace(".", "", $sisa);
				
			$insdata2 = array("kode_barang" => $kode_barang,
							  "no_proses" => $data['no_proses'],
							  "stok_pusat" => $stok_gudang,
							  "bad_stock" => $bad_stock,
							  "qty" => $qty,
							  "sisa" => $sisa,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('sub_badstockgudang',$insdata2);
			
			/* $insdata3 = array("stok_pusat" => $qty_after,
							  "bad_stock" => $bad_stock_baru);
					
			$where2 = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where2); */
				
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
	
	public function approvedata(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		$no_proses = $data['no_proses'];
		$nama_file = $data['nama_file'];
		
		if($nama_file){
			$insdata = array("tgl_proses" => $data['tgl_proses'],
							 "nama_file" => $data['nama_file'],
							 "status" => 'Approve');
		} else {
			$insdata = array("tgl_proses" => $data['tgl_proses'],
							 "status" => 'Approve');
		}
						 
		$where = "no_proses = '".$no_proses."'";
					
		$db->update('badstockgudang',$insdata,$where);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			
			$db->delete('sub_badstockgudang', $where);
			
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang = $data['kode_barang'][$x];
				$stok_gudang = $data['stok_gudang'][$x];
				$qty = $data['qty'][$x];
				$bad_stock = $data['bad_stock'][$x];
				$sisa = $data['sisa'][$x];
				
				$nama_tabel = $data['nama_tabel'][$x];
				$kode = $data['kode'][$x];
				
				$stok_gudang= str_replace(".", "", $stok_gudang);
				$qty= str_replace(".", "", $qty);
				$bad_stock= str_replace(".", "", $bad_stock);
				$sisa= str_replace(".", "", $sisa);
				
			$insdata2 = array("kode_barang" => $kode_barang,
							  "no_proses" => $data['no_proses'],
							  "stok_pusat" => $stok_gudang,
							  "bad_stock" => $bad_stock,
							  "qty" => $qty,
							  "sisa" => $sisa,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('sub_badstockgudang',$insdata2);
			
			$insdata3 = array("bad_stock" => $sisa);
					
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
	
	public function approvedata2(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		$no_proses = $data['no_proses'];
		
	   $insdata = array("tgl_proses" => $data['tgl_proses'],
						"status" => 'Not-Approve');
						 
		$where = "no_proses = '".$no_proses."'";
					
		$db->update('badstockgudang',$insdata,$where);
		
		if(count($data['kode_barang']) <> 0 && trim($data['kode_barang'][0]) <> ''){
			
			$db->delete('sub_badstockgudang', $where);
			
			for($x=0;$x<count($data['kode_barang']);$x++){
				$kode_barang = $data['kode_barang'][$x];
				$stok_gudang = $data['stok_gudang'][$x];
				$qty = $data['qty'][$x];
				$bad_stock = $data['bad_stock'][$x];
				$sisa = $data['sisa'][$x];
				
				$nama_tabel = $data['nama_tabel'][$x];
				$kode = $data['kode'][$x];
				
				$stok_gudang= str_replace(".", "", $stok_gudang);
				$qty= str_replace(".", "", $qty);
				$bad_stock= str_replace(".", "", $bad_stock);
				$sisa= str_replace(".", "", $sisa);
				
			$insdata2 = array("kode_barang" => $kode_barang,
							  "no_proses" => $data['no_proses'],
							  "stok_pusat" => $stok_gudang,
							  "bad_stock" => $bad_stock,
							  "qty" => $qty,
							  "sisa" => $sisa,
							  "jenis_barang" => $nama_tabel,
							  "kode_jenis_barang" => $kode);
					
			$db->insert('sub_badstockgudang',$insdata2);
			
			/* $insdata3 = array("bad_stock" => $sisa);
					
			$where2 = "$kode = '".$kode_barang."'";
					
			$db->update($nama_tabel,$insdata3,$where2); */
				
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
		
		$no_proses = $dataInput['no_proses'];
		
	    $where = "no_proses = '".$no_proses."'";
				
		$db->delete('badstockgudang', $where);
		$db->delete('sub_badstockgudang', $where);
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