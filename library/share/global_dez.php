<?php 

class global_dez {
	public function f_FRpZ($data){
		$rupi = number_format($data , 0 , ',' , '.' );
		$cek = substr($rupi, 0, 1);
		if($cek == '-'){
			$rerupi = str_replace("-","",$rupi);
			$rupiah = "(".$rerupi.")";
		}
		else{
			$rupiah = $rupi;
		}
		return $rupiah;
	}
  
	
	function rp_satuan($angka,$debug) {
	
		$a_str['1']="satu";
		$a_str['2']="dua";
		$a_str['3']="tiga";
		$a_str['4']="empat";
		$a_str['5']="lima";
		$a_str['6']="enam";
		$a_str['7']="tujuh";
		$a_str['8']="delapan";
		$a_str['9']="sembilan";

		$panjang=strlen($angka);
		for ($b=0;$b<$panjang;$b++)
		{
		$a_bil[$b]=substr($angka,$panjang-$b-1,1);
		}

		if ($panjang>2)
		{
		if ($a_bil[2]=="1")
		{
		$terbilang=" seratus";
		}
		else if ($a_bil[2]!="0")
		{
		$terbilang= " ".$a_str[$a_bil[2]]. " ratus";
		}
		}

		if ($panjang>1)
		{
		if ($a_bil[1]=="1")
		{
		if ($a_bil[0]=="0")
		{
		$terbilang .=" sepuluh";
		}
		else if ($a_bil[0]=="1")
		{
		$terbilang .=" sebelas";
		}
		else
		{
		$terbilang .=" ".$a_str[$a_bil[0]]." belas";
		}
		return $terbilang;
		}
		else if ($a_bil[1]!="0")
		{
		$terbilang .=" ".$a_str[$a_bil[1]]." puluh";
		}
		}

		if ($a_bil[0]!="0")
		{
		$terbilang .=" ".$a_str[$a_bil[0]];
		}
		return $terbilang;

		}
		
		
		public function rp_terbilang($angka,$debug) {

			$angka = str_replace(".",",",$angka);

			list ($angka, $desimal) = explode(",",$angka);
			$panjang=strlen($angka);
			for ($b=0;$b<$panjang;$b++)
			{
			$myindex=$panjang-$b-1;
			$a_bil[$b]=substr($angka,$myindex,1);
			}
			if ($panjang>9)
			{
			$bil=$a_bil[9];
			if ($panjang>10)
			{
			$bil=$a_bil[10].$bil;
			}

			if ($panjang>11)
			{
			$bil=$a_bil[11].$bil;
			}
			if ($bil!="" && $bil!="000")
			{
			$terbilang .= $this->rp_satuan($bil,$debug)." milyar";
			}

			}

			if ($panjang>6)
			{
			$bil=$a_bil[6];
			if ($panjang>7)
			{
			$bil=$a_bil[7].$bil;
			}

			if ($panjang>8)
			{
			$bil=$a_bil[8].$bil;
			}
			if ($bil!="" && $bil!="000")
			{
			$terbilang .= $this->rp_satuan($bil,$debug)." juta";
			}

			}

			if ($panjang>3)
			{
			$bil=$a_bil[3];
			if ($panjang>4)
			{
			$bil=$a_bil[4].$bil;
			}

			if ($panjang>5)
			{
			$bil=$a_bil[5].$bil;
			}
			if ($bil!="" && $bil!="000")
			{
			$terbilang .= $this->rp_satuan($bil,$debug)." ribu";
			}

			}

			$bil=$a_bil[0];
			if ($panjang>1)
			{
			$bil=$a_bil[1].$bil;
			}

			if ($panjang>2)
			{
			$bil=$a_bil[2].$bil;
			}
			//die($bil);
			if ($bil!="" && $bil!="000")
			{
			$terbilang .= $this->rp_satuan($bil,$debug);
			}
			return trim($terbilang);
			}
  
	public function getNamaBulan($mm){
		$mm = $mm*1;
		$namaBulanArr = array('1' =>'Januari', 'Pebruari', 'Maret', 'April',  'Mei', 'Juni',  'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
		$namaBulan = $namaBulanArr[$mm];

		return $namaBulan;
	}

	public function formatTglLengkap($tglmachine){
	
		$thn = substr($tglmachine, 0, 4);
		$bln = $this->getNamaBulan(substr($tglmachine, 5, 2));
		$tgl = substr($tglmachine, 8, 2);

		return $tgl." ".$bln." ".$thn;
	}

	public function tglLengkapNormal($tglmachine){
	
		$thn = substr($tglmachine, 6, 4);
		$bln = $this->getNamaBulan(substr($tglmachine, 3, 2));
		$tgl = substr($tglmachine, 0, 2);

		return $tgl." ".$bln." ".$thn;
	}

	public function tglSystem($tglmachine){
	
		$thn = substr($tglmachine, 6, 4);
		$bln = substr($tglmachine, 3, 2);
		$tgl = substr($tglmachine, 0, 2);

		return $thn."-".$bln."-".$tgl;
	}
  
}
?>