<?php

include_once __DIR__.'/../traits/SQLGetterSetter.trait.php';

class Post{

    use SQLGetterSetter;

    public $conn;

    public function registerPost($image,$imageText){
        if(isset($_FILES['post_image'])){
            $author = Session::getUser()->getEmail();
            //TODO:Change the image ID algorithm
            $image_name = md5($author.time()).jpg;
            $image_path = get_config("upload_path");
        if(move_uploaded_file($image_name,$image_path)){
            $sql = "INSERT INTO `posts` (`post_text`, `image_uri`, `like_count`, `uploaded_time`, `owner`)
            VALUES ('$imageText', 'https://unsplash.com/photos/CwUdwGNysyk', '0', now(), '$author');";
            $conn = Database::getConnection();
            if($conn->query($sql)){
                $id = mysqli_insert_id($conn);
                return new Post($id);
            } else {
                return false;
            }

            } else {
                throw new Exception("Image not uploaded");
            }
        } else {
            throw new Exception("Image is empty");
        }
        

    }
    public function __construct($id){
        $this->id = $id;
        $this->table = 'posts';
    }
    
}