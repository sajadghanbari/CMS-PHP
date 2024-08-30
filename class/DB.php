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
    public function deletecategory($catId)
    {
        $qId = $this->connect()->quote($catId);
        $this->connect()->query("delete from categories where id=$qId");
        
    }
    public function addcategory($name, $description)
    {
        $qName = $this->connect()->quote($name);
        $qDescription = $this->connect()->quote($description);
        $this->connect()->query("insert into categories (name , description) values ($qName , $qDescription)");

    }
    public function getcategory($id)
    {
        $qId = $this->connect()->quote($id);
        return $this->connect()->query("select * from categories where id=$qId")->fetchAll(PDO::FETCH_ASSOC) ;
    }
    public function updatecategory($updateId, $updateName, $updateDescription)
    {
        $qId = $this->connect()->quote($updateId);
        $qName = $this->connect()->quote($updateName);
        $qDescription = $this->connect()->quote($updateDescription);
        $this->connect()->query("update categories set name=$qName , description=$qDescription where id=$qId");
    }
}
class Post extends DB
{
    public function getAllPosts()
    {
        return $this->connect()->query("select * from posts")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchPost($searchQuery)
    {
        
        $searchQuery ='%'.$searchQuery.'%';
        $searchQuery = $this->connect()->quote($searchQuery);
        $query = "select * from posts where title like $searchQuery or author like $searchQuery or content like $searchQuery or tags like $searchQuery ";
        return $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addPost($title,$categoryId,$author,$status,$image,$tags,$content)
    {
        $qTitle = $this->connect()->quote($title);
        $qCategoryId = $this->connect()->quote($categoryId);
        $qAuthor = $this->connect()->quote($author);
        $qStatus = $this->connect()->quote($status);
        $qImage = $this->connect()->quote($image);
        $qTags = $this->connect()->quote($tags);
        $qContent = $this->connect()->quote($content);
        $query = "insert into posts (title,author,category_id,status,image,tags,content,comment_count,date) values ($qTitle,$qAuthor,$qCategoryId,$qStatus,$qImage,$qTags,$qContent,0,now())";
        $this->connect()->query($query);



    }
    public function deletePost($postId)
    {
        $qId = $this->connect()->quote($postId);
        $query = "delete from posts where id=$qId";
        $this->connect()->query($query);
    }
    public function getPost($id)
    {
        $qId = $this->connect()->quote($id);
        $query = "select * from posts where id=$id";
        return $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updatePost($id,$title,$categoryId, $author,$status,$image,$tags,$content)
    {
        $qId = $this->connect()->quote($id);
        $qTitle = $this->connect()->quote($title);
        $qCategoryId = $this->connect()->quote($categoryId);
        $qAuthor = $this->connect()->quote($author);
        $qStatus = $this->connect()->quote($status);
        $qImage = $this->connect()->quote($image);
        $qTags = $this->connect()->quote($tags);
        $qContent = $this->connect()->quote($content);
        $query = "update posts set title=$qTitle , category_id=$qCategoryId ,author=$qAuthor, status=$qStatus, image=$qImage , tags=$qTags,content=$qContent where id=$qId";
        $this->connect()->query($query);
    }
}
?>