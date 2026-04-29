<?php   
    require_once __DIR__ . '/../../config.php'; //para acceder a las variables globales
    
    class Model {
        protected $db;

        public function __construct(){ 
            $this->db = new PDO( //creo el PHP Data Object quien se encargara de hablar con la bd
                "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8",
                MYSQL_USER,
                MYSQL_PASS
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //configuro el PDO para el manejo de errores asi me los muestra cuando ocurren
            $this->_deploy();
        }

        private function _deploy(){
            $query = $this->db->query('SHOW TABLES'); //le pido a mysql que muestre todas las tablas
            $tables = $query->fetchAll(); //las traigo en un arreglo

            if (count($tables)==0){ 
                $sql= <<<END
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
END;
                $this->db->query($sql);
            }
        }

    }
?>