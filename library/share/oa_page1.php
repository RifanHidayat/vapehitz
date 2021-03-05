<?php 
require_once 'Zend/View.php';
require_once 'tcpdf_barcodes_2d_include.php';

class oa_page {

	public function pager($totalData, $maxDisplay)
	{
		$div = $totalData/$maxDisplay;
		$mod = $totalData%$maxDisplay;
		

		$x = explode(".",$div);
		
		if($mod == 0)
			$totalPages = $x[0];
		else
			$totalPages = $x[0] + 1;

		return $totalPages;
	}

	public function showPage($totalData, $numToDisplay, $currentPage, $modul, $fungsi, $param1, $param2, $param3, $param4)
	{
		$totalPages = $this->pager($totalData, $numToDisplay);
		$totalPerPages = 5;
		$totalGroup = $totalPages / $totalPerPages ;
		$modTotalGroup = $totalPages % $totalPerPages ;

		$x = explode(".",$totalGroup);

		$a = 1;
		if($modTotalGroup == 0)
			$totalGroup = $x[0];
		else
			$totalGroup = $x[0] + 1;
		
		
		if($currentPage)
		{
			$currentGroupPage_arr =  explode(".",$currentPage / $totalPerPages);
			if(isset($currentGroupPage_arr[1])){
				if($currentGroupPage_arr[1] != 0)
					$currentGroupPage = $currentGroupPage_arr[0] +1;
				else
					$currentGroupPage = $currentGroupPage_arr[0];
			} else {
				$currentGroupPage = $currentGroupPage_arr[0];
			}
			
		}
		
		if(!$currentGroupPage)
			$currentGroupPage = 1;
			
		$indexStartPage = (($currentGroupPage - 1) * $totalPerPages ) + 1 ;
		$indexEndPage = $indexStartPage+$totalPerPages-1;
		$dataAwal = (($currentPage - 1) * $numToDisplay ) + 1 ;
		if($currentPage != $totalPages)
		{
			$dataAkhir = $currentPage * $numToDisplay;
		}
		else
		{
			$dataAkhir = $totalData;
		}
			$keluaran = "";
			$keluaran = $keluaran."<div class=\"col-lg-12\">";
			$keluaran = $keluaran."<div class=\"pull-right\">Data $dataAwal - $dataAkhir dari total $totalData data</div><br>";
		if($totalPages > 1){
			$keluaran = $keluaran."<ul class=\"pagination pull-right\" >";
			//$keluaran = $keluaran."<li>";
			if($totalPages == 1){
				$keluaran = $keluaran."<li>Halaman $currentPage dari $totalPages</li>";			
			}else{
				$keluaran = $keluaran."<li>.<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto('$modul','$totalPages','$fungsi', '$param1', '$param2', '$param3', '$param4'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a></li>";			
			}
			//$keluaran = $keluaran."</li>";
			
			//if(($currentGroupPage > 1) && ($totalGroup != 1))
			if($currentPage > 1)
			{
				//$a = ($indexStartPage -$totalPerPages);
				$a = 1;
				//$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;<<</a></div>";
				//**$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\"><strong>&#60;&#60;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
				$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">&#60;&#60;</a></li>";
			}
			
			if($totalPages > 1 && $currentPage == 1){
				$keluaran =  $keluaran . "<li class=\"prev disabled\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">Previous</a></li>";
			}

			if($totalPages <= $indexEndPage)
			{
				
				for($a=$indexStartPage; $a <= $totalPages; $a ++)
				{
					if($a == $currentPage)
						//$keluaran =  $keluaran . "<div class=\"pageCurrent\">&nbsp;$a&nbsp;</div>"; 
						//**$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
						$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">$a</a></li>";
					else
					{
						//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;$a&nbsp;</a></div>";		
						//**$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
						$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">$a</a></li>";
					}
				}
				
				if($currentPage < $totalPages)
				{
					$a = $currentPage +1;
					//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;>&nbsp;</a></div>";
					//**$keluaran =  $keluaran . "<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\"><strong>&#62;</strong></a>";
					$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">Next</a></li>";
				}
			}
			else
			{
				for($a=$indexStartPage; $a<=$indexEndPage; $a++)
				{
					if($a == $currentPage)
						//**$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
						$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">$a</a></li>";
					else
					{
						//**$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
						$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">$a</a></li>";
					}
				}
				
				if($currentPage < $totalPages)
				{
					$a = $currentPage +1;
					//**$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\"><strong>&#62;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
					$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">Next</a></li>";
				}
				
				
			/* if($currentGroupPage < $totalGroup)
			{
				$a = $totalPages;
				$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$terakhir&nbsp;</a></div>";
			}	 */
				//if(($totalGroup > 1) && ($currentGroupPage != $totalGroup))
				if ($currentPage <= $totalPages)
				{
					//$a = ($currentGroupPage * $totalPerPages) + 1;
					$a = $totalPages;
					//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;>></a></div>";
					$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">&#62;&#62;</a></li>";
				}
			}	
			
			
			/* $indexPage = "<div class=\"page\">Halaman $currentPage dari $totalPages  : </div>".$indexPage;
			if($totalPages > 1)
			{
				$keluaran = $keluaran."<a href=\"#\" onclick=\"return !showPopup('mn_paging', event);\" title=\"Cari Halaman\"><div class=\"pageNav\">";
			}
			$keluaran = $keluaran."			</div></a>"; */
			$keluaran = $keluaran."      </ul>";
			$keluaran = $keluaran."      </div>";
		}
		return $keluaran;
	}
	
