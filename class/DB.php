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
    public function getAllPostCount()
    {
        return $this->connect()->query("SELECT count(id) as cnt  from posts")->fetchAll(PDO::FETCH_ASSOC)[0]["cnt"];

    }
    public function getAllPosts()
    {
        $query = "SELECT p.id,category_id,concat(u.first_name,' ',u.last_name) 
        as author,title,date,p.image,content,tags,status,view_count,(SELECT count(id) from comments WHERE comments.post_id=p.id) 
        AS comment_count from posts as p
        INNER JOIN users as u on u.id=p.author_id";
        return $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
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
        $query = "insert into posts (title,author_id,category_id,status,image,tags,content,comment_count,date) values ($qTitle,$qAuthor,$qCategoryId,$qStatus,$qImage,$qTags,$qContent,0,now())";
        $this->connect()->query($query);



    }
    public function deletePost($postId)
    {
        $qId = $this->connect()->quote($postId);
        $query = "DELETE from posts where id=$qId";
        // $this->connect()->query($query);
        return $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPost($id)
    {
        $qId = $this->connect()->quote($id);
        $query = "select * from posts where id=$id";
        return $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updatePost($id,$title,$categoryId,$status,$image,$tags,$content)
    {
        $qId = $this->connect()->quote($id);
        $qTitle = $this->connect()->quote($title);
        $qCategoryId = $this->connect()->quote($categoryId);
        // $qAuthor = $this->connect()->quote($author);
        $qStatus = $this->connect()->quote($status);
        $qImage = $this->connect()->quote($image);
        $qTags = $this->connect()->quote($tags);
        $qContent = $this->connect()->quote($content);
        $query = "update posts set title=$qTitle , category_id=$qCategoryId , status=$qStatus, image=$qImage , tags=$qTags,content=$qContent where id=$qId";
        $this->connect()->query($query);
    }
    public function getPosts($catid)
    {
        $qCatid = $this->connect()->quote($catid);
        $query = "SELECT p.id,category_id,concat(u.first_name,' ',u.last_name) as author,title,date,p.image,content,tags,status,view_count,(SELECT count(id) from comments WHERE comments.post_id=p.id) AS comment_count from posts as p
    INNER JOIN users as u on u.id=p.author_id where status='published' and category_id=$qCatid";
        return $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function changePostStatus($ar , $status)
    {
        $joinedAr = implode("," , $ar);
        $query = "UPDATE posts SET status='$status' where id in($joinedAr)";
        $this->connect()->query($query);
    }
    public function deleteBulkPost($ar)
    {
        $joinedAr = join(",", $ar);
        $query = "DELETE FROM posts  where id in($joinedAr)";
        $this->connect()->query($query);
    }
    public function getPostByAuthor($author)
    {
        $qAuthor = $this->connect()->quote($author);
        $query = "SELECT * from posts where status='Published' and author=$qAuthor";
        return $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function incrementView($pid)
    {
        $qPid = $this->connect()->quote($pid);
        $query = "UPDATE posts set view_count=view_count+1 where id=$pid";
        $this->connect()->query($query);
    }
    public function getAllPostsByPage($pageLength, $page)
    {
        $pageLimit = $page*$pageLength - $pageLength;
        return $this->connect()->query("SELECT p.id,category_id,concat(u.first_name,' ',u.last_name) as author,title,date,p.image,content,tags,status,view_count,(SELECT count(id) from comments WHERE comments.post_id=p.id) AS comment_count from posts as p
    INNER JOIN users as u on u.id=p.author_id limit $pageLimit,$pageLength")->fetchAll(PDO::FETCH_ASSOC);
    }
}
class Comment extends DB
{
    public function getAllComments()
    {
        return $this->connect()->query("select comments.*, posts.title as post_title from  comments inner join posts on comments.post_id=posts.id ")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteComment($id)
    {
        $qId = $this->connect()->quote($id);
        $postId = $this->connect()->query("select * from comments whre id=$qId")->fetchAll(PDO::FETCH_ASSOC)[0]["post_id"];
        $this->connect()->query("update posts set comment_count=comment_count-1 where id=$postId");
        $query = "delete from comments where id=$qId";
        $this->connect()->query($query);
    }
    public function changeStatus($id)
    {
        $qId = $this->connect()->quote($id);
        $query = "update comments set status=abs(status-1) where id=$qId";
        return $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addComment($author,$email,$commentText,$postId)
    {
        $qId = $this->connect()->quote($postId);
        $qAuthor = $this->connect()->quote($author);
        $qEmail = $this->connect()->quote($email);
        $qComment = $this->connect()->quote($commentText);
        $query = "insert into comments (post_id,author,email,content,status,date) value ($qId,$qAuthor,$qEmail,$qComment,0,now())";
        $this->connect()->query($query);
        $this->connect()->query("update posts set comment_count=comment_count+1 where id=$qId");
    }
    public function getPostComments($id)
    {
        $qId = $this->connect()->quote($id);
        $query = "select * from comments where status=1 and post_id=$qId order by date desc";
        return $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
class User extends DB
{
    public function getAllUsers()
    {
        return $this->connect()->query("select * from users")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addUser($username,$password,$firstName,$lastName,$email,$role)
    {
        $qUsername = $this->connect()->quote($username);
        $ops = ["cost"=>11];
        $qPassword = $this->connect()->quote(password_hash($password, PASSWORD_BCRYPT,$ops));
        $qEmail = $this->connect()->quote($email);
        $qFirstName = $this->connect()->quote($firstName);
        $qLastName = $this->connect()->quote($lastName);
        $qRole = $this->connect()->quote($role);
        $query = "INSERT INTO users (username,password,first_name,last_name,email,role) VALUES ($qUsername,$qPassword,$qFirstName,$qLastName,$qEmail,$qRole)";
        $this->connect()->query($query);
    }
    public function deleteUser($id)
    {
        $qId = $this->connect()->quote($id);
        $query = ("DELETE FROM  users WHERE id =$qId");
        $this->connect()->query($query);
    }
    public function getUser( $id )
    {
        $qId = $this->connect()->quote($id);
        $query = ("select * from users where id=$qId");
        return $this->connect()->query($query)->fetch(PDO::FETCH_ASSOC);
    }
    public function updateUser($id,$username,$password,$firstName,$lastName,$email,$role)
    {
        $qId = $this->connect()->quote($id);
        $qUsername = $this->connect()->quote($username);
        $ops = ["cost"=>11];
        $qPassword = $this->connect()->quote(password_hash($password, PASSWORD_BCRYPT,$ops));
        $qFirstName = $this->connect()->quote($firstName);
        $qLastName = $this->connect()->quote($lastName);
        $qEmail = $this->connect()->quote($email);
        $qRole = $this->connect()->quote($role);
        $query = ("UPDATE users SET username=$qUsername ,password=$qPassword ,first_name=$qFirstName ,last_name=$qLastName ,email=$qEmail ,role=$qRole WHERE id=$qId");
        $this->connect()->query($query);

    }
    public  function getUserByUsrename($username)
    {
        $qUsername = $this->connect()->quote($username);
        $all = $this->connect()->query("SELECT * FROM users WHERE username=$qUsername ")->fetchAll(PDO::FETCH_ASSOC);
        if(count($all) > 0)
        {
            return $all[0];
        }
        else
        {
            return null;
        }    }
    public  function getUserByEmail($email)
    {
        $qEmail = $this->connect()->quote($email);
        $all = $this->connect()->query("SELECT * FROM users WHERE email=$qEmail ")->fetchAll(PDO::FETCH_ASSOC);
        if(count($all) > 0)
        {
            return $all[0];
        }
        else
        {
            return null;
        }
    }
    public function registerUser($username,$password,$email)
    {
        $qUsername = $this->connect()->quote($username);
        $ops = ["cost"=>11];
        $qPassword = $this->connect()->quote(password_hash($password, PASSWORD_BCRYPT,$ops));
        $qEmail = $this->connect()->quote($email);
        $query = "INSERT into users (username,password,email,role) value ($qUsername,$qPassword,$qEmail,'subscriber')";
        $this->connect()->query($query);
    }
    public function isAdmin($username)
    {
        $qUsername = $this->connect()->quote($username);
        $query = "SELECT role from users where username=$qUsername";
        $result = $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
        if(count($result) > 0)
        {
            return $result[0]["role"] == "admin";
        }
        else
        {
            return false;
        }
    }
    public function updateToken($userid,$token)
    {
        $qUserid = $this->connect()->quote($userid);
        $qToken = $this->connect()->quote($token);
        $query = "UPDATE users set token=$qToken where id=$qUserid";
        $this->connect()->query($query);
    }
}
class Report extends DB
{
    public function getPostCount()
    {
        $query = "SELECT COUNT(*) AS cnt FROM posts";
        $result = $this->connect()->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result["cnt"];
    }
    public function getUserCount()
    {
        $query = "SELECT COUNT(*) AS cnt FROM users";
        $result = $this->connect()->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result["cnt"];
    }
    public function getCommentCount()
    {
        $query = "SELECT COUNT(*) AS cnt FROM comments";
        $result = $this->connect()->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result["cnt"];
    }
    public function getCategoryCount()
    {
        $query = "SELECT COUNT(*) AS cnt FROM categories";
        $result = $this->connect()->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result["cnt"];
    }
}
class OnlineUsers extends DB
{   

    public function getOnlineUsers()
    {
        $sessionId = session_id();
        $time = time();
        $query = "SELECT * from online_users where session='$sessionId'";
        $currentUser = $this->connect()->query($query)->fetchAll(PDO::FETCH_ASSOC);
        if(count($currentUser) > 0) 
        {
            $query = "UPDATE online_users set time=$time where session='$sessionId' ";
            $this->connect()->query($query);
        }
        else 
        {
        $query = "INSERT into online_users(session,time) values('$sessionId',$time)";
        $this->connect()->query($query);
        }
        $timeOffset = 60;
        $offlineTime = $time - $timeOffset;
        return $this->connect()->query("SELECT count(id) as cnt from online_users where time >$offlineTime")->fetchAll(PDO::FETCH_ASSOC)[0]["cnt"];
    }
}
class MailConfig
{
    const Host = "sandbox.smtp.mailtrap.io";
    const Port = 2525;
    const Username = "f6e38f2fea724e";
    const Password = "089a9e4553bc02";
    const Auth = "PLAIN";
}

?>