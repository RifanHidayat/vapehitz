<?
//include "eac_curl_stream/eac_curl.class.php";
class ldap_services{
// konfigurasi untuk server lokal
/*
	var $cfg 	= array("ldap_host"=>"127.0.0.1",
				"ldap_baseDN" => "cn=people,dc=bumn,dc=go,dc=id",
				"ldap_manager_user" => "cn=root,dc=bumn,dc=go,dc=id",
				"ldap_manager_pwd" => "admin"
				);
*/
// konfigurasi untuk server ldap karet

	/* var $cfg 	= array("ldap_host"=>"192.168.1.254",
				"ldap_baseDN" => "dc=ma,dc=go,dc=id"); */
				
	var $cfg 	= array("ldap_host"=>"192.168.17.199",
				"ldap_baseDN" => "dc=ma,dc=go,dc=id");
				/*,
				"ldap_manager_user" => "uid=rencana1,ou=people,dc=ma,dc=go,dc=id",
				"ldap_manager_pwd" => "rencana1"
				);*/

	var $pid, $ppwd, $user_id;
	// Constructor berisi parameter default yang selalu ada pada saat user me-request
	function services(){
		$this->pid 		= $_REQUEST[pid];
		$this->ppwd		= $_REQUEST[ppwd];
//		$this->user_id	= $_REQUEST[user_id];
		$this->user_id	= $_REQUEST[userid];
	}
	
	// method untuk melakukan koneksi ke server ldap menggunakan user login
	function koneksiLdap($dataMasukan){
		$ldap_manager_user	= $dataMasukan['userid'];
		$ldap_manager_pwd	= $dataMasukan['password'];
		//var_dump($dataMasukan);
		$cfg		= $this->cfg;
		$ldapconn 	= ldap_connect($cfg['ldap_host']) or die("Could not connect to " . $cfg['ldap_host']);
		
		if($ldap_manager_user != 'config'){
			$root 		= "uid=$ldap_manager_user,ou=people,".$cfg['ldap_baseDN']; //$cfg['ldap_manager_user'];
			$rootPwd 	= "$ldap_manager_pwd";  //$cfg['ldap_manager_pwd'];
		} else {
			$root 		= "cn=config";//,ou=people,dc=ma,dc=go,dc=id"; //$cfg['ldap_manager_user'];
			$rootPwd 	= "YCzzNgxIq";
		}
		
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		$hasil = ldap_bind($ldapconn, $root, $rootPwd);
		
		return $ldapconn;
	}
	
	
	
	// method untuk menampilkan response dari server berupa xml
	function showResult($status, $msg, $result){
		header("Content-type: text/xml\n");
			$s = '<'.'?'.'xml version="1.0"'.'?'.'>';
			$s .= "<reply>\n";
			$s .= "<status>$status</status>\n";
			$s .= "<msg>$msg</msg>\n";
			$s .= "<result>$result</result>";
			$s .= "</reply>\n";
		
		echo $s;
	}


/**********************************************************************************************
 * Method2 action ke server ldap
 **********************************************************************************************/
/**
 * Method untuk list dan search
 * Untuk list, bila yang me-request adalah admin utama, tampilkan admin sistam
 * 	       bila yang me-request adalah admin sistem, tampilkan user
 * Untuk search dibagi 2, yaitu search berdasarkan bumn_id dan username
 * 		Bila keywordnya kosong, maka tampil semua
 **/
	function searchUser($keyword){
		$cfg = $this->cfg;
		$ldap_manager_user	= "config"; //$dataMasukan['userid'];
		$ldap_manager_pwd	= "YCzzNgxIq"; //$dataMasukan['password'];
		$dataMasukankoneksildap = array("userid"	=> $ldap_manager_user,
										"password"	=> $ldap_manager_pwd);
		$ldapconn = $this->koneksiLdap($dataMasukankoneksildap);

		$search_DN = "ou=people,".$cfg['ldap_baseDN'];
		$search="(|(uid=$keyword*))";
		
		$ldapFilterAttributes =  array("cn", "sn", "uid");
		$sr=ldap_search($ldapconn, $search_DN, $search, $ldapFilterAttributes);
		
		$info = ldap_get_entries($ldapconn, $sr);	
		
		$jumUser = $info["count"];
		//echo "jml = $jumUser<br>";
		if($jumUser){
			for($x=0; $x<$jumUser; $x++){
				$hasil[$x] = $info[$x]['uid'][0];
			}
		}
		ldap_close($ldapconn);
		return $hasil;
	}
 
