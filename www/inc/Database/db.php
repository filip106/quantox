<?php

namespace inc\Database;

use mysqli;
use mysqli_stmt;

class db
{
    /** @var mysqli */
    protected $connection;

    /** @var mysqli_stmt */
    protected $query;

    /** @var int */
    public $query_count = 0;

    /**
     * db constructor.
     * @param string $dbhost
     * @param string $dbuser
     * @param string $dbpass
     * @param string $dbname
     * @param string $charset
     *
     * @throws \Exception
     */
    public function __construct($dbhost = 'db', $dbuser = 'user', $dbpass = 'test', $dbname = 'myDb', $charset = 'utf8')
    {
        $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if ($this->connection->connect_error) {
            throw new \Exception(sprintf('Failed to connect to MySQL - %s', $this->connection->connect_error));
        }
        $this->connection->set_charset($charset);
    }

    /**
     * @param $query
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function query($query)
    {
        if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
                $types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
                    if (is_array($args[$k])) {
                        foreach ($args[$k] as $j => &$a) {
                            $types .= $this->_gettype($args[$k][$j]);
                            $args_ref[] = &$a;
                        }
                    } else {
                        $types .= $this->_gettype($args[$k]);
                        $args_ref[] = &$arg;
                    }
                }
                array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
            if ($this->query->errno) {
                throw new \Exception(sprintf('Unable to process MySQL query (check your params) - %s', $this->query->error));
            }
            $this->query_count++;
        } else {
            throw new \Exception(sprintf('Unable to prepare statement (check your syntax) - %s', $this->connection->error));
        }

        return $this;
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        $params = array();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            $result[] = $r;
        }
        $this->query->close();
        return $result;
    }

    /**
     * @return array
     */
    public function fetchArray()
    {
        $params = array();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                $result[$key] = $val;
            }
        }
        $this->query->close();
        return $result;
    }

    public function numRows()
    {
        $this->query->store_result();
        return $this->query->num_rows;
    }

    public function close()
    {
        return $this->connection->close();
    }

    public function affectedRows()
    {
        return $this->query->affected_rows;
    }

    private function _gettype($var)
    {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';

        return 'b';
    }

}