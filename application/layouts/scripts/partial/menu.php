<!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
		<?php
		$ket_menu = '';
		$source = '';
		if(isset($this->menu[0]['ket_menu'])){ $ket_menu = $this->menu[0]['ket_menu'];} 
		if(isset($this->menu[0]['source'])){ $source = $this->menu[0]['source'];} 
		?>
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile"><img src="<?php echo $this->baseUrl();?>/img/apple-touch-icon.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?php echo $this->nama;?></h5>
		  <?php $serialize_permission = unserialize($this->permission);?>
		  <li class="mt">
            <a href="index" <?php if($ket_menu == "Dashboard") echo "class='active'";?>>
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
		  <?php if($serialize_permission) { if(in_array('viewSupplier', $serialize_permission)OR 
											   in_array('viewSales', $serialize_permission)OR
											   in_array('viewCustomer', $serialize_permission)OR
											   in_array('viewLiquid', $serialize_permission)OR
											   in_array('viewPerlengkapan', $serialize_permission)OR
											   in_array('viewAksesoris', $serialize_permission)OR
											   in_array('viewAtomizer', $serialize_permission))  {?>
          <li class="sub-menu" id='2'>
            <a href="javascript:;" <?php if($ket_menu == "Master Data") echo "class='active'";?>><i class="fa fa-desktop"></i><span>Master Data</span></a>
            <ul class="sub">
			<?php if($serialize_permission) { if(in_array('viewSupplier', $serialize_permission)) { ?>
              <li <?php if($source == "supplier") echo "class='active'";?>><a href="supplier">Master Data Supplier</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewSales', $serialize_permission)) { ?>
              <li <?php if($source == "sales") echo "class='active'";?>><a href="sales">Master Data Sales</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewCustomer', $serialize_permission)) { ?>
              <li <?php if($source == "customer") echo "class='active'";?>><a href="customer">Master Data Customer</a></li>
			<?php } } ?>
			  <li><hr></li>
			<?php if($serialize_permission) { if(in_array('viewLiquid', $serialize_permission)) { ?>
			  <li <?php if($source == "liquid") echo "class='active'";?>><a href="liquid">Master Data Isi Ulang Liquid</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewPerlengkapan', $serialize_permission)) { ?>
			  <li <?php if($source == "device") echo "class='active'";?>><a href="device">Master Data Device</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewAksesoris', $serialize_permission)) { ?>
			  <li <?php if($source == "accessories") echo "class='active'";?>><a href="accessories">Master Data Aksesoris</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewAtomizer', $serialize_permission)) { ?>
			  <li <?php if($source == "atomizer") echo "class='active'";?>><a href="atomizer">Master Data Atomizer</a></li>
			<?php } } ?>
            </ul>
          </li>
		  <?php } } ?>
		  <?php if($serialize_permission) { if(in_array('viewOrderCentral', $serialize_permission)OR 
											   in_array('viewPembayaranSupplier', $serialize_permission)OR
											   in_array('viewReturSupplier', $serialize_permission)OR
											   in_array('viewPenyelesaianPembelian', $serialize_permission)OR
											   in_array('viewSaleCentral', $serialize_permission)OR
											   in_array('viewPembayaranCustomer', $serialize_permission)OR
											   in_array('viewReturCustomer', $serialize_permission)OR
											   in_array('viewPenyelesaianPenjualan', $serialize_permission)OR
											   in_array('viewSopGudang', $serialize_permission)OR
											   in_array('viewBadstockGudang', $serialize_permission)OR
											   in_array('viewReqtoRetail', $serialize_permission)OR
											   in_array('viewReqtoStudio', $serialize_permission)OR
											   in_array('viewApprvCentral', $serialize_permission))  {?>
		  <li class="sub-menu">
            <a href="javascript:;" <?php if($ket_menu == "Transaksi Pusat") echo "class='active'";?>>
              <i class="fa fa-cogs"></i>
              <span>Transaksi Pusat</span>
              </a>
            <ul class="sub">
			<?php if($serialize_permission) { if(in_array('viewOrderCentral', $serialize_permission)) { ?>
              <li <?php if($source == "ordercentral") echo "class='active'";?>><a href="ordercentral">Pembelian Barang</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewPembayaranSupplier', $serialize_permission)) { ?>
              <li <?php if($source == "pembayaransupplier") echo "class='active'";?>><a href="pembayaransupplier">Pembayaran Supplier (Hutang)</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewReturSupplier', $serialize_permission)) { ?>
              <li <?php if($source == "retursupplier") echo "class='active'";?>><a href="retursupplier">Retur Barang Pembelian</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewPenyelesaianPembelian', $serialize_permission)) { ?>
			  <li <?php if($source == "penyelesaianpembelian") echo "class='active'";?>><a href="penyelesaianpembelian">Penyelesaian Retur</a></li>
			<?php } } ?>
			  <li><hr></li>
			<?php if($serialize_permission) { if(in_array('viewSaleCentral', $serialize_permission)) { ?>
			  <li <?php if($source == "salecentral") echo "class='active'";?>><a href="salecentral">Penjualan Barang</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewPembayaranCustomer', $serialize_permission)) { ?>
              <li <?php if($source == "pembayarancustomer") echo "class='active'";?>><a href="pembayarancustomer">Pembayaran Pelanggan (Piutang)</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewReturCustomer', $serialize_permission)) { ?>
              <li <?php if($source == "returcustomer") echo "class='active'";?>><a href="returcustomer">Retur Barang Penjualan</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewPenyelesaianPenjualan', $serialize_permission)) { ?>
			  <li <?php if($source == "penyelesaianpenjualan") echo "class='active'";?>><a href="penyelesaianpenjualan">Penyelesaian Retur</a></li>
			<?php } } ?>
			  <li><hr></li>
			<?php if($serialize_permission) { if(in_array('viewSopGudang', $serialize_permission)) { ?>
			  <li <?php if($source == "sopgudang") echo "class='active'";?>><a href="sopgudang">Stock Opname</a></li>
			<?php } } ?>
			  <?php if($serialize_permission) { if(in_array('viewBadstockGudang', $serialize_permission)) { ?>
              <li <?php if($source == "badstockgudang") echo "class='active'";?>><a href="badstockgudang">Pengeluaran Bad Stock</a></li>
			<?php } } ?>
			  <li><hr></li>
			<?php if($serialize_permission) { if(in_array('viewReqtoRetail', $serialize_permission)) { ?>
			  <li <?php if($source == "reqtoretail") echo "class='active'";?>><a href="reqtoretail">Permintaan ke Retail</a></li>
			<?php } } ?>
			  <?php if($serialize_permission) { if(in_array('viewReqtoStudio', $serialize_permission)) { ?>
              <li <?php if($source == "reqtostudio") echo "class='active'";?>><a href="reqtostudio">Permintaan ke Studio</a></li>
			<?php } } ?>
			  <li><hr></li>
			<?php if($serialize_permission) { if(in_array('viewApprvCentral', $serialize_permission)) { ?>
			  <li <?php if($source == "reqfromretail") echo "class='active'";?>><a href="reqfromretail">Permintaan Dari Retail</a></li>
			<?php } } ?>
			  <?php if($serialize_permission) { if(in_array('viewApprvCentral', $serialize_permission)) { ?>
			  <li <?php if($source == "reqfromstudio") echo "class='active'";?>><a href="reqfromstudio">Permintaan Dari Studio</a></li>
			<?php } } ?>
            </ul>
          </li>
		  <?php } } ?>
		  <?php if($serialize_permission) { if(in_array('viewApprvRetail', $serialize_permission)OR 
											   in_array('viewReqretailToCentral', $serialize_permission)OR
											   in_array('viewSaleRetail', $serialize_permission)OR
											   in_array('viewReturSaleRetail', $serialize_permission)OR
											   in_array('viewSopRetail', $serialize_permission))  {?>
		  <li class="sub-menu">
            <a href="javascript:;" <?php if($ket_menu == "Transaksi Retail") echo "class='active'";?>>
              <i class="fa fa-book"></i>
              <span>Transaksi Retail</span>
              </a>
            <ul class="sub">
			<?php if($serialize_permission) { if(in_array('viewApprvRetail', $serialize_permission)) { ?>
			  <li <?php if($source == "apprvretail") echo "class='active'";?>><a href="apprvretail">Permintaan Dari Pusat</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewReqretailToCentral', $serialize_permission)) { ?>
              <li <?php if($source == "reqretailtocentral") echo "class='active'";?>><a href="reqretailtocentral">Permintaan Ke Gudang Pusat</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewSaleRetail', $serialize_permission)) { ?>  
			  <li <?php if($source == "saleretail") echo "class='active'";?>><a href="saleretail">Penjualan Barang</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewReturSaleRetail', $serialize_permission)) { ?>  
			  <li <?php if($source == "retursaleretail") echo "class='active'";?>><a href="retursaleretail">Retur Barang Penjualan</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewSopRetail', $serialize_permission)) { ?>  
			  <li <?php if($source == "sopretail") echo "class='active'";?>><a href="sopretail">Stock Opname</a></li>
			<?php } } ?>
            </ul>
          </li>
		  <?php } } ?>
		  <?php if($serialize_permission) { if(in_array('viewApprvStudio', $serialize_permission)OR 
											   in_array('viewReqstudioToCentral', $serialize_permission)OR
											   in_array('viewSaleStudio', $serialize_permission)OR
											   in_array('viewReturSaleStudio', $serialize_permission)OR
											   in_array('viewSopStudio', $serialize_permission))  {?>
		  <li class="sub-menu">
            <a href="javascript:;" <?php if($ket_menu == "Transaksi Studio") echo "class='active'";?>>
              <i class="fa fa-tasks"></i>
              <span>Transaksi Studio</span>
              </a>
            <ul class="sub">
			<?php if($serialize_permission) { if(in_array('viewApprvStudio', $serialize_permission)) { ?>
			  <li <?php if($source == "apprvstudio") echo "class='active'";?>><a href="apprvstudio">Permintaan Dari Pusat</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewReqstudioToCentral', $serialize_permission)) { ?>
              <li <?php if($source == "reqstudiotocentral") echo "class='active'";?>><a href="reqstudiotocentral">Permintaan Ke Gudang Pusat</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewSaleStudio', $serialize_permission)) { ?>
			  <li <?php if($source == "salestudio") echo "class='active'";?>><a href="salestudio">Penjualan Barang</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewReturSaleStudio', $serialize_permission)) { ?>
			  <li <?php if($source == "retursalestudio") echo "class='active'";?>><a href="retursalestudio">Retur Barang Penjualan</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewSopStudio', $serialize_permission)) { ?>
			  <li <?php if($source == "sopstudio") echo "class='active'";?>><a href="sopstudio">Stock Opname</a></li>
			<?php } } ?>
            </ul>
          </li>
		  <?php } } ?>
		  <?php if($serialize_permission) { if(in_array('viewVolLiquid', $serialize_permission)OR 
											   in_array('viewJenisDevice', $serialize_permission)OR
											   in_array('viewJenisAcc', $serialize_permission)OR
											   in_array('viewJenisAtomizer', $serialize_permission)OR
											   in_array('viewRekening', $serialize_permission)OR
											   in_array('viewRasaLiquid', $serialize_permission)OR
											   in_array('viewWarna', $serialize_permission)OR
											   in_array('viewKatRetur', $serialize_permission)OR
											   in_array('viewDateLine', $serialize_permission))  {?>
		  <li class="sub-menu">
            <a href="javascript:;" <?php if($ket_menu == "Parameter") echo "class='active'";?>>
              <i class="fa fa-tasks"></i>
              <span>Parameter</span>
              </a>
            <ul class="sub">
			<?php if($serialize_permission) { if(in_array('viewVolLiquid', $serialize_permission)) { ?>
              <li <?php if($source == "volliquid") echo "class='active'";?>><a href="volliquid">Data Isi Volume Liquid</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewJenisDevice', $serialize_permission)) { ?>
			  <li <?php if($source == "jenisdevice") echo "class='active'";?>><a href="jenisdevice">Data Jenis Device</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewJenisAcc', $serialize_permission)) { ?>
			  <li <?php if($source == "jenisacc") echo "class='active'";?>><a href="jenisacc">Data Jenis Aksesoris</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewJenisAtomizer', $serialize_permission)) { ?>
			  <li <?php if($source == "jenisatomizer") echo "class='active'";?>><a href="jenisatomizer">Data Jenis Atomizer</a></li>
			<?php } } ?>
		<!-- 	<?php if($serialize_permission) { if(in_array('viewRekening', $serialize_permission)) { ?>
			  <li <?php if($source == "rekening") echo "class='active'";?>><a href="rekening">Data Bank Pembayaran</a></li>
			<?php } } ?> -->
			<?php if($serialize_permission) { if(in_array('viewRasaLiquid', $serialize_permission)) { ?>
			  <li <?php if($source == "rasaliquid") echo "class='active'";?>><a href="rasaliquid">Data Rasa Liquid</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewWarna', $serialize_permission)) { ?>

			  <li <?php if($source == "warna") echo "class='active'";?>><a href="warna">Data Warna</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewKatRetur', $serialize_permission)) { ?>
			  <li <?php if($source == "katretur") echo "class='active'";?>><a href="katretur">Kategori Retur Barang</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewDateLine', $serialize_permission)) { ?>
			  <li <?php if($source == "dateline") echo "class='active'";?>><a href="dateline">Batas Waktu Transaksi</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewDateLine', $serialize_permission)) { ?>
			  <li <?php if($source == "rekening") echo "class='active'";?>><a href="jenisexpense">Data Jenis Expense</a></li>
			<?php } } ?>
            </ul>
          </li>
		  <?php } } ?>
		  <li class="sub-menu">
            <a href="laporan" <?php if($ket_menu == "Laporan") echo "class='active'";?>>
              <i class="fa fa-dashboard"></i>
              <span>Laporan</span>
              </a>
          </li>
		  <?php if($serialize_permission) { if(in_array('viewGroups', $serialize_permission)OR 
											   in_array('viewUsers', $serialize_permission)OR
											   in_array('viewGntPassword', $serialize_permission))  {?>
		  <li class="sub-menu">
            <a href="javascript:;" <?php if($ket_menu == "Administrator") echo "class='active'";?>>
              <i class="fa fa-tasks"></i>
              <span>Administrator</span>
              </a>
            <ul class="sub">
			<?php if($serialize_permission) { if(in_array('viewGroups', $serialize_permission)) { ?>
              <li <?php if($source == "groups") echo "class='active'";?>><a href="groups">Data Groups</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewUsers', $serialize_permission)) { ?>
			  <li <?php if($source == "user") echo "class='active'";?>><a href="user">Data User</a></li>
			<?php } } ?>
			<?php if($serialize_permission) { if(in_array('viewGntPassword', $serialize_permission)) { ?>
			  <li <?php if($source == "gntpassword") echo "class='active'";?>><a href="gntpassword">Ganti Password</a></li>
            <?php } } ?>
			</ul>
          </li>
		  <?php } } ?>

		   <?php if($serialize_permission) { if(in_array('viewGroups', $serialize_permission)OR 
											   in_array('viewUsers', $serialize_permission)OR
											   in_array('viewGntPassword', $serialize_permission))  {?>
		  <li class="sub-menu">
            <a href="javascript:;" <?php if($ket_menu == "Finance") echo "class='active'";?>>
              <i class="fa fa-tasks"></i>
              <span>Finance</span>
              </a>
            <ul class="sub">
            	<?php if($serialize_permission) { if(in_array('viewGroups', $serialize_permission)) { ?>
              <li <?php if($source == "akun") echo "class='active'";?>><a href="tambahakun">Tambah Sumber Dana</a></li>
			<?php } } ?>

			<?php if($serialize_permission) { if(in_array('viewGroups', $serialize_permission)) { ?>
              <li <?php if($source == "cashincashout") echo "class='active'";?>><a href="cashincashout">Cash In  Cash Out</a></li>
			<?php } } ?>

				<?php if($serialize_permission) { if(in_array('viewGroups', $serialize_permission)) { ?>
              <li <?php if($source == "transaksi") echo "class='active'";?>><a href="transaksi">Transaksi</a></li>
			<?php } } ?>
			

			
			
			
			</ul>
          </li>
		  <?php } } ?>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->