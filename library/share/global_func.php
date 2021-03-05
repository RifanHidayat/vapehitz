<?php

//include_once('sms/send-sms.php');

function cropImage($nw, $nh, $source, $stype, $dest) {
 
    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];
 
    switch($stype) {
        case 'gif':
        $simg = imagecreatefromgif($source);
        break;
        case 'jpg':
        $simg = imagecreatefromjpeg($source);
        break;
        case 'png':
        $simg = imagecreatefrompng($source);
        break;
    }
 
    $dimg = imagecreatetruecolor($nw, $nh);
 
    $wm = $w/$nw;
    $hm = $h/$nh;
 
    $h_height = $nh/2;
    $w_height = $nw/2;
 
    if($w> $h) {
 
        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;
 
        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
 
    } elseif(($w <$h) || ($w == $h)) {
 
        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;        
	imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
 
    } else {

        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
    }
 
    imagejpeg($dimg,$dest,100);
	chmod($dest, 0777);
}

/* function getDataKirim($tujuankirim, $userid, $password){
	$data['resetpassword'] = array("subject" => "Reset Password IPK Online",
									"isi" 	 => "Password Untuk User Id $userid direset menjadi :  $password");
									
	$data['daftarpencaker'] = array("subject" => "Pendaftaran Pencaker IPK Online",
									"isi" 	 => "Pendaftaran Pencaker Anda Dengan User ID: $userid, Berhasil");

	$data['daftarperusahaan'] = array("subject" => "Pendaftaran Perusahaan IPK Online",
									"isi" 	 => "Pendaftaran Perusahaan Anda Dengan User ID: $userid, Berhasil");

	return $data[$tujuankirim];
}
 */
function kirimEmail($masukan){
	try{
		
		/* $module	 = $masukan['module'];
		$nama		 = $masukan['nama'];
		$userid		 = $masukan['userid'];
		$password	 = $masukan['reset_password'];
		
		$email_ipkadmin	 = $masukan['email_ipkadmin'];
		$tujuanKirim = getDataKirim($module, $userid, $password);
		 */
		$subject = $tujuanKirim['subject'];
		$isi = $tujuanKirim['isi'];
		
		$header = 'From: '.$email_ipkadmin. "\r\n" .
				  'Reply-To: '.$email_ipkadmin. "\r\n" .
				  'X-Mailer: PHP/' . phpversion();		
				
		$to		 = $masukan['alamatemail'];
		$subject = $subject;
		$pesan	 = $isi;
		$headers = $header;
		
		//echo "$to <br> $subject <br> $pesan <br> $headers";
		if($to){
			mail($to, $subject, $pesan, $headers);
		}
		echo ' ';
		return "sukses";
	} catch (Exception $e) {
	 echo $e->getMessage().'<br>';
	 return 'gagal '.$e->getMessage();
	}	
}

function kirim_sms($masukan){
	$module		 = $masukan['module'];
	$nama		 = $masukan['nama'];
	$userid		 = $masukan['userid'];
	$password	 = $masukan['reset_password'];
	$noHP		 = $masukan['noHP'];
	
	$tujuanKirim = getDataKirim($module, $userid, $password);

	$isiPesan = $tujuanKirim['isi'];
	
	$hasil = sendSMS($noHP, $isiPesan);
	return $hasil;
}

?>