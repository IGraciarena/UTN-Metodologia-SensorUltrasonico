<?php namespace DAO;

    use DAO\Connection as Connection;
    use Models\ClassInfo as Info; 
    require_once "Connection.php";
    require_once  dirname(__DIR__) ."/Models/ClassInfo.php";
    
    class InfoDao{
        
        //ATRIBUTES
        private $connection;

        //CONSTRUCT
        public function __construct()
        {
            $this->connection = null;
        }

        public function add($distancia){

            $sql = "INSERT INTO distancia(valor,fecha,hora) VALUES (:valor,curdate(),curtime())";
            $parameters["valor"]=$distancia;
            try{
                //creo la instancia de conexion
                $this->connection = Connection::getInstance();
                return $this->connection->ExecuteNonQuery($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
        }
          /*
        *Trae todas los datos del sensor, de a 10 para la paginacion
        */
        public function getRow4Page($iniciar,$art_x_pag){
            $sql="SELECT * FROM distancia limit :iniciar,:narticulos";
            $parameters["iniciar"]=$iniciar;
            $parameters["narticulos"]=$art_x_pag;
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute4Pages($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
            //hay que mapear de un arreglo asociativo a objetos
            if(!empty($result)){
                return $this->mapear($result);
            }else{
                return false;
            }
        }
         /*
        *
        */
        public function getRow4PageByDate($iniciar,$art_x_pag,$searchDate){
            $sql="SELECT * FROM distancia where fecha = :searchDate limit :iniciar,:narticulos";
            $parameters["iniciar"]=$iniciar;
            $parameters["narticulos"]=$art_x_pag;
            $parameters["searchDate"]=$searchDate;
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute4PagesByDate($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
            //hay que mapear de un arreglo asociativo a objetos
            if(!empty($result)){
                return $this->mapear($result);
            }else{
                return false;
            }
        }
        /*
        *
        */
        public function getCountRow4PageByDate($searchDate){
            $sql="SELECT * FROM distancia where fecha = :searchDate";
            $parameters["searchDate"]=$searchDate;
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute4PagesByDateRowCount($sql,$parameters);
            }catch(\PDOException $ex){
                throw $ex;
            } 
            //hay que mapear de un arreglo asociativo a objetos
            if(!empty($result)){
                return $result;
            }else{
                return false;
            }
        }
          /*
        *
        */
        public function getAll(){
            $sql="SELECT * FROM distancia";
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->execute($sql);
            }catch(\PDOException $ex){
                throw $ex;
            } 
            //hay que mapear de un arreglo asociativo a objetos
            if(!empty($result)){
                return $this->mapear($result);
            }else{
                return false;
            }
        }

        public function getRowCount(){
            $sql="SELECT * FROM distancia";
            try{
                //creo la instancia de coneccion
                $this->connection= Connection::getInstance();
                $result = $this->connection->executeAndReturnRowsCount($sql);
            }catch(\PDOException $ex){
                throw $ex;
            } 
            //hay que mapear de un arreglo asociativo a objetos
            if(!empty($result)){
                return $result;
            }else{
                return false;
            }
        }
        

         /*
        *Convierte un array asociativo a un array de objetos para facilitar su manejo
        *si la cantidad de elementos es mayor a 1 retorna el array entero, sino retorna la posicion 0.
        */
        protected function mapear($value) {
            $value = is_array($value) ? $value : [];
            $resp = array_map(function($p){
                return new Info($p['valor'],$p['fecha'],$p['hora']);
            }, $value);
                /* devuelve un arreglo si tiene datos y sino devuelve nulo*/
                return count($resp) > 1 ? $resp : $resp['0'];
         }
}
?>