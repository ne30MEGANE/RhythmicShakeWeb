<?php
require './vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();

header('Content-Type: application/json; charset=UTF-8');

if(isset($_POST["music_id"]) && isset($_POST["player"]) && isset($_POST["score"]) ){
    $id = htmlspecialchars($_POST["music_id"]);
    $player = htmlspecialchars($_POST["player"]);
    $score = htmlspecialchars($_POST["score"]);

    try{
        // db connect
        $dsn = $_ENV['dsn'];
        $username = $_ENV['username'];
        $password = $_ENV['password'];
        $dbh = new PDO($dsn, $username, $password);

        // insert
        $sql = "INSERT INTO score (id, Music_id, Player, Score) VALUES (NULL, ".$id.", '".$player."', ".$score.")";
        $sth = $dbh -> prepare($sql);
        $sth -> execute();

        http_response_code(200);

        // disconnect
        $dbh = null;
        $sth = null;

    }catch(PDOException $e){
        http_response_code(500);
        exit();
    }

}