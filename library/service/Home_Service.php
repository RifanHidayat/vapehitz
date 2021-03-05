<?php
class Home_Service {
    private static $instance;
    private function __construct() {
    }

    public static function getInstance() {
       if (!isset(self::$instance)) {
           $c = __CLASS__;
           self::$instance = new $c;
       }

       return self::$instance;
    }
    public function getOrderCentralTotalPerMonth() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE YEAR(tgl_order) = YEAR(CURRENT_DATE) GROUP BY MONTH(tgl_order) ORDER BY SUM(total) DESC";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }

    public function getOrderCentralTotal() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }

    public function getOrderCentralJanuari() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='01' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralFebruari() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='02' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralMaret() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='03' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralApril() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='04' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralMei() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='05' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralJuni() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='06' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralJuli() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='07' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralAgustus() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='08' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralSeptember() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='09' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralOktober() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='10' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralNovember() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='11' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getOrderCentralDesember() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total) FROM ordercentral WHERE MONTH(tgl_order) ='12' AND YEAR(tgl_order) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralJanuari() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='01' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralFebruari() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='02' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralMaret() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='03' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralApril() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='04' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralMei() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='05' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralJuni() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='06' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralJuli() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='07' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralAgustus() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='08' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralSeptember() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='09' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralOktober() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='10' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralNovember() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='11' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleCentralDesember() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(net_total) FROM salecentral WHERE MONTH(tgl_invoice) ='12' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail1() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='01' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail2() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='02' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail3() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='03' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail4() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='04' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail5() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='05' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail6() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='06' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail7() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='07' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail8() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='08' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail9() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='09' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail10() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='10' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail11() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='11' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleRetail12() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM saleretail WHERE MONTH(tgl_invoice) ='12' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio1() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='01' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio2() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='02' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio3() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='03' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio4() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='04' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio5() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='05' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio6() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='06' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio7() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='07' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio8() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='08' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio9() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='09' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio10() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='10' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio11() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='11' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getSaleStudio12() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT SUM(total_biaya) FROM salestudio WHERE MONTH(tgl_invoice) ='12' AND YEAR(tgl_invoice) = YEAR(CURRENT_DATE)";
            $result = $db->fetchOne($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
    public function getData($id) {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT user.user_id, user.password, user.nama, user.email, user.group
					 FROM user WHERE user.user_id='$id'";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getmenu() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * from menu where source = 'index' ";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataMainMenu() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * FROM menu where substr(menu_level,3,1) = '0' order by kode_menu asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
	
	public function getDataSubMenu() {
        $registry = Zend_Registry::getInstance();
        $db = $registry->get('db');

        try {
            $query ="SELECT * FROM menu where substr(menu_level,3,1) != '0' order by kode_menu asc";
            $result = $db->fetchAll($query);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage() . '<br>';
            return $e->getMessage(); //'Data tidak ada <br>';
        }
    }
}
?>