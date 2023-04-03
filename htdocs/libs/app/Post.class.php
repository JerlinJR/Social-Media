<?php

include_once __DIR__.'/../traits/SQLGetterSetter.trait.php';

class Post{

    use SQLGetterSetter;

    public $conn;

    public static function registerPost($text,$image_tmp){
        // print("Is file:" .is_file($image_tmp));
        if(is_file($image_tmp) and exif_imagetype($image_tmp) !== False){
            $author = Session::getUser()->getEmail();
            $image_name = md5($author.time()) . image_type_to_extension(exif_imagetype($image_tmp));
            $image_path = get_config("upload_path") . $image_name;
        if(move_uploaded_file($image_tmp,$image_path)){
            $sql = "INSERT INTO `posts` (`post_text`, `multiple_images`,`image_uri`, `like_count`, `uploaded_time`, `owner`)
            VALUES ('$text', '0' , '/images/$image_name', '0', now(), '$author');";
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