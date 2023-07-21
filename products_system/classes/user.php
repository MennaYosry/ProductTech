<?php 
class User {
private $pdo;
public function __construct(PDO $pdo)
{
    $this->pdo=$pdo;
}
public function register($username , $email , $password){

    //Data Validation
    $errors=array();
    if(empty($username)|| empty($email)|| empty($password)){
         $errors[]="Please enter all data in the form"; 
    }else{
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[]="Please enter a valid email";
    }
    }
    // check if the record is already saved in database 
    $query=$this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email=:email");
    $query->execute(array(':email'=>$email));
    $count=$query->fetchColumn();
    if($count){
        $errors[]="This user is already existed";
    }

    // save user in database & Hashing password 
    if(empty($errors)){
        $hash=password_hash($password,PASSWORD_DEFAULT);
        $query=$this->pdo->prepare("INSERT INTO users (username,email,password) VALUES (:username , :email , :password)");
        $query->execute(array(':username'=>$username , ':email'=>$email ,':password'=>$hash));
        
        return true;
    }else{
        // show the error 
        return $errors;
    }
}
public function login( $email , $password)
{
    // Check if the username or email address is already in use
    $query = $this->pdo->prepare("SELECT * FROM users WHERE  email = :email");
        
    $query->execute(array( ':email' => $email));  

    $user = $query->fetch(PDO::FETCH_ASSOC);
  
    if ($user && password_verify($password, $user['password'])) {
    
        $_SESSION['user_id']=$user['id'];
        $_SESSION['username']=$user['username'];
        $_SESSION['email']=$user['email'];
        
        return true;
        exit;
    } else {
        // The username or password is incorrect
        return "The email or password is incorrect";
    }
    
        
}


}
?>