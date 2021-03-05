<?php
class Accessories_Service {
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
            $query ="SELECT * from menu where source = 'accessories' ";
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
            $query ="select kode_aksesoris FROM accessories Order by kode_aksesoris Desc";
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
            $query ="select * FROM jenisacc Order by id_jenis Asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getRasa() {
        
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
	
	public function getDataaccessories($kode_aksesoris_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from accessories where kode_aksesoris = '$kode_aksesoris_data'";
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
						 "jenis_aksesoris" => $data['jenis_aksesoris'],
						 "kode_aksesoris" => $data['kode_aksesoris'],
						 "id_kode_barang" => $data['id_kode_barang'],
						 "seq_kode_barang" => $data['seq_kode_barang'],
						 "nama_aksesoris" => $data['nama_aksesoris'],
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
					
		$db->insert('accessories',$insdata);
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
		
		$kode_aksesoris = $data['kode_aksesoris'];
		
	    $insdata = array("kode_supplier" => $data['kode_supplier'],
						 "jenis_aksesoris" => $data['jenis_aksesoris'],
						 "nama_aksesoris" => $data['nama_aksesoris'],
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
						 
		$where = "kode_aksesoris = '".$kode_aksesoris."'";
					
		$db->update('accessories',$insdata,$where);
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
		
		$kode_aksesoris = $dataInput['kode_aksesoris'];
		
	    $where = "kode_aksesoris = '".$kode_aksesoris."'";
				
		$db->delete('accessories', $where);
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
            $query ="select max(seq_kode_barang) FROM accessories where id_kode_barang = '$id_kode_barang'";
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