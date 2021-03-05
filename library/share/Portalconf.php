<?php
date_default_timezone_set('Asia/Jakarta');
/*mendefinisikan libs_dir sebagai ABSOLUTE PATH*/
define('libs_dir', dirname(__FILE__)."/");
// Base path
define('BASE_PATH', dirname(__FILE__)."/");
/*hostname*/
global $revise;
global $volume;
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$save_path="../../temp";
$path_file="data_doc/";
$path_file_ori="data_ori/";
$path_file2="data_doc2/";
$path_form242="data_form242/";
$path_coverpage="data_coverpage/";
$path_temp="data_temp/";
$path_pide="data_pide/";
$path_pide_excel="excel_pide/";
$path_drawing="data_drawing/";
$path_modification="data_mod/";
$path_drawing2d="data_drawing2d/";
$path_catia2d="data_catia2d/";
$path_catia3d="data_catia3d/";
$path_others="data_others/";
$path_sdd="data_sdd/";
$path_sac="data_sac/";
$path_draw_rar="data_drawing_rar/";
$path_pdf3d="data_pdf3d/";

/*fungsi untuk redirect*/
function dt_redirect($location) {
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header ("Location:http://$host$uri/$location");
}
function html_redirect($location, $time = 0){
    echo '<meta http-equiv="refresh" content="'.$time.'; url='.$location.'"/>';
}
function curPageURL() {
 $pageURL = "";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 //return substr($pageURL, 0, -1);
 return $pageURL;
}
function dt_redirect2($location) {
	header ("Location:http://$location");
	}
function returnBulan2($bulan)
    {  
    switch($bulan)
    {
    case "01":
    $bulannya="Januari";
    break;
    case "02";
    $bulannya="Februari";
    break;
    case "03":
    $bulannya="Maret";
    break;
    case "04":
    $bulannya="April";
    break;
    case "05":
    $bulannya="Mei";
    break;
    case "06":
    $bulannya="Juni";
    break;
	case "07":
    $bulannya="Juli";
    break;
	case "08":
    $bulannya="Agustus";
    break;
	case "09":
    $bulannya="September";
    break;
	case "10":
    $bulannya="Oktober";
    break;	
	case "11":
    $bulannya="Nopember";
    break;	
	case "12":
    $bulannya="Desember";
    break;
    }
	
	return $bulannya;
    }  	
function returnBulan($bulan)
    {  
    switch($bulan)
    {
    case "01":
    $bulannya="Jan";
    break;
    case "02";
    $bulannya="Feb";
    break;
    case "03":
    $bulannya="Mar";
    break;
    case "04":
    $bulannya="Apr";
    break;
    case "05":
    $bulannya="May";
    break;
    case "06":
    $bulannya="Jun";
    break;
	case "07":
    $bulannya="Jul";
    break;
	case "08":
    $bulannya="Aug";
    break;
	case "09":
    $bulannya="Sep";
    break;
	case "10":
    $bulannya="Oct";
    break;	
	case "11":
    $bulannya="Nov";
    break;	
	case "12":
    $bulannya="Dec";
    break;
    }
	
	return $bulannya;
    }  	
/*fungsi format ulang tanggal dari dd-mm-yyyy ked dd/mm/yyyy*/
function NewformatDate($value)    {  
     list($tgl,$bulan,$xtahun,)=explode("-",$value);
    $tahun=substr($xtahun,0,4);
    $tglbaru=$tgl."/".$bulan."/".$tahun;;
    return $tglbaru;
    }
/*fungsi format ulang tanggal dari yyyy-mm-dd ked dd/mm/yyyy*/
function formatDate($value)    {  
     list($tgl,$bulan,$xtahun,)=explode("-",$value);
    $tahun=substr($xtahun,0,4);
    $tglbaru=$tgl." ".returnBulan2($bulan)." ".$tahun;
    return $tglbaru;
    }
function formatDatez($value)    {  
    list($tahun,$bulan,$tgl)=explode("-",$value);  
    $tglbaru=$tgl." ".returnBulan2($bulan)." ".$tahun;
    return $tglbaru;
    }
function formatDateplus3($value)    {  
    list($tahun,$bulan,$tgl)=explode("-",$value);  
    $tahunbaru=$tahun+3;
    $tglbaru=$tahunbaru."-".$bulan."-".$tgl;
    return $tglbaru;
    }    
/*fungsi format ulang tanggal dari yyyy-mm-dd H:i:s ke dd-mm-yyyy | H:i*/
function formatDate2($value)    {  
     list($bulan,$tahun,)=explode("-",$value);
    $tglbaru=returnBulan2($bulan)." ".$tahun;
    return $tglbaru;
    }
