<?php

	/**
	 * 
	 * CRUD
	 * insert
	 * update
	 * delete
	 * select
	 * 
	 **/

	// __destruct(), __call(), __callStatic(), __get(), __set(), __isset(), __unset(), __sleep(), __wakeup(), __serialize(), __unserialize(), __toString(), __invoke(), __set_state(), __clone(), and __debugInfo().

	class Product {

		protected $conn;

		public function __construct()
		{
			try {
				$servername = "localhost";
				$username = "root";
				$password = "toor1";
				$dbName = "sample_test";
				$this->conn = new mysqli($servername, $username, $password, $dbName);
				if ($this->conn->connect_error) {
					die("Connection failed: " . $this->conn->connect_error);
				}
			} catch (Exception $e) {
				echo $e->getMessage();die;
			}
			
		}

		public function insert()
		{

		}
		public function update()
		{

		}
		public function delete($id)
		{

		}
		public function select()
		{
			$sql = "SELECT * FROM product";
			$result = $this->conn->query($sql);
			return $result;
		}
		public function selectRow($id)
		{
			$sql = "SELECT * FROM product WHERE entity_id = $id";
			$result = $this->conn->query($sql);
			return $result;
		}
	}
?>