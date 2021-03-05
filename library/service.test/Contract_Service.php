<?php

class Contract_Service {

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


	public function insertTmtargetcontprod(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		//$password = MD5($data['n_userid']);
		
	    $insdata = array('i_product'  	=> $data['i_product'], 
					   'n_customer' 	=> $data['n_customer'],
					   'v_unit' 	=> $data['v_unit'],
					   'v_prodcont_tw1' 	=> $data['v_prodcont_tw1'],
					   'v_prodcont_tw2' 	=> $data['v_prodcont_tw2'],
					   'v_prodcont_tw3' 	=> $data['v_prodcont_tw3'],
					   'v_prodcont_tw4' 	=> $data['v_prodcont_tw4'],
					   'n_year' => $data['n_year'],
					   'i_entry' 	=> $data['i_entry'],
					   'd_entry' 		=> $data['d_entry']);
		
		$db->insert('expro.tmtargetcontprod',$insdata);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}

	public function insertTmtargetcontserv(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		//$password = MD5($data['n_userid']);
		
	    $insdata = array('i_service'  	=> $data['i_service'], 
					   'c_category' 	=> $data['c_category'],
					   'c_sub_category' 	=> $data['c_sub_category'],
					   'v_servcont_tw1' 	=> $data['v_servcont_tw1'],
					   'v_servcont_tw2' 	=> $data['v_servcont_tw2'],
					   'v_servcont_tw3' 	=> $data['v_servcont_tw3'],
					   'v_servcont_tw4' 	=> $data['v_servcont_tw4'],
					   'n_year'		=> $data['n_year'],
					   'i_entry' 		=> $data['i_entry'],
					   'd_entry' 		=> $data['d_entry']);
		
		$db->insert('expro.tmtargetcontserv',$insdata);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
	public function insertTmtargetcontsubs(array $data){
		$registry = Zend_Registry::getInstance();
		$db = $registry->get('db');
		try {
	    $db->beginTransaction();
		
		//$password = MD5($data['n_userid']);
		
	    $insdata = array('i_subsidiaries'  	=> $data['i_subsidiaries'], 
					   'v_subscont_tw1' 	=> $data['v_subscont_tw1'],
					   'v_subscont_tw2' 	=> $data['v_subscont_tw2'],
					   'v_subscont_tw3' 	=> $data['v_subscont_tw3'],
					   'v_subscont_tw4' 	=> $data['v_subscont_tw4'],
					   'n_year'		=> $data['n_year'],
					   'i_entry' 		=> $data['i_entry'],
					   'd_entry' 		=> $data['d_entry']);
		
		$db->insert('expro.tmtargetcontsubs',$insdata);
		$db->commit();
	    return 'sukses';
	   } catch (Exception $e) {
	 $db->rollBack();
	 echo $e->getMessage().'<br>';
	     return 'gagal';
	   }
	}
/* CREATED BY RICKY*/

   public function getAllProductContract() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            /* $query ='SELECT A.n_product, A.n_type, B.n_customer, B.v_unit, B.v_price,B.d_contract, B.e_activity, B.e_note, B.e_activity
				FROM tmproduct A, tmtargetcontprod B where A.i_product=B.i_product  ORDER BY A.i_product'; */
			$query ='SELECT A.i_product, A.n_product, A.n_type, B.n_customer, B.v_unit, 
					 B.v_prodcont_tw1, B.i_cont_prod, B.v_prodcont_tw2, B.v_prodcont_tw3,B.v_prodcont_tw4,
					 B.n_year, B.e_activity, B.e_note, B.e_activity, B.c_status
					 FROM expro.tmproduct A, expro.tmtargetcontprod B where A.i_product=B.i_product  
					 ORDER BY B.i_cont_prod ASC';
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getAllServiceContract() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            /* $query ='SELECT A.i_service, A.n_service, A.e_serv_detail, A.c_category,
					 B.v_realization, B.i_cont_serv, B.c_category, B.c_status, B.e_note, B.n_year,
					 B.v_servcont_tw1, B.v_servcont_tw2, B.v_servcont_tw3, B.v_servcont_tw4,
					 (B.v_servcont_tw1 + B.v_servcont_tw2 + B.v_servcont_tw3 + B.v_servcont_tw4) as jumlah
					 FROM expro.tmservice A, expro.tmtargetcontserv B where A.i_service=B.i_service AND B.c_category IN (1,2)
					 ORDER BY A.i_service'; */
			$query ="SELECT A.i_service, A.n_service, A.e_serv_detail, A.c_category,
					 B.v_realization, B.i_cont_serv, B.c_category, B.c_status, B.e_note, B.n_year,
					 B.v_servcont_tw1, B.v_servcont_tw2, B.v_servcont_tw3, B.v_servcont_tw4,
					 (B.v_servcont_tw1 + B.v_servcont_tw2 + B.v_servcont_tw3 + B.v_servcont_tw4) as jumlah
					 FROM expro.tmservice A, expro.tmtargetcontserv B where A.i_service=B.i_service 
					 AND A.n_service != 'MN1' AND  A.n_service != 'MN2' AND A.n_service != 'MN3' AND A.n_service != 'MN4' 
					 ORDER BY B.i_cont_serv ASC";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	public function getAllServiceContract2() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT A.i_service, A.n_service, A.e_serv_detail, A.c_category,
					 B.v_realization, B.i_cont_serv, B.c_category, B.c_status, B.e_note, B.n_year,
					 B.v_servcont_tw1, B.v_servcont_tw2, B.v_servcont_tw3, B.v_servcont_tw4, B.c_sub_category,
					 (B.v_servcont_tw1 + B.v_servcont_tw2 + B.v_servcont_tw3 + B.v_servcont_tw4) as jumlah
					 FROM expro.tmservice A, expro.tmtargetcontserv B where A.i_service=B.i_service 
					 AND (A.n_service = 'MN1' OR  A.n_service = 'MN2' OR A.n_service = 'MN3' OR A.n_service = 'MN4') 
					 ORDER BY B.i_cont_serv ASC ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function EditStatusProdCont($dataInput) {
	   $registry = Zend_Registry::getInstance();
	   $db = $registry->get('db');
	   $currDate = new Zend_Db_Expr('NOW()');
	   try {	
			$db->beginTransaction();
			
			$i_product = $dataInput['i_product'];
			$i_cont_prod = $dataInput['i_cont_prod'];
			$c_status = $dataInput['c_status'];
			
			$where = "i_product = '".$i_product."' AND i_cont_prod = '".$i_cont_prod."' " ;
			
			$datasimpan = array("c_status" => $c_status);	
								
			$db->update('expro.tmtargetcontprod',$datasimpan, $where);
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
	
	public function EditStatusServCont($dataInput) {
	   $registry = Zend_Registry::getInstance();
	   $db = $registry->get('db');
	   $currDate = new Zend_Db_Expr('NOW()');
	   try {	
			$db->beginTransaction();
			
			$i_service = $dataInput['i_service'];
			$i_cont_serv = $dataInput['i_cont_serv'];
			$c_status2 = $dataInput['c_status2'];
			
			$where = "i_service = '".$i_service."' AND i_cont_serv = '".$i_cont_serv."' " ;
			
			$datasimpan = array("c_status" => $c_status2);	
								
			$db->update('expro.tmtargetcontserv',$datasimpan, $where);
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
	
	public function EditStatusServCont2($dataInput) {
	   $registry = Zend_Registry::getInstance();
	   $db = $registry->get('db');
	   $currDate = new Zend_Db_Expr('NOW()');
	   try {	
			$db->beginTransaction();
			
			$c_sub_category = $dataInput['c_sub_category'];
			$c_status3 = $dataInput['c_status3'];
			
			$where = "c_sub_category = '".$c_sub_category."' " ;
			
			$datasimpan = array("c_status" => $c_status3);	
								
			$db->update('expro.tmtargetcontserv',$datasimpan, $where);
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
	
	public function EditProdCont($dataInput) {
	   $registry = Zend_Registry::getInstance();
	   $db = $registry->get('db');
	   $currDate = new Zend_Db_Expr('NOW()');
	   try {	
			$db->beginTransaction();
			
			$i_product 		= $dataInput['i_product'];
			$i_cont_prod 	= $dataInput['i_cont_prod'];
			$tarkon 		= $dataInput['tarkon'];
			$v_prodcont_tw1 = $dataInput['v_prodcont_tw1'];
			$v_prodcont_tw2 = $dataInput['v_prodcont_tw2'];
			$v_prodcont_tw3 = $dataInput['v_prodcont_tw3'];
			$v_prodcont_tw4 = $dataInput['v_prodcont_tw4'];
			//var_dump($v_prodcont_tw2);
			$where = "i_product = '".$i_product."' AND i_cont_prod = '".$i_cont_prod."' " ;
			
			if ($v_prodcont_tw1 != '0'){
				$datasimpan = array("v_prodcont_tw1" => $tarkon);
			} else if ($v_prodcont_tw2 != '0'){
				$datasimpan = array("v_prodcont_tw2" => $tarkon);
			} else if ($v_prodcont_tw3 != '0'){
				$datasimpan = array("v_prodcont_tw3" => $tarkon);
			} else if ($v_prodcont_tw4 != '0'){
				$datasimpan = array("v_prodcont_tw4" => $tarkon);
			}
				
								
			$db->update('expro.tmtargetcontprod',$datasimpan, $where);
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
	
	public function EditProdCont2($dataInput) {
	   $registry = Zend_Registry::getInstance();
	   $db = $registry->get('db');
	   $currDate = new Zend_Db_Expr('NOW()');
	   try {	
			$db->beginTransaction();
			
			$i_product 		= $dataInput['i_product'];
			$i_cont_prod 	= $dataInput['i_cont_prod'];
			$tarsign 		= $dataInput['tarsign'];
			$tarkon 		= $dataInput['tarkon'];
			$v_prodcont_tw1 = $dataInput['v_prodcont_tw1'];
			$v_prodcont_tw2 = $dataInput['v_prodcont_tw2'];
			$v_prodcont_tw3 = $dataInput['v_prodcont_tw3'];
			$v_prodcont_tw4 = $dataInput['v_prodcont_tw4'];
			//var_dump($v_prodcont_tw2);
			$where = "i_product = '".$i_product."' AND i_cont_prod = '".$i_cont_prod."' " ;
			
			if ($tarsign == 'Tw-I'){
				$datasimpan = array("v_prodcont_tw1" => $tarkon,
									"v_prodcont_tw2" => '0',
									"v_prodcont_tw3" => '0',
									"v_prodcont_tw4" => '0');
			} else if ($tarsign == 'Tw-II'){
				$datasimpan = array("v_prodcont_tw1" => '0',
									"v_prodcont_tw2" => $tarkon,
									"v_prodcont_tw3" => '0',
									"v_prodcont_tw4" => '0');
			} else if ($tarsign == 'Tw-III'){
				$datasimpan = array("v_prodcont_tw1" => '0',
									"v_prodcont_tw2" => '0',
									"v_prodcont_tw3" => $tarkon,
									"v_prodcont_tw4" => '0');
			} else if ($tarsign == 'Tw-IV'){
				$datasimpan = array("v_prodcont_tw1" => '0',
									"v_prodcont_tw2" => '0',
									"v_prodcont_tw3" => '0',
									"v_prodcont_tw4" => $tarkon);
			}
								
			$db->update('expro.tmtargetcontprod',$datasimpan, $where);
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
	
	public function EditProdUnit($dataInput) {
	   $registry = Zend_Registry::getInstance();
	   $db = $registry->get('db');
	   $currDate = new Zend_Db_Expr('NOW()');
	   try {	
			$db->beginTransaction();
			
			$i_product 		= $dataInput['i_product'];
			$i_cont_prod 	= $dataInput['i_cont_prod'];
			$v_unit 		= $dataInput['v_unit'];
			//var_dump($v_prodcont_tw2);
			$where = "i_product = '".$i_product."' AND i_cont_prod = '".$i_cont_prod."' " ;
			
				$datasimpan = array("v_unit" => $v_unit);
				
			$db->update('expro.tmtargetcontprod',$datasimpan, $where);
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
	
	public function EditServCont($dataInput) {
	   $registry = Zend_Registry::getInstance();
	   $db = $registry->get('db');
	   $currDate = new Zend_Db_Expr('NOW()');
	   try {	
			$db->beginTransaction();
			
			$i_service = $dataInput['i_service'];
			$i_cont_serv = $dataInput['i_cont_serv'];
			$jumlah = $dataInput['jumlah'];
			
			$where = "i_service = '".$i_service."' AND i_cont_serv = '".$i_cont_serv."' " ;
			
			$hasilbagi = $jumlah / 4;
			
			$datasimpan = array("v_servcont_tw1" => $hasilbagi,
								"v_servcont_tw2" => $hasilbagi,
								"v_servcont_tw3" => $hasilbagi,
								"v_servcont_tw4" => $hasilbagi);	
								
			$db->update('expro.tmtargetcontserv',$datasimpan, $where);
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