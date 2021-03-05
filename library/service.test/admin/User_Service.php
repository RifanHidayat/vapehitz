<?php

class User_Service {

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

/* USER PUBLIK*/
   public function getAllTrwblsusr($cari) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT * FROM DBADMSI.TRWBLSUSR where 1=1 '.$cari.' ORDER BY N_WBLS_USRNAME ASC';
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
   public function findTrwblsusr($email) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT N_WBLS_USRMAIL, N_WBLS_USRNAME,F_WBLS_USRSTAT,C_WBLS_USRPSWD FROM DBADMSI.TRWBLSUSR where N_WBLS_USRMAIL='".$email."'";
			// $query ="SELECT COUNT(*) AS COUNT FROM DBADMSI.TRWBLSUSR where N_WBLS_USRMAIL='".$email."' AND N_WBLS_USRMAIL='".$email."'";
			//$query ="SELECT C_ORG_CUR FROM DBADMSI.TPRRMEMPII WHERE I_EMP='010004'";
			//echo $query;
            $result = $db->fetchRow($query);
//echo count($result);
	    var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
	}
   public function getAllTrwblsadm($cari) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT * FROM DBADMSI.TRWBLSADM  ORDER BY I_WBLS_ADM ASC';
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
	
   public function findTrwblsadm($userid) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

	    $query ="SELECT * FROM DBADMSI.TRWBLSADM where I_WBLS_ADM=:userid";
	    $stmt = $db->prepare($query);	
	    $stmt->bindParam(':userid', $userid);
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
    public function cekTrwblsadm($userid) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT count(I_WBLS_ADM) as count FROM DBADMSI.TRWBLSADM where I_WBLS_ADM='".$userid."'";
			// $query ="SELECT COUNT(*) AS COUNT FROM DBADMSI.TRWBLSUSR where N_WBLS_USRMAIL='".$email."' AND N_WBLS_USRMAIL='".$email."'";
			//$query ="SELECT C_ORG_CUR FROM DBADMSI.TPRRMEMPII WHERE I_EMP='010004'";
			//echo $query;
			
            $result = $db->fetchOne($query);
//echo count($result);
	    //var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
   }  
	public function finddataTrwblsadm($userid,$oldpassword) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
			try {
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
				$query ="SELECT COUNT(*) AS COUNT FROM DBADMSI.TRWBLSADM where I_WBLS_ADM='".$userid."' AND C_WBLS_ADMPSWD='".$oldpassword."'";
				$result = $db->fetchOne($query);
			//var_dump($query);
				return $result;
			} catch (Exception $e) {
				echo $e->getMessage() . '<br>';
				return $e->getMessage(); //'Data tidak ada <br>';
			}
		} 
	
	public function insertTrwblsadm(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
	    
	
		//$password = MD5($data['n_userid']);
		$currdate=$data['D_ENTRY'];
	    $insdata = array("N_WBLS_ADM" 	=> $data['N_WBLS_ADM'],
					   "I_EMP" 	=> $data['I_EMP'],
					   "I_WBLS_ADM" 	=> $data['I_WBLS_ADM'],
					   "C_WBLS_ADMAUTH" 	=> $data['C_WBLS_ADMAUTH'],
					   "C_WBLS_ADMPSWD" 	=> $data['C_WBLS_ADMPSWD'],
					   "I_ENTRY" 	=> $data['I_ENTRY'],
					   "D_ENTRY" 		    => new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
		//var_dump($insdata);
		$db->insert('DBADMSI.TRWBLSADM',$insdata);
		$db->commit();
	    return $insdata;
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	public function updateTrwblsadm($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$nama = $dataInput['N_WBLS_ADM'];
			$nik = $dataInput['I_EMP'];
			$auth = $dataInput['C_WBLS_ADMAUTH'];
			$userid = $dataInput['I_WBLS_ADM'];
			$today = $dataInput['D_ENTRY'];
			
			$where = "I_WBLS_ADM = '".$userid."' " ;
			
			$datasimpan = array("N_WBLS_ADM" => $nama,"I_EMP" => $nik,"C_WBLS_ADMAUTH" => $auth,"D_ENTRY" => new Zend_Db_Expr("to_date('$today','YYYY-MM-DD HH24:MI:SS')"));	
								
			$db->update('DBADMSI.TRWBLSADM',$datasimpan, $where);
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
	public function updatePasswordTrwblsadm($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$userid = $dataInput['I_WBLS_ADM'];
			$password = $dataInput['C_WBLS_ADMPSWD'];
			
			$where = "I_WBLS_ADM = '".$userid."' " ;
			
			$datasimpan = array("C_WBLS_ADMPSWD" => $password);	
								
			$db->update('DBADMSI.TRWBLSADM',$datasimpan, $where);
			$db->commit(); 
			var_dump($password);
			
			$_hasil = array("rcNumber"=>"1",
						 "rcDesc"  =>"Proses Sukses");
			return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function deleteTrwblsadm($id){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
	    $db->beginTransaction();
	    
		$where = array();
		$where[] = $db->quoteInto('I_WBLS_ADM = ?', $id);
		$db->delete('DBADMSI.TRWBLSADM', $where);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	} 
	public function resetTrwblsadm($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$userid = $dataInput['I_WBLS_ADM'];
			$passwd = $dataInput['C_WBLS_ADMPSWD'];
			
			$where = "I_WBLS_ADM = '".$userid."' " ;
			
			$datasimpan = array("C_WBLS_ADMPSWD" => $passwd);	
								
			$db->update('DBADMSI.TRWBLSADM',$datasimpan, $where);
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
	public function deleteTrwblsusr($id){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
	    $db->beginTransaction();
	    
		$where = array();
		$where[] = $db->quoteInto('N_WBLS_USRMAIL = ?', $id);
		$db->delete('DBADMSI.TRWBLSUSR', $where);
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