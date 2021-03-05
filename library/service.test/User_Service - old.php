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

   public function getAllTrwblsusr($cari) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT * FROM DBADMSI.TRWBLSUSR where 1=1 '.$cari.' ORDER BY I_INIT_TRC ASC';
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
	public function insertTrwblsusr(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
	
		//$password = MD5($data['n_userid']);
		$currdate=$data['d_entry'];
	    $insdata = array("N_WBLS_USRMAIL" 	=> $data['n_email'],
					   "N_WBLS_USRNAME" 	=> $data['n_username'],
					   "I_WBLS_USRPHONE" 	=> $data['i_phone'],
					   "F_WBLS_USRSTAT" 	=> $data['n_status'],
					   "C_WBLS_USRPSWD" 	=> $data['c_password'],
					   "D_WBLS_USRREG" 	    => new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
					//    "D_ENTRY" 		    => new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
		var_dump($insdata);
		$db->insert('DBADMSI.TRWBLSUSR',$insdata);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}

	public function updateActiveTrwblsusr($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$email = $dataInput['email'];
			$flogin = $dataInput['flogin'];
			
			$where = "N_WBLS_USRMAIL = '".$email."' " ;
			
			$datasimpan = array("F_WBLS_USRSTAT" => $flogin);	
								
			$db->update('DBADMSI.TRWBLSUSR',$datasimpan, $where);
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
	public function updatePasswordTrwblsusr($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$email = $dataInput['email'];
			$password = $dataInput['password'];
			
			$where = "N_WBLS_USRMAIL = '".$email."' " ;
			
			$datasimpan = array("C_WBLS_USRPSWD" => $password);	
								
			$db->update('DBADMSI.TRWBLSUSR',$datasimpan, $where);
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
	
	public function cekTrwblsusr($email) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
		//var_dump($db_config);

				$query ="SELECT COUNT(*) as COUNT FROM DBADMSI.TRWBLSUSR where N_WBLS_USRMAIL='".$email."'";
			//$query ="SELECT C_ORG_CUR FROM DBADMSI.TPRRMEMPII WHERE I_EMP='010004'";
			//echo $query;
            $result = $db->fetchOne($query);
//echo count($result);
	    var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }    


}

?>