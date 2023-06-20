<?php

class sql_wrapper
{
    private $connection;

    public function __construct($db_host = null, $db_user = null, $db_pass = null, $db_file = null)
    {
        $host = $db_host ?? $GLOBALS["db_host"];
        $user = $db_user ?? $GLOBALS["db_user"];
        $pass = $db_pass ?? $GLOBALS["db_pass"];
        $file = $db_file ?? $GLOBALS["db_file"];
    
        $this->connection = new mysqli($host, $user, $pass, $file);
    
        if (!$this->connection) throw new Exception('Error connecting to Database.');
    }
    

    public function __destruct()
    {
        $this->connection->close();
    }

    //prepared statements shout out jcode
    public function query(string $query, array $args = [], string $types = null) {
        if ($types === null && $args !== []) $types = str_repeat('s', count($args));

        $stmt = $this->connection->prepare($query);

        if (!$stmt) throw new Exception('Error preparing query');
        if (strpos($query, '?') !== false) $stmt->bind_param($types, ...$args);

        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();

        return $result;
    }

    public function escape(string $string) {
        return $this->connection->real_escape_string($string);
    }

    //testing purposes
    public function connection() : mysqli
    {
        return $this->connection;
    }
}