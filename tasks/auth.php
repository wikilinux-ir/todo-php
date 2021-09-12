<?php
include_once "/srv/train/todo/config/init.php";

function isLogedIn()
{
    return isset($_SESSION['login']) ? true : false;

}

function checkExistUser($email)
{
    global $dbc;
    $query = "SELECT * from users where email = :email";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":email" => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt->rowCount() > 0 ? $result : false;
}
function passwordIsTrue()
{

}
function registerUser($params)
{

    global $dbc;
    if (checkExistUser($params['email'])) {
        return "email duplicate";
    }
    $passwdHash = password_hash($params["password"], PASSWORD_BCRYPT);
    $query = "INSERT into users (username,email,password) values(:username,:email,'$passwdHash')";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":email" => $params['email'], ":username" => $params['username']]);
    return $stmt->rowCount() > 0 ? "register" : "not";

}

function login($params)
{

    $user = checkExistUser($params['email']);

    if (!checkExistUser($params['email'])) {

        return "ایمیل یا پسورد اشتباه است";
    }

    if (password_verify($params["password"], $user['password'])) {

        $_SESSION['login'] = $user;
        return true;
    }
    return null;
}

function logOut()
{
    unset($_SESSION['login']);
    session_destroy();
}