function formatDateTime($value)   {  
    list($tahun,$bulan,$xtgl)=explode("-",$value);
    $tgl=substr($xtgl,0,2);
    $xtime=substr($value,11,5);
    $tglbaru=$tgl."/".$bulan."/".$tahun." ".$xtime;
    return $tglbaru;
    }
function formatDateBlnThn($value)   {  
    list($bulan,$tahun)=explode("-",$value);
    $tglbaru=$tahun."-".$bulan;
    return $tglbaru;
    }	
/*fungsi format ulang tanggal dari yyyy-mm-dd H:i:s ke dd-mm-yyyy | H:i*/
function formatDateChat($value)   {  
    list($tahun,$bulan,$xtgl)=explode("-",$value);
    $tgl=substr($xtgl,0,2);
	$tanggal=$tgl."-".$bulan."-".$tahun;
	$strtanggal=strtotime($tanggal);
	$strdate=strtotime(date("j-m-Y"));
	$diff=date("j-m-Y")-$tanggal;
    $tgl2=$tgl." ".returnBulan($bulan)." ".$tahun;
    $xtime=substr($value,11,8);
    list($jam,$mnt,$det)=explode(":",$xtime);
	if ($tanggal==date("j-m-Y")) $tglbaru=" <i>".$jam.":".$mnt."</i>";
	else if ($diff==1) $tglbaru="Yesterday <i>".$jam.":".$mnt."</i>";
    else $tglbaru=$tgl2." <i>".$jam.":".$mnt."</i>";
    return $tglbaru;
    }
	
	
/* fungsi format ulang tanggal dari yyyy-mm-dd ke  dd/mm/yyyy */
function formatDate3($value)    {  
     list($tgl,$bulan,$tahun)=explode("-",$value);  
    $tglbaru=$tgl."/".$bulan."/".$tahun;
    return $tglbaru;
    }
/* fungsi format ulang tanggal dari yyyy-mm-dd ke  dd/mm/yyyy */
function formatDateSlash($value)    {  
    list($tahun,$bulan,$tgl)=explode("/",$value);  
    $tglbaru=$tgl."/".$bulan."/".$tahun;
    return $tglbaru;
    }
/* fungsi format ulang tanggal dari dd-mm-yyyy ke yyyy-mm-dd */
function reformatDate($value)     {  
      list($tgl,$bulan,$tahun)=explode("-",$value);  	
      $tglbaru=$tahun."-".$bulan."-".$tgl;
	return $tglbaru;
    }
/* fungsi format ulang tanggal dari dd-mm-yyy ke yyyy-mm-dd */
function reformatDate2($value)    {  
   list($tgl,$bulan,$tahun)=explode("-",$value); 
    $tglbaru=$tahun."-".$bulan."-".$tgl;
    return $tglbaru;
    }

function formatDate4($value)    {  
   list($tgl,$bulan,$tahun)=explode("/",$value); 
    $tglbaru=$tahun."-".$bulan."-".$tgl;
    return $tglbaru;
    }
function formatDate5($value)    {  
   list($bulan,$tgl,$tahun)=explode("/",$value); 
    $tglbaru=$tahun."-".$bulan."-".$tgl;
    return $tglbaru;
    }
/*Function for upload image*/
//fungsi resize imge
function resizeImage($image,$width,$height,$scale,$stype) {
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($stype) {
        case 'gif':
      //  $source = imagecreatefromgif($image);
		$source = imagecreatefromjpeg($image);
        break;
        case 'jpg':
        $source = imagecreatefromjpeg($image);
        break;
        case 'jpeg':
        $source = imagecreatefromjpeg($image);
        break;
        case 'png':
        $source = imagecreatefromjpeg($image);
        break;
    }
	imagecopyresampled($newImage, $source,0,0,0,0, $newImageWidth, $newImageHeight, $width, $height);
	imagejpeg($newImage,$image,90);
	chmod($image, 0777);
	return $image;
}

