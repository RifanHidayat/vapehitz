<?php

class Verification_Service {

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


   public function findTmwblsvrf($idwbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT I_WBLS_BAVRF, D_WBLS_VRF, F_WBLS_USRNAME, F_WBLS_FILE FROM DBADMSI.TMWBLSVRF where I_WBLS='".$idwbls."'";
			// $query ="SELECT COUNT(*) AS COUNT FROM DBADMSI.TRWBLSUSR where N_WBLS_USRMAIL='".$email."' AND N_WBLS_USRMAIL='".$email."'";
			//$query ="SELECT C_ORG_CUR FROM DBADMSI.TPRRMEMPII WHERE I_EMP='010004'";
			//echo $query;
           $result = $db->fetchRow($query);
//echo count($result);
	    //var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
   public function cekTmwblsvrf($idwbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT count(*) as count  FROM DBADMSI.TMWBLSVRF where I_WBLS='".$idwbls."'";
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
	
	public function insertTmwblsvrf(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
		    $curryear=date("Y");
		    $currmonth=date("m");
	            $sql = "select max(I_WBLS_BAVRFSEQ) as I_WBLS_BAVRFSEQ from DBADMSI.TMWBLSVRF where substr(D_WBLS_VRF,7,4)= '$curryear' ";
		    $idseq = $db->fetchOne($sql);
	            $idseq = $idseq+1;
		    $seq=str_pad($idseq, 4, "0", STR_PAD_LEFT);
		    $nobav="BAV/".$seq."/PTD/".$currmonth."/".$curryear;
		//$password = MD5($data['n_userid']);
		$today=$data['D_WBLS_VRF'];
	    $insdata = array("I_WBLS_ADM" 	=> $data['I_WBLS_ADM'],
					   "I_WBLS" 	=> $data['I_WBLS'],
					   "F_WBLS_USRNAME" 	=> $data['F_WBLS_USRNAME'],
					   "F_WBLS_FILE" 	=> $data['F_WBLS_FILE'],
					   "I_WBLS_BAVRF" 	=> $nobav,
					   "I_WBLS_BAVRFSEQ" 	=> $idseq,
					   "D_WBLS_VRF" 	    => new Zend_Db_Expr("to_date('$today','YYYY-MM-DD')"));
					//    "D_ENTRY" 		    => new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
		var_dump($insdata);
		$db->insert('DBADMSI.TMWBLSVRF',$insdata);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}

	public function updateTmwblsvrf($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$idwbls = $dataInput['I_WBLS'];
			$vrf = $dataInput['E_WBLS_VRF'];
			$userid = $dataInput['I_WBLS_ADM'];
			$dvrf = $dataInput['D_WBLS_VRF'];
			
			$where = "I_WBLS = '".$idwbls."' " ;
			
			$datasimpan = array("E_WBLS_VRF" => $vrf,"I_WBLS_ADM" => $userid,"D_WBLS_VRF" => new Zend_Db_Expr("to_date('$dvrf','YYYY-MM-DD')"));	
								
			$db->update('DBADMSI.TMWBLSVRF',$datasimpan, $where);
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
	    //var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }    


}

?>