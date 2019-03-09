<?php

class Connector
{
	private $connect;
	private $host;
	private $db;
	private $user;
	private $password;

	public function __construct()
	{
		$this->host = "localhost";
		$this->db = "db";
		$this->user = "root";
		$this->password = "";
		/*$this->host = "localhost";
		$this->db = "ossin_db";
		$this->user = "ossin_db";
		$this->password = "r5Zxdmu4";*/
	}

	public function __get($property)
	{
		switch($property)
		{
			case "host": return $this->host;
			case "db": return $this->db;
			case "user": return $this->user;
			case "password": return $this->password;
		}
	}

	public function __set($property, $value)
	{
		switch($property)
		{
			case "host": $this->host = $value;
				break;
			case "db": $this->db = $value;
				break;
			case "user": $this->user = $value;
				break;
			case "password": $this->password = $value;
				break;
		}
	}

	public function connection()
	{
		return $this->connect;
	}

	public function dataQuery($query)
	{
		return $result = mysqli_query($this->connect, $query);
	}

	public function start()
	{
		$this->connect = mysqli_connect($this->host, $this->user, $this->password, $this->db) 
		or die("Ошибка! Проверте подключение к базе данных (MySql).". mysqli_error($this->connect));
		mysqli_set_charset($this->connect, 'utf8');
	}

	public function close()
	{
		mysqli_close($this->connect);
	}
};

?>