 /**
 *Method untuk menambah user ke server ldap
 */
	function addUser($dataMasukan){	
		// konfigurasi ldap
		$username = $dataMasukan['username'];
		$password = $dataMasukan['password'];
		
		$cfg 		= $this->cfg;
		$ldap_manager_user	= "config"; //$dataMasukan['userid'];
		$ldap_manager_pwd	= "YCzzNgxIq"; //$dataMasukan['password'];
		$dataMasukankoneksildap = array("userid"	=> $ldap_manager_user,
										"password"	=> $ldap_manager_pwd);
		$ldapconn = $this->koneksiLdap($dataMasukankoneksildap);
		
		$search_DN = "ou=people,".$cfg['ldap_baseDN'];
		
		//$r = ldap_bind($ds, "cn=$ldap_manager_user, $search_DN", $ldap_manager_pwd);
		
		// data2 profil user 
		$info["cn"] 		= $username;
		$info["uid"] 		= $username;
		$info["sn"] 		= $username?$username:'Nama Lengkap'; /* daniel 10/22/2008 */

	//	$pwd_md5 = crypt($password, 'rl');
		$pwd_md5=base64_encode(pack("H*", md5($password)));

		$info["userPassword"] 	= "{MD5}".$pwd_md5;

//		$info["userpassword"] 	= "{CRYPT}".$pwd_md5;
		$info["objectClass"] 	= "inetOrgPerson";
		
		 
		// add data to directory
		//if(@ldap_add($ldapconn, "cn=$username, ". $cfg['ldap_baseDN'] , $info)){
		
		//echo "cn=$username, ".$search_DN;	
		if(@ldap_add($ldapconn, "uid=$username,".$search_DN , $info)){
			$status = "sukses";
			$msg	= "Sukses Menambahkan User";
		}
		// bila username sudah ada, tampilkan pesan
		else if(ldap_errno($ldapconn) == 68){
			$status	= "Error";
			$msg 	= "Username sudah ada";
		}
		// bila error tampilkan pesan kesalahan
		else{
			$status	= "Error";
			$msg = "Error: " . ldap_error($ldapconn);
		}
		
		ldap_close($ldapconn);
		return $status." ".$msg;
	}

	function deleteUser($dataMasukan){
		$username = $dataMasukan['username'];
		
		$cfg 		= $this->cfg;
		$ldap_manager_user	= "config"; //$dataMasukan['userid'];
		$ldap_manager_pwd	= "YCzzNgxIq"; //$dataMasukan['password'];
		$dataMasukankoneksildap = array("userid"	=> $ldap_manager_user,
										"password"	=> $ldap_manager_pwd);
		$ldapconn = $this->koneksiLdap($dataMasukankoneksildap);
		$search_DN = "ou=people,".$cfg['ldap_baseDN'];
		
	
		// cari username di server ldap
		$justthese  = array();
		$search = "uid=$username, ou=people,".$cfg['ldap_baseDN'];
		
		if(ldap_delete($ldapconn, $search)){
			$status = "OK";
			$msg	= "Sukses menghapus $username";
		}
		else{
			$status = "Error";
			$msg	= ldap_error($ldapconn);
		}
		return $status." ".$msg;
	}

/**
 *Method untuk mengubah password user
 */
	//function chPwd($username, $oldpwd, $newpwd, $isEd= false){
	function chPwd($dataMasukan){
		$userid = $dataMasukan['userid'];
		$newpwd = $dataMasukan['newpwd'];
		$oldpwd = $dataMasukan['oldpwd'];
		
		$cfg	= $this->cfg;
		$ldap_manager_user	= "config"; //$dataMasukan['userid'];
		$ldap_manager_pwd	= "YCzzNgxIq"; //$dataMasukan['password'];
		$dataMasukankoneksildap = array("userid"	=> $ldap_manager_user,
										"password"	=> $ldap_manager_pwd);
		$ldapconn = $this->koneksiLdap($dataMasukankoneksildap);
		$search_DN = "ou=people,".$cfg['ldap_baseDN'];
		
		// cari username di server ldap
		$justthese  = array();
		$search = "uid=$username".$search_DN;

		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese);
		$info = ldap_get_entries($ldapconn, $sr);
		
