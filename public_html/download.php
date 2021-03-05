<?php
session_start();
//echo "user=".$_SESSION['username'];
include 'Portalconf.php';
include libs_dir."cmslibs/tmenglishcapServices/tmenglishcapServices.php" ;
include libs_dir."cmslibs/tmfileServices/tmfileServices.php" ;

$userid=$_SESSION['userid'];

if (isset($_SESSION['userid'])){

	$datv = findtmenglishcap($userid);
	$objtmenglishcap=new tmenglishcap();
	$objtmenglishcap = unserialize($datv);
	$enginst=$objtmenglishcap->getn_institution();
	$other=$objtmenglishcap->getn_other();
	$engcat=$objtmenglishcap->getn_category();
	$engyear=$objtmenglishcap->geti_year();
	$engscore=$objtmenglishcap->getv_score();
	$engfile=$objtmenglishcap->getn_file();

	$datz = findtmfile($userid);
	$objtmfile=new tmfile();
	$objtmfile = unserialize($datz);
	$cvfile=$objtmfile->getn_file_cv();	
	$transkrfile=$objtmfile->getn_file_transkr();	
	$sertiffile=$objtmfile->getn_file_sertif();	
	$ktpfile=$objtmfile->getn_file_ktp();	
	$fotofile=$objtmfile->getn_file_foto();	
	$reportfile=$objtmfile->getn_file_report();	
	



ignore_user_abort(true);
set_time_limit(0); // disable the time limit for this script
$cat=isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';
//echo $cat;
if ($cat=="TOEFL") $fullPath = $path_toefl.$engfile; // change the path to fit your websites document structure
else if ($cat=="CV") $fullPath = $path_cv.$cvfile;
else if ($cat=="KTP") $fullPath = $path_ktp.$ktpfile;
else if ($cat=="TRANSKRIP") $fullPath = $path_transkrip.$transkrfile;
else if ($cat=="SERTIFIKAT") $fullPath = $path_sertifikat.$sertiffile;
else if ($cat=="FOTO") $fullPath = $path_foto.$fotofile;
else if ($cat=="REPORT") $fullPath = $path_report.$reportfile;
//echo $path;



// grab the requested file's name
$file_name = $fullPath;
// make sure it's a file before doing anything!
if( !is_file($file_name) )
	exit();
// required for IE
if(ini_get('zlib.output_compression')) 
	ini_set('zlib.output_compression', 'Off');	
// get the file mime type using the file extension
switch(strtolower(substr(strrchr($file_name,'.'),1)))
{
	case 'pdf': $mime = 'application/pdf'; break;
	case 'zip': $mime = 'application/zip'; break;
	case 'jpeg':
	case 'jpg': $mime = 'image/jpg'; break;
	default: exit();
}
header('Pragma: public'); 	// required
header('Expires: 0');		// no cache
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_name)).' GMT');
header('Cache-Control: private',false);
header('Content-Type: '.$mime);
header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: '.filesize($file_name));	// provide file size
header('Connection: close');
readfile($file_name);		// push it out
exit();
} else echo "<h2>You are not allowed to download this file</h2>\n";
?>