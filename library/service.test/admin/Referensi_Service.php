<?php

class Referensi_Service {

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
	public function findTrwblscateg($id) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

		/* $sql = $db->prepare("SELECT * FROM DBADMSI.TMWBLSABOUT WHERE I_WBLS_ABOUT = ? ");
		$sql->bindParam(1, $id);
		$sql->execute();			
		$result = $sql->fetchRow(); */

	    $query ="SELECT * FROM DBADMSI.TRWBLSCATEG WHERE C_WBLS_CATEG=:id";
	    $stmt = $db->prepare($query);	
	    $stmt->bindParam(':id', $id);
	    $db->beginTransaction();
	    $stmt->execute();	
            $result = $stmt->fetch();   
		
//echo count($result);
	    //var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
   }
   
   public function getAllTrwblscateg() {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT C_WBLS_CATEG, N_WBLS_CATEG, E_WBLS_CATEG FROM DBADMSI.TRWBLSCATEG ORDER BY C_WBLS_CATEG';
			//$query ="SELECT C_ORG_CUR FROM DBADMSI.TPRRMEMPII WHERE I_EMP='010004'";
			//echo $query;
            $result = $db->fetchAll($query);
//echo count($result);
	    //var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function insertTrwblscateg(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
        $sql = "select max(C_WBLS_CATEG) as C_WBLS_CATEG from DBADMSI.TRWBLSCATEG";
        $jumlah = $db->fetchOne($sql);
            $jumlah = $jumlah+1;
	
		//$password = MD5($data['n_userid']);

		//$currdate=$data['D_WBLS_PURPOSE'];
	    $data = array("C_WBLS_CATEG"  	=> $jumlah, 
					   "N_WBLS_CATEG" 	=> $data['N_WBLS_CATEG'],
					   "E_WBLS_CATEG" 	=> $data['E_WBLS_CATEG']
					   );
		var_dump($data);
		$db->insert('DBADMSI.TRWBLSCATEG',$data);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function updateTrwblscateg($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$ID = $dataInput['C_WBLS_CATEG'];
			$title = $dataInput['N_WBLS_CATEG'];
			$dekripsi = $dataInput['E_WBLS_CATEG'];
			
			$where = "C_WBLS_CATEG = '".$ID."' " ;
			
			$datasimpan = array("N_WBLS_CATEG" => $title,"E_WBLS_CATEG" => $dekripsi);	
								
			$db->update('DBADMSI.TRWBLSCATEG',$datasimpan, $where);
			$db->commit(); 
			
			$_hasil = array("rcNumber"=>"1",
						 "rcDesc"  =>"Proses Sukses");
			return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function deleteTrwblscateg($id){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
	    $db->beginTransaction();
	    
		$where = array();
		$where[] = $db->quoteInto('C_WBLS_CATEG = ?', $id);
		$db->delete('DBADMSI.TRWBLSCATEG', $where);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function findTrwblsstat($id) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

		/* $sql = $db->prepare("SELECT * FROM DBADMSI.TMWBLSABOUT WHERE I_WBLS_ABOUT = ? ");
		$sql->bindParam(1, $id);
		$sql->execute();			
		$result = $sql->fetchRow(); */

	    $query ="SELECT * FROM DBADMSI.TRWBLSSTAT WHERE C_WBLS_STAT=:id";
	    $stmt = $db->prepare($query);	
	    $stmt->bindParam(':id', $id);
	    $db->beginTransaction();
	    $stmt->execute();	
            $result = $stmt->fetch();   
//echo count($result);
	    //var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
   }
   
   public function getAllTrwblsstat() {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT C_WBLS_STAT, N_WBLS_STAT, E_WBLS_STAT FROM DBADMSI.TRWBLSSTAT ORDER BY C_WBLS_STAT';
			//$query ="SELECT C_ORG_CUR FROM DBADMSI.TPRRMEMPII WHERE I_EMP='010004'";
			//echo $query;
            $result = $db->fetchAll($query);
//echo count($result);
	    //var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function insertTrwblsstat(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
        $sql = "select max(C_WBLS_STAT) as C_WBLS_STAT from DBADMSI.TRWBLSSTAT";
        $jumlah = $db->fetchOne($sql);
            $jumlah = $jumlah+1;
	
		//$password = MD5($data['n_userid']);

		//$currdate=$data['D_WBLS_PURPOSE'];
	    $data = array("C_WBLS_STAT"  	=> $jumlah, 
					   "N_WBLS_STAT" 	=> $data['N_WBLS_STAT'],
					   "E_WBLS_STAT" 	=> $data['E_WBLS_STAT']
					   );
		var_dump($data);
		$db->insert('DBADMSI.TRWBLSSTAT',$data);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function updateTrwblsstat($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$ID = $dataInput['C_WBLS_STAT'];
			$title = $dataInput['N_WBLS_STAT'];
			$dekripsi = $dataInput['E_WBLS_STAT'];
			
			$where = "C_WBLS_STAT = '".$ID."' " ;
			
			$datasimpan = array("N_WBLS_STAT" => $title,"E_WBLS_STAT" => $dekripsi);	
								
			$db->update('DBADMSI.TRWBLSSTAT',$datasimpan, $where);
			$db->commit(); 
			
			$_hasil = array("rcNumber"=>"1",
						 "rcDesc"  =>"Proses Sukses");
			return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function deleteTrwblsstat($id){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
	    $db->beginTransaction();
	    
		$where = array();
		$where[] = $db->quoteInto('C_WBLS_STAT = ?', $id);
		$db->delete('DBADMSI.TRWBLSSTAT', $where);
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