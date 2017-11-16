<?php
Class Model {
	private $_pdo = null,
			$_query = null,
			$_error = false,
			$_results,
			$_count = 0;

	public function __construct()
	{
		try {
			$this->_pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, [
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			]);
			if (DEBUG)
			{
				$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	public function query($sql, $params = [])
	{
		$this->_error = false;

		if ($this->_query = $this->_pdo->prepare($sql))
		{
			if ($params) 
			{
				$x = 1;
				if (count($params))
				{
					foreach ($params as $param)
					{
						$this->_query->bindValue($x, $param);
						$x++;
					}
				}
			}
			if ($this->_query->execute())
			{
				$this->_count = $this->_query->rowCount();
				if (strpos($sql, 'SELECT') === 0)
				{
					$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				}
			} else {
				$this->_error = true;
			}
		}
		return $this;
	}

	public function action($action, $table, $where = [])
	{        
		if (count($where) === 3) {
			$operators = ['=','>','<','>=','<='];

			$field      = $where[0];
			$operator   = $where[1];
			$params     = $where[2];

			if (in_array($operator, $operators))
			{
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

				if (!$this->query($sql, [$params])->error())
				{
					return $this;
				}
			}
		} else {
			$sql = "{$action} FROM {$table}";

			if (!$this->query($sql)->error())
			{
				return $this;
			}
		}
		return false;
	}

	public function select($table, $where = false)
	{
		return $this->action('SELECT *', $table, $where);
	}

	public function delete($table, $where)
	{
		return $this->action('DELETE', $table, $where);
	}

	public function insert($table, $fields = [])
	{
		if (count($fields))
		{
			$keys = array_keys($fields);
			$values = null;
			$x = 1;

			foreach ($fields as $field)
			{
				$values .= "?";
				if ($x < count($fields))
				{
					$values .= ', ';
				}
				$x++;
			}

			$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) ."`) VALUES ({$values})";

			if (!$this->query($sql, $fields)->error())
			{
				return true;
			}
		}
		return false;
	}

	public function update($table, $id, $fields)
	{
		$set = '';
		$x = 1;

		foreach ($fields as $name => $value)
		{
			$set .= "{$name}= ?";
			if ($x < count($fields)) {
				$set .= ", ";
			}
			$x++;
		}

		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
		
		if (!$this->query($sql, $fields)->error())
		{
			return true;
		}
		return false;
	}
	
	public function error()
	{
		return $this->_error;
	}

	public function count()
	{
		return $this->_count;
	}

	public function results()
	{
		return $this->_results;
	}

	public function first()
	{
		return $this->results()[0];
	}

}