		// bila user tsb tidak ada di server ldap tampilkan pesan error
		if($info["count"] == 0){
			$status = "error";
			$msg	= "Username tidak terdaftar";
		}
		else{

			$newPlain = $newpwd;
			$oldpwd ="{MD5}".base64_encode(pack("H*", md5($oldpwd)));
			$newpwd ="{MD5}".base64_encode(pack("H*", md5($newpwd)));

//			$oldpwd ="{CRYPT}".crypt($oldpwd, 'rl');
//			$newpwd ="{CRYPT}".crypt($newpwd, 'rl');

			if(($oldpwd == $info[0]['userpassword'][0]) || ($isEd == true && $newpwd)){
				$new["userpassword"][] = $newpwd;
				if(ldap_modify($ldapconn, $search, $new)){
					$status = "OK";
					$msg	= "Sukses mengubah password $username";
				} else{
					$status = "error";
					$msg	= "Gagal mengubah password $username";
					$content = "<username>$username</username>";	
				}
			} else{
				$status = "error";
				$msg	= "Password Lama Salah";
			}
		}
		return $status.$msg;
	} 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
/**
 *Method untuk menambahkan satu portal ke user
 */
	function addPortal($username, $portal){
		$cfg	= $this->cfg;
		$ldapconn = $this->koneksiLdap();
		
		// cari username di server ldap
		$justthese  = array();
		$search = "cn=$username";

		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese  );  
		$info = ldap_get_entries($ldapconn, $sr);
		
		// bila user tsb tidak ada di server ldap tampilkan pesan error
		if($info["count"] == 0){
			$status = "error";
			$msg	= "Username tidak terdaftar";
			
		}
		// bila portal sudah dapat diakses oleh user tampilkan pesan error
		else{
			$userPortals = $info[0]["businesscategory"];
			if(in_array($portal, $userPortals)){
				$status = "error";
				$msg	= "Portal $portal sudah dapat diakses oleh $username";
				
			}
			else{
		// tambahkan hak akses portal ke user
				for($i = 0; $i<$userPortals["count"];$i++){
					if($userPortals[$i] != 'na'){
					$portals["businesscategory"][] = $userPortals[$i];
					}
				}
					$portals["businesscategory"][] = $portal;
					
				if(ldap_modify($ldapconn, "cn=$username, ". $cfg['ldap_baseDN'], $portals)){
					$status = "OK";
					$msg	= "Sukses menambah hak akses portal $portal kepada $username";
				}
				else{
					$status = "Error";
					$msg	= ldap_error($ldapconn);
				}
			}
		}
		
		$this->showResult($status,$msg,"");
	}
/**
 *Method untuk edit profil user
 */
	function editUser($username, $email, $phone, $emp_id, $fullname){
		$cfg	= $this->cfg;
		$ldapconn = $this->koneksiLdap();
		
		// cari username di server ldap
		$justthese  = array();
		$search = "cn=$username";

		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese);
		$info = ldap_get_entries($ldapconn, $sr);
		
		// bila user tsb tidak ada di server ldap tampilkan pesan error
		if($info["count"] == 0){
			$status = "error";
			$msg	= "Username tidak terdaftar";
		}
		else{
			$email!=""?$new["mail"][]=$email:"";
			$phone!=""?$new["telephonenumber"][]=$phone:"";
			$fullname!=""?$new["sn"][]=$fullname:""; //daniel 11/13/2008
			// bila user dapat mengakses portal oa dan emp_id != null, edit emp_id
			if(in_array("oa",$info[0]["businesscategory"]) && $emp_id != ""){
				$new["employeetype"][] = $emp_id;
			}	
			
			if(ldap_modify($ldapconn, "cn=$username, ". $cfg['ldap_baseDN'], $new)){
				$status = "OK";
				$msg	= "Sukses mengubah profil $username";
			}
			else{
				$status = "Error";
				$msg	= ldap_error($ldapconn);
			}
			
		}
		
		$this->showResult($status,$msg,"");
	}
	
