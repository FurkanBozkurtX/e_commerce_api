<?php
/*
 * Static PDO MySQL DB Class
 *
 * MySQL
 * bağlantısı yapan ve rahat bir şekilde
 * kullanabileceğiniz bir static PDO sınıfı.
 *
 */

class DB
{

     /*
      * uusssss
      */
     static $pdo = null;

     /*
      * Kullanacağımız veritabanı karakter seti
      */
     static $charset = 'UTF8';

     /*
      * Son yapılan sorguyu saklar
      */
     static $last_stmt = null;

     /*
      * PDO örneğini yoksa oluşturan, varsa
      * oluşturulmuş olanı döndüren metot
      */
     public static function instance()
     {
          return
               self::$pdo == null ?
               self::init() :
               self::$pdo;
     }

     /*
      * PDO'yu tanımlayan ve bağlantıyı
      * kuran metot
      */
     public static function init()
     {
          self::$pdo = new PDO(
               'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB,
               MYSQL_USER,
               MYSQL_PASS
          );

          self::$pdo->exec('SET NAMES `' . self::$charset . '`');
          self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

          return self::$pdo;
     }

     /*
      * PDO'nun query metoduna bindings
      * ilave edilmiş metot
      */
     public static function query($query, $bindings = null)
     {
          if (is_null($bindings)) {
               if (!self::$last_stmt = self::instance()->query($query))
                    return false;
          } else {
               self::$last_stmt = self::prepare($query);
               if (!self::$last_stmt->execute($bindings))
                    return false;
          }

          return self::$last_stmt;
     }

     /*
      * Yapılan sorgunun ilk satırının
      * ilk değerini döndüren metod
      */
     public static function getVar($query, $bindings = null)
     {
          if (!$stmt = self::query($query, $bindings))
               return false;

          return $stmt->fetchColumn();
     }

     /*
      * Yapılan sorgunun ilk satırını
      * döndğren metod
      */
     public static function getRow($query, $bindings = null)
     {
          if (!$stmt = self::query($query, $bindings))
               return false;

          return $stmt->fetch();
     }

     /*
      * Yapılan sorgunun ilk satırını
      * döndğren metod
      */
     public static function getAll($query, $bindings = null)
     {
          if (!$stmt = self::query($query, $bindings))
               return false;

          return $stmt->fetchAll();
     }

     /*
      * Yapılan sorgunun tüm satırlarını
      * döndüren metod
      */
     public static function get($query, $bindings = null)
     {
          if (!$stmt = self::query($query, $bindings))
               return false;

          $result = array();

          foreach ($stmt as $row)
               $result[] = $row;

          return $result;
     }

     /*
      * Query metodu ile aynı işlemi yapar
      * fakat etkilenen satır sayısını
      * döndürür
      */
     public static function exec($query, $bindings = null)
     {
          if (!$stmt = self::query($query, $bindings))
               return false;

          return $stmt->rowCount();
     }

     /*
      * Query metodu ile aynı işlemi yapar
      * fakat son eklenen ID'yi döndürür
      */
     public static function insert($query, $bindings = null)
     {
          if (!$stmt = self::query($query, $bindings))
               return false;

          return self::$pdo->lastInsertId();
     }

     public static function insertData($data = [], $table)
     {
          $sql_text = '';
          $sql_array_text = '';
          $sql_array = [];

          foreach ($data as $key => $value) {
               $sql_text .= $key . ',';
               $sql_array_text .= '?,';
               $sql_array[] = $value;
          }
          $sql_text = trim($sql_text, ',');
          $sql_array_text = trim($sql_array_text, ',');
          $sql_text = $table . '(' . $sql_text . ') VALUES(' . $sql_array_text . ')';
          //return 'INSERT INTO '.$sql_text.p($sql_array);
          return DB::insert('INSERT INTO ' . $sql_text, $sql_array);
     }

     public static function updateData($data = [], $table, $where = [])
     {
          $sql_text = '';
          $sql_array = [];

          foreach ($data as $key => $value) {
               $sql_text .= $key . '=?,';
               $sql_array[] = $value;
          }
          $sql_text = trim($sql_text, ',');
          $sql_text .= ' WHERE ';
          foreach ($where as $key => $val) {
               $sql_text .= $key . '=? AND ';
               $sql_array[] = $val;
          }
          $sql_text = trim($sql_text, 'AND ');

          return DB::exec('UPDATE ' . $table . ' SET ' . $sql_text, $sql_array);
     }

     /*
      * Son gerçekleşen sorgudaki (varsa)
      * hatayı döndüren metod
      */
     public static function getLastError()
     {
          $error_info = self::$last_stmt->errorInfo();

          if ($error_info[0] == 00000)
               return false;

          return $error_info;
     }

     /*
      * Statik olarak çağırılan ve yukarıda olmayan
      * tüm metodları PDO'da çağıran sihirli metot
      */
     public static function __callStatic($name, $arguments)
     {
          return call_user_func_array(
               array(self::instance(), $name),
               $arguments
          );
     }
}