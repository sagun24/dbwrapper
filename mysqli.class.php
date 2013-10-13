<?php
//mysqli wrapper singleton pattern
//author : Sagun Siwakoti

	class DB
	{
		private $_mysqli,
				$_query,
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
			$this->_mysqli = new mysqli('localhost','root','','auth');
			if($this->_mysqli->connect_error)
			{
				die($this->_mysqli->connect_error);
			}
		}

		//this is the method that runs the query.
		public function query($sql)
		{
			if($this->_query = $this->_mysqli->query($sql))
			{
				while($row = $this->_query->fetch_object())
				{
					$this->_results[] = $row; 
				}
				$this->_count = $this->_query->num_rows;
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
		public function insert()
		{

		}

		//here we wil update the data in the database.
		public function update($id)
		{

		}

		//here we will delete the data from the database.
		public function delete($id)
		{

		}
	}

?>