/**
 *Method untuk melihat detail user
*/
	function viewUser($username){
		$cfg	= $this->cfg;
		$ldapconn = $this->koneksiLdap();
		
		// cari username di server ldap
		$justthese  = array();
		$search = "cn=$username";

		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese);
		$info = ldap_get_entries($ldapconn, $sr);
		
		// bila user tsb tidak ada di server ldap tampilkan pesan error
		if($info["count"] == 0){
			$status = "error";
			$msg	= "Username tidak terdaftar";
		}
		else{
			$bumn_id = $info[0]["ou"][0];
			$email   = $info[0]["mail"][0];
			$phone	 = $info[0]["telephonenumber"][0];
			$level	 = $info[0]["employeetype"][0];
			$dpNo 	 = $info[0]["departmentnumber"][0];
			$fullname 	 = $info[0]["sn"][0];

			
			$content = "<username>$username</username>\n
				    <bumn_id>$bumn_id</bumn_id>\n
				    <dp_no>$dpNo</dp_no>\n
				    <email>$email</email>\n
				    <phone>$phone</phone>\n
				    <level>$level</level>\n
					<fullname>$fullname</fullname>\n
			        ";			    
			// portal 
			if($info[0]["businesscategory"]["count"] > 0)
			$content .= "<portal>";
			for($i=0;$i<$info[0]["businesscategory"]["count"];$i++){
				$portal = $info[0]['businesscategory'][$i];
				$content .="<list>\n
						<nama>$portal</nama>\n
						<url>http://$portal.bumn.go.id/</url>\n
					    </list>
					   ";
			}
			if($info[0]["businesscategory"]["count"] > 0)
			$content .= "</portal>";
			
			// bila password tidak null status = aktif
			if($info[0]["userpassword"][0] != ""){
				$content .= "<status>Aktif</status>";
			}
			else{
				$content .= "<status>Tidak Aktif</status>";
			}
			
			// bila ada oa di  maka tampilkan emp_id
			if(in_array("oa", $info[0]["businesscategory"])){
				$content .= "<emp_id>".$info[0]['employeenumber'][0]."</emp_id>";
			}
			
			
		}
		$this->showResult($status,$msg,$content);
	}
/**
 *Method untuk menghapus portal
 */
	function deletePortal($username, $portal){
		$cfg	= $this->cfg;
		$ldapconn = $this->koneksiLdap();
		
		// cari username di server ldap
		$justthese  = array();
		$search = "cn=$username";

		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese);
		$info = ldap_get_entries($ldapconn, $sr);
		
		// bila user tsb tidak ada di server ldap tampilkan pesan error
		if($info["count"] == 0){
			$status = "error";
			$msg	= "Username tidak terdaftar";
		}
		else if(in_array($portal, $info[0]["businesscategory"])){
			// bila hanya ada satu portal, isi  dengan na dan hapus password
			if($info[0]["businesscategory"]["count"] == 1 && $info[0]["businesscategory"][0] == $portal){
				$new["businesscategory"][] = "na";
					$pwd["userpassword"] = array();
					ldap_modify($ldapconn, "cn=$username, ". $cfg['ldap_baseDN'], $pwd);
			}
			else{
				for($i=0;$i<$info[0]["businesscategory"]["count"];$i++){
					if($info[0]["businesscategory"][$i] != $portal){
						$new["businesscategory"][] = $info[0]["businesscategory"][$i];
					}
				}	
			}
			
			if(ldap_modify($ldapconn, "cn=$username, ". $cfg['ldap_baseDN'], $new)){
				
				
				
				$status = "OK";
				$msg	= "Sukses menghapus hak akses ke portal $portal kepada $username";
			}
			else{
				$status = "Error";
				$msg	= ldap_error($ldapconn);
			}
		}
		else{
			$status = "error";
			$msg	= "Portal sudah tidak dapat diakses oleh $username";
		}
		$this->showResult($status,$msg,"");
	}
