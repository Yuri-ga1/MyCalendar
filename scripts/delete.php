<?php
    if(empty($_POST['rowDelete'])){
        header("Location: ../index.php");
        die();
    }
    else{
        $delete = $_POST['rowDelete'];
        $N = count($delete);

        $dbname = 'calendardyegor92';
        $username = 'calendardyegor92';
        $password ='NZ9Ije1S';
        $table_name = 'tasks';
        $dbo = new PDO('mysql:host=localhost;dbname=' . $dbname, $username, $password);

        $sql = $dbo->prepare("DELETE FROM $table_name WHERE `id`= :id");

        for($i=0; $i < $N; $i++)
        {
            $sql->execute([':id' => $delete[$i]]);
        }

        header("Location: ../index.php");
        die();
    }
?>