<?php
require_once 'Zend/Controller/Action.php';
require_once 'service/Regist_Service.php';
require_once "share/_lib/class.phpmailer.php";
require_once 'share/Portalconf.php';


class LoginController extends Zend_Controller_Action {

    public function init() {
        $registry = Zend_Registry::getInstance();
        $this->auth = Zend_Auth::getInstance();
		$this->Regist_Service = Regist_Service::getInstance();
	$sessionlogin = new Zend_Session_Namespace('sessionlogin');	
	$sessionlogin->setExpirationSeconds(9000) ;	
	//$this->Menu_Service = Menu_Service::getInstance();
	$this->view->userid = $sessionlogin->userid;
	$this->view->nama=$sessionlogin->nama;
	$this->view->auth=$sessionlogin->auth;
	$this->view->group = $sessionlogin->group;
	$this->view->email = $sessionlogin->email;
	$this->view->active = $sessionlogin->active;
	$this->view->permission = $sessionlogin->permission;
	}

    public function indexAction() {
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$this->view->permission = $sessionlogin->permission;
		
		$this->_helper->layout->setLayout('login-layout');
		
		$id = 'admin';
		$this->view->data=$this->Regist_Service->getData($id);
		
		$userid = 'admin';
		$this->view->dataLogin = $this->Regist_Service->findUserLogin($userid);
	}
	
	public function loginAction() {
		//$this->_helper->layout->setLayout('index-layout');//hendar
		$sessionlogin = new Zend_Session_Namespace('sessionlogin');
		$userid= isset($_POST['userid']) ? $_POST['userid'] : null;
		$password= isset($_POST['password']) ? $_POST['password'] : null;
		$pass=md5($password);
		/* $pass1=sha1($pass);
		$layer=encryptpass($userid);
		$pass1=$pass1.$layer; */
		//$this->view->userid1 = $userid;
		//$this->view->password1 = $password;
		$dataLogin = $this->Regist_Service->findUserLogin($userid);
		$password = $dataLogin[0]['password'];
		//$flogin = $dataLogin->F_PKL_USRSTAT;
	
		$clogin=1;
		$today=date("Y-m-j");
		if ($pass==$password){ 
			$sessionlogin->user_id=$dataLogin[0]['user_id'];
			$sessionlogin->email=$dataLogin[0]['email'];
			$sessionlogin->nama=$dataLogin[0]['nama'];
			$sessionlogin->group=$dataLogin[0]['group'];
			$sessionlogin->permission=$dataLogin[0]['permission'];
			
			if(!empty($_POST["remember"])) {
				setcookie ("member_login",$userid,time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
			}
			/* if ($flogin==0) {
				
				$sessionlogin->active=0;
					
			} else $sessionlogin->active=1;		 */

		// show a message of success and provide a true success variable
		} //else echo "Userid dan password tidak sesuai atau tidak terdaftar";
    }	
}