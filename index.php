<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>りずしぇWEB</title>
<body>
  <h2>りずしぇうぇぶ</h2>
  <h3>Rhythmic Shake!(リズミックシェイク)とは</h3>
  <p>
      リズミックシェイクは、スマホ音ゲーに振る操作を組み合わせた新感覚リズムゲームです。
  </p>
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

        // recent score
        $sql = "SELECT m.Title, s.Player, s.Score FROM music AS m, score AS s WHERE m.id = s.music_id ORDER BY s.id DESC LIMIT 10;";
        $sth = $dbh -> prepare($sql);
        $sth -> execute();
        $result = $sth -> fetchALL();
        
        // print
        echo "<h3>最近登録されたスコア</h3>";
        echo "<table>";
        echo "<tr><td>楽曲</td> <td>プレイヤー名</td> <td>スコア</td></tr>";
        foreach($result as $row){
            echo "<tr><td>".$row['Title']."</td><td>".$row['Player']."</td><td>".$row['Score']."</td></tr>";
        }
        echo "</table>";

        // disconnect
        $dbh = null;
        $sth = null;

    }catch (PDOException $e){
        echo "<p>Error!". $e->getMessage()."</p>";
    }
  ?>

  <p><a href="posttest.php">Score登録デバッグ用</a></p>
</body>
</html>