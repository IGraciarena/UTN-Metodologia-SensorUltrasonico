<?php namespace DAO;
use PDO;
require_once  dirname(__DIR__) ."/Config/Config.php";
//require_once ROOT."Config/Config.php";
class Connection {
     private $pdo = null;
     private $pdoStatement = null;
     private static $instance = null;
     /**
      *
      */
     public function __construct() {
          try {
               $this->pdo = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
               $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
          } catch (Exception $ex) {
               throw $ex;
          }
     }
     /**
      *
      */
     public static function getInstance()
     {
         if(self::$instance == null)
            self::$instance = new Connection();
         return self::$instance;
     }

     /**
      *
      */
      public function execute($query, $parameters = array())
      {
           try
           {
                // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
                $this->pdoStatement = $this->pdo->prepare($query);
                foreach($parameters as $parameterName => $value)
                {
                     // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
                     $this->pdoStatement->bindParam(":".$parameterName, $value);
                }
                $this->pdoStatement->execute();
                return $this->pdoStatement->fetchAll();
           }
           catch(Exception $ex)
           {
                throw $ex;
           }
      }

        /**
      *
      */
      public function execute4PagesByDate($query, $parameters = array())
      {
           try
           {
                // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
                $this->pdoStatement = $this->pdo->prepare($query);
                
                     // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
                $this->pdoStatement->bindParam(":iniciar", $parameters["iniciar"],PDO::PARAM_INT);
                $this->pdoStatement->bindParam(":narticulos", $parameters["narticulos"],PDO::PARAM_INT);
                $this->pdoStatement->bindParam(":searchDate", $parameters["searchDate"],PDO::PARAM_STR);
                $this->pdoStatement->execute();
                return $this->pdoStatement->fetchAll();
           }
           catch(Exception $ex)
           {
                throw $ex;
           }
      }
   /**
      *
      */
      public function execute4PagesByDateRowCount($query, $parameters = array())
      {
           try
           {
                // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
                $this->pdoStatement = $this->pdo->prepare($query);
                
                     // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
                $this->pdoStatement->bindParam(":searchDate", $parameters["searchDate"],PDO::PARAM_STR);
                $this->pdoStatement->execute();
                $a = $this->pdoStatement->rowCount();
                return $a;
           }
           catch(Exception $ex)
           {
                throw $ex;
           }
      }
     /**
      * //execute para paginacion con todos los registrosa
      */
     public function execute4Pages($query, $parameters = array())
     {
          try
          {
			// Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
               $this->pdoStatement = $this->pdo->prepare($query);
               
                    // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
               $this->pdoStatement->bindParam(":iniciar", $parameters["iniciar"],PDO::PARAM_INT);
               $this->pdoStatement->bindParam(":narticulos", $parameters["narticulos"],PDO::PARAM_INT);
               $this->pdoStatement->execute();
               return $this->pdoStatement->fetchAll();
          }
          catch(Exception $ex)
          {
               throw $ex;
          }
     }
     //trae la cantidad de registros almacenados
     public function executeAndReturnRowsCount($query, $parameters = array())
     {
          try
          {
			// Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
               $this->pdoStatement = $this->pdo->prepare($query);
               foreach($parameters as $parameterName => $value)
               {
                    // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
                    $this->pdoStatement->bindParam(":".$parameterName, $value);
               }
               $this->pdoStatement->execute();
               return $this->pdoStatement->rowCount();
          }
          catch(Exception $ex)
          {
               throw $ex;
          }
     }
     /**
      *
      */
     public function executeNonQuery($query, $parameters = array())
     {
          try
          {
               // Creo una sentencia llamando a prepare. Esto devuelve un objeto statement
               $this->pdoStatement = $this->pdo->prepare($query);
               foreach($parameters as $parameterName => $value) {
                    // Reemplazo los marcadores de parametro por los valores reales utilizando el método bindParam().
                    $this->pdoStatement->bindParam(":$parameterName", $parameters[$parameterName]);
               }
               $this->pdoStatement->execute();
               return $this->pdoStatement->rowCount();
          }
          catch(\PDOException $ex)
          {
               throw $ex;
          }
     }
}