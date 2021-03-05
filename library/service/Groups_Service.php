<?php
class Groups_Service {
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
            $query ="SELECT * from menu where source = 'groups' ";
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
    
    public function getlistgroups() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from groups order by id ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataGroup($id) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from groups where id = '$id'";
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
		
		$insdata = array("group_name" => $data['group_name'],
						 "permission" => $data['permission']);
					
		$db->insert('groups',$insdata);
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
		
		$id = $data['id'];
		
	    $insdata = array("group_name" => $data['group_name'],
						 "permission" => $data['permission']);
						 
		$where = "id = '".$id."'";
					
		$db->update('groups',$insdata,$where);
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
		
		$id = $dataInput['id'];
		
	    $where = "id = '".$id."'";
				
		$db->delete('groups', $where);
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