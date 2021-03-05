<?php
class Home_Service {
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
    
    public function getTmwblsaboutDetail($key) {
        $registry = Zend_Registry::getInstance();
        $db_config = $registry->get('db_config');
        $db = Zend_Db::factory('Oracle', $db_config);
            try {
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //var_dump($db_config);
    
                $query ='SELECT * FROM DBADMSI.TMWBLSABOUT where i_wbls_about= '.$key;
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
		
	public function getAllTmwblspurposeDetail() {
        $registry = Zend_Registry::getInstance();
        $db_config = $registry->get('db_config');
        $db = Zend_Db::factory('Oracle', $db_config);
            try {
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //var_dump($db_config);
    
                $query ='SELECT * FROM DBADMSI.TMWBLSPURPOSE order by c_wbls_purposeord';
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
	public function getAllTmwblsreqDetail() {
        $registry = Zend_Registry::getInstance();
        $db_config = $registry->get('db_config');
        $db = Zend_Db::factory('Oracle', $db_config);
            try {
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //var_dump($db_config);
    
                $query ='SELECT * FROM DBADMSI.TMWBLSREQ order by c_wbls_reqord';
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
		
	public function getAllTmwblsprotectDetail() {
        $registry = Zend_Registry::getInstance();
        $db_config = $registry->get('db_config');
        $db = Zend_Db::factory('Oracle', $db_config);
            try {
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //var_dump($db_config);
    
                $query ='SELECT * FROM DBADMSI.TMWBLSPROTECT order by c_wbls_protectord';
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
	
	public function getAllTmwblsprocDetail($key) {
        $registry = Zend_Registry::getInstance();
        $db_config = $registry->get('db_config');
        $db = Zend_Db::factory('Oracle', $db_config);
            try {
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        //var_dump($db_config);
    
                $query ='SELECT * FROM DBADMSI.TMWBLSPROC order by c_wbls_procord';
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