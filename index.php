<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>りずしぇWEB</title>
<body>
  <h2>りずしぇうぇぶ</h2>
  <?php
    require './vendor/autoload.php';
    Dotenv\Dotenv::createImmutable(__DIR__)->load();

    try{
        // db connect
        $dsn = $_ENV['dsn'];
        $username = $_ENV['username'];
        $password = $_ENV['password'];
        $dbh = new PDO($dsn, $username, $password);

        $sth = $dbh -> prepare('select * from Music');
        $sth -> execute();
        $result = $sth -> fetchALL();

        // print
        echo "<h3>楽曲一覧</h3>";
        echo "<ul>";
        foreach($result as $row){
            echo "<li><b>".$row['Title']."</b> by ".$row['Artist']."</li>";
        }
        echo "</ul>";

    }catch (PDOException $e){
        echo "<p>Error!". $e->getMessage()."</p>";
    }

  ?>
</body>
</html>