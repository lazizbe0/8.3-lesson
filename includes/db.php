<?

function db(){
    return new PDO("mysql:host=127.0.0.1;dbname=gr1500chorshan", 'root', '');
}

function userReg($login, $name, $pass, $photoDir){
    $login = strip_tags($login);
    $name = strip_tags($name);
    $pass = password_hash($pass, PASSWORD_BCRYPT);
    $db = db();
    $query = "INSERT INTO `users`(`user_login`, `user_name`, `user_pass`) VALUES (?,?,?)";
    $userDriver = $db->prepare($query);
    $result = $userDriver->execute([$login, $name, $pass]);

    if ($result) {
        $userId = $db->lastInsertId();
        $query = "INSERT INTO `images`(`user_id`, `img_path`, `img_select`) VALUES (?,?,?)";
        $imgDriver = $db->prepare($query);
        $result = $imgDriver->execute([$userId, $photoDir, 1]);
    }
    return $result;
}
