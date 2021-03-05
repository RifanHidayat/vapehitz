<?php
class Master_Service {
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
    
    public function getlistsupplier() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');
		
        try {
			
            $query ="SELECT * from supplier order by kode_supplier ASC ";
			
			$result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getmenusupplier() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from menu where source = 'supplier' ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataSupplier($kode_supplier_data) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from supplier where kode_supplier = '$kode_supplier_data'";
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
						 "nama_supplier" => $data['nama_supplier'],
						 "alamat_supplier" => $data['alamat_supplier'],
						 "no_tlp" => $data['no_tlp'],
						 "no_hp" => $data['no_hp'],
						 "email" => $data['email'],
						 "tipe" => $data['tipe'],
						 "status" => $data['status']);
					
		$db->insert('supplier',$insdata);
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
		
		$kode_supplier = $dataInput['kode_supplier'];
		
	    $where = "kode_supplier = '".$kode_supplier."'";
				
		$db->delete('supplier', $where);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function getNoSeq() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select kode_supplier FROM supplier Order by kode_supplier Desc";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function editdata(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		$kode_supplier = $data['kode_supplier'];
		
	    $insdata = array("nama_supplier" => $data['nama_supplier'],
						 "alamat_supplier" => $data['alamat_supplier'],
						 "no_tlp" => $data['no_tlp'],
						 "no_hp" => $data['no_hp'],
						 "email" => $data['email'],
						 "tipe" => $data['tipe'],
						 "status" => $data['status']);
						 
		$where = "kode_supplier = '".$kode_supplier."'";
					
		$db->update('supplier',$insdata,$where);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
}
?>