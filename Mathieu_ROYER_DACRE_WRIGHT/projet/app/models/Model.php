<?php

class Model extends PDO {

 private static $_instance;

 public function __construct() {
 }

 public static function getInstance() {
  // Inclure la config une seule fois
  static $included = false;
  if (!$included) {
      include_once __DIR__ . '/../controllers/config.php';
      $included = true;
  }

  if (DEBUG) echo ("Model : getInstance : dsn = $dsn</br>");

  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  if (!isset(self::$_instance)) {
   try {
    self::$_instance = new PDO($dsn, $username, $password, $options);
   } catch (PDOException $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   }
  }
  return self::$_instance;
 }

}
?>
