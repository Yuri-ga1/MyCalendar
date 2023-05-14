<?php
    //error_reporting(0);

    if (empty($_POST['theme'])){
        header("Location: index.php");
        die();
    }

    $dbname = 'notes_db';
    $username = 'root';
    $password ='';
    $table_name = 'tasks';
    $dbo = new PDO('mysql:host=localhost;dbname=' . $dbname, $username, $password);
    $sql = $dbo->prepare("INSERT INTO `$table_name` (`name`, `type_id`, `place`, `date`, `duration`, `comment`) VALUES (:name, :type_id, :place, :date, :duration, :comment)");

    $theme = $_POST['theme'];
    $type = $_POST['type_name'];
    $place = $_POST['place'];
    $dateandtime = $_POST['dateandtime'];
    $duration = $_POST['duration'];
    $comment = $_POST['comment'];

    $type_list = [
        'Meeting' => 1,
        'Call' => 2,
        'Conference' => 3,
        'Work' => 4,
        '' => 5,
    ];

    echo $comment;

    $sql->execute([
        ':name' => $theme,
        ':type_id' => $type_list[$type],
        ':place' => $place,
        ':date' => $dateandtime,
        ':duration' => $duration,
        ':comment' => $comment,
    ]);

    header("Location: index.php");
    die();
?>