//fungsi mendapatkan tinggi image
function getHeight($image) {
	$sizes = getimagesize($image);
	$height = $sizes[1];
	return $height;
}
//fungsi mendapatkan lebar image 
function getWidth($image) {
	$sizes = getimagesize($image);
	$width = $sizes[0];
	return $width;
}
//fungsi crop image
function cropImage($nw, $nh, $source, $stype, $dest) {
 
    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];
 
    switch($stype) {
        case 'gif':
        $simg = imagecreatefromjpeg($source);
        break;
        case 'jpg':
        $simg = imagecreatefromjpeg($source);
        break;
		case 'jpeg':
        $simg = imagecreatefromjpeg($source);
        break;
        case 'png':
        $simg = imagecreatefromjpeg($source);
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
function saltString($_string,$_salt='}#f4ga~g%7hjg4&j(7mk?/!bj$^R9F|V4N#h0t3N;IO[JN')
    {
        return md6(sha1($_salt.$_string));
    } 
$BULANX=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
$BULANY=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
$HARI=array("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
$CATPINJAMUSER=array("ALL","APPROVE","UNAPPROVE","EXPIRED");
$arrrevise=array("A","B","C","D","E","F","G","H","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BL","BM","BN","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ");
$arrvolume=array("I","II","III","IV","V","VI");
$arrdoa=array("ALL","CVE","AWO");
$arrok=array("Not OK","OK");
$arruserexecutive=array("dgca1","dgca2","div1","awo","edm1","it1","it2");
$arrfunction=array("Project Management Office (PMO)","Engineering Data Management (EDM)","Project Assignment","Publik","Executive 1","Executive 2","PL","Collector","DGCA/IMAA");
//$arrDE = array("1"=>"DE", "6"=>"CHIEF ENGINEER", "7"=>"PROJECT LEADER", "8"=>"SPV", "9"=>"MGR");
//$arrDE = array("1"=>"DE", "4"=>"EDM",  "6"=>"SUPERVISOR", "7"=>"MANAGER", "8"=>"KA. DIVISI", "9"=>"PROJECT LEADER", "10"=>"PROJECT ENGINEER");
$arrDE = array("1"=>"DE", "4"=>"EDM",  "6"=>"SPV", "7"=>"MGR", "8"=>"KADIV", "9"=>"PL", "10"=>"PE");
$DRAWFORMAT=array("A0","A1","A2","A3","A4");


$arrstatusx = array
  (
  array("Identification Number","link"),
  array("Prepare Document",""),
  array("Review Document",""),
  array("Correction Document",""),
  array("Request Final Review",""),
  array("Final Review",""),
  array("Final Document",""),
  array("Document to Release",""),
  array("Released Document","")
  );

function returnStatus($status)
    {  
    switch($status)
    {
    case "1":
    $statusnya="Identification Number~fa-ticket~greyblue";
    break;
    case "2";
    $statusnya="Prepare Document~fa-file-o~danger";
    break;
    case "2a";
    $statusnya="Review Document by PL,PE,SPV,MGR~fa-share~warning";
    break;
    case "2b";
    $statusnya="Correction Document DE~fa-pencil~success";
    break;
    case "3":
    $statusnya="Checker/Approval~fa-user-md~purple";
    break;
    case "4":
    $statusnya="Correction Document~fa-pencil-square-o~yellow";
    break;
    case "5":
    $statusnya="Invitation of Signing Room~fa-ticket-envelope-o~toska";
    break;
    case "6":
    $statusnya="Create Form242~fa-ticket~fa-legal~salem";
    break;
	case "7":
    $statusnya="Final Correction Document~fa-file-text-o~lightgreen";
    break;
	case "8":
    $statusnya="Pre-released Document~fa-circle-o~pink";
    break;
	case "8a":
    $statusnya="Document to Release~fa-circle-o~pink";
    break;
	case "9":
    $statusnya="Released Document~fa-circle-o~grey";
    break;
    }
	
	return $statusnya;
    }   
  
  
 function revised(){ 
  $REVISEX=Array();
  $REVISEX[1]="A";
  $REVISEX[2]="B";
  $REVISEX[3]="C";
  $REVISEX[4]="D";
  $REVISEX[6]="E";
  $REVISEX[6]="F";
  $REVISEX[7]="G";
  $REVISEX[8]="H";
  $REVISEX[9]="J";
  while(list($x,$v)=each($REVISEX)) {
    echo "<option value=$v";
    if ($revise==$v) echo " selected";
    echo ">$v</option>";
  }
 } 
 function volume(){ 
  $VOLUMEX=Array();
  $VOLUMEX[1]="I";
  $VOLUMEX[2]="II";
  $VOLUMEX[3]="III";
  $VOLUMEX[4]="IV";
  $VOLUMEX[6]="V";
  $VOLUMEX[6]="VI";
  while(list($x,$v)=each($VOLUMEX)) {
    echo "<option value=$v";
    if ($volume==$v) echo " selected";
    echo ">$v</option>";
  }
 } 

  function cleartag($msg) {
     $msg=ereg_replace("'","&prime;",$msg);
	 return $msg;
  }
  
function returnDay($value)
    {
    switch($value)
    {
    case "Mon":
    $harinya="Senin";
    break;
    case "Tue";
    $harinya="Selasa";
    break;
    case "Wed":
    $harinya="Rabu";
    break;
    case "Thu":
    $harinya="Kamis";
    break;
    case "Fri":
    $harinya="Jumat";
    break;
    case "Sat":
    $harinya="Sabtu";
    break;
	case "Sun":
    $harinya="Minggu";
    break;
    }
	
	return $harinya;
    }  
  
  
function formatDateDay($value)    {  
    $dt = strtotime($value);
	$day = date("D", $dt);
	$hari=returnDay($day);
    $tglbaru=$hari.", ".formatDate($value);
    return $tglbaru;
    }  

function roman2number($roman){
    $conv = array(
        array("letter" => 'I', "number" => 1),
        array("letter" => 'V', "number" => 5),
        array("letter" => 'X', "number" => 10),
        array("letter" => 'L', "number" => 50),
        array("letter" => 'C', "number" => 100),
        array("letter" => 'D', "number" => 500),
        array("letter" => 'M', "number" => 1000),
        array("letter" => 0, "number" => 0)
    );
    $arabic = 0;
    $state = 0;
    $sidx = 0;
    $len = strlen($roman);

    while ($len >= 0) {
        $i = 0;
        $sidx = $len;

        while ($conv[$i]['number'] > 0) {
            if (strtoupper(@$roman[$sidx]) == $conv[$i]['letter']) {
                if ($state > $conv[$i]['number']) {
                    $arabic -= $conv[$i]['number'];
                } else {
                    $arabic += $conv[$i]['number'];
                    $state = $conv[$i]['number'];
                }
            }
            $i++;
        }

        $len--;
    }

    return($arabic);
}


function number2roman($num,$isUpper=true) {
    $n = intval($num);
    $res = '';

    /*** roman_numerals array ***/
    $roman_numerals = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    );

    foreach ($roman_numerals as $roman => $number)
    {
        /*** divide to get matches ***/
        $matches = intval($n / $number);

        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);

        /*** substract from the number ***/
        $n = $n % $number;
    }

    /*** return the res ***/
    if($isUpper) return $res;
    else return strtolower($res);
}
function returnVol($value)
    {
    switch($value)
    {
    case "I":
    $newvol="II";
    break;
    case "II";
    $newvol="III";
    break;
    case "III":
    $newvol="IV";
    break;
    case "IV":
    $newvol="V";
    break;
    case "V":
    $newvol="VI";
    break;
    case "VI":
    $newvol="VII";
    break;
    case "VII":
    $newvol="VIII";
    break;
    case "VIII":
    $newvol="IX";
    break;
    }
	
	return $newvol;
    } 
