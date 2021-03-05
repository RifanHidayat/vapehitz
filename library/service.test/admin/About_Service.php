<?php

class About_Service {

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


   public function findTmwblsabout($id) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);



	     /* $query ="SELECT * FROM DBADMSI.TMWBLSABOUT WHERE I_WBLS_ABOUT='".$id."'";
            $result = $db->fetchRow($query);   */
	    
	    $query ="SELECT * FROM DBADMSI.TMWBLSABOUT WHERE I_WBLS_ABOUT=:id";
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
	public function updateTmwblsabout($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$ID = $dataInput['I_WBLS_ABOUT'];
			$title = $dataInput['N_WBLS_ABOUT'];
			$dekripsi = $dataInput['E_WBLS_ABOUT'];
			$userid = $dataInput['I_WBLS_ADM'];
			$today = $dataInput['D_WBLS_ABOUT'];
			
			$where = "I_WBLS_ABOUT = '".$ID."' " ;
			
			$datasimpan = array("N_WBLS_ABOUT" => $title,"E_WBLS_ABOUT" => $dekripsi,"I_WBLS_ADM" => $userid,"D_WBLS_ABOUT" => new Zend_Db_Expr("to_date('$today','YYYY-MM-DD HH24:MI:SS')"));	
								
			$db->update('DBADMSI.TMWBLSABOUT',$datasimpan, $where);
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
    public function getAllTmwblspurpose() {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT I_WBLS_PURPOSE, N_WBLS_PURPOSE, E_WBLS_PURPOSE, F_WBLS_PURPOSESTAT FROM DBADMSI.TMWBLSPURPOSE ORDER BY to_number(C_WBLS_PURPOSEORD)';
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
    
    public function insertTmwblspurpose(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
        $sql = "select max(I_WBLS_PURPOSE) as I_WBLS_PURPOSE from DBADMSI.TMWBLSPURPOSE";
        $jumlah = $db->fetchOne($sql);
            $jumlah = $jumlah+1;
	
		//$password = MD5($data['n_userid']);

		$currdate=$data['D_WBLS_PURPOSE'];
	    $data = array("I_WBLS_PURPOSE"  	=> $jumlah, 
					   "N_WBLS_PURPOSE" 	=> $data['N_WBLS_PURPOSE'],
					   "E_WBLS_PURPOSE" 	=> $data['E_WBLS_PURPOSE'],
					   "F_WBLS_PURPOSESTAT" => $data['F_WBLS_PURPOSESTAT'],
					   "I_WBLS_ADM" 	=> $data['I_WBLS_ADM'],
					   "C_WBLS_PURPOSEORD" 	=> $jumlah,
					   "D_WBLS_PURPOSE" 	=> new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
		var_dump($data);
		$db->insert('DBADMSI.TMWBLSPURPOSE',$data);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	

    public function findTmwblspurpose($id) {
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

	    $query ="SELECT * FROM DBADMSI.TMWBLSPURPOSE WHERE I_WBLS_PURPOSE='".$id."'";
            $result = $db->fetchRow($query); 
		
//echo count($result);
	    //var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
   }
    
	public function updateTmwblspurpose($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$ID = $dataInput['I_WBLS_PURPOSE'];
			$N_WBLS_PURPOSE = $dataInput['N_WBLS_PURPOSE'];
			$E_WBLS_PURPOSE = $dataInput['E_WBLS_PURPOSE'];
			$stat = $dataInput['F_WBLS_PURPOSESTAT'];
			$userid = $dataInput['I_WBLS_ADM'];
			$today = $dataInput['D_WBLS_PURPOSE'];
			
			$where = "I_WBLS_PURPOSE = '".$ID."' " ;
			
			$datasimpan = array("N_WBLS_PURPOSE" => $N_WBLS_PURPOSE,"E_WBLS_PURPOSE" => $E_WBLS_PURPOSE,"F_WBLS_PURPOSESTAT" => $stat,"I_WBLS_ADM" => $userid,"D_WBLS_PURPOSE" => new Zend_Db_Expr("to_date('$today','YYYY-MM-DD HH24:MI:SS')"));	
								
			$db->update('DBADMSI.TMWBLSPURPOSE',$datasimpan, $where);
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
	public function deleteTmwblspurpose($id){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
	    $db->beginTransaction();
	    
		$where = array();
		$where[] = $db->quoteInto('I_WBLS_PURPOSE = ?', $id);
		$db->delete('DBADMSI.TMWBLSPURPOSE', $where);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	public function getAllTmwblsreq() {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT I_WBLS_REQ, N_WBLS_REQ, E_WBLS_REQ, C_WBLS_REQORD, F_WBLS_REQSTAT FROM DBADMSI.TMWBLSREQ  ORDER BY to_number(C_WBLS_REQORD) ASC';
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
   public function findTmwblsreq($id) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT I_WBLS_REQ, N_WBLS_REQ, E_WBLS_REQ, C_WBLS_REQORD, F_WBLS_REQSTAT FROM DBADMSI.TMWBLSREQ WHERE I_WBLS_REQ='".$id."'";
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
	public function insertTmwblsreq(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
	    
            $sql = "select max(I_WBLS_REQ) as I_WBLS_REQ from DBADMSI.TMWBLSREQ";
	    $idreq = $db->fetchOne($sql);
            $idreq = $idreq+1;
	
		//$password = MD5($data['n_userid']);
		$currdate=$data['D_ENTRY'];
	    $insdata = array("I_WBLS_REQ" 	=> $idreq,
					   "N_WBLS_REQ" 	=> $data['N_WBLS_REQ'],
					   "E_WBLS_REQ" 	=> $data['E_WBLS_REQ'],
					   "I_WBLS_ADM" 	=> $data['I_WBLS_ADM'],
					   "C_WBLS_REQORD" 	=> $idreq,
					   "F_WBLS_REQSTAT" 	=> $data['F_WBLS_REQSTAT'],
					   "D_ENTRY" 		    => new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
		var_dump($insdata);
		$db->insert('DBADMSI.TMWBLSREQ',$insdata);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	public function updateTmwblsreq($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$ID = $dataInput['I_WBLS_REQ'];
			$title = $dataInput['N_WBLS_REQ'];
			$dekripsi = $dataInput['E_WBLS_REQ'];
			$status = $dataInput['F_WBLS_REQSTAT'];
			$userid = $dataInput['I_WBLS_ADM'];
			$today = $dataInput['D_ENTRY'];
			
			$where = "I_WBLS_REQ = '".$ID."' " ;
			
			$datasimpan = array("N_WBLS_REQ" => $title,"E_WBLS_REQ" => $dekripsi,"F_WBLS_REQSTAT" => $status,"I_WBLS_ADM" => $userid,"D_ENTRY" => new Zend_Db_Expr("to_date('$today','YYYY-MM-DD HH24:MI:SS')"));	
								
			$db->update('DBADMSI.TMWBLSREQ',$datasimpan, $where);
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
	public function deleteTmwblsreq($id){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
	    $db->beginTransaction();
	    
		$where = array();
		$where[] = $db->quoteInto('I_WBLS_REQ = ?', $id);
		$db->delete('DBADMSI.TMWBLSREQ', $where);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	} 
   public function getAllTmwblsproc() {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT I_WBLS_PROC, N_WBLS_PROC, E_WBLS_PROC, C_WBLS_PROCORD, F_WBLS_PROCSTAT FROM DBADMSI.TMWBLSPROC  ORDER BY to_number(C_WBLS_PROCORD) ASC';
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
   public function findTmwblsproc($id) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT I_WBLS_PROC, N_WBLS_PROC, E_WBLS_PROC, C_WBLS_PROCORD, F_WBLS_PROCSTAT FROM DBADMSI.TMWBLSPROC WHERE I_WBLS_PROC='".$id."'";
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
	public function insertTmwblsproc(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
	    
            $sql = "select max(I_WBLS_PROC) as I_WBLS_PROC from DBADMSI.TMWBLSPROC";
	    $idproc = $db->fetchOne($sql);
            $idproc = $idproc+1;
	
		//$password = MD5($data['n_userid']);
		$currdate=$data['D_WBLS_PROC'];
	    $insdata = array("I_WBLS_PROC" 	=> $idproc,
					   "N_WBLS_PROC" 	=> $data['N_WBLS_PROC'],
					   "E_WBLS_PROC" 	=> $data['E_WBLS_PROC'],
					   "I_WBLS_ADM" 	=> $data['I_WBLS_ADM'],
					   "C_WBLS_PROCORD" 	=> $idproc,
					   "F_WBLS_PROCSTAT" 	=> $data['F_WBLS_PROCSTAT'],
					   "D_WBLS_PROC" 		    => new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
		var_dump($insdata);
		$db->insert('DBADMSI.TMWBLSPROC',$insdata);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	public function updateTmwblsproc($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$ID = $dataInput['I_WBLS_PROC'];
			$title = $dataInput['N_WBLS_PROC'];
			$dekripsi = $dataInput['E_WBLS_PROC'];
			$status = $dataInput['F_WBLS_PROCSTAT'];
			$userid = $dataInput['I_WBLS_ADM'];
			$today = $dataInput['D_WBLS_PROC'];
			
			$where = "I_WBLS_PROC = '".$ID."' " ;
			
			$datasimpan = array("N_WBLS_PROC" => $title,"E_WBLS_PROC" => $dekripsi,"F_WBLS_PROCSTAT" => $status,"I_WBLS_ADM" => $userid,"D_WBLS_PROC" => new Zend_Db_Expr("to_date('$today','YYYY-MM-DD HH24:MI:SS')"));	
								
			$db->update('DBADMSI.TMWBLSPROC',$datasimpan, $where);
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
	public function deleteTmwblsproc($id){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
	    $db->beginTransaction();
	    
		$where = array();
		$where[] = $db->quoteInto('I_WBLS_PROC = ?', $id);
		$db->delete('DBADMSI.TMWBLSPROC', $where);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	} 
	public function getAllTmwblsprotect() {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ='SELECT I_WBLS_PROTECT, N_WBLS_PROTECT, E_WBLS_PROTECT, C_WBLS_PROTECTORD, F_WBLS_PROTECTSTAT FROM DBADMSI.TMWBLSPROTECT  ORDER BY to_number(C_WBLS_PROTECTORD) ASC';
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
	
	public function findTmwblsprotect($id) {
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

	    $query ="SELECT * FROM DBADMSI.TMWBLSPROTECT WHERE I_WBLS_PROTECT='".$id."'";
            $result = $db->fetchRow($query); 
		
//echo count($result);
	    //var_dump($result);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
   }
	
	public function insertTmwblsprotect(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	        try {
	    $db->beginTransaction();
            $sql = "select max(I_WBLS_PROTECT) as I_WBLS_PROTECT from DBADMSI.TMWBLSPROTECT";
	    $idpro = $db->fetchOne($sql);
            $idpro = $idpro+1;
	
		//$password = MD5($data['n_userid']);
		
		$currdate=$data['D_WBLS_PROTECT'];
	    $insdata = array("I_WBLS_PROTECT" 	=> $idpro,
					   "N_WBLS_PROTECT" 	=> $data['N_WBLS_PROTECT'],
					   "E_WBLS_PROTECT" 	=> $data['E_WBLS_PROTECT'],
					   "I_WBLS_ADM" 	=> $data['I_WBLS_ADM'],
					   "C_WBLS_PROTECTORD" 	=> $idpro,
					   "F_WBLS_PROTECTSTAT" 	=> $data['F_WBLS_PROTECTSTAT'],
					   "D_WBLS_PROTECT" 		    => new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
		var_dump($insdata);
		$db->insert('DBADMSI.TMWBLSPROTECT',$insdata);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function updateTmwblsprotect($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$ID = $dataInput['I_WBLS_PROTECT'];
			$title = $dataInput['N_WBLS_PROTECT'];
			$dekripsi = $dataInput['E_WBLS_PROTECT'];
			$status = $dataInput['F_WBLS_PROTECTSTAT'];
			$userid = $dataInput['I_WBLS_ADM'];
			$today = $dataInput['D_WBLS_PROTECT'];
			
			$where = "I_WBLS_PROTECT = '".$ID."' " ;
			
			$datasimpan = array("N_WBLS_PROTECT" => $title,"E_WBLS_PROTECT" => $dekripsi,"F_WBLS_PROTECTSTAT" => $status,"I_WBLS_ADM" => $userid,"D_WBLS_PROTECT" => new Zend_Db_Expr("to_date('$today','YYYY-MM-DD HH24:MI:SS')"));	
								
			$db->update('DBADMSI.TMWBLSPROTECT',$datasimpan, $where);
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
	
	public function deleteTmwblsprotect($id){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
	    $db->beginTransaction();
	    
		$where = array();
		$where[] = $db->quoteInto('I_WBLS_PROTECT = ?', $id);
		$db->delete('DBADMSI.TMWBLSPROTECT', $where);
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