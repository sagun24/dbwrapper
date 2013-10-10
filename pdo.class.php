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
	}

?>