/**
 *Method untuk mendelete user dengan cara menghapus passwordnya
 */
	
	

/**
 *method untuk mereset password
 */
	function resPwd($username){
		$cfg	= $this->cfg;
		$ldapconn = $this->koneksiLdap();
		
		// cari username di server ldap
		$justthese  = array();
		$search = "cn=$username";

		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese);
		$info = ldap_get_entries($ldapconn, $sr);
		
		// bila user tsb tidak ada di server ldap tampilkan pesan error
		if($info["count"] == 0){
			$status = "error";
			$msg	= "Username tidak terdaftar";
			$content = "";
		}
		else{
//			$newpwd ="{MD5}".base64_encode(pack("H*", md5($username)));	
			$newPlain = substr(uniqid(""),5);

	//		$newpwd ="{CRYPT}".crypt($newPlain,'rl');
			$newpwd ="{MD5}".base64_encode(pack("H*", md5($newPlain)));	

			$new["userpassword"][]= $newpwd;
			
			$email = $info[0]["mail"][0];
			
			if(ldap_modify($ldapconn, "cn=$username, ". $cfg['ldap_baseDN'], $new)){				
				// kirim ke email
			//	ini_set("SMTP","smtp.telkom.net");
				ini_set("SMTP","mail.bumn.go.id");
				ini_set("sendmail_from","sekretariat@bumn.go.id");
				
				$to 		= $email;
				$subject	= "Perubahan kata kunci untuk ". $username;
				$msg		= "Password baru anda = ". $newPlain;
				$headers = 'From: sekretariat@bumn.go.id' . "\r\n" .
   					    'Reply-To: sekretariat@bumn.go.id' . "\r\n" .
   					    'X-Mailer: PHP/' . phpversion();
				

			$from = "Sekretariat Sistem Informasi Kementerian Negara BUMN <sekretariat@bumn.go.id>";
		       $to   = $info[0][mail][0];
			$subject	= "Perubahan kata kunci untuk   ". $username;
			
			$mailfrom	= "sekretariat@bumn.go.id";
		    	$mailheaders = "Return-Path: <sekretariat@bumn.go.id>\n";
			$mailheaders .= "From: $mailfrom\n";
			$mailheaders .= "Reply-To: $mailfrom\n";
//			$mailheaders .= "Cc: $cc\n";
//			$mailheaders .= "Bcc: $bcc\n";
			$msg_body = "Password baru anda = ". $newPlain;

/*
				$to 		= $info[0][mail][0];
				$subject	= "Perubahan kata kunci untuk   ". $username;
				$res		= "Password baru anda = ". $newPlain;
				$headers = 'From: sekretariat@bumn.go.id' . "\r\n" .
   					    'Reply-To: sekretariat@bumn.go.id' . "\r\n" .
   					    'X-Mailer: PHP/' . phpversion();
*/

//echo $to."<br/>". stripslashes($subject)."<br/>".$msg_body."<br/>".$mailheaders;
//exit;

				if (mail($to, stripslashes($subject), $msg_body, $mailheaders)) {
					$status = "OK";
					$msg	= "Sukses mereset password $username";
					$content = "<username>$username</username>";	
				}
				else{
					$status = "Error";
					$msg	= "gagal mengirim email ke $username";
				}
			}
			else{
				$status = "Error";
				$msg	= ldap_error($ldapconn);
				$content = "";
			}
		}

		$this->showResult($status,$msg,$content);
	}

	function authLogin($pid, $ppwd, $user_id){
		$cfg 		= $this->cfg;
		$ldapconn 	= $this->koneksiLdap();
		$auth = array("pkbl"=> md5("aplikasipkbl"),
					  "sdm" => md5("aplikasisdm"),
					  "oa"  => md5("aplikasioa"),
					  "eis" => md5("aplikasieis"),
					  "publik" => md5("aplikasipublik"),
					  "aset"   => md5("aplikasiaset")
					  );
		
		if($auth[$pid] == $ppwd){
				$justthese  = array();
				$search ="cn=$user_id";

				$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese  );  
				$info = ldap_get_entries($ldapconn, $sr);	

				if($info["count"] == 0){
					$status = "Error";
					$msg	= "User tidak terdaftar";
				}
				else{
					$status = "OK";
					$msg	= "User Valid";
					
					$content .= "<username>".$info[0]['cn'][0]."</username>\n";
					$content .= "<bumn_id>".$info[0]['ou'][0]."</bumn_id>\n";
					$content .= "<level>".$info[0]['employeetype'][0]."</level>\n";
					$content .= "<dp_no>".$info[0]['departmentnumber'][0]."</dp_no>\n";
					$content .= "<portal>";
					
					for($i=0;$i<$info[0]["businesscategory"]["count"];$i++){
						if($info[0]["businesscategory"][$i] == "pkbl"){	
							$content .="<list> 
						               <nama>".$info[0]["businesscategory"][$i]."</nama>
                                                                <url>http://".$info[0]["businesscategory"][$i].".bumn.go.id/internal/</url>
                                                                </list>";
						}
						else if($info[0]["businesscategory"][$i] == "publik"){
                                                        $content .="<list>
                                                               <nama>".$info[0]["businesscategory"][$i]."</nama>
                                                                <url>http://www.bumn.go.id/internal/</url>
                                                                </list>";
                                                }

		
						else if($info[0]["businesscategory"][$i] == "eis" || $info[0]["businesscategory"][$i] == "oa"){
							$content .="<list>
								<nama>".$info[0]["businesscategory"][$i]."</nama>
								<url>http://".$info[0]["businesscategory"][$i].".bumn.go.id/</url>					
								</list>";
						}
						else if($info[0]["businesscategory"][$i] != "eis"){
							$content .=strtolower("<list>
								<nama>".$info[0]["businesscategory"][$i]."</nama>
								<url>http://".$info[0]["businesscategory"][$i].".bumn.go.id/internal/</url>					
								</list>");
						}
					}
					$content .= "</portal>";
				}
		}
		else{
					$status = "Error";
					$msg	= "Portal id atau portal password salah";
		}
		
		// panggil method showResult untuk menampilkan xml
		$this->showResult($status,$msg, $content);
		
		ldap_close($ldapconn);
	}
	// list user yang tidak mempunyai hak akses di portal ybs
	function listNonMember($pid,$keyword, $level, $bumn, $offset = 0, $limit = 20){
		$cfg = $this->cfg;
		$ldapconn = $this->koneksiLdap();
		$justthese  = array();
		
		if($keyword){
			if($bumn){
				$search ="(&(cn=*$keyword*)(employeetype=$level)(ou=$bumn))";
			}else{
				$search ="(&(cn=*$keyword*)(employeetype=$level))";
			}
		}
		else{
			if($bumn){
				$search ="(&(ou=$bumn)(employeetype=$level))";
			}
			else{
				$search ="employeetype=$level";
			}
		}
		
		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese);
		$info = ldap_get_entries($ldapconn, $sr);
		
		$msg	= "List User non-" .$pid;
		
		/**
		 * Simpan nama user non member ke dalam variabel
		 */
		
		$j=0;
		for ($i=0; $i<$info[count]; $i++) {
			$portals = "";
			if(!in_array($pid,$info[$i]['businesscategory'])){
				foreach($info[$i]['businesscategory'] as $key => $portal){
					$portals .=$portal.",";
				}
				$portals = urlencode(substr(substr($portals,0,-1),2));
				
				$p[$j]["username"] = $info[$i]['cn'][0];
				$p[$j]["portals"]	 = $portals;
				$p[$j]["bumn_id"]	 = $info[$i]['ou'][0];

				
				$j++;
			}
			
		}
			$jumUser = count($p);
			// sisa modulus
			$margin	= $jumUser%$limit;
			$offset = $offset * $limit;		
			
			$content = "<jml_user>$jumUser</jml_user>";
			$content .= "<offset>".$offset / $limit."</offset>";
			$content .= "<limit>$limit</limit>";
			
			if(($offset + $limit) > $jumUser){
				$jumRec	= $offset + $margin;
			}
			else{
			 	$jumRec = $offset + $limit;
			}
			
			
			//echo "offset = ". $offset.", jumRec = ". $jumRec;
			for($i=$offset;$i<$jumRec;$i++){
				$content .= "<list>";
				$content .= "<username>".$p[$i]["username"]."</username>";
				$content .= "<aplikasi>".$p[$i]["portals"]."</aplikasi>";
				$content .= "<bumn_id>".$p[$i]["bumn_id"]."</bumn_id>";
				$content .= "</list>";
			}
			
		// panggil method showResult untuk menampilkan xml
		$this->showResult("OK",$msg, $content);
		
		ldap_close($ldapconn);
	}

	// method untuk mengecek ketersediaan keyword untuk dijadikan nama user
	function cekKeyword($keyword){
		$cfg = $this->cfg;
		$ldapconn = $this->koneksiLdap();
		$justthese = array();
		
		$search="cn=$keyword";
		
		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese);  
		$info = ldap_get_entries($ldapconn, $sr);
	
		if($info["count"] > 0){
			if(in_array($this->pid,$info[0]["businesscategory"]))
			{
				$this->showResult("Error","Username $keyword sudah ada di portal $this->pid", $content);
			}
			else{
				$this->showResult("Error","Username $keyword tidak dapat digunakan", $content);	
			}
		}
		else{
				$this->showResult("OK","Username $keyword dapat digunakan", $content);
		}	
	}
	
	// method untuk mencari bumn binaan berdasarkan user
	function userBumn($username)
	{	
		// cari dp_no
		$cfg = $this->cfg;
		$ldapconn = $this->koneksiLdap();
		$justthese = array();
		
		$search="cn=$username";
		
		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese);  
		$info = ldap_get_entries($ldapconn, $sr);
		
		$dp_no = $info[0]["departmentnumber"][0];
		
		if($info[count] == 1)
		{
		
			$pars = "ref=user_bumn&username=".$username."&dp_no=".$dp_no;
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://eis.bumn.go.id/services.php");
	//		curl_setopt($ch, CURLOPT_URL,"http://localhost/zulfy/beta-1.1/www/services.php");
			curl_setopt($ch, CURLOPT_HEADER, 0); 
			curl_setopt($ch, CURLOPT_POST, 1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $pars);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_VERBOSE, 1); 
			
			$data = curl_exec($ch);
			if (curl_errno($ch)) {
				echo "error curl: ";
				print curl_error($ch);
			} else {
				curl_close($ch);
			}
			$bumn_ids = explode(",",$data);
			
			$content = "<username>".$username."</username>
						<dp_no>".$dp_no."</dp_no>";		
			$content .= "<list>";
			
			foreach($bumn_ids as $bumn_id)
			{
				$content .= "<bumn_id>".$bumn_id."</bumn_id>";
			}
						
			$content .=	"</list>";
			
			$msg = "Sukses Mengambil Data Bumn Binaan";
				
			return $this->showResult("OK",$msg, $content);
		}
		else{
			return $this->showResult("Error","username ".$username ." tidak ditemukan", "");
		}
	}
	
	function editOrg($emp_id, $dp_no)
	{
		// cari emp_id
		$cfg = $this->cfg;
		$ldapconn = $this->koneksiLdap();
		$justthese = array();
		
		$search="employeenumber=$emp_id";
		
		$sr=ldap_search($ldapconn, $cfg['ldap_baseDN'], $search, $justthese);  
		$info = ldap_get_entries($ldapconn, $sr);
		
		if($info[count] > 0)
		{
			$a["departmentnumber"] = $dp_no;
			
			if(ldap_modify($ldapconn, "cn=".$info[0][cn][0].", ". $cfg['ldap_baseDN'], $a)){
							
				$this->showResult("OK","Sukses mengubah nomor organisasi kepada $emp_id", $content);
			}
			else
			{
				$this->showResult("Error","Gagal mengubah nomor organisasi kepada $emp_id", $content);		
			}
		}
		else
		{
				$this->showResult("Error","User tidak ditemukan ", $content);
		}
	}
}
?>
