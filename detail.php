<?php
//1.外部ファイル読み込みしてDB接続
require_once('funcs.php');
$pdo = db_conn();

//2.対象のIDを取得
$id = $_GET['id'];

//3．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table WHERE id=:id;");
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = '';
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
?>

<!-- html -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
            <legend>Book log</legend>
            <label>Book name<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
            <label>URL<input type="text" name="email" value="<?= $result['email'] ?>"></label><br>
            <label><textarea name="content" rows="4" cols="40"><?= $result['content'] ?></textarea></label><br>
            <input type="hidden" name="id" value="<?= $result['id'] ?>">
            <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>

</html>