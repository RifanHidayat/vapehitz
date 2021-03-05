<?php

class Plaint_Service {

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

   public function getAllTmwbls($cari) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT A.I_WBLS, A.D_WBLS, A.C_WBLS_CATEG, A.N_WBLS_CATEGOTHER, B.N_WBLS_CATEG, C.N_WBLS_STAT, A.E_WBLS_STAT, A.C_WBLS_STAT, A.C_WBLS_STATUPD,A.D_ENTRY FROM DBADMSI.TMWBLS A, DBADMSI.TRWBLSCATEG B, DBADMSI.TRWBLSSTAT C WHERE A.C_WBLS_CATEG=B.C_WBLS_CATEG AND A.C_WBLS_STAT=C.C_WBLS_STAT '.$cari.' ORDER BY A.D_ENTRY ASC';
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
   public function findTmwbls($idwbs) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT A.C_WBLS_STATUPD, A.I_WBLS, A.C_WBLS_STAT, D.N_WBLS_STAT, A.E_WBLS_STAT, A.D_WBLS, A.C_WBLS_CATEG, A.N_WBLS_CATEGOTHER, B.N_WBLS_CATEG, A.E_WBLS, A.D_WBLS_INCIDENT, A.N_WBLS_USRMAIL, C.N_WBLS_USRNAME, C.I_WBLS_USRPHONE FROM DBADMSI.TMWBLS A, DBADMSI.TRWBLSCATEG B, DBADMSI.TRWBLSUSR C, DBADMSI.TRWBLSSTAT D WHERE A.C_WBLS_STAT=D.C_WBLS_STAT AND A.N_WBLS_USRMAIL=C.N_WBLS_USRMAIL AND A.C_WBLS_CATEG=B.C_WBLS_CATEG  AND A.I_WBLS='".$idwbs."'";
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
   public function getSumTmwbls($cari) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT count(*) as sum FROM DBADMSI.TMWBLS '.$cari.' ORDER BY D_WBLS DESC';
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
	public function updateTmwbls($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$ID = $dataInput['I_WBLS'];
			$wblsstat = $dataInput['C_WBLS_STAT'];
			$progress = $dataInput['E_WBLS_STAT'];
			$update = $dataInput['C_WBLS_STATUPD'];
			$userid = $dataInput['I_WBLS_ADM'];
			$today = $dataInput['D_WBLS_CHECK'];
			
			$where = "I_WBLS = '".$ID."' " ;
			
			$datasimpan = array("C_WBLS_STATUPD" => $update,"C_WBLS_STAT" => $wblsstat,"E_WBLS_STAT" => $progress,"I_WBLS_ADM" => $userid,"D_WBLS_CHECK" => new Zend_Db_Expr("to_date('$today','YYYY-MM-DD HH24:MI:SS')"));	
								
			$db->update('DBADMSI.TMWBLS',$datasimpan, $where);
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