<?php
class Liquid_Service {
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
            $query ="SELECT * from menu where source = 'liquid' ";
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
            $query ="select kode_barang FROM liquid Order by kode_barang Desc";
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
	
	public function getVolume() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM volliquid Order by id_volume Asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getRasa() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select * FROM rasa_liquid Order by kode_rasa Asc";
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
	
	public function getDataLiquid($kode_barang_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from liquid where kode_barang = '$kode_barang_data'";
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
		
	    /* $insdata = array("kode_barang" => $data['kode_barang'],
						 "stok_pusat" => $data['stok_pusat'],
						 "kode_supplier" => $data['kode_supplier']); */
		
		$insdata = array("kode_supplier" => $data['kode_supplier'],
						 "volume" => $data['volume'],
						 "kode_barang" => $data['kode_barang'],
						 "id_kode_barang" => $data['id_kode_barang'],
						 "seq_kode_barang" => $data['seq_kode_barang'],
						 "merk_barang" => $data['merk_barang'],
						 "nama_barang" => $data['nama_barang'],
						 "kode_rasa" => $data['kode_rasa'],
						 "nic" => $data['nic'],
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
					
		$db->insert('liquid',$insdata);
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
		
		$kode_barang = $data['kode_barang'];
		
	    $insdata = array("kode_supplier" => $data['kode_supplier'],
						 "volume" => $data['volume'],
						 "merk_barang" => $data['merk_barang'],
						 "nama_barang" => $data['nama_barang'],
						 "kode_rasa" => $data['kode_rasa'],
						 "nic" => $data['nic'],
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
						 
		$where = "kode_barang = '".$kode_barang."'";
					
		$db->update('liquid',$insdata,$where);
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
		
		$kode_barang = $dataInput['kode_barang'];
		
	    $where = "kode_barang = '".$kode_barang."'";
				
		$db->delete('liquid', $where);
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
            $query ="select max(seq_kode_barang) FROM liquid where id_kode_barang = '$id_kode_barang'";
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