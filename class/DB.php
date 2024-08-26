<?php
class DB
{
    private $servername;
    private $username;
    private $password;
    private $dbName;
    private $charset;

    protected function connect()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbName = "cmsdb";
        $this->charset = "utf8mb4";
        try 
        {
            $dsn = "mysql:host=$this->servername;dbname=$this->dbName;charset=$this->charset";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }
        catch (Exception $e)
        {
            echo "ERROR". $e->getMessage();
        }
    }


}
class Category extends DB
{
    public function getallcategories()
    {
        return $this->connect()->query("select * from categories")->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>