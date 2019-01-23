<?php
class Session
{
    static $pdo = null;
    function __construct()
    {
        ini_set("session.gc_probability", 1);
        ini_set("session.gc_divisor", 1000);
        ini_set("session.gc_maxlifetime", 1440);

        session_set_save_handler(
            array($this, "begin"),
            array($this, "end"),
            array($this, "read"),
            array($this, "write"),
            array($this, "delete"),
            array($this, "gc")
        );

        $dsn = "mysql:host=localhost;port=3306;dbname=bimdb";
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8");
        self::$pdo = new PDO($dsn, "root", "19881211", $options);
    }

    function begin()
    {
        return true;
    }
    function end()
    {
        return true;
    }
    function read($session_id)
    {
        $data = "";

        $sql = "select sess_data from session_list where sess_id='$session_id'";
        $stmt = self::$pdo->query($sql);
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetchColumn();
        }
        return $data;
    }
    function write($session_id, $session_data)
    {
        $t1 = time();
        $sql = "replace into session_list(sess_id, sess_data, sess_time)";
        $sql .= "values('$session_id', '$session_data', $t1)";
        $result = self::$pdo->exec($sql);
        return (bool)$result;
    }
    function delete($session_id)
    {
        $sql = "delete from session_list where sess_id='$session_id'";
        $result = self::$pdo->exec($sql);
        return (bool)$result;
    }
    function gc($maxlifetime)
    {
        $sql = "delete from session_list where now()-sess_time>$maxlifetime";
        $result = self::$pdo->exec($sql);
        return (bool)$result;
    }
}
?>