<?php
class Atomizer_Service {
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
            $query ="SELECT * from menu where source = 'atomizer' ";
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
            $query ="select kode_atomizer FROM atomizer Order by kode_atomizer Desc";
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
            $query ="select * FROM jenisatomizer Order by id_jenis Asc";
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
	
	public function getDataatomizer($kode_atomizer_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from atomizer where kode_atomizer = '$kode_atomizer_data'";
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
						 "kode_atomizer" => $data['kode_atomizer'],
						 "id_kode_barang" => $data['id_kode_barang'],
						 "seq_kode_barang" => $data['seq_kode_barang'],
						 "merk_atomizer" => $data['merk_atomizer'],
						 "nama_atomizer" => $data['nama_atomizer'],
						 "jenis_atomizer" => $data['jenis_atomizer'],
						 "kode_warna" => $data['kode_warna'],
						 "berat" => $data['berat'],
						 "stok_pusat" => $data['stok_pusat'],
						 "stok_retail" => $data['stok_retail'],
						 "stok_studio" => $data['stok_studio'],
						 "bad_stock" => $data['bad_stock'],
						 "harga_beli" => $data['harga_beli'],
						 "hj_agen" => $data['hj_agen'],
						 "hj_retail" => $data['hj_retail'],
						 "hj_whs" => $data['hj_whs'],
						 "otorisasi_harga" => $data['otorisasi_harga'],
						 "status" => $data['status']);
					
		$db->insert('atomizer',$insdata);
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
		
		$kode_atomizer = $data['kode_atomizer'];
		
	   $insdata = array("kode_supplier" => $data['kode_supplier'],
						 "merk_atomizer" => $data['merk_atomizer'],
						 "nama_atomizer" => $data['nama_atomizer'],
						 "jenis_atomizer" => $data['jenis_atomizer'],
						 "kode_warna" => $data['kode_warna'],
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
						 
		$where = "kode_atomizer = '".$kode_atomizer."'";
					
		$db->update('atomizer',$insdata,$where);
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
		
		$kode_atomizer = $dataInput['kode_atomizer'];
		
	    $where = "kode_atomizer = '".$kode_atomizer."'";
				
		$db->delete('atomizer', $where);
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
            $query ="select max(seq_kode_barang) FROM atomizer where id_kode_barang = '$id_kode_barang'";
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