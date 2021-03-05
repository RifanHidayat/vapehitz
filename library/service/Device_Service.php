<?php
class Device_Service {
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
            $query ="SELECT * from menu where source = 'device' ";
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
            $query ="select kode_device FROM device Order by kode_device Desc";
            $result = $db->fetchOne($query);
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
	
	public function getJenis() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM jenisdevice Order by id_jenis Asc";
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
	
	public function getDataDevice($kode_device_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from device where kode_device = '$kode_device_data'";
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
		
	    /* $insdata = array("kode_device" => $data['kode_device'],
						 "stok_pusat" => $data['stok_pusat'],
						 "kode_supplier" => $data['kode_supplier']); */
		
		$insdata = array("kode_supplier" => $data['kode_supplier'],
						 "jenis_device" => $data['jenis_device'],
						 "kode_device" => $data['kode_device'],
						 "id_kode_barang" => $data['id_kode_barang'],
						 "seq_kode_barang" => $data['seq_kode_barang'],
						 "merk_device" => $data['merk_device'],
						 "nama_device" => $data['nama_device'],
						 "kode_warna" => $data['kode_warna'],
						 "ket" => $data['ket'],
						 "berat" => $data['berat'],
						 "stok_pusat" => $data['stok_pusat'],
						 "stok_retail" => $data['stok_retail'],
						 "stok_studio" => $data['stok_studio'],
						 "bad_stock" => $data['bad_stock'],
						 "harga_beli" => $data['harga_beli'],
						 "hj_agen" => $data['hj_agen'],
						 "hj_retail" => $data['hj_retail'],
						 "hj_whs" => $data['hj_whs'],
						 "status" => $data['status']);
					
		$db->insert('device',$insdata);
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
		
		$kode_device = $data['kode_device'];
		
	    $insdata = array("kode_supplier" => $data['kode_supplier'],
						 "jenis_device" => $data['jenis_device'],
						 "merk_device" => $data['merk_device'],
						 "nama_device" => $data['nama_device'],
						 "kode_warna" => $data['kode_warna'],
						 "ket" => $data['ket'],
						 "berat" => $data['berat'],
						 "stok_pusat" => $data['stok_pusat'],
						 "stok_retail" => $data['stok_retail'],
						 "stok_studio" => $data['stok_studio'],
						 "bad_stock" => $data['bad_stock'],
						 "harga_beli" => $data['harga_beli'],
						 "hj_agen" => $data['hj_agen'],
						 "hj_retail" => $data['hj_retail'],
						 "hj_whs" => $data['hj_whs'],
						 "status" => $data['status']);
						 
		$where = "kode_device = '".$kode_device."'";
					
		$db->update('device',$insdata,$where);
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
		
		$kode_device = $dataInput['kode_device'];
		
	    $where = "kode_device = '".$kode_device."'";
				
		$db->delete('device', $where);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function getSeq($id_kode_barang) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select max(seq_kode_barang) FROM device where id_kode_barang = '$id_kode_barang'";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getNamaSupplier($kode_supplier) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select nama_supplier FROM supplier where kode_supplier = '$kode_supplier'";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
}
?>