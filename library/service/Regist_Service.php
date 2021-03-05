<?php

class Regist_Service {

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
	
   public function findUserLogin($userid) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT a.user_id, a.password, a.nama, a.email, a.group,
					 b.permission
					 FROM user a, groups b 
					 WHERE a.group = b.id
					 AND a.user_id='$userid'";
            $result = $db->fetchAll($query);
            return $result;
			
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getData($id) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT user.user_id, user.password, user.nama, user.email, user.group
					 FROM user WHERE user.user_id='$id'";
            $result = $db->fetchAll($query);
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
	    
	    $query ="SELECT N_PKL_USRMAIL, N_PKL_USRNAME,C_PKL_EDULVL,F_PKL_USRSTAT,C_PKL_USRPSWD FROM DBADMIT.TRPKLUSR where N_PKL_USRMAIL=:email";
	    $stmt = $db->prepare($query);	
	    $stmt->bindParam(':email', $email);
	    $db->beginTransaction();
	    $stmt->execute();	
            $result = $stmt->fetch();   	    
	    
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

			$query ="SELECT I_WBLS_ADM, C_WBLS_ADMPSWD FROM DBADMSI.TRWBLSADM where I_WBLS_ADM='".$userid."'";
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
	
	public function finddataTrwblsusr($email,$oldpassword) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
			try {
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
				$query ="SELECT COUNT(*) AS COUNT FROM DBADMSI.TRWBLSUSR where N_WBLS_USRMAIL='".$email."' AND C_WBLS_USRPSWD='".$oldpassword."'";
				$result = $db->fetchOne($query);
			var_dump($query);
				return $result;
			} catch (Exception $e) {
				echo $e->getMessage() . '<br>';
				return $e->getMessage(); //'Data tidak ada <br>';
			}
		}
	
	/* public function getDataEmail($email) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
        try {
			$db->setFetchMode(Zend_Db::FETCH_OBJ);
			
			$query ="SELECT N_PKL_USRMAIL FROM DBADMIT.TRPKLUSR where N_PKL_USRMAIL=:email";
			$stmt = $db->prepare($query);	
			$stmt->bindParam(':email', $email);
			$db->beginTransaction();
			$stmt->execute();	
				$result = $stmt->fetch();   	    
			
				return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
	} */
	
	public function getDataEmail($emaildata) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
			$db->setFetchMode(Zend_Db::FETCH_OBJ);

			$query ="SELECT count(N_PKL_USRMAIL) as count FROM DBADMIT.TRPKLUSR where N_PKL_USRMAIL='".$emaildata."'";
			
            $result = $db->fetchOne($query);
			//echo count($result);
			//var_dump($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
   } 

	public function insertTrpklusr(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);

		try {
			$db->beginTransaction();
			
			$N_PKL_USRMAIL	=$data['emailhubin'];
			$N_PKL_USRNAME	=$data['namahubin'];
			$N_PKL_SCHOOL	=$data['namasekolah'];
			$I_PKL_USRPHONE	=$data['notlp'];
			$C_PKL_EDULVL	=$data['lvl'];
			$F_PKL_USRSTAT	=$data['status'];
			$C_PKL_USRPSWD	=$data['cpassword'];
			$currdate		=$data['today'];
			$currdate		=new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')");

			$query ="INSERT INTO DBADMIT.TRPKLUSR (
				N_PKL_USRMAIL,
				N_PKL_USRNAME,
				N_PKL_SCHOOL,
				I_PKL_USRPHONE,
				C_PKL_EDULVL,
				F_PKL_USRSTAT,
				C_PKL_USRPSWD,
				D_PKL_USRREGIS
			) VALUES (
				:a,
				:b,
				:c,
				:d,
				:e,
				:f,
				:g,
				$currdate
			)";

			$stmt = $db->prepare($query);

			$stmt->bindParam(':a', $N_PKL_USRMAIL);
			$stmt->bindParam(':b', $N_PKL_USRNAME);
			$stmt->bindParam(':c', $N_PKL_SCHOOL);
			$stmt->bindParam(':d', $I_PKL_USRPHONE);
			$stmt->bindParam(':e', $C_PKL_EDULVL);
			$stmt->bindParam(':f', $F_PKL_USRSTAT);
			$stmt->bindParam(':g', $C_PKL_USRPSWD);
			$stmt->execute();

			$db->commit();
			//return $insdata;
		} 
		
		catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage().'<br>';
			return 'gagal';
		}
	}
	
	public function insertTrpklusr2(array $data){
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);

		try {
			$db->beginTransaction();
			
			$N_PKL_USRMAIL	=$data['email'];
			$N_PKL_USRNAME	=$data['nama'];
			$N_PKL_SCHOOL	=$data['namauniversitas'];
			$I_PKL_USRPHONE	=$data['notlp2'];
			$C_PKL_EDULVL	=$data['lvl2'];
			$F_PKL_USRSTAT	=$data['status'];
			$C_PKL_USRPSWD	=$data['cpassword'];
			$currdate		=$data['today'];
			$currdate		=new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')");

			$query ="INSERT INTO DBADMIT.TRPKLUSR (
				N_PKL_USRMAIL,
				N_PKL_USRNAME,
				N_PKL_SCHOOL,
				I_PKL_USRPHONE,
				C_PKL_EDULVL,
				F_PKL_USRSTAT,
				C_PKL_USRPSWD,
				D_PKL_USRREGIS
			) VALUES (
				:a,
				:b,
				:c,
				:d,
				:e,
				:f,
				:g,
				$currdate
			)";

			$stmt = $db->prepare($query);

			$stmt->bindParam(':a', $N_PKL_USRMAIL);
			$stmt->bindParam(':b', $N_PKL_USRNAME);
			$stmt->bindParam(':c', $N_PKL_SCHOOL);
			$stmt->bindParam(':d', $I_PKL_USRPHONE);
			$stmt->bindParam(':e', $C_PKL_EDULVL);
			$stmt->bindParam(':f', $F_PKL_USRSTAT);
			$stmt->bindParam(':g', $C_PKL_USRPSWD);
			$stmt->execute();

			$db->commit();
			//return $insdata;
		} 
		
		catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage().'<br>';
			return 'gagal';
		}
	}

	public function insertTrwblsusr($datains){

		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
			$db->beginTransaction();
			
			$datasimpan = array("N_PKL_USRMAIL" =>$datains['emailhubin'],
								 "N_PKL_USRNAME" =>$datains['namahubin'],
								 "N_PKL_SCHOOL" =>$datains['namasekolah'],
								 "I_PKL_USRPHONE" =>$datains['notlp'],
								 "C_PKL_EDULVL" =>$datains['lvl'],
								 "F_PKL_USRSTAT" =>$datains['status'],
								 "C_PKL_USRPSWD" =>$datains['cpassword'],
								 "D_PKL_USRREGIS" =>$datains['today']);										
  
			$db->insert('DBADMIT.TRPKLUSR',$datasimpan);
			$db->commit(); 
			
			/* $namahubin=$data['namahubin'];
			$namasekolah=$data['namasekolah'];
			$emailhubin=$data['emailhubin'];
			$lvl=$data['lvl'];
			$notlp=$data['notlp'];
			$status=$data['status'];
			$cpassword=$data['cpassword'];
			$today=$data['today'];
			$currdate=new Zend_Db_Expr("to_date('$today','YYYY-MM-DD HH24:MI:SS')");
			
			$query ="INSERT INTO DBADMIT.TRPKLUSR (N_PKL_USRMAIL, N_PKL_USRNAME, N_PKL_SCHOOL, I_PKL_USRPHONE, C_PKL_EDULVL, F_PKL_USRSTAT, C_PKL_USRPSWD, D_PKL_USRREGIS) VALUES (:a, :b, :c, :d, :e, :f, :g, $currdate)";
					
			$stmt = $db->prepare($query);
			
			$stmt->bindParam(':a', $emailhubin);
			$stmt->bindParam(':b', $namahubin);
			$stmt->bindParam(':c', $namasekolah);
			$stmt->bindParam(':d', $notlp);
			$stmt->bindParam(':e', $lvl);
			$stmt->bindParam(':f', $status);
			$stmt->bindParam(':g', $cpassword);

			$stmt->execute();
			$db->commit(); */
			return 'sukses';
		} 
		catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage().'<br>';
			return 'gagal';
		}
	}
	
	public function insertTrwblsusr2(array $data){

		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
		try {
			$db->beginTransaction();
			
			$nama=$data['nama'];
			$namauniversitas=$data['namauniversitas'];
			$email=$data['email'];
			$lvl2=$data['lvl2'];
			$i_phone=$data['i_phone'];
			$n_status=$data['n_status'];
			$c_password=$data['c_password'];
			$currdate=$data['d_entry'];
			$currdate=new Zend_Db_Expr("to_date('$currdate','YYYY-MM-DD HH24:MI:SS')");

			$query ="INSERT INTO DBADMIT.TRPKLUSR (N_PKL_USRMAIL, N_PKL_USRNAME, N_PKL_SCHOOL, I_PKL_USRPHONE, C_PKL_EDULVL, F_PKL_USRSTAT, C_PKL_USRPSWD, D_PKL_USRREGIS) VALUES (:a, :b, :c, :d, :e, :f, :g, $currdate)";
					
			$stmt = $db->prepare($query);
			
			$stmt->bindParam(':a', $email);
			$stmt->bindParam(':b', $nama);
			$stmt->bindParam(':c', $namauniversitas);
			$stmt->bindParam(':d', $i_phone);
			$stmt->bindParam(':e', $lvl2);
			$stmt->bindParam(':f', $n_status);
			$stmt->bindParam(':g', $c_password);

			$stmt->execute();
			$db->commit();
			return 'sukses';
		} 
		catch (Exception $e) {
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
			
			$where = "N_PKL_USRMAIL = '".$email."' " ;
			
			$datasimpan = array("F_PKL_USRSTAT" => $flogin);	
								
			$db->update('DBADMIT.TRPKLUSR',$datasimpan, $where);
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
	
    public function cekTrpklusr($emailhubin) {
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	//var_dump($db_config);

			$query ="SELECT count(N_PKL_USRMAIL) as count FROM DBADMIT.TRPKLUSR where N_PKL_USRMAIL='".$emailhubin."'";
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

	public function findoldpassword($email,$oldpassword) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
			try {
		$db->setFetchMode(Zend_Db::FETCH_OBJ);
				$query ="SELECT COUNT(*) AS COUNT FROM DBADMIT.TRPKLUSR where N_PKL_USRMAIL='".$email."' AND C_PKL_USRPSWD='".$oldpassword."'";
				$result = $db->fetchOne($query);
			//var_dump($query);
				return $result;
			} catch (Exception $e) {
				echo $e->getMessage() . '<br>';
				return $e->getMessage(); //'Data tidak ada <br>';
			}
	}
	
	public function updatePassword($data) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$email = $data['email'];
			$password = $data['password'];
			$nilai = '1';

			$query ="UPDATE DBADMIT.TRPKLUSR SET C_PKL_USRPSWD=:b,F_PKL_USRSTAT=:c WHERE N_PKL_USRMAIL=:a";

			$stmt = $db->prepare($query);
			
			$stmt->bindParam(':a', $email);
			$stmt->bindParam(':b', $password);
			$stmt->bindParam(':c', $nilai);

			echo $query;
			$stmt->execute();
			$db->commit();
			
			// $where = "N_WBLS_USRMAIL = '".$email."' " ;
			// $datasimpan = array("C_WBLS_USRPSWD" => $password);	
			// $db->update('DBADMSI.TRWBLSUSR',$datasimpan, $where);
			// $db->commit(); 
			// var_dump($password);
			
			$_hasil = array(
				"rcNumber"=>"1",
				"rcDesc"  =>"Proses Sukses"
			);
			return 'sukses';
		} 
		catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage().'<br>';
			return 'gagal';
		}
	}
	
	public function LupaPassword($data) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$email = $data['email'];
			$cpassword = $data['cpassword'];

			$query ="UPDATE DBADMIT.TRPKLUSR SET C_PKL_USRPSWD=:b WHERE N_PKL_USRMAIL=:a";

			$stmt = $db->prepare($query);
			
			$stmt->bindParam(':a', $email);
			$stmt->bindParam(':b', $cpassword);

			echo $query;
			$stmt->execute();
			$db->commit();
			
			$_hasil = array(
				"rcNumber"=>"1",
				"rcDesc"  =>"Proses Sukses"
			);
			return 'sukses';
		} 
		catch (Exception $e) {
			$db->rollBack();
			echo $e->getMessage().'<br>';
			return 'gagal';
		}
	}
	
	public function GetDataHubin($logmail) { 
	$registry = Zend_Registry::getInstance();
	$db_config = $registry->get('db_config');
	$db = Zend_Db::factory('Oracle', $db_config);
        try {
	$db->setFetchMode(Zend_Db::FETCH_OBJ);
	    
	    $query ="SELECT N_PKL_USRMAIL, N_PKL_USRNAME,N_PKL_SCHOOL,I_PKL_USRPHONE FROM DBADMIT.TRPKLUSR where N_PKL_USRMAIL=:logmail";
	    $stmt = $db->prepare($query);	
	    $stmt->bindParam(':logmail', $logmail);
	    $db->beginTransaction();
	    $stmt->execute();	
            $result = $stmt->fetch();   	    
	    
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
	}
	
	public function updateData($data) {
		$registry = Zend_Registry::getInstance();
		$db_config = $registry->get('db_config');
		$db = Zend_Db::factory('Oracle', $db_config);
	   try {	
			$db->beginTransaction();
			
			$email = $data['email'];
			$nama = $data['nama'];
			$namasekolah = $data['namasekolah'];
			$notlp = $data['notlp'];
			
			$where = "N_PKL_USRMAIL = '".$email."' " ;
			
			$datasimpan = array("N_PKL_USRNAME" => $nama,
								"N_PKL_SCHOOL" => $namasekolah,
								"I_PKL_USRPHONE" => $notlp);	
								
			$db->update('DBADMIT.TRPKLUSR',$datasimpan, $where);
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