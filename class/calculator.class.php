<?php

@include("includes/config.php");

class Calculator {
	
	private $server_info;
	
	public function CalculateResult($factor1, $factor2, $operation) {
		// Računanje
		$result = 0.0;
		if ($operation == '*') {
			$result = $factor1 * $factor2;
		}
		// Upis u bazu
		$this->SaveResult($factor1, $factor2, $operation, $result);
		// Vraćanje za ispis
		return $result;
    }
	
	protected function SaveResult($factor1, $factor2, $operation, $result) {
		// Var
		global $servername, $username, $password, $db_name, $db_table;
		
		// POvezivanje na bazu
		$server = $this->InitDB();
		
		mysqli_query($server, "INSERT INTO $db_table (
								factor1, factor2, operation, result, operation_date) VALUES (
								'$factor1', '$factor2', '$operation', '$result', CURRENT_TIMESTAMP);");
		
		$this->CloseDB($server);
    }
	
	protected function InitDB() {
		// Var
		global $servername, $username, $password, $db_name, $db_table;
		
		// Konektovanje na server
		$server = mysqli_connect($servername, $username, $password) or die();
		
		// Kreira bazu ukoliko već nije kreirana
		mysqli_query($server, "CREATE DATABASE IF NOT EXISTS $db_name;") or die();
        
		// Konektovanje na bazu
		$db = mysqli_select_db($server, $db_name) or die();
		
		// Kreira tabelu ukoliko nije već kreirana
		mysqli_query($server, "CREATE TABLE IF NOT EXISTS $db_table (
							  id int(11) NOT NULL AUTO_INCREMENT,
							  factor1 int(11) NOT NULL,
							  factor2 int(11) NOT NULL,
							  operation varchar(1) COLLATE utf8_unicode_ci NOT NULL,
							  result int(11) NOT NULL,
							  operation_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
							  PRIMARY KEY (id)
							) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;");
		
		// Return
		return $server;
		
    }
	
	protected function CloseDB($server){
		mysqli_close($server);
	}
	
}

?>