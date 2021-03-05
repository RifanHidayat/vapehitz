<?php
class Cashincashout_Service{
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
            $query ="SELECT * from menu where source = 'cashincashout' ";
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
            $query ="select max(seq) FROM volliquid";
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
            $query ="SELECT *,transaksi.id as id_transaksi,akun.id as id_akun,jenisexpense.id as id_jenisexpense from transaksi JOIN jenisexpense on transaksi.id_jenisexpense=jenisexpense.id JOIN akun on transaksi.id_akun=akun.id order by transaksi.id ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }

    public function getlistjenisexpense(){
         $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from jenisexpense order by id ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }

    }
    public function getlistakun(){
         $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from akun order by id ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }

    }
    
    
    public function getDataLiquid($id) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT *,transaksi.id as id_transaksi,akun.id as id_akun,jenisexpense.id as id_jenisexpense  from transaksi JOIN jenisexpense on jenisexpense.id=transaksi.id_jenisexpense JOIN akun on akun.id=transaksi.id_akun where transaksi.id = '$id'";
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
        
        $insdata = array("tgl_transaksi" => $data['tgl_transaksi'],
                         "id_jenisexpense" => $data['id_jenisexpense'],
                         "nominal" => $data['nominal'],
                         "catatan" => $data['catatan'],
                             "id_akun" => $data['id_akun'],
                         "type" => $data['type']);
                    
        $db->insert('transaksi',$insdata);
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
        
     
        $insdata = array("tgl_transaksi" => $data['tgl_transaksi'],
                         "id_jenisexpense" => $data['id_jenisexpense'],
                         "nominal" => $data['nominal'],
                         "catatan" => $data['catatan'],
                             "id_akun" => $data['id_akun'],
                         "type" => $data['type']);
                         
        $where = "id = '".$id."'";
                    
        $db->update('transaksi',$insdata,$where);
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
                
        $db->delete('transaksi', $where);
        $db->commit();
        return 'sukses';
       } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
         return 'gagal';
       }
    }
    
    public function getSeq($id_id_volume) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="select max(seq_id_volume) FROM liquid where id_id_volume = '$id_id_volume'";
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