<?php 
Class Post{
    private $pdo; 
    public function __construct($pdo)
    {
        $this->pdo=$pdo;

    }
    public function createpost($content , $user_id){
        $query="INSERT INTO posts (content , user_id) VALUES (:content , :user_id)";
        try{
            $stmt=$this->pdo->prepare($query);
            $stmt->execute(array(':content'=>$content , ':user_id'=>$user_id));
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function readallposts(){
        $query= 'SELECT posts .* ,users.username FROM posts 
        LEFT JOIN users ON (users.id = posts.user_id) ORDER BY posts.created_at DESC';
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }



 

 }
}

?>