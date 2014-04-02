<?php
// phpinfo();
 
   //$cn = new PDO( "sqlsrv:Server=INFORMATICA09\SQL2008 ; Database = BDDESA ", "sa", "guillermo", array(PDO::SQLSRV_ATTR_DIRECT_QUERY => true)); 




function conectaDb()
{
    try {
        $db = new PDO("sqlsrv:Server=INFORMATICA09\SQL2008 ; Database = BDDESA ", "sa", "guillermo");
        $db->setAttribute(PDO::SQLSRV_ATTR_DIRECT_QUERY, true);
        return($db);
    } catch (PDOException $e) {
   		print  "<p><b>Error : </b> No puede conectarse con la base de datos.</p>\n";
        exit();
    }
}

// EJEMPLO DE USO DE LA FUNCIÓN ANTERIOR
// La conexión se debe realizar en cada página que acceda a la base de datos
$db = conectaDB();
if($db!=null){
	echo "conectado";
} 


?>


 
