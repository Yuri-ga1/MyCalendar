<?php
    //error_reporting(0);

    if (empty($_POST['theme'])){
        header("Location: index.php");
        die();
    }

    $dbname = 'calendardyegor92';
    $username = 'calendardyegor92';
    $password ='NZ9Ije1S';
    $table_name = 'tasks';
    $dbo = new PDO('mysql:host=localhost;dbname=' . $dbname, $username, $password);
    $sql = $dbo->prepare("INSERT INTO `$table_name` (`name`, `type_id`, `place`, `date`, `duration`, `comment`) VALUES (:name, :type_id, :place, :date, :duration, :comment)");

    $theme = $_POST['theme'];
    $type = empty($_POST['type_name']) ? '' : $_POST['type_name'];
    $place = empty($_POST['place']) ? '-' : $_POST['place'];
    $date = empty($_POST['date']) ? date("Y-m-d") : $_POST['date'];
    $duration = empty($_POST['duration']) ? 0 : $_POST['duration'];
    $comment = empty($_POST['comment']) ? '-' : $_POST['comment'];

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
    ]);

    header("Location: ../index.php");
    die();
?>