ll
cd public_html/
ifconfig 
ll
scp -r application/ library/ public_html/ wbs@10.1.94.84:/home/wbs
ll
scp -r application/ library/ public_html/ wbs@10.1.94.84:/home/wbs
cd
su - portal
su - portal-new
exit
cd library/service/admin/
scp Plaint_Service.php wbs@10.1.94.84:/home/wbs/library/service/admin
cd
cd application/modules/cmsmodule/controllers/
scp PlaintController.php wbs@10.1.94.84:/home/wbs/application/modules/cmsmodule/controllers
cd application/modules/cmsmodule/views/scripts/user
ll
pwd
scp -r useradminform.phtml cekuseradmin.phtml wbs@10.1.94.84:/home/wbs/application/modules/cmsmodule/views/scripts/user
cd ..
ll
cd plaint
ll
pwd
scp -r listplaint.phtml plaint.phtml wbs@10.1.94.84:/home/wbs/application/modules/cmsmodule/views/scripts/plaint
cd
cd 
cd application/modules/cmsmodule/
cd controllers/
ll
pwd
scp -r UserController.php PlaintController.php wbs@10.1.94.84:/home/wbs/application/modules/cmsmodule/controllers
cd
ll
cd application/layouts/scripts/admin
ll
pwd
cd partial
pwd
scp -r menu-admin.php wbs@10.1.94.84:/home/wbs/application/layouts/scripts/admin/partial
cd ..
ll
pwd
scp -r login-layout.phtml wbs@10.1.94.84:/home/wbs/application/layouts/scripts/admin
cd
cd library/service/admin
ll
pwd
scp -r User_Service.php wbs@10.1.94.84:/home/wbs/library/service/admin
cd
cd public_html/assets/images/backgrounds/
pwd
scp -r DSC_0147.jpg wbs@10.1.94.84:/home/wbs/public_html/assets/images/backgrounds
cd
ll
cd public_html/assets/build/css/
pwd
scp -r style.css wbs@10.1.94.84:/home/wbs/public_html/assets/build/css
ll
cd
cd library/service/admin/
ll
pwd
scp -r Plaint_Service.php User_Service.php Referensi_Service.php About_Service.php wbs@10.1.94.84:/home/wbs/library/service/admin
ll
scp -r application/ library/ public_html/ wbs@10.1.94.84:/home/wbs
ll
cd library/service/
pwd
scp -r User_Service.php wbs@10.1.94.84:/home/wbs/library/service
cd 
cd application/layouts/scripts/partial
pwd
scp register.php wbs@10.1.94.84:/home/wbs/application/layouts/scripts/partial
cd home/wbs/application/controllers/
cd /home/wbs/application/controllers/
scp UserController.php wbs@10.1.94.84:/home/wbs/application/controllers
scp /home/wbs/library/share/Portalconf.php wbs@10.1.94.84:home/wbs/library/share
scp /home/wbs/library/share/Portalconf.php wbs@10.1.94.84:/home/wbs/library/share
scp /home/wbs/application/modules/cmsmodule/views/scripts/plaint/listplaint.phtml wbs@10.1.94.84:/home/wbs/application/modules/cmsmodule/views/scripts/plaint
scp /home/wbs/public_html/assets/images/backgrounds/DSC_0147.jpg wbs@10.1.94.84:/home/wbs/public_html/assets/images/backgrounds/
cd
scp application/views/scripts/pengaduan/editpengaduan.phtml wbs@10.1.94.84:application/views/scripts/pengaduan
ll
ls -l
ll -a
la
ls -la
ll -a
ll
ll -a
ls -F
ll
cd application/
ll
ls -F
ll -t
ll -r
ll
ll -tr
ll -atr
history
cd
ll
cd application/
ll
ll -a
cd
ll
cd logs
ll
cd library
cd ../library/
ll
ll -a
c
cd
ls -RCatr
ls -RdCaltr
ll
ll -d
ll --color
ls
ll -C
tree
tree -d
scp /home/wbs/application/layouts/scripts/formpengaduan.phtml wbs@10.1.94.84:/home/wbs/application/layouts/scripts
ll
scp -r application/ library/ public_html/ wbs@10.1.94.84:/home/wbs
cp -R application/controllers/UserController.php application/controllers/UserController.php_20191004
cp -R application/layouts/scripts/partial/register.php application/layouts/scripts/partial/register.php_20191004
su - portal-new
cd application/layouts/scripts/
ll
cp formpengaduan.phtml formpengaduan.phtml_20191008
ll
pwd
ll
cd
cd application/controllers/
ll
cp PengaduanController.php PengaduanController.php_20191008
ll
pwd
ll
mkdir application-test
ll
cd 
ll
cd library/
ll
mkdir service-test
ll
cd ..
ll
cd application-test/
ll
cd ..
ll
cd library/
ll
cd service-test/
ll
cd
cd application
ll
scp -r controllers/ layouts/ modules/ views/ wbs@10.1.94.84:/home/wbs/application
ll
cd ../
ll
scp -r library/ public_html/ portal@10.1.94.84:/home/wbs
scp -r library/ public_html/ wbs@10.1.94.84:/home/wbs
cd public_html/
ll
cd admin/
ll
cd ../
ll
ll -a
cd application/controllers/
scp UserController.php wbs@10.1.94.84:application/controllers/
cd
cd application/layouts/scripts/partial/
scp register.php wbs@10.1.94.84:application/layouts/scripts/partial/
cd
cd application/views/scripts/user/
scp cekemail.phtml wbs@10.1.94.84:application/views/scripts/user/
cd
cd library/service/
scp User_Service.php wbs@10.1.94.84:library/service/
cd
cd application/modules/cmsmodule/views/scripts/about/
scp when.phtml legal.phtml definition.phtml wbs@10.1.94.84:application/modules/cmsmodule/views/scripts/about/
ll
cd application
ll
scp -r controllers layouts modules views wbs@10.1.94.84:/home/wbs/application
cd ../
ll
scp -r library/ public_html/ wbs@10.1.94.84:/home/wbs
cd library/
ll
cd public_html/
ll
scp -r _lib/ sysadmin@10.212.1.63:/web-source/wbs/public_html
scp -r sendmail.php sysadmin@10.212.1.63:/web-source/wbs/public_html
sudo vi sendmail.php 
cd application/controllers/
ll
cd /
cd
cd public_html/
ll
more sendmail.php 
scp -r application/controllers/IndexController.php wbs@10.1.94.84:/home/wbs/application/controllers/IndexController.php
scp -r library/service/Home_Service.php wbs@10.1.94.84:/home/wbs/library/service/Home_Service.php
scp -r library/service/finance/Pebopl_Service.php portal@10.1.94.84:/home/portal/library/service/finance/Pebopl_Service.php
cd
exit
ll