	public function showPage2($totalData, $numToDisplay, $currentPage, $modul, $fungsi, $param1, $param2, $param3, $param4, $divId)
	{
		//echo "$modul";
		$totalPages = $this->pager($totalData, $numToDisplay);
		$totalPerPages = 5;
		$totalGroup = $totalPages / $totalPerPages ;
		$modTotalGroup = $totalPages % $totalPerPages ;

		$x = explode(".",$totalGroup);

		if($modTotalGroup == 0)
			$totalGroup = $x[0];
		else
			$totalGroup = $x[0] + 1;
		
		
		if($currentPage)
		{
			$currentGroupPage_arr =  explode(".",$currentPage / $totalPerPages);
			if($currentGroupPage_arr[1] != 0)
				$currentGroupPage = $currentGroupPage_arr[0] +1;
			else
				$currentGroupPage = $currentGroupPage_arr[0];
		}
		
		if(!$currentGroupPage)
			$currentGroupPage = 1;
			
		$indexStartPage = (($currentGroupPage - 1) * $totalPerPages ) + 1 ;
		$indexEndPage = $indexStartPage+$totalPerPages-1;
		$dataAwal = (($currentPage - 1) * $numToDisplay ) + 1 ;

		if($currentPage != $totalPages)
		{
			$dataAkhir = $currentPage * $numToDisplay;
		}
		else
		{
			$dataAkhir = $totalData;
		}
		
		$keluaran = "";
		//$keluaran = $keluaran."<div id=\"ctBox\">";
		$keluaran = $keluaran."      <div class=\"left\">Data $dataAwal - $dataAkhir dari total $totalData data</div><br>";
		$keluaran = $keluaran."      <div class=\"pagination\">";
		if($totalPages == 1)
		{
			$keluaran = $keluaran." 	 	Halaman $currentPage dari $totalPages : ";			
		}
		else
		{
			$keluaran = $keluaran." 	 	<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto2('$modul','$totalPages','$fungsi', '$param1', '$param2', '$param3', '$param4', '$divId'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a> : ";			
		}
		
		
		//if(($currentGroupPage > 1) && ($totalGroup != 1))
		if($currentPage > 1)
		{
			//$a = ($indexStartPage -$totalPerPages);
			$a = 1;
			//$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;<<</a></div>";
			$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage2('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$divId');\"><strong>&#60;&#60;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
		}
		
/* 		if($currentGroupPage > 1)
		{
			$a = 1;
			$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$pertama&nbsp;</a></div>";
		} */
		
		if($currentPage > 1)
			{
				$a = $currentPage -1;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;<&nbsp;</a></div>";
				$keluaran =  $keluaran . "<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage2('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$divId');\"><strong>&nbsp;&#60;&nbsp;</strong><span class=\"page-sep\"> </span></a>";
			}
			
		if($totalPages <= $indexEndPage)
		{
			
			for($a=$indexStartPage; $a <= $totalPages; $a ++)
			{
				if($a == $currentPage)
					//$keluaran =  $keluaran . "<div class=\"pageCurrent\">&nbsp;$a&nbsp;</div>"; 
					$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
				else
				{
					//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;$a&nbsp;</a></div>";		
					$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage2('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$divId');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;>&nbsp;</a></div>";
				$keluaran =  $keluaran . "<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage2('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$divId');\"><strong>&#62;</strong></a>";
			}
		}
		else
		{
			for($a=$indexStartPage; $a<=$indexEndPage; $a++)
			{
				if($a == $currentPage)
					$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
				else
				{
					$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage2('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$divId');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage2('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$divId');\"><strong>&#62;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
			}
		/* if($currentGroupPage < $totalGroup)
		{
			$a = $totalPages;
			$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$terakhir&nbsp;</a></div>";
		}	 */
			//if(($totalGroup > 1) && ($currentGroupPage != $totalGroup))
			if ($currentPage <= $totalPages)
			{
				//$a = ($currentGroupPage * $totalPerPages) + 1;
				$a = $totalPages;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;>></a></div>";
				$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage2('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$divId');\">&#62;&#62;<span class=\"page-sep\"> </span></a>&nbsp;";
			}
		}	
		
		
		/* $indexPage = "<div class=\"page\">Halaman $currentPage dari $totalPages  : </div>".$indexPage;
		if($totalPages > 1)
		{
			$keluaran = $keluaran."<a href=\"#\" onclick=\"return !showPopup('mn_paging', event);\" title=\"Cari Halaman\"><div class=\"pageNav\">";
		}
		$keluaran = $keluaran."			</div></a>"; */
		$keluaran = $keluaran."      </div>";
		//$keluaran = $keluaran."      </div>";
		
		return $keluaran;
	}
	
	public function showPage3($totalData, $numToDisplay, $currentPage, $modul, $fungsi, $param1, $param2, $param3, $param4, $param5, $param6, $divId)
	{
		$totalPages = $this->pager($totalData, $numToDisplay);
		$totalPerPages = 5;
		$totalGroup = $totalPages / $totalPerPages ;
		$modTotalGroup = $totalPages % $totalPerPages ;

		$x = explode(".",$totalGroup);
		$a = 1;
		
		if($modTotalGroup == 0)
			$totalGroup = $x[0];
		else
			$totalGroup = $x[0] + 1;
		
		
		if($currentPage)
		{
			$currentGroupPage_arr =  explode(".",$currentPage / $totalPerPages);
			if($currentGroupPage_arr[1] != 0)
				$currentGroupPage = $currentGroupPage_arr[0] +1;
			else
				$currentGroupPage = $currentGroupPage_arr[0];
		}
		
		if(!$currentGroupPage)
			$currentGroupPage = 1;
			
		$indexStartPage = (($currentGroupPage - 1) * $totalPerPages ) + 1 ;
		$indexEndPage = $indexStartPage+$totalPerPages-1;
		$dataAwal = (($currentPage - 1) * $numToDisplay ) + 1 ;

		if($currentPage != $totalPages)
		{
			$dataAkhir = $currentPage * $numToDisplay;
		}
		else
		{
			$dataAkhir = $totalData;
		}
	//	echo " current page  ".$currentPage."  totalPages ".$totalPages;
		$keluaran = "";
		//$keluaran = $keluaran."<div id=\"ctBox\">";
		$keluaran = $keluaran."<div class=\"col-lg-12\">";
		$keluaran = $keluaran."<div class=\"pull-right\">Data $dataAwal - $dataAkhir dari total $totalData data</div><br>";
		
		if($totalPages > 1){
			$keluaran = $keluaran."<ul class=\"pagination pull-right\" >";
		if($totalPages == 1)
		{
			$keluaran = $keluaran."<li>Halaman $currentPage dari $totalPages</li>";			
		}
		else
		{
			$keluaran = $keluaran."<li>.<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto3('$modul','$totalPages','$fungsi', '$param1', '$param2', '$param3', '$param4', '$param5', '$param6', '$divId'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a></li>";			
		}
		}
		
		//if(($currentGroupPage > 1) && ($totalGroup != 1))
		if($currentPage > 1)
		{
			//$a = ($indexStartPage -$totalPerPages);
			$a = 1;
			//$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;<<</a></div>";
			$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage3('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$param5', '$param6', '$divId');\">&#60;&#60;</a></li>";
		}
		
		if($totalPages > 1 && $currentPage == 1){
			$keluaran =  $keluaran . "<li class=\"prev disabled\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage3('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">Previous</a></li>";
		}
		
/* 		if($currentGroupPage > 1)
		{
			$a = 1;
			$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$pertama&nbsp;</a></div>";
		} */
		
		
		if($totalPages <= $indexEndPage)
		{
			
			for($a=$indexStartPage; $a <= $totalPages; $a ++)
			{
				if($a == $currentPage)
					//$keluaran =  $keluaran . "<div class=\"pageCurrent\">&nbsp;$a&nbsp;</div>"; 
					$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage3('$modul','$fungsi','$a','$param1','$param2','$param3','$param4');\">$a</a></li>";
				else
				{
					//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;$a&nbsp;</a></div>";		
					$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage3('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$param5', '$param6', '$divId');\">$a</a></li>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;>&nbsp;</a></div>";
				$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage3('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$param5', '$param6', '$divId');\">Next</a></li>";
			}
		}
		else
		{
			for($a=$indexStartPage; $a<=$indexEndPage; $a++)
			{
				if($a == $currentPage)
					$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage3('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$param5', '$param6', '$divId');\">$a</a></li>";
				else
				{
					$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage3('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$param5', '$param6', '$divId');\">$a</a></li>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage3('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$param5', '$param6', '$divId');\">Next</a></li>";
			}
		/* if($currentGroupPage < $totalGroup)
		{
			$a = $totalPages;
			$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$terakhir&nbsp;</a></div>";
		}	 */
			//if(($totalGroup > 1) && ($currentGroupPage != $totalGroup))
			if ($currentPage <= $totalPages)
			{
				//$a = ($currentGroupPage * $totalPerPages) + 1;
				$a = $totalPages;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;>></a></div>";
				$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage3('$modul','$fungsi','$a','$param1','$param2','$param3','$param4', '$param5', '$param6', '$divId');\">&#62;&#62;</a></li>";
			}
		}	
		
		
		/* $indexPage = "<div class=\"page\">Halaman $currentPage dari $totalPages  : </div>".$indexPage;
		if($totalPages > 1)
		{
			$keluaran = $keluaran."<a href=\"#\" onclick=\"return !showPopup('mn_paging', event);\" title=\"Cari Halaman\"><div class=\"pageNav\">";
		}*/
		$keluaran = $keluaran."      </ul>";
		$keluaran = $keluaran."      </div>";
		
		return $keluaran;
	}	
	/* showPage5 portal lama */
	public function showPage555($totalData, $numToDisplay, $currentPage, $modul, $fungsi, $param1, $param2, $param3, $param4, $param5, $param6)
	{
	//echo "totalData= ".$totalData."<br>"."numToDisplay= ".$numToDisplay."<br>"."currentPage= ".$currentPage."<br>"."modul= ".$modul."<br>"."fungsi= ".$fungsi."<br>";
	//echo "param1= ".$param1."<br>"."param2= ".$param2."<br>"."param3= ".$param3."<br>"."param4= ".$param4."<br>"."param5= ".$param5."<br>";
	
		//echo "param5= ".$param5."<br>";
		$totalPages = $this->pager($totalData, $numToDisplay);
		$totalPerPages = 5;
		$totalGroup = $totalPages / $totalPerPages ;
		$modTotalGroup = $totalPages % $totalPerPages ;

		$x = explode(".",$totalGroup);

		if($modTotalGroup == 0)
			$totalGroup = $x[0];
		else
			$totalGroup = $x[0] + 1;
		
		
		if($currentPage)
		{
			$currentGroupPage_arr =  explode(".",$currentPage / $totalPerPages);
			if($currentGroupPage_arr[1] != 0)
				$currentGroupPage = $currentGroupPage_arr[0] +1;
			else
				$currentGroupPage = $currentGroupPage_arr[0];
		}
		
		if(!$currentGroupPage)
			$currentGroupPage = 1;
			
		$indexStartPage = (($currentGroupPage - 1) * $totalPerPages ) + 1 ;
		$indexEndPage = $indexStartPage+$totalPerPages-1;
		$dataAwal = (($currentPage - 1) * $numToDisplay ) + 1 ;
		if($currentPage != $totalPages)
		{
			$dataAkhir = $currentPage * $numToDisplay;
		}
		else
		{
			$dataAkhir = $totalData;
		}
		
		$keluaran = "";
		//$keluaran = $keluaran."<div id=\"ctBox\">";
		$keluaran = $keluaran."      <div class=\"left\">Data $dataAwal - $dataAkhir dari total $totalData data</div><br>";
		$keluaran = $keluaran."      <div class=\"pagination\">";
		if($totalPages == 1)
		{
			$keluaran = $keluaran." 	 	Halaman $currentPage dari $totalPages : ";			
		}
		else
		{
			$keluaran = $keluaran." 	 	<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto5('$modul','$totalPages','$fungsi', '$param1', '$param2', '$param3', '$param4', '$param5', '$param6'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a> : ";			
		}
		
		
		//if(($currentGroupPage > 1) && ($totalGroup != 1))
		if($currentPage > 1)
		{
			//$a = ($indexStartPage -$totalPerPages);
			$a = 1;
			//$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;<<</a></div>";
			$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\"><strong>&#60;&#60;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
		}
		
/* 		if($currentGroupPage > 1)
		{
			$a = 1;
			$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$pertama&nbsp;</a></div>";
		} */
		
		if($currentPage > 1)
			{
				$a = $currentPage -1;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;<&nbsp;</a></div>";
				$keluaran =  $keluaran . "<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\"><strong>&nbsp;&#60;&nbsp;</strong><span class=\"page-sep\"> </span></a>";
			}
			
		if($totalPages <= $indexEndPage)
		{
			
			for($a=$indexStartPage; $a <= $totalPages; $a ++)
			{
				if($a == $currentPage)
					//$keluaran =  $keluaran . "<div class=\"pageCurrent\">&nbsp;$a&nbsp;</div>"; 
					$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
				else
				{
					//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;$a&nbsp;</a></div>";		
					$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;>&nbsp;</a></div>";
				$keluaran =  $keluaran . "<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\"><strong>&#62;</strong></a>";
			}
		}
		else
		{
			for($a=$indexStartPage; $a<=$indexEndPage; $a++)
			{
				if($a == $currentPage)
					$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
				else
				{
					$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\"><strong>&#62;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
			}
		/* if($currentGroupPage < $totalGroup)
		{
			$a = $totalPages;
			$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$terakhir&nbsp;</a></div>";
		}	 */
			//if(($totalGroup > 1) && ($currentGroupPage != $totalGroup))
			if ($currentPage <= $totalPages)
			{
				//$a = ($currentGroupPage * $totalPerPages) + 1;
				$a = $totalPages;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;>></a></div>";
				$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">&#62;&#62;<span class=\"page-sep\"> </span></a>&nbsp;";
			}
		}	
		
		
		/* $indexPage = "<div class=\"page\">Halaman $currentPage dari $totalPages  : </div>".$indexPage;
		if($totalPages > 1)
		{
			$keluaran = $keluaran."<a href=\"#\" onclick=\"return !showPopup('mn_paging', event);\" title=\"Cari Halaman\"><div class=\"pageNav\">";
		}
		$keluaran = $keluaran."			</div></a>"; */
		$keluaran = $keluaran."      </div>";
		//$keluaran = $keluaran."      </div>";
		
		return $keluaran;
	}
	
	public function showPage5($totalData, $numToDisplay, $currentPage, $modul, $fungsi, $param1, $param2, $param3, $param4, $param5, $param6)
	{
		//echo "totalData= ".$totalData."<br>"."numToDisplay= ".$numToDisplay."<br>"."currentPage= ".$currentPage."<br>"."modul= ".$modul."<br>"."fungsi= ".$fungsi."<br>";
	//echo "param1= ".$param1."<br>"."param2= ".$param2."<br>"."param3= ".$param3."<br>"."param4= ".$param4."<br>"."param5= ".$param5."<br>";
	
		//echo "param5= ".$param5."<br>";
		$totalPages = $this->pager($totalData, $numToDisplay);
		$totalPerPages = 5;
		$totalGroup = $totalPages / $totalPerPages ;
		$modTotalGroup = $totalPages % $totalPerPages ;

		$x = explode(".",$totalGroup);
		$a = 1;
		if($modTotalGroup == 0)
			$totalGroup = $x[0];
		else
			$totalGroup = $x[0] + 1;
		
		if($currentPage)
		{
			$currentGroupPage_arr =  explode(".",$currentPage / $totalPerPages);
			if(isset($currentGroupPage_arr[1])){
				if($currentGroupPage_arr[1] != 0)
					$currentGroupPage = $currentGroupPage_arr[0] +1;
				else
					$currentGroupPage = $currentGroupPage_arr[0];
			} else {
				$currentGroupPage = $currentGroupPage_arr[0];
			}
			
		}
		
		if(!$currentGroupPage)
			$currentGroupPage = 1;
			
		$indexStartPage = (($currentGroupPage - 1) * $totalPerPages ) + 1 ;
		$indexEndPage = $indexStartPage+$totalPerPages-1;
		$dataAwal = (($currentPage - 1) * $numToDisplay ) + 1 ;
		if($currentPage != $totalPages)
		{
			$dataAkhir = $currentPage * $numToDisplay;
		}
		else
		{
			$dataAkhir = $totalData;
		}
		
		$keluaran = "";
		$keluaran = $keluaran."<div class=\"col-lg-12\">";
		$keluaran = $keluaran."<div class=\"pull-right\">Data $dataAwal - $dataAkhir dari total $totalData data</div><br>";
		if($totalPages > 1){
		$keluaran = $keluaran."<ul class=\"pagination pull-right\" >";
		//$keluaran = $keluaran."<li>";
		
		//Jika totalPages-nya hanya satu maka tidak udah ditampilkan paging-nya
		if($totalPages == 1){
			$keluaran = $keluaran."<li>Halaman$currentPage dari $totalPages </li>";
		}else{
			$keluaran = $keluaran."<li>.<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto5('$modul','$totalPages','$fungsi', '$param1', '$param2', '$param3', '$param4', '$param5', '$param6'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a></li>";			
		}
		//$keluaran = $keluaran."</li>";
		
		
		//if(($currentGroupPage > 1) && ($totalGroup != 1))
		if($currentPage > 1)
		{
			//$a = ($indexStartPage -$totalPerPages);
			$a = 1;
			//$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;<<</a></div>";
			//**$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\"><strong>&#60;&#60;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
			$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">&#60;&#60;</a></li>";
		}
		
/* 		if($currentGroupPage > 1)
		{
			$a = 1;
			$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$pertama&nbsp;</a></div>";
		} */
		// Jika page yg aktif lebih dari 1 maka tampilkan tombol previous
		if($currentPage > 1)
		{
			$a = $currentPage -1;
			//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;<&nbsp;</a></div>";
			//**$keluaran =  $keluaran . "<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\"><strong>&nbsp;&#60;&nbsp;</strong><span class=\"page-sep\"> </span></a>";
			$keluaran =  $keluaran . "<li class=\"prev\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">Previous</a></li>";
		}
		
		if($totalPages > 1 && $currentPage == 1){
			$keluaran =  $keluaran . "<li class=\"prev disabled\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">Previous</a></li>";
		}
		
		if($totalPages <= $indexEndPage)
		{
			
			for($a=$indexStartPage; $a <= $totalPages; $a ++)
			{
				if($a == $currentPage)
					//$keluaran =  $keluaran . "<div class=\"pageCurrent\">&nbsp;$a&nbsp;</div>"; 
					//**$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
					$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">$a</a></li>";
				else
				{
					//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;$a&nbsp;</a></div>";		
					//**$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
					$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">$a</a></li>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;>&nbsp;</a></div>";
				//**$keluaran =  $keluaran . "<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\"><strong>&#62;</strong></a>";
				$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">Next</a></li>";
			}
		}
		else
		{
			for($a=$indexStartPage; $a<=$indexEndPage; $a++)
			{//beda
				if($a == $currentPage){//Page yg sedang aktif
					//**$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
					$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">$a</a></li>";
					//**$keluaran =  $keluaran . "<li>$a</li>";
				}else{
					//**$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
					$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">$a</a></li>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				//**$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\"><strong>&#62;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
				$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">Next</a></li>";
			}
			
			/**if($currentPage == $totalPages){
				
				$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">Next</a></li>";	
			}**/
		/* if($currentGroupPage < $totalGroup)
		{
			$a = $totalPages;
			$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$terakhir&nbsp;</a></div>";
		}	 */
			//if(($totalGroup > 1) && ($currentGroupPage != $totalGroup))
			if ($currentPage <= $totalPages)
			{
				//$a = ($currentGroupPage * $totalPerPages) + 1;
				$a = $totalPages;
				//$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">&nbsp;&nbsp;>></a></div>";
				//**$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\"><span class=\"page-sep\"> </span></a>&nbsp;";
				$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage5('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">&#62;&#62;</a></li>";
			}
		}	
		
		
		/* $indexPage = "<div class=\"page\">Halaman $currentPage dari $totalPages  : </div>".$indexPage;
		if($totalPages > 1)
		{
			$keluaran = $keluaran."<a href=\"#\" onclick=\"return !showPopup('mn_paging', event);\" title=\"Cari Halaman\"><div class=\"pageNav\">";
		}
		$keluaran = $keluaran."			</div></a>"; */
		$keluaran = $keluaran."      </ul>";
		$keluaran = $keluaran."      </div>";
		}
		// $keluaran = $keluaran."<div class=\"col-lg-12\">";
		// $keluaran = $keluaran."<ul class=\"pagination pull-right\" >";
		// if($totalPages == 1){
			// $keluaran = $keluaran."Halaman $currentPage dari $totalPages";			
		// }else{
			// $keluaran = $keluaran."<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto5('$modul','$totalPages','$fungsi', '$param1', '$param2', '$param3', '$param4', '$param5', '$param6'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a>";			
		// }
		// $keluaran = $keluaran."      </ul>";
		// $keluaran = $keluaran."      </div>";
		return $keluaran;
	}
	
	
	public function showPage10($totalData, $numToDisplay, $currentPage, $modul, $fungsi, $param1, $param2, $param3, $param4, $param5, $param6, $param7, $param8, $param9, $param10, $param11)
	{
	//echo "totalData= ".$totalData."<br>"."numToDisplay= ".$numToDisplay."<br>"."currentPage= ".$currentPage."<br>"."modul= ".$modul."<br>"."fungsi= ".$fungsi."<br>";
	//echo "param1= ".$param1."<br>"."param2= ".$param2."<br>"."param3= ".$param3."<br>"."param4= ".$param4."<br>"."param5= ".$param5."<br>";
	
		//echo "param5= ".$param5."<br>";
		$totalPages = $this->pager($totalData, $numToDisplay);
		$totalPerPages = 5;
		$totalGroup = $totalPages / $totalPerPages ;
		$modTotalGroup = $totalPages % $totalPerPages ;

		$x = explode(".",$totalGroup);
		$a = 1;
		if($modTotalGroup == 0)
			$totalGroup = $x[0];
		else
			$totalGroup = $x[0] + 1;
		
		
		if($currentPage)
		{
			$currentGroupPage_arr =  explode(".",$currentPage / $totalPerPages);
			if(isset($currentGroupPage_arr[1])){
				if($currentGroupPage_arr[1] != 0)
					$currentGroupPage = $currentGroupPage_arr[0] +1;
				else
					$currentGroupPage = $currentGroupPage_arr[0];
			} else {
				$currentGroupPage = $currentGroupPage_arr[0];
			}
		}
		
		if(!$currentGroupPage)
			$currentGroupPage = 1;
			
		$indexStartPage = (($currentGroupPage - 1) * $totalPerPages ) + 1 ;
		$indexEndPage = $indexStartPage+$totalPerPages-1;
		$dataAwal = (($currentPage - 1) * $numToDisplay ) + 1 ;
		if($currentPage != $totalPages)
		{
			$dataAkhir = $currentPage * $numToDisplay;
		}
		else
		{
			$dataAkhir = $totalData;
		}
		
		$keluaran = "";
		$keluaran = $keluaran."<div class=\"col-lg-12\">";
		$keluaran = $keluaran."<div class=\"pull-right\">Data $dataAwal - $dataAkhir dari total $totalData data</div><br>";
		if($totalPages > 1){
			$keluaran = $keluaran."<ul class=\"pagination pull-right\" >";
			if($totalPages == 1)
			{
				$keluaran = $keluaran."<li>Halaman $currentPage dari $totalPages</li>";			
			}
			else
			{
				$keluaran = $keluaran."<li>.<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto10('$modul','$totalPages','$fungsi', '$param1', '$param2', '$param3', '$param4', '$param5', '$param6', '$param7', '$param8', '$param9', '$param10', '$param11'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a></li>";			
			}
			
			//if(($currentGroupPage > 1) && ($totalGroup != 1))
			if($currentPage > 1)
			{
				//$a = ($indexStartPage -$totalPerPages);
				$a = 1;
				$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11');\">&#60;&#60;</a></li>";
			}
			
			/*if($currentGroupPage > 1)
			{
				$a = 1;
				$keluaran =  $keluaran . "<div class=\"page\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$pertama&nbsp;</a></div>";
			} */
			
			if($currentPage > 1)
				{
					$a = $currentPage -1;
					$keluaran =  $keluaran . "<li class=\"prev\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11');\">Previous</a></li>";
				}
			
			if($totalPages > 1 && $currentPage == 1){
				$keluaran =  $keluaran . "<li class=\"prev disabled\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6');\">Previous</a></li>";
			}
				
			if($totalPages <= $indexEndPage)
			{
				
				for($a=$indexStartPage; $a <= $totalPages; $a ++)
				{
					if($a == $currentPage){
						$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11');\">$a</a></li>";
					}else{
						$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11');\">$a</a></li>";
					}
				}
				
				if($currentPage < $totalPages)
				{
					$a = $currentPage +1;
					$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11');\">Next</a></li>";
				}
			}
			else
			{
				for($a=$indexStartPage; $a<=$indexEndPage; $a++)
				{
					if($a == $currentPage)
						$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11');\">$a</a></li>";
					else
					{
						$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11');\">$a</a></li>";
					}
				}
				
				if($currentPage < $totalPages)
				{
					$a = $currentPage +1;
					$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11');\">Next</a></li>";
				}
				
				/* if($currentGroupPage < $totalGroup)
				{
					$a = $totalPages;
					$keluaran =  $keluaran . "<div class=\"pageFL\"><a href=\"#viewDetail\" idreg='$req_id' svr='$req_svr' currentPage='$a' ctgr='$ctgr' key='$key' sdate='$sdate' edate='$edate' nametitle= \"$LanguangeName\">$terakhir&nbsp;</a></div>";
				}*/
				//if(($totalGroup > 1) && ($currentGroupPage != $totalGroup))
				if ($currentPage <= $totalPages)
				{
					//$a = ($currentGroupPage * $totalPerPages) + 1;
					$a = $totalPages;
					$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage10('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11');\">&#62;&#62;</a></li>";
				}
			}	
			
			$keluaran = $keluaran."      </ul>";
			$keluaran = $keluaran."      </div>";
		}
		
		return $keluaran;
	}
	
	
	
	public function showPage20($totalData, $numToDisplay, $currentPage, $modul, $fungsi, $param1, $param2, $param3, $param4, $param5, $param6, $param7, $param8, $param9, $param10, $param11, $param12, $param13, $param14, $param15, $param16, $param17, $param18, $param19, $param20)
	{
		$totalPages = $this->pager($totalData, $numToDisplay);
		$totalPerPages = 5;
		$totalGroup = $totalPages / $totalPerPages ;
		$modTotalGroup = $totalPages % $totalPerPages ;

		$x = explode(".",$totalGroup);
		$a = 1;
		if($modTotalGroup == 0)
			$totalGroup = $x[0];
		else
			$totalGroup = $x[0] + 1;
		
		
		if($currentPage)
		{
			$currentGroupPage_arr =  explode(".",$currentPage / $totalPerPages);
			if(isset($currentGroupPage_arr[1])){
				if($currentGroupPage_arr[1] != 0)
					$currentGroupPage = $currentGroupPage_arr[0] +1;
				else
					$currentGroupPage = $currentGroupPage_arr[0];
			} else {
				$currentGroupPage = $currentGroupPage_arr[0];
			}
		}
		
		if(!$currentGroupPage)
			$currentGroupPage = 1;
			
		$indexStartPage = (($currentGroupPage - 1) * $totalPerPages ) + 1 ;
		$indexEndPage = $indexStartPage+$totalPerPages-1;
		$dataAwal = (($currentPage - 1) * $numToDisplay ) + 1 ;
		if($currentPage != $totalPages)
		{
			$dataAkhir = $currentPage * $numToDisplay;
		}
		else
		{
			$dataAkhir = $totalData;
		}
		
		$keluaran = "";
		$keluaran = $keluaran."<div class=\"col-lg-12\">";
		$keluaran = $keluaran."<div class=\"pull-right\">Data $dataAwal - $dataAkhir dari total $totalData data</div><br>";
		if($totalPages > 1){
			$keluaran = $keluaran."<ul class=\"pagination pull-right\" >";
			if($totalPages == 1)
			{
				$keluaran = $keluaran."<li>Halaman $currentPage dari $totalPages</li>";			
			}
			else
			{
				$keluaran = $keluaran."<li>.<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto20('$modul','$totalPages','$fungsi', '$param1', '$param2', '$param3', '$param4', '$param5', '$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a></li>";			
			}
			
			if($currentPage > 1)
			{
				$a = 1;
				$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">&#60;&#60;</a></li>";
			}
			
			if($currentPage > 1)
				{
					$a = $currentPage -1;
					$keluaran =  $keluaran . "<li class=\"prev\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">Previous</a></li>";
				}
			
			if($totalPages > 1 && $currentPage == 1){
				$keluaran =  $keluaran . "<li class=\"prev disabled\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">Previous</a></li>";
			}
				
			if($totalPages <= $indexEndPage)
			{
				
				for($a=$indexStartPage; $a <= $totalPages; $a ++)
				{
					if($a == $currentPage){
						$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">$a</a></li>";
					}else{
						$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">$a</a></li>";
					}
				}
				
				if($currentPage < $totalPages)
				{
					$a = $currentPage +1;
					$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">Next</a></li>";
				}
			}
			else
			{
				for($a=$indexStartPage; $a<=$indexEndPage; $a++)
				{
					if($a == $currentPage)
						$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">$a</a></li>";
					else
					{
						$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">$a</a></li>";
					}
				}
				
				if($currentPage < $totalPages)
				{
					$a = $currentPage +1;
					$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">Next</a></li>";
				}
				
				if ($currentPage <= $totalPages)
				{
					$a = $totalPages;
					$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20');\">&#62;&#62;</a></li>";
				}
			}	
			
			$keluaran = $keluaran."      </ul>";
			$keluaran = $keluaran."      </div>";
		}
		
		return $keluaran;
	}
	
	
	
	public function showPage25($totalData, $numToDisplay, $currentPage, $modul, $fungsi, $param1, $param2, $param3, $param4, $param5, $param6, $param7, $param8, $param9, $param10, $param11, $param12, $param13, $param14, $param15, $param16, $param17, $param18, $param19, $param20,$param21, $param22, $param23, $param24, $param25)
	{
		$totalPages = $this->pager($totalData, $numToDisplay);
		$totalPerPages = 5;
		$totalGroup = $totalPages / $totalPerPages ;
		$modTotalGroup = $totalPages % $totalPerPages ;

		$x = explode(".",$totalGroup);
		$a = 1;
		if($modTotalGroup == 0)
			$totalGroup = $x[0];
		else
			$totalGroup = $x[0] + 1;
		
		
		if($currentPage)
		{
			$currentGroupPage_arr =  explode(".",$currentPage / $totalPerPages);
			if(isset($currentGroupPage_arr[1])){
				if($currentGroupPage_arr[1] != 0)
					$currentGroupPage = $currentGroupPage_arr[0] +1;
				else
					$currentGroupPage = $currentGroupPage_arr[0];
			} else {
				$currentGroupPage = $currentGroupPage_arr[0];
			}
		}
		
		if(!$currentGroupPage)
			$currentGroupPage = 1;
			
		$indexStartPage = (($currentGroupPage - 1) * $totalPerPages ) + 1 ;
		$indexEndPage = $indexStartPage+$totalPerPages-1;
		$dataAwal = (($currentPage - 1) * $numToDisplay ) + 1 ;
		if($currentPage != $totalPages)
		{
			$dataAkhir = $currentPage * $numToDisplay;
		}
		else
		{
			$dataAkhir = $totalData;
		}
		
		$keluaran = "";
		$keluaran = $keluaran."<div class=\"col-lg-12\">";
		$keluaran = $keluaran."<div class=\"pull-right\">Data $dataAwal - $dataAkhir dari total $totalData data</div><br>";
		if($totalPages > 1){
			$keluaran = $keluaran."<ul class=\"pagination pull-right\" >";
			if($totalPages == 1)
			{
				$keluaran = $keluaran."<li>Halaman $currentPage dari $totalPages</li>";			
			}
			else
			{
				$keluaran = $keluaran."<li>.<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto20('$modul','$totalPages','$fungsi', '$param1', '$param2', '$param3', '$param4', '$param5', '$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a></li>";			
			}
			
			if($currentPage > 1)
			{
				$a = 1;
				$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">&#60;&#60;</a></li>";
			}
			
			if($currentPage > 1)
				{
					$a = $currentPage -1;
					$keluaran =  $keluaran . "<li class=\"prev\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">Previous</a></li>";
				}
			
			if($totalPages > 1 && $currentPage == 1){
				$keluaran =  $keluaran . "<li class=\"prev disabled\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">Previous</a></li>";
			}
				
			if($totalPages <= $indexEndPage)
			{
				
				for($a=$indexStartPage; $a <= $totalPages; $a ++)
				{
					if($a == $currentPage){
						$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">$a</a></li>";
					}else{
						$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">$a</a></li>";
					}
				}
				
				if($currentPage < $totalPages)
				{
					$a = $currentPage +1;
					$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">Next</a></li>";
				}
			}
			else
			{
				for($a=$indexStartPage; $a<=$indexEndPage; $a++)
				{
					if($a == $currentPage)
						$keluaran =  $keluaran . "<li class=\"active\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">$a</a></li>";
					else
					{
						$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">$a</a></li>";
					}
				}
				
				if($currentPage < $totalPages)
				{
					$a = $currentPage +1;
					$keluaran =  $keluaran . "<li class=\"next\"><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">Next</a></li>";
				}
				
				if ($currentPage <= $totalPages)
				{
					$a = $totalPages;
					$keluaran =  $keluaran . "<li><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage20('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5','$param6', '$param7', '$param8', '$param9', '$param10', '$param11', '$param12', '$param13', '$param14', '$param15', '$param16', '$param17', '$param18', '$param19', '$param20','$param21', '$param22', '$param23', '$param24', '$param25');\">&#62;&#62;</a></li>";
				}
			}	
			
			$keluaran = $keluaran."      </ul>";
			$keluaran = $keluaran."      </div>";
		}
		
		return $keluaran;
	}
	
	public function showPage35($totalData, $numToDisplay, $currentPage, $modul, $fungsi, 
								$param1,  $param2,  $param3, $param4, $param5, 
								$param6,  $param7,  $param8, $param9, $param10, 
								$param11, $param12, $param13, $param14, $param15, 
								$param16, $param17, $param18, $param19, $param20, 
								$param21, $param22, $param23, $param24, $param25,
								$param26, $param27, $param28, $param29, $param30, 
								$param31, $param32, $param33, $param34, $param35, 
								$param36
								)
	{
		$totalPages = $this->pager($totalData, $numToDisplay);
		$totalPerPages = 5;
		$totalGroup = $totalPages / $totalPerPages ;
		$modTotalGroup = $totalPages % $totalPerPages ;

		$x = explode(".",$totalGroup);

		if($modTotalGroup == 0)
			$totalGroup = $x[0];
		else
			$totalGroup = $x[0] + 1;
		
		
		if($currentPage)
		{
			$currentGroupPage_arr =  explode(".",$currentPage / $totalPerPages);
			if($currentGroupPage_arr[1] != 0)
				$currentGroupPage = $currentGroupPage_arr[0] +1;
			else
				$currentGroupPage = $currentGroupPage_arr[0];
		}
		
		if(!$currentGroupPage)
			$currentGroupPage = 1;
			
		$indexStartPage = (($currentGroupPage - 1) * $totalPerPages ) + 1 ;
		$indexEndPage = $indexStartPage+$totalPerPages-1;
		$dataAwal = (($currentPage - 1) * $numToDisplay ) + 1 ;
		if($currentPage != $totalPages)
		{
			$dataAkhir = $currentPage * $numToDisplay;
		}
		else
		{
			$dataAkhir = $totalData;
		}
		
		$keluaran = "";
		//$keluaran = $keluaran."<div id=\"ctBox\">";
		$keluaran = $keluaran."      <div class=\"left\">Data $dataAwal - $dataAkhir dari total $totalData data</div><br>";
		$keluaran = $keluaran."      <div class=\"pagination\">";
		if($totalPages == 1)
		{
			$keluaran = $keluaran." 	 	Halaman $currentPage dari $totalPages : ";			
		}
		else
		{
			$keluaran = $keluaran." 	 	<a title=\"Klik untuk langsung ke halaman ... \" onclick=\"jumpto35('$modul','$totalPages','$fungsi', 
																													'$param1', '$param2', '$param3', '$param4', '$param5', 
																													'$param6', '$param7', '$param8', '$param9', '$param10', 
																													'$param11','$param12', '$param13', '$param14', '$param15', 
																													'$param16', '$param17','$param18', '$param19', '$param20', 
																													'$param21', '$param22', '$param23', '$param24', '$param25', 
																													'$param26', '$param27', '$param28', '$param29', '$param30', 
																													'$param31', '$param32', '$param33', '$param34', '$param35', 
																													'$param36'); return false;\" href=\"#pageCursor\">Halaman $currentPage dari $totalPages</a> : ";			
																							}
		
		
		//if(($currentGroupPage > 1) && ($totalGroup != 1))
		if($currentPage > 1)
		{
			$a = 1;
			$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage35('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5',
																										'$param6', '$param7', '$param8', '$param9', '$param10',
																										'$param11','$param12', '$param13', '$param14', '$param15', 
																										'$param16', '$param17','$param18', '$param19', '$param20', 
																										'$param21', '$param22', '$param23', '$param24', '$param25', 
																										'$param26', '$param27', '$param28', '$param29', '$param30', 
																										'$param31', '$param32', '$param33', '$param34', '$param35', 
																										'$param36');\"><strong>&#60;&#60;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
		}
		

		
		if($currentPage > 1)
			{
				$a = $currentPage -1;
				$keluaran =  $keluaran . "<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage35('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5',
																										'$param6', '$param7', '$param8', '$param9', '$param10',
																										'$param11','$param12', '$param13', '$param14', '$param15', 
																										'$param16', '$param17','$param18', '$param19', '$param20', 
																										'$param21', '$param22', '$param23', '$param24', '$param25',
																										'$param26', '$param27', '$param28', '$param29', '$param30', 
																										'$param31', '$param32', '$param33', '$param34', '$param35', 
																										'$param36');\"><strong>&nbsp;&#60;&nbsp;</strong><span class=\"page-sep\"> </span></a>";
			}
			
		if($totalPages <= $indexEndPage)
		{
			
			for($a=$indexStartPage; $a <= $totalPages; $a ++)
			{
				if($a == $currentPage)
					$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
				else
				{
					$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage35('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5',
																												'$param6', '$param7', '$param8', '$param9', '$param10', 
																												'$param11','$param12', '$param13', '$param14', '$param15', 
																												'$param16', '$param17','$param18', '$param19', '$param20', 
																												'$param21', '$param22', '$param23', '$param24', '$param25', 
																												'$param26', '$param27', '$param28', '$param29', '$param30', 
																												'$param31', '$param32', '$param33', '$param34', '$param35', 
																												'$param36');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				$keluaran =  $keluaran . "<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage35('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5',
																									'$param6', '$param7', '$param8', '$param9', '$param10', 
																									'$param11','$param12', '$param13', '$param14', '$param15', 
																									'$param16', '$param17','$param18', '$param19', '$param20', 
																									'$param21', '$param22', '$param23', '$param24', '$param25', 
																									'$param26', '$param27', '$param28', '$param29', '$param30', 
																									'$param31', '$param32', '$param33', '$param34', '$param35', 
																									'$param36');\"><strong>&#62;</strong></a>";
			}
		}
		else
		{
			for($a=$indexStartPage; $a<=$indexEndPage; $a++)
			{
				if($a == $currentPage)
					$keluaran =  $keluaran . "<span><strong>&nbsp;$a&nbsp;</strong><span class=\"page-sep\"> </span></span>";
				else
				{
					$keluaran =  $keluaran . "<span><a href=\"#pageCursor\" onClick=\"javascript:gantinewPage35('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5',
																												'$param6', '$param7', '$param8', '$param9', '$param10', 
																												'$param11','$param12', '$param13', '$param14', '$param15', 
																												'$param16', '$param17','$param18', '$param19', '$param20', 
																												'$param21', '$param22', '$param23', '$param24', '$param25', 
																												'$param26', '$param27', '$param28', '$param29', '$param30', 
																												'$param31', '$param32', '$param33', '$param34', '$param35', 
																												'$param36');\">&nbsp;$a&nbsp;</a><span class=\"page-sep\"> </span></span>";
				}
			}
			
			if($currentPage < $totalPages)
			{
				$a = $currentPage +1;
				$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage35('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5',
																											'$param6', '$param7', '$param8', '$param9', '$param10', 
																											'$param11','$param12', '$param13', '$param14', '$param15', 
																											'$param16', '$param17','$param18', '$param19', '$param20', 
																											'$param21', '$param22', '$param23', '$param24', '$param25',
																											'$param26', '$param27', '$param28', '$param29', '$param30', 
																											'$param31', '$param32', '$param33', '$param34', '$param35', 
																											'$param36');\"><strong>&#62;</strong><span class=\"page-sep\"> </span></a>&nbsp;";
			}
			if ($currentPage <= $totalPages)
			{
				$a = $totalPages;
				$keluaran =  $keluaran . "&nbsp;<a href=\"#pageCursor\" onClick=\"javascript:gantinewPage35('$modul','$fungsi','$a','$param1','$param2','$param3','$param4','$param5',
																											'$param6', '$param7', '$param8', '$param9', '$param10', 
																											'$param11','$param12', '$param13', '$param14', '$param15', 
																											'$param16', '$param17','$param18', '$param19', '$param20', 
																											'$param21', '$param22', '$param23', '$param24', '$param25',
																											'$param26', '$param27', '$param28', '$param29', '$param30', 
																											'$param31', '$param32', '$param33', '$param34', '$param35', 
																											'$param36');\">&#62;&#62;<span class=\"page-sep\"> </span></a>&nbsp;";
			}
		}	
		
		
		$keluaran = $keluaran."      </div>";
		
		return $keluaran;
	}
	
  /**
           Fungsi ini berguna untuk menampilkan combo tanggal, bulan dan textbox tahun
	 param $namaTgl adalah untuk mewakili property name combo tanggal String|null
	 param $valueTgl adalah untuk mewakili value default combo tanggal String|null
	 param $namaBln adalah untuk mewakili property name combo bulan String|null
	 param $valueBln adalah untuk mewakili value default combo tanggal String|null
	 param $namaThn adalah untuk mewakili property name textbox tahun String|null
	 param $valueThn adalah untuk mewakili value default textbox tanggal String|null
	 Jika property tersebut diisi null maka property tersebut tidak akan muncul di page html
   */
  public function formTanggal_oa($namaTgl,$valueTgl,$namaBln,$valueBln,$namaThn,$valueThn) {
    $ctrl = new Zend_View();
	$tglArr = array("#"=>"--","01"=>"1","02"=>"2","03"=>"3","04"=>"4","05"=>"5","06"=>"6","07"=>"7",
					"08"=>"8","09"=>"9","10"=>"10","11"=>"11","12"=>"12","13"=>"13","14"=>"14","15"=>"15",
					"16"=>"16","17"=>"17","18"=>"18","19"=>"19","20"=>"20","21"=>"21","22"=>"22","23"=>"23",
					"24"=>"24","25"=>"25","26"=>"26","27"=>"27","28"=>"28","29"=>"29","30"=>"30","31"=>"31");
	if ($valueTgl == '' || $valueTgl == null) {
	  $valueTgl = '#';
	}
    $tgl = $ctrl->formSelect($namaTgl,$valueTgl, null, $tglArr);
	
	$blnArr = array("#"=>"--","01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei",
					"06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November",
					"12"=>"Desember");
	if ($valueBln == '' || $valueBln == null) {
	  $valueBln = '#';
	}
    $bln = $ctrl->formSelect($namaBln,$valueBln, null, $blnArr);
	
	$thnAtrib = array("size"=>"4",
	                  "maxlength"=>"4",
					  "onkeyup"=>"javascript:checkNumber(this)",
					  "onkeypress"=>"javascript:checkNumber(this)");
	if ($valueThn == '' || $valueThn == null) {
	  $valueThn = null;
	}
	$thn = $ctrl->formText($namaThn, $valueThn,$thnAtrib);
	
	if ($namaTgl != null) {
	  $xhtml = $tgl;  
	}
	
	if ($namaBln != null) {
	  if ($namaTgl != null) {
	    $xhtml = $xhtml."&nbsp;".$bln;
	  } else {
	    $xhtml = $bln;
	  }
	}
	
	if ($namaThn != null) {
	  if ($namaTgl != null || $namaBln != null) {
	    $xhtml = $xhtml."&nbsp;".$thn;
	  } else {
	    $xhtml = $thn;
	  }
	}
	
	return $xhtml;
  }
  
  /**
         Fungsi untuk konversi tanggal dari format indonesia DD-MM-YYYY menjadi format database YYYY-MM-DD
       */
  public function convertTglHumanToMachine($tglhuman) {
	$tgl = substr($tglhuman, 0, 2);
	//echo "<br>".$tgl;
	$bln = substr($tglhuman, 3, 2);
	//echo "<br>".$bln;
    $thn = substr($tglhuman, 6, 4);
	//echo "<br>".$thn;
	return $thn."-".$bln."-".$tgl;
  }
  
  /**
         Fungsi untuk konversi tanggal dari format database YYYY-MM-DD menjadi format indonesia DD-MM-YYYY
       */
  public function convertTglMachineToHuman($tglmachine) {
	$thn = substr($tglmachine, 0, 4);
	//echo "<br>".$thn;
	$bln = substr($tglmachine, 5, 2);
	//echo "<br>".$bln;
    $tgl = substr($tglmachine, 8, 2);
	//echo "<br>".$tgl;
	return $tgl."-".$bln."-".$thn;
  }
  
  /**
         Fungsi untuk konversi bulan dari format database MM menjadi format bulan singkat indonesia 
       */
	public function getNamaBulanSingkat($mm){

		$mm = $mm*1;
		$namaBulanArr = array('1' =>'Jan', 'Peb', 'Mar', 'Apr',  'Mei', 'Jun',  'Jul', 'Ags', 'Sep', 'Okt', 'Nop', 'Des');
		$namaBulan = $namaBulanArr[$mm];
		
		return $namaBulan;
	}

	/**
         Fungsi untuk konversi bulan dari format database MM menjadi format bulan indonesia 
       */

	public function getNamaBulan($mm)
	{
		$mm = $mm*1;
		$namaBulanArr = array('1' =>'Januari', 'Pebuari', 'Maret', 'April',  'Mei', 'Juni',  'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
		$namaBulan = $namaBulanArr[$mm];
	
		return $namaBulan;
	}
	
	/**
         Fungsi untuk konversi tanggal dari format databaseYYYY-MM-DD  menjadi format tanggal indonesia DD-Month-YYYY
       */
	public function formatTglLengkap($tglmachine){
		$convDate = new oa_date();
		
		$thn = substr($tglmachine, 0, 4);
		$bln = $convDate->getNamaBulan(substr($tglmachine, 5, 2));
		$tgl = substr($tglmachine, 8, 2);
	
		return $tgl."-".$bln."-".$thn;
	}
	
	public function formatTglSingkat($tglmachine){
		$convDate = new oa_date();
		
		$thn = substr($tglmachine, 0, 4);
		$thnSingkat = substr($tglmachine, 2, 2);
		$bln = $convDate->getNamaBulanSingkat(substr($tglmachine, 5, 2));
		$tgl = substr($tglmachine, 8, 2);
	
		return $tgl."-".$bln."-".$thnSingkat;
	}
	
	public function tandatangan($param){
	
		// set the barcode content and type
		$barcodeobj = new TCPDF2DBarcode($param, 'QRCODE,H');

		// output the barcode as HTML object
		$hasil = $barcodeobj->getBarcodeHTML(3, 3, 'black');
		$hasil .= '<style="text-align:center;><font size="0.1px">'.$param.'</font></style>';
	
		return $hasil;
	}

}
?>
<script language="JavaScript" type="text/javascript">
<!--// calculate the ASCII code of the given character
function CalcKeyCode(aChar) {
  var character = aChar.substring(0,1);
  var code = aChar.charCodeAt(0);
  return code;
}

function checkNumber(val) {
  var strPass = val.value;
  var strLength = strPass.length;
  var lchar = val.value.charAt((strLength) - 1);
  var cCode = CalcKeyCode(lchar);

  if ((cCode < 48) || (cCode > 57)) {
    var myNumber = val.value.substring(0, (strLength) - 1);
    val.value = myNumber;
  }
  return false;
}
-->
</script>