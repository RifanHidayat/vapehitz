<?php
class Laporanpurchasesbyproductdetail_Service
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

  public function getlistpurchases()
  {
    $registry = Zend_Registry::getInstance();
    $db = $registry->get('db');

    try {
      $query = "SELECT sub_ordercentral.sub_total, sub_ordercentral.kode_barang, liquid.nama_barang, sub_ordercentral.harga_beli, sub_ordercentral.qty, ordercentral.tgl_order, supplier.nama_supplier, sub_ordercentral.no_order FROM sub_ordercentral INNER JOIN liquid ON sub_ordercentral.kode_barang = liquid.kode_barang INNER JOIN ordercentral ON sub_ordercentral.no_order = ordercentral.no_order INNER JOIN supplier ON ordercentral.kode_supplier = supplier.kode_supplier";
      $result = $db->fetchAll($query);
      $query2 = "SELECT sub_ordercentral.sub_total, sub_ordercentral.kode_barang, accessories.nama_aksesoris AS nama_barang, sub_ordercentral.harga_beli, sub_ordercentral.qty, ordercentral.tgl_order, supplier.nama_supplier, sub_ordercentral.no_order FROM sub_ordercentral INNER JOIN accessories ON sub_ordercentral.kode_barang = accessories.kode_aksesoris INNER JOIN ordercentral ON sub_ordercentral.no_order = ordercentral.no_order INNER JOIN supplier ON ordercentral.kode_supplier = supplier.kode_supplier";
      $result2 = $db->fetchAll($query2);
      $query3 = "SELECT sub_ordercentral.sub_total, sub_ordercentral.kode_barang, atomizer.nama_atomizer AS nama_barang, sub_ordercentral.harga_beli, sub_ordercentral.qty, ordercentral.tgl_order, supplier.nama_supplier, sub_ordercentral.no_order FROM sub_ordercentral INNER JOIN atomizer ON sub_ordercentral.kode_barang = atomizer.kode_atomizer INNER JOIN ordercentral ON sub_ordercentral.no_order = ordercentral.no_order INNER JOIN supplier ON ordercentral.kode_supplier = supplier.kode_supplier";
      $result3 = $db->fetchAll($query3);
      $query4 = "SELECT sub_ordercentral.sub_total, sub_ordercentral.kode_barang, device.nama_device AS nama_barang, sub_ordercentral.harga_beli, sub_ordercentral.qty, ordercentral.tgl_order, supplier.nama_supplier, sub_ordercentral.no_order FROM sub_ordercentral INNER JOIN device ON sub_ordercentral.kode_barang = device.kode_device INNER JOIN ordercentral ON sub_ordercentral.no_order = ordercentral.no_order INNER JOIN supplier ON ordercentral.kode_supplier = supplier.kode_supplier";
      $result4 = $db->fetchAll($query4);
      return array_merge($result, $result2, $result3, $result4);

      // $query = "SELECT supplier.nama_supplier, tgl_order, no_order, sub_total, diskon, jenis_diskon, total_biaya FROM ordercentral INNER JOIN supplier ON ordercentral.kode_supplier = supplier.kode_supplier";
      // $result = $db->fetchAll($query);
      // return $result;

    } catch (Exception $e) {
      echo $e->getMessage() . '<br>';
      return $e->getMessage(); //'Data tidak ada <br>';
    }
  }

  // public function getTotalBysupplier()
  // {
  //   $registry = Zend_Registry::getInstance();
  //   $db = $registry->get('db');
  //   try {
  //     $query = "SELECT ordercentral.kode_supplier, supplier.nama_supplier, SUM(sub_total) AS total
  //     FROM ordercentral JOIN supplier ON ordercentral.kode_supplier = supplier.kode_supplier GROUP BY kode_supplier;";
  //     $result = $db->fetchAll($query);
  //     return $result;
  //   } catch(Exception $e) {
  //     echo $e->getMessage() . '<br>';
  //     return $e->getMessage();
  //   }
  // }
}
