<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Home_Service.php';
require_once 'service/Groups_Service.php';

class GroupsController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
        $this->Home_Service = Home_Service::getInstance();
		$this->Groups_Service = Groups_Service::getInstance();
	$sessionlogin = new Zend_Session_Namespace('sessionlogin');
	$sessionlogin->setExpirationSeconds(9000) ;	
	$this->view->email = $sessionlogin->email;
	$this->view->nama = $sessionlogin->nama;
	$this->view->active = $sessionlogin->active;
	$this->view->permission = $sessionlogin->permission;
	}

    public function indexAction() {
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
        $this->_helper->layout->setLayout('groups-layout');
		
		$this->view->Groups_Service = $this->Groups_Service;
		
		$this->view->data = $this->Groups_Service->getlistgroups();
		$this->view->menu = $this->Groups_Service->getmenu();
    }
	
	public function tambahdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Groups_Service = $this->Groups_Service;
		
		$this->view->supplier=$this->Groups_Service->getSupplier();
		$this->view->jenis=$this->Groups_Service->getJenis();
		$this->view->rasa=$this->Groups_Service->getRasa();
		$this->view->seq=$this->Groups_Service->getNoSeq();
    }
	
	public function kirimdataAction() { 
		$this->_helper->layout->setLayout('groups-layout');
		
		$group_name  = '';
		$permission = '';
		
		if(isset($_POST['group_name'])){ $group_name = $_POST['group_name'];}
		if(isset($_POST['permission'])){ $permission = $_POST['permission'];}
		
		$permission = serialize($permission);
		
		$data = array('group_name' => $group_name,
					  'permission' => $permission); 
		//var_dump($data);
		$this->view->datainsert=$this->Groups_Service->insertdata($data);
   }
   
   public function hapusdataAction(){
		$id = '';
		
		if(isset($_REQUEST['id'])){ $id = $_REQUEST['id'];}
		
		$dataInput = array('id' => $id);
		$hasil = $this->Groups_Service->hapusData($dataInput);

		if ($hasil == 'sukses') {
			$this->view->pesan = 'Data Berhasil Dihapus';
		}
		/* $this->indexAction();
		$this->render('index'); */
	}
	
	public function editdataAction() {
        $this->_helper->layout->setLayout('target-column');
		
		$this->view->Groups_Service = $this->Groups_Service;
		
		$id   = $_GET['id'];
		$this->view->kode_aksesoris_data = $id;
		
		$this->view->data=$this->Groups_Service->getDataGroup($id);
		
    }
	
	public function kirimdataeditAction() { 
	
		$this->_helper->layout->setLayout('groups-layout');
		
		$id = '';
		$group_name = '';
		$permission = '';
		
		if(isset($_POST['id'])){ $id = $_POST['id'];}
		if(isset($_POST['group_name'])){ $group_name = $_POST['group_name'];}
		if(isset($_POST['permission'])){ $permission = $_POST['permission'];}
		
		$permission = serialize($permission);
		
		$data = array('id' => $id,
					  'group_name' => $group_name,
					  'permission' => $permission); 
		
		$this->view->datainsert=$this->Groups_Service->editdata($data);
   }
   
   public function cekseqAction(){
		$this->_helper->layout->setLayout('target-column');
		
		$id_kode_barang = '';
		if(isset($_REQUEST['id_kode_barang'])){ $id_kode_barang = $_REQUEST['id_kode_barang'];}
		
		$this->view->id_kode_barang = $this->Groups_Service->getSeq($id_kode_barang);
	}
 
}