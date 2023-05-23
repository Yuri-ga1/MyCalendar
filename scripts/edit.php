<?php
    $dbname = 'calendardyegor92';
    $username = 'calendardyegor92';
    $password ='NZ9Ije1S';
    $table_name = 'tasks';

    $dbo = new PDO('mysql:host=localhost;dbname=' . $dbname, $username, $password);
    $dbo->exec('SET NAMES "utf8";');

    var_dump($_POST);
    $id = $_POST['id'];
    $theme = $_POST['theme'];
    $type = empty($_POST['type_name']) ? '' : $_POST['type_name'];
    $place = empty($_POST['place']) ? '-' : $_POST['place'];
    $date = empty($_POST['dateandtime']) ? date("Y-m-d") : $_POST['dateandtime'];
    $duration = empty($_POST['duration']) ? 0 : $_POST['duration'];
    $comment = empty($_POST['comment']) ? '-' : $_POST['comment'];

    $sql = $dbo->prepare("UPDATE $table_name SET `name`=:name, `type_id`=:type_id, `place`=:place, `date`=:date, `duration`=:duration, `comment`=:comment WHERE `id` = :id LIMIT 1");

    $type_list = [
        'Meeting' => 1,
        'Call' => 2,
        'Conference' => 3,
        'Work' => 4,
        '' => 5,
    ];

    $sql->execute([
        ':name' => $theme,
        ':type_id' => $type_list[$type],
        ':place' => $place,
        ':date' => $date,
        ':duration' => $duration,
        ':comment' => $comment,
        ':id' => $id
    ]);
    echo 'pivo';

    header("Location: ../index.php");
    die();
?>