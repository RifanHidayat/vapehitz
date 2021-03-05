<?php

class Resume_Service {

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
   public function findTmwblsresume($idwbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT I_WBLS_BAINVEST, D_WBLS_BAINVEST FROM DBADMSI.TMWBLSRESUME where I_WBLS='".$idwbls."'";
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
   public function cekTmwblsresume($idwbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT count(*) as count  FROM DBADMSI.TMWBLSRESUME where I_WBLS='".$idwbls."'";
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
	
	public function insertTmwblsresume(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
		    $curryear=date("Y");
		    $currmonth=date("m");
	            $sql = "select max(I_WBLS_BAINVESTSEQ) as I_WBLS_BAINVESTSEQ from DBADMSI.TMWBLSRESUME where substr(D_WBLS_BAINVEST,7,4)= '$curryear' ";
		    $idseq = $db->fetchOne($sql);
	            $idseq = $idseq+1;
		    $seq=str_pad($idseq, 4, "0", STR_PAD_LEFT);
		    $nobai="BAI/".$seq."/PTD/".$currmonth."/".$curryear;
		//$password = MD5($data['n_userid']);
		$today=$data['D_WBLS_RESUME'];
		$currdate=$data['D_WBLS_BAINVEST'];
	    $insdata = array("I_WBLS_ADM" 	=> $data['I_WBLS_ADM'],
					   "I_WBLS" 	=> $data['I_WBLS'],
					   "I_WBLS_BAINVEST" 	=> $nobai,
					   "I_WBLS_BAINVESTSEQ" 	=> $idseq,
					   "D_WBLS_BAINVEST" 	    => new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD')"),
					   "D_WBLS_RESUME" 	    => new Zend_Db_Expr("to_date('$today','YYYY-MM-DD HH24:MI:SS')"));
					//    "D_ENTRY" 		    => new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
		var_dump($insdata);
		$db->insert('DBADMSI.TMWBLSRESUME',$insdata);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}

	public function updateTmwblsresume($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$idwbls = $dataInput['I_WBLS'];
			$resume = $dataInput['E_WBLS_RESUME'];
			$userid = $dataInput['I_WBLS_ADM'];
			$dresume = $dataInput['D_WBLS_RESUME'];
			
			$where = "I_WBLS = '".$idwbls."' " ;
			
			$datasimpan = array("E_WBLS_RESUME" => $resume,"I_WBLS_ADM" => $userid,"D_WBLS_RESUME" => new Zend_Db_Expr("to_date('$dresume','YYYY-MM-DD HH24:MI:SS')"));	
								
			$db->update('DBADMSI.TMWBLSRESUME',$datasimpan, $where);
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

	



}

?>