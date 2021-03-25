<?php
class Laporanpurchasesbyproductsummary_Service
{
  private static $instance;
  private function __construct()
  {
  }

  public static function getInstance()
  {
    if (!isset(self::$instance)) {
      $c = __CLASS__;
      self::$instance = new $c;
    }

    return self::$instance;
  }

  public function getTotalByProduct()
  {
    $registry = Zend_Registry::getInstance();
    $db = $registry->get('db');
    try {
      $query = "SELECT sub_ordercentral.kode_barang, liquid.nama_barang, SUM(sub_ordercentral.sub_total) AS total
      FROM sub_ordercentral JOIN liquid ON sub_ordercentral.kode_barang = liquid.kode_barang INNER JOIN ordercentral ON sub_ordercentral.no_order = ordercentral.no_order GROUP BY kode_barang;";
      $result = $db->fetchAll($query);
      $query2 = "SELECT sub_ordercentral.kode_barang, accessories.nama_aksesoris AS nama_barang, SUM(sub_ordercentral.sub_total) AS total
      FROM sub_ordercentral JOIN accessories ON sub_ordercentral.kode_barang = accessories.kode_aksesoris INNER JOIN ordercentral ON sub_ordercentral.no_order = ordercentral.no_order GROUP BY kode_barang;";
      $result2 = $db->fetchAll($query2);
      $query3 = "SELECT sub_ordercentral.kode_barang, atomizer.nama_atomizer AS nama_barang, SUM(sub_ordercentral.sub_total) AS total
      FROM sub_ordercentral JOIN atomizer ON sub_ordercentral.kode_barang = atomizer.kode_atomizer INNER JOIN ordercentral ON sub_ordercentral.no_order = ordercentral.no_order GROUP BY kode_barang;";
      $result3 = $db->fetchAll($query3);
      $query4 = "SELECT sub_ordercentral.kode_barang, device.nama_device AS nama_barang, SUM(sub_ordercentral.sub_total) AS total
      FROM sub_ordercentral JOIN device ON sub_ordercentral.kode_barang = device.kode_device INNER JOIN ordercentral ON sub_ordercentral.no_order = ordercentral.no_order GROUP BY kode_barang;";
      $result4 = $db->fetchAll($query4);
      // $result4 = [];
      return array_merge($result, $result2, $result3, $result4);
    } catch(Exception $e) {
      echo $e->getMessage() . '<br>';
      return $e->getMessage();
    }
  }
}
