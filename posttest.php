<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>りずしぇWEB</title>
<body>

  <h3>スコア登録POSTテスト用</h3>
  <form action="score.php" method="POST">
      <label>MusicID <input type="number" name="music_id" min="0"></input></label><br>
      <label>Player  <input type="text" name="player"></input></label><br>
      <label>Score   <input type="number" name="score" min="0"></input></label><br>
      <input type="submit" value="INSERT"></input>
  </form>

</body>
</html>