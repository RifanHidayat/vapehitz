<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Gntpassword_Service.php';

class GntpasswordController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Gntpassword_Service = Gntpassword_Service::getInstance();
	$sessionlogin = new Zend_Session_Namespace('sessionlogin');
	$sessionlogin->setExpirationSeconds(9000) ;	
	$this->view->email = $sessionlogin->email;
	$this->view->nama = $sessionlogin->nama;
	$this->view->user_id = $sessionlogin->user_id;
	$this->view->permission = $sessionlogin->permission;
	}

    public function indexAction() {
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
        $this->_helper->layout->setLayout('gntpassword-layout');
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->Gntpassword_Service = $this->Gntpassword_Service;
		
		$this->view->data = $this->Gntpassword_Service->getlistliquid();
		$this->view->menu = $this->Gntpassword_Service->getmenu();
		$this->view->group  = $this->Gntpassword_Service->getGroup();
		$this->view->user_id = $sessionlogin->user_id;
    }
	
	public function cekdatapasswordAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$user_id = '';
		$oldpassword = '';
		
		if(isset($_REQUEST['user_id'])){ $user_id = $_REQUEST['user_id'];}
		if(isset($_REQUEST['oldpassword'])){ $oldpassword = $_REQUEST['oldpassword'];}
		
		$oldpassword=md5($oldpassword);
		
		$this->view->password = $this->Gntpassword_Service->getDataPassword($user_id,$oldpassword);
	}
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Gntpassword_Service = $this->Gntpassword_Service;
		
		$this->view->supplier=$this->Gntpassword_Service->getSupplier();
		$this->view->rasa=$this->Gntpassword_Service->getRasa();
		$this->view->seq=$this->Gntpassword_Service->getNoSeq();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('gntpassword-layout');
		
		$user_id 	 = '';
		$password	 = '';
		
		if(isset($_POST['user_id'])){ $user_id = $_POST['user_id'];}
		if(isset($_POST['password'])){ $password = $_POST['password'];}
		
		$password=md5($password);
		
		$data = array('user_id' => $user_id,
					  'password' => $password); 
		
		$this->view->datainsert=$this->Gntpassword_Service->editdata($data);
			
   }
   
   public function hapusdataAction(){
		$user_id = '';
		
		if(isset($_REQUEST['user_id'])){ $user_id = $_REQUEST['user_id'];}
		
		$dataInput = array('user_id' => $user_id);
		$hasil = $this->Gntpassword_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
		$this->_helper->layout->setLayout('target-column');
		
		$this->view->group  = $this->Gntpassword_Service->getGroup();
		
        $user_id = '';
		if(isset($_REQUEST['user_id'])){ $user_id = $_REQUEST['user_id'];}
		
		$this->view->data=$this->Gntpassword_Service->getUser($user_id);
		
		$this->view->Gntpassword_Service = $this->Gntpassword_Service;
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('gntpassword-layout');
		
		$kode_supplier 	 = '';
		$nama		     = '';
		$user_id 	 = '';
		$merk_barang 	 = '';
		$nama_barang 	 = '';
		$kode_rasa	 	 = '';
		$nic		 	 = '';
		$berat 	  		 = '';
		$stok_pusat  	 = '';
		$stok_retail 	 = '';
		$stok_studio 	 = '';
		$bad_stock    	 = '';
		$harga_beli  	 = '';
		$hj_agen 	  	 = '';
		$hj_retail 	  	 = '';
		$hj_whs 		 = '';
		$email 		 = '';
		
		if(isset($_POST['kode_supplier2'])){ $kode_supplier = $_POST['kode_supplier2'];}
		if(isset($_POST['nama'])){ $nama = $_POST['nama'];}
		if(isset($_POST['user_id'])){ $user_id = $_POST['user_id'];}
		if(isset($_POST['merk_barang'])){ $merk_barang = $_POST['merk_barang'];}
		if(isset($_POST['nama_barang'])){ $nama_barang = $_POST['nama_barang'];}
		if(isset($_POST['kode_rasa'])){ $kode_rasa = $_POST['kode_rasa'];}
		if(isset($_POST['nic'])){ $nic = $_POST['nic'];}
		if(isset($_POST['berat'])){ $berat = $_POST['berat'];}
		if(isset($_POST['stok_pusat'])){ $stok_pusat = $_POST['stok_pusat'];}
		if(isset($_POST['stok_retail'])){ $stok_retail = $_POST['stok_retail'];}
		if(isset($_POST['stok_studio'])){ $stok_studio = $_POST['stok_studio'];}
		if(isset($_POST['bad_stock'])){ $bad_stock = $_POST['bad_stock'];}
		if(isset($_POST['harga_beli'])){ $harga_beli = $_POST['harga_beli'];}
		if(isset($_POST['hj_agen'])){ $hj_agen = $_POST['hj_agen'];}
		if(isset($_POST['hj_retail'])){ $hj_retail = $_POST['hj_retail'];}
		if(isset($_POST['hj_whs'])){ $hj_whs = $_POST['hj_whs'];}
		if(isset($_POST['email'])){ $email = $_POST['email'];}
		
		$harga_beli = str_replace(".", "", $harga_beli);
		$hj_agen 	= str_replace(".", "", $hj_agen);
		$hj_retail 	= str_replace(".", "", $hj_retail);
		$hj_whs 	= str_replace(".", "", $hj_whs);
		
		$data = array('kode_supplier' => $kode_supplier,
					  'nama' => $nama,
					  'user_id' => $user_id,
					  'merk_barang' => $merk_barang,
					  'nama_barang' => $nama_barang,
					  'kode_rasa' => $kode_rasa,
					  'nic' => $nic,
					  'berat' => $berat,
					  'stok_pusat' => $stok_pusat,
					  'stok_retail' => $stok_retail,
					  'stok_studio' => $stok_studio,
					  'bad_stock' => $bad_stock,
					  'harga_beli' => $harga_beli,
					  'hj_agen' => $hj_agen,
					  'hj_retail' => $hj_retail,
					  'hj_whs' => $hj_whs,
					  'email' => $email); 
		
		$this->view->datainsert=$this->Gntpassword_Service->editdata($data);
   }
 
	public function cekseqAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$id_user_id = '';
		if(isset($_REQUEST['id_user_id'])){ $id_user_id = $_REQUEST['id_user_id'];}
		
		$this->view->id_user_id = $this->Gntpassword_Service->getSeq($id_user_id);
	}
 
}