function convertTime($time){
    // Waktu Start & expired
  //$w = date("d-m-Y\ g:i:s");
  $datex=date("d/m/Y", $time);

  return $datex;
}	
function durationleft($timestamp_start,$timestamp_exp){
    // Waktu Start & expired
  //$w = date("d-m-Y\ g:i:s");
  $datez=convertTime($timestamp_start).' s.d. '.convertTime($timestamp_exp);

  return $datez;
}	
function cut_karakter($char,$length_char){
  if(strlen($char) > $length_char){
	$char=preg_replace('/<img.*src="(.*?)".*\/?>/', '', $char);
	$char=preg_replace('/<div.*style="(.*?)".*\/?>/', '', $char);
	$char=preg_replace('/<div.*\/?>/', '', $char);
	for ($i=$length_char;$i<=$length_char+1000;$i++){
	  if(substr($char,$i,1)==" " or substr($char,$i,1)==""){
		$new_char = substr($char,0,$i);
		return $new_char;
		break;
	  }
	}
  }
  else return $char;
}
function encryptpass($str) {
     $hasil="";
    $kunci = '979a218e0632df2935317f98d47956c7';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)+ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return urlencode(base64_encode($hasil));
}
function AntiHack($value) {
	$value1=strip_tags($value);
	$value2=ereg_replace("'", "",$value1);
	$value3=htmlspecialchars($value2);
	$hasil = str_replace("[QSA,L][QSA,L]","",$value3);
	return $hasil;
}
function timeago($date) {
	   $timestamp = strtotime($date);	
	   
	   $strTime = array("detik", "menit", "jam", "hari", "bulan", "tahun");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . " yang lalu ";
			//return $date;
	   }
	}	
?>