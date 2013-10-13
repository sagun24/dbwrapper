<?php
//pdo wrapper singleton pattern
//author : Sagun Siwakoti

	class DB
	{
		private $_pdo,
				$_query,
				$_prep,
				$_results = array(),
				$_count = 0;

		public static $instance;

		// we are checking that the class is being instantiated once and the same instance can be used for chaining later on.
		public static function getInstance()
		{
			if(!isset(self::$instance))
			{
				self::$instance =  new DB;
			}
			return self::$instance;
		}

		//this is the constructor method that connects to and selects the db.
		public function __construct()
		{
			try{
			$this->_pdo = new PDO('mysql:host=localhost;dbname=auth', 'root', '');
			}
			catch(PDOException $e)
			{
				    echo "Error!: " . $e->getMessage() . "<br/>";
   					die();
			}
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		//this is the method that runs the query.
		public function query($sql)
		{
			$this->_prep = $this->_pdo->prepare($sql);
			if($this->_prep->execute())
			{
				while($row = $this->_prep->fetchObject()) //use fetch for array
				{
					$this->_results[] = $row; 
				}
				$this->_count = $this->_prep->rowCount();
			}
			return $this;
		}

		//here we return the results.
		public function results()
		{
			return $this->_results;
		}

		//here we return the number of rows returned.
		public function count()
		{
			return $this->_count;
		}

		//here we will insert the data in the database.
		public function insert($data, $table)
		{
			$columns="";
			$values="";
			foreach($data as $column=>$value)
			{
			$columns .= ($columns == "") ? "" : ",";  
			$columns .= $column;  
			$values .= ($values == "") ? "" : ",";  
			$values .= "'".$value."'";
			}
			$sql="INSERT INTO $table($columns)
			      VALUES($values);";
			$this->_prep = $this->_pdo->prepare($sql);
			if($this->_prep->execute())
			{
				return $this->_pdo->lastInsertId();
			}
		}

		//here we wil update the data in the database.
		public function update($data, $table, $where)
		{
			foreach ($data as $column => $value) {  
			$sql = "UPDATE $table SET $column = '$value' WHERE $where"; 
			$this->_prep = $this->_pdo->prepare($sql);
			$this->_prep->execute();
			}  
			return true; 
		}

		//here we will delete the data from the database.
		public function delete($table,$where)
		{
			$sql="DELETE FROM $table
				  WHERE $where;";
			$this->_prep = $this->_pdo->prepare($sql);
			$this->_prep->execute();
			return true;
		}
	}

?>