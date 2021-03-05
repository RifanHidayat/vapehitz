<?php

class File_Service {

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


   public function getAllTmwblsfile($idwbs) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT A.N_WBLS_FILE, B.N_WBLS_FILECATEG  FROM DBADMSI.TMWBLSFILE A, DBADMSI.TRWBLSFILECATEG B WHERE A.C_WBLS_FILECATEG=B.C_WBLS_FILECATEG AND I_WBLS='".$idwbs."'  ORDER BY A.N_WBLS_FILE ASC";
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



}

?>