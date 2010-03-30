<?php

class DbConn {
    private $db;

    // handle to connection

    function __construct() {
        // TODO: use proper config
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'vteer_dev';

        $this->db = mysql_connect($db_host, $db_user, $db_pass);
        if (!$this->db)
            throw new RuntimeException("Couldn't connect to database");

        if (!mysql_select_db($db_name, $this->db))
        {
            mysql_close($this->db);
            throw new RuntimeException("Couldn't find database");
        }
    }

    function __destruct() {
        #if ($this->db)
        #   mysql_close($this->db);
        #$this->db = FALSE;
    }

    /**
     * Executes a SELECT, DESCRIBE, etc. query and returns a DbResult.
     *
     * Accepts additional arguments that will be escaped and
     * inserted into the query.
     *
     * Example:
     * $foo->query("SELECT * FROM users WHERE name = ? AND pass = ?", $name, $pass);
     */
    function query($query) {
        $params = func_get_args();
        array_shift($params);
        return $this->query_internal($query, $params);
    }

    /**
     * Like query, but returns only the first result (as an object) or
     * null if none.
     */
    function fetch($query) {
        $params = func_get_args();
        array_shift($params);
        $dbr = $this->query_internal($query, $params);
        return $dbr->next();
    }

    /**
     * Like query, but returns only the first result (as an assoc array)
     * or null if none.
     */
    function fetch_assoc($query) {
        $params = func_get_args();
        array_shift($params);
        $dbr = $this->query_internal($query, $params);
        return $dbr->next_assoc();
    }

    /**
     * Like query, but returns only the first result (as an array) or
     * null if none.
     */
    function fetch_array($query) {
        $params = func_get_args();
        array_shift($params);
        $dbr = $this->query_internal($query, $params);
        return $dbr->next_array();
    }

    function last_insert_id() {
        return mysql_insert_id($this->db);
    }

    /**
     * Executes an INSERT, UPDATE, DELETE etc. query and returns
     * number of rows affected.
     *
     * Accepts additional arguments that will be escaped and
     * inserted into the query.
     *
     * Example:
     * $foo->exec("UPDATE users SET name=? WHERE id=?", $name, $id);
     */
    function exec($query) {
        $params = func_get_args();
        array_shift($params);
        $formatted = $this->format_query($query, $params);

        $result = mysql_query($formatted, $this->db);
        if (!$result)
            throw new RuntimeException(mysql_error($this->db));

        return mysql_affected_rows($this->db);
    }

    function format_query($query, $args) {
        $helper = new DbFormatHelper();
        $helper->value = $args;
        $helper->count = 0;
        $helper->db = $this->db;

        $result = preg_replace_callback("/\?/", array($helper, 'replace'), $query);

        if ($helper->count != count($args))
            throw new RuntimeException("Wrong number of args for query");

            #echo $result;

        return $result;
    }

    private function query_internal($query, $params) {
        $formatted = $this->format_query($query, $params);

        $result = mysql_query($formatted, $this->db);
        if (!$result)
            throw new RuntimeException(mysql_error($this->db));

        return new DbResult($result);
    }
}

class DbResult {

    private $dbr;
    public $length;

    function __construct($dbr) {
        $this->dbr = $dbr;
        $this->length = mysql_num_rows($dbr);
    }

    function __destruct() {
        mysql_free_result($this->dbr);
    }

    function next() {
        return mysql_fetch_object($this->dbr);
    }

    function next_assoc() {
        return mysql_fetch_assoc($this->dbr);
    }

    function next_array() {
        return mysql_fetch_array($this->dbr);
    }
}

class DbFormatHelper {
    public $value;
    public $count;
    public $db;

    function replace($match) {
        return $this->escape_value($this->value[$this->count++]);
    }

    function escape_value($value) {
        switch (gettype($value))
        {
            case "boolean":
                return $value ? "TRUE" : "FALSE";
            case "integer":
            case "double":
                return (string) $value;
            case "string":
                return "'" . mysql_real_escape_string($value, $this->db) . "'";
            case "array":
                $result = '(';
                for ($i = 0; $i < count($value); $i++)
                {
                    $result = $result . $this->escape_value($value[$i]);
                    if ($i < count($value) - 1)
                        $result = $result . ', ';
                }
                return $result . ')';
            case 'object':
                if (get_class($value) == 'DateTime')
                {
                    return "'" . $value->format('Y-m-d H:i:s') . "'";
                }
                throw new RuntimeException("Don't know how to escape arbitrary objects");
            case "NULL":
                return "NULL";
            default:
                throw new RuntimeException("Don't know how to escape type " . gettype($value));
        }
    }
}

?>