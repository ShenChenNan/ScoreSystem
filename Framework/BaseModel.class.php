<?php
class BaseModel
{
    protected $pdo = null;

    function __construct()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=bimdb";
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"set names utf8");
        $this->pdo = new PDO($dsn, "root", "19881211", $options);
    }
}
?>