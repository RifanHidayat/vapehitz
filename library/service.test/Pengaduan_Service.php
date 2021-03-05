<?php

class Pengaduan_Service {

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
	
	/* public function getPerihal(){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try 
		{
			$db->setFetchMode(Zend_Db::FETCH_OBJ);			
			$result = $db->fetchAll("	select * FROM tmaero
										WHERE c_status = 1
										ORDER BY n_judul ASC
										");
			return $result;
		} catch (Exception $e) 
		{
	     	echo $e->getMessage().'<br>';
		   	return 'Data tidak ada <br>';
		}
	} */
	
	public function getPerihal() {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);

			$query ='SELECT * FROM DBADMSI.TRWBLSCATEG ORDER BY C_WBLS_CATEG ASC';
			
            $result = $db->fetchAll($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function getDatacateg() {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);

			$query ='SELECT * FROM DBADMSI.TRWBLSFILECATEG ORDER BY C_WBLS_FILECATEG ASC';
			
            $result = $db->fetchAll($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function cekverifikasi($data_i_wbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);

			$query ="SELECT count(*) as count  FROM DBADMSI.TMWBLSVRF where I_WBLS='".$data_i_wbls."'";
			
            $result = $db->fetchOne($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function cekresume($data_i_wbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);

			$query ="SELECT count(*) as count  FROM DBADMSI.TMWBLSRESUME where I_WBLS='".$data_i_wbls."'";
			
            $result = $db->fetchOne($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function getDataWbls($logmail) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);

			$query ="SELECT A.I_WBLS, A.D_WBLS, A.C_WBLS_CATEG, A.C_WBLS_STAT, A.E_WBLS_STAT,  
					 B.N_WBLS_CATEG, C.N_WBLS_STAT
					 FROM DBADMSI.TMWBLS A, DBADMSI.TRWBLSCATEG B, DBADMSI.TRWBLSSTAT C
					 WHERE A.C_WBLS_CATEG = B.C_WBLS_CATEG AND A.C_WBLS_STAT = C.C_WBLS_STAT
					 AND A.N_WBLS_USRMAIL = '$logmail'
					 ORDER BY A.I_WBLS DESC";
			
            $result = $db->fetchAll($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function getWbls($data_i_wbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	
			$query ="SELECT A.I_WBLS, A.D_WBLS, A.C_WBLS_CATEG, A.C_WBLS_STATUPD, A.C_WBLS_STAT, A.E_WBLS_STAT,  
					 A.N_WBLS_CATEGOTHER, A.E_WBLS, A.D_WBLS_INCIDENT, B.N_WBLS_CATEG, C.N_WBLS_STAT
					 FROM DBADMSI.TMWBLS A, DBADMSI.TRWBLSCATEG B, DBADMSI.TRWBLSSTAT C
					 WHERE A.I_WBLS = '$data_i_wbls' AND
					 A.C_WBLS_CATEG = B.C_WBLS_CATEG AND A.C_WBLS_STAT = C.C_WBLS_STAT
					 ORDER BY A.I_WBLS ASC";
			
            $result = $db->fetchAll($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function getTerlapor($data_i_wbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
				
			$query ="SELECT N_WBLS_SUSPECT, N_WBLS_SUSPECTPOS, N_WBLS_SUSPECTORG
					 FROM DBADMSI.TMWBLSSUSPECT
					 WHERE I_WBLS = '$data_i_wbls' ORDER BY N_WBLS_SUSPECT ASC";
			
            $result = $db->fetchAll($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function getFile($data_i_wbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
				
			$query ="SELECT C_WBLS_FILECATEG, N_WBLS_FILE, D_WBLS_FILE, I_WBLS_FILESEQ
					 FROM DBADMSI.TMWBLSFILE
					 WHERE I_WBLS = '$data_i_wbls' ORDER BY N_WBLS_FILE ASC";
			
            $result = $db->fetchAll($query);

            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function hapusData($dataInput) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
			try {
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
				
				$data_i_wbls = $dataInput['data_i_wbls'];
				
				$where = "I_WBLS = '".$data_i_wbls."'";
				
				$db->delete('DBADMSI.TMWBLSSUSPECT', $where);
				$db->delete('DBADMSI.TMWBLSFILE', $where);
				$db->delete('DBADMSI.TMWBLS', $where);
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
	
	/* public function getAircraftDetail($no){
	$registry = Zend_Registry::getInstance();
	$db = $registry->get('db');
	try 
	{
	$db->setFetchMode(Zend_Db::FETCH_OBJ);

	$sql = $db->prepare("select * FROM tmproduct WHERE c_product= ? AND c_status = 1";
	$sql->bindParam(1, $no);
	$sql->execute();	
	$result = $sql->fetchAll();	
	return $result;
	} catch (Exception $e) 
	{
			echo $e->getMessage().'<br>';
		return 'Data tidak ada <br>';
	}
	} */

	
	public function getNoWbls() {
	$curYear = date('Y');
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
			//$curYear = date('Y');
			//$query ="SELECT MAX(I_WBLS_SEQ) FROM DBADMSI.TMWBLS where substr(D_WBLS,7,4)= '$curYear'";
			$query ='SELECT MAX(I_WBLS_SEQ) FROM DBADMSI.TMWBLS';
            //$result = $db->fetchOne($query);
			$I_WBLS_SEQ = $db->fetchOne($query);
			$I_WBLS_SEQ += 1;
			if ($I_WBLS_SEQ <=9){
				$I_WBLS_SEQ = "000".$I_WBLS_SEQ;
			} else if ($I_WBLS_SEQ <=99) {
				$I_WBLS_SEQ = "00".$I_WBLS_SEQ;
			} else if ($I_WBLS_SEQ <=999) {
				$I_WBLS_SEQ = "0".$I_WBLS_SEQ;
			} else if ($I_WBLS_SEQ <=9999) {
				$I_WBLS_SEQ = $I_WBLS_SEQ;
			}

            return $I_WBLS_SEQ;
			return $I_WBLS_SEQ;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function getNoWblsedit($data_i_wbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);

			$query ="SELECT I_WBLS_SEQ FROM DBADMSI.TMWBLS WHERE I_WBLS = '$data_i_wbls'";
			
            //$result = $db->fetchOne($query);
			$I_WBLS_SEQ = $db->fetchOne($query);
			//$I_WBLS_SEQ += 1;
			if ($I_WBLS_SEQ <=9){
				$I_WBLS_SEQ = "000".$I_WBLS_SEQ;
			} else if ($I_WBLS_SEQ <=99) {
				$I_WBLS_SEQ = "00".$I_WBLS_SEQ;
			} else if ($I_WBLS_SEQ <=999) {
				$I_WBLS_SEQ = "0".$I_WBLS_SEQ;
			} else if ($I_WBLS_SEQ <=9999) {
				$I_WBLS_SEQ = $I_WBLS_SEQ;
			}

            return $I_WBLS_SEQ;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function getNoWblseditfile($data_i_wbls) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);

			$query ="SELECT MAX(I_WBLS_FILESEQ) AS I_WBLS_FILESEQ FROM DBADMSI.TMWBLSFILE WHERE I_WBLS = '$data_i_wbls'";
			
            //$result = $db->fetchOne($query);
			$I_WBLS_FILESEQ = $db->fetchOne($query);
			//$I_WBLS_SEQ += 1;

            return $I_WBLS_FILESEQ;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage();
        }
    }
	
	public function insertdata(array $data, array $data2){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
        try {
	    $db->beginTransaction();
		
		$I_WBLS_SEQ = $data['I_WBLS_SEQ'];
		
		$bulan = date('m');	
		$tahun = date('Y'); 
		$I_WBLS = "WBS/".$I_WBLS_SEQ."/PTD/".$bulan."/".$tahun."";
		$C_WBLS_STAT = "1";
		$currdate = date('Y-m-d H:i:s');
		
	    $insdata = array("I_WBLS" => $I_WBLS,
						 "I_WBLS_SEQ" => $I_WBLS_SEQ,
						 "C_WBLS_STAT" => $C_WBLS_STAT,
						 "N_WBLS_USRMAIL" =>  $data['mail'],
						 "C_WBLS_CATEG" => $data['c_wbls_categ'],
						 "E_WBLS" => $data['e_wbls'],
						 "F_WBLS_AGREE" => $data['F_WBLS_AGREE'],
						 "D_WBLS_INCIDENT" => $data['d_wbls_incident'],
						 "N_WBLS_CATEGOTHER" => $data['n_wbls_categother'],
						 "D_WBLS" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"),
						 "D_ENTRY" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
						 
		$db->insert('DBADMSI.TMWBLS',$insdata);	
		
		$sql = "select max(I_WBLS_SUSPECT) as I_WBLS_SUSPECT from DBADMSI.TMWBLSSUSPECT";
		$jumlah = $db->fetchOne($sql);
		
		if(count($data['namapelapor']) <> 0 && trim($data['namapelapor'][0]) <> ''){
			for($x=0;$x<count($data['namapelapor']);$x++){
				$N_WBLS_SUSPECT = $data['namapelapor'][$x];
				$N_WBLS_SUSPECTPOS = $data['jabatanpelapor'][$x];
				$N_WBLS_SUSPECTORG = $data['divisipelapor'][$x];
				$jumlah = $jumlah+1;
				
				$insdata2 = array("I_WBLS_SUSPECT" => $jumlah, "I_WBLS" => $I_WBLS, "N_WBLS_SUSPECT" => $N_WBLS_SUSPECT, "N_WBLS_SUSPECTPOS" => $N_WBLS_SUSPECTPOS, "N_WBLS_SUSPECTORG" => $N_WBLS_SUSPECTORG);
				$db->insert('DBADMSI.TMWBLSSUSPECT',$insdata2);	
			}
		}
		//$namaFile = 'testnama6.jpg';
		if(count($data['c_wbls_filecateg']) <> 0 && trim($data['c_wbls_filecateg'][0]) <> ''){
			for($x=0;$x<count($data['c_wbls_filecateg']);$x++){
				$C_WBLS_FILECATEG = $data['c_wbls_filecateg'][$x];
				
				$filename = $data2[$x]['namaFile'];
				$nox = $data2[$x]['nox'];
				if ($filename){
					$insdata3 = array("I_WBLS" => $I_WBLS, 
									  "C_WBLS_FILECATEG" => $C_WBLS_FILECATEG, 
									  "N_WBLS_FILE" => $filename, 
									  "I_WBLS_FILESEQ" => $nox, 
									  "D_WBLS_FILE" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
					$db->insert('DBADMSI.TMWBLSFILE',$insdata3);	
				}
			}
		}
		
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function insertdata2(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
        try {
	    $db->beginTransaction();
		
		$I_WBLS_SEQ = $data['I_WBLS_SEQ'];
		
		$bulan = date('m');	
		$tahun = date('Y'); 
		$I_WBLS = "WBS/".$I_WBLS_SEQ."/PTD/".$bulan."/".$tahun."";
		$C_WBLS_STAT = "1";
		$currdate = date('Y-m-d H:i:s');
		
	    $insdata = array("I_WBLS" => $I_WBLS,
						 "I_WBLS_SEQ" => $I_WBLS_SEQ,
						 "C_WBLS_STAT" => $C_WBLS_STAT,
						 "N_WBLS_USRMAIL" =>  $data['mail'],
						 "C_WBLS_CATEG" => $data['c_wbls_categ'],
						 "E_WBLS" => $data['e_wbls'],
						 "F_WBLS_AGREE" => $data['F_WBLS_AGREE'],
						 "D_WBLS_INCIDENT" => $data['d_wbls_incident'],
						 "N_WBLS_CATEGOTHER" => $data['n_wbls_categother'],
						 "D_WBLS" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"),
						 "D_ENTRY" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
						 
		$db->insert('DBADMSI.TMWBLS',$insdata);	
		
		$sql = "select max(I_WBLS_SUSPECT) as I_WBLS_SUSPECT from DBADMSI.TMWBLSSUSPECT";
		$jumlah = $db->fetchOne($sql);
		
		if(count($data['namapelapor']) <> 0 && trim($data['namapelapor'][0]) <> ''){
			for($x=0;$x<count($data['namapelapor']);$x++){
				$N_WBLS_SUSPECT = $data['namapelapor'][$x];
				$N_WBLS_SUSPECTPOS = $data['jabatanpelapor'][$x];
				$N_WBLS_SUSPECTORG = $data['divisipelapor'][$x];
				$jumlah = $jumlah+1;
				
				$insdata2 = array("I_WBLS_SUSPECT" => $jumlah, "I_WBLS" => $I_WBLS, "N_WBLS_SUSPECT" => $N_WBLS_SUSPECT, "N_WBLS_SUSPECTPOS" => $N_WBLS_SUSPECTPOS, "N_WBLS_SUSPECTORG" => $N_WBLS_SUSPECTORG);
				$db->insert('DBADMSI.TMWBLSSUSPECT',$insdata2);	
			}
		}
		
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function editdata(array $data, array $data2){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
        try {
	    $db->beginTransaction();
		
		$bulan = date('m');	
		$tahun = date('Y'); 
		$I_WBLS = $data['i_wbls'];
		$currdate = date('Y-m-d H:i:s');
		$C_WBLS_STAT = $data['C_WBLS_STAT'];
		$DATA_C_WBLS_STATUPD = $data['C_WBLS_STATUPD'];
		
		if ($C_WBLS_STAT == '2' OR $C_WBLS_STAT == '4'){
			$C_WBLS_STATUPD = '1';
		} else {
			$C_WBLS_STATUPD = $DATA_C_WBLS_STATUPD;
		}
		
		
		$where = "I_WBLS = '".$I_WBLS."'";
		
	    $insdata = array("N_WBLS_USRMAIL" =>  $data['mail'],
						 "C_WBLS_CATEG" => $data['c_wbls_categ'],
						 "E_WBLS" => $data['e_wbls'],
						 "D_WBLS_INCIDENT" => $data['d_wbls_incident'],
						 "C_WBLS_STATUPD" => $C_WBLS_STATUPD,
						 "N_WBLS_CATEGOTHER" => $data['n_wbls_categother'],
						 "D_WBLS" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"),
						 "D_ENTRY" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
						 
		$db->update('DBADMSI.TMWBLS',$insdata, $where);
		
		$sql = "select max(I_WBLS_SUSPECT) as I_WBLS_SUSPECT from DBADMSI.TMWBLSSUSPECT";
		$jumlah = $db->fetchOne($sql);
		
		$db->delete('DBADMSI.TMWBLSSUSPECT', $where);
		
		if(count($data['namapelapor']) <> 0 && trim($data['namapelapor'][0]) <> ''){
			for($x=0;$x<count($data['namapelapor']);$x++){
				$N_WBLS_SUSPECT = $data['namapelapor'][$x];
				$N_WBLS_SUSPECTPOS = $data['jabatanpelapor'][$x];
				$N_WBLS_SUSPECTORG = $data['divisipelapor'][$x];
				$jumlah = $jumlah+1;
				
				$insdata2 = array("I_WBLS_SUSPECT" => $jumlah, "I_WBLS" => $I_WBLS, "N_WBLS_SUSPECT" => $N_WBLS_SUSPECT, "N_WBLS_SUSPECTPOS" => $N_WBLS_SUSPECTPOS, "N_WBLS_SUSPECTORG" => $N_WBLS_SUSPECTORG);
				$db->insert('DBADMSI.TMWBLSSUSPECT',$insdata2);	
			}
		}
		
		if(count($data['c_wbls_filecateg']) <> 0 && trim($data['c_wbls_filecateg'][0]) <> ''){
			for($x=0;$x<count($data['c_wbls_filecateg']);$x++){
				$C_WBLS_FILECATEG = $data['c_wbls_filecateg'][$x];
				
				$filename = $data2[$x]['namaFile'];
				$nox = $data2[$x]['nox'];
				if ($filename){
					$insdata3 = array("I_WBLS" => $I_WBLS, 
									  "C_WBLS_FILECATEG" => $C_WBLS_FILECATEG, 
									  "N_WBLS_FILE" => $filename, 
									  "I_WBLS_FILESEQ" => $nox, 
									  "D_WBLS_FILE" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
					$db->insert('DBADMSI.TMWBLSFILE',$insdata3);	
				}
			}
		}
		
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
         $db->rollBack();
         echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	
	public function editdata2(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
        try {
	    $db->beginTransaction();
		
		$bulan = date('m');	
		$tahun = date('Y'); 
		$I_WBLS = $data['i_wbls'];
		$currdate = date('Y-m-d H:i:s');
		$C_WBLS_STAT = $data['C_WBLS_STAT'];
		$DATA_C_WBLS_STATUPD = $data['C_WBLS_STATUPD'];
		
		$query = "select count(I_WBLS_SUSPECT) as total from DBADMSI.TMWBLSSUSPECT where i_wbls = '$I_WBLS'";
		$total = $db->fetchOne($query);
		$totaldata = count($data['namapelapor']);
		
		if ($C_WBLS_STAT == '2' OR $C_WBLS_STAT == '4'){
			if($totaldata > $total){
				$C_WBLS_STATUPD = '1';
			} else {
				$C_WBLS_STATUPD = $DATA_C_WBLS_STATUPD;
			}
		} else {
			$C_WBLS_STATUPD = $DATA_C_WBLS_STATUPD;
		}
		
		$where = "I_WBLS = '".$I_WBLS."'";
		
	    $insdata = array("N_WBLS_USRMAIL" =>  $data['mail'],
						 "C_WBLS_CATEG" => $data['c_wbls_categ'],
						 "E_WBLS" => $data['e_wbls'],
						 "D_WBLS_INCIDENT" => $data['d_wbls_incident'],
						 "C_WBLS_STATUPD" => $C_WBLS_STATUPD,
						 "N_WBLS_CATEGOTHER" => $data['n_wbls_categother'],
						 "D_WBLS" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"),
						 "D_ENTRY" =>  new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')"));
						 
		$db->update('DBADMSI.TMWBLS',$insdata, $where);
		
		$sql = "select max(I_WBLS_SUSPECT) as I_WBLS_SUSPECT from DBADMSI.TMWBLSSUSPECT";
		$jumlah = $db->fetchOne($sql);
		
		$db->delete('DBADMSI.TMWBLSSUSPECT', $where);
		
		if(count($data['namapelapor']) <> 0 && trim($data['namapelapor'][0]) <> ''){
			for($x=0;$x<count($data['namapelapor']);$x++){
				$N_WBLS_SUSPECT = $data['namapelapor'][$x];
				$N_WBLS_SUSPECTPOS = $data['jabatanpelapor'][$x];
				$N_WBLS_SUSPECTORG = $data['divisipelapor'][$x];
				$jumlah = $jumlah+1;
				
				$insdata2 = array("I_WBLS_SUSPECT" => $jumlah, "I_WBLS" => $I_WBLS, "N_WBLS_SUSPECT" => $N_WBLS_SUSPECT, "N_WBLS_SUSPECTPOS" => $N_WBLS_SUSPECTPOS, "N_WBLS_SUSPECTORG" => $N_WBLS_SUSPECTORG);
				$db->insert('DBADMSI.TMWBLSSUSPECT',$insdata2);	
			}
		}
		
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