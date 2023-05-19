<?php
    if(empty($_POST['rowDelete'])){
        header("Location: ../index.php");
        die();
    }
    else{
        $delete = $_POST['rowDelete'];
        $N = count($delete);

        $dbname = 'notes_db';
        $username = 'root';
        $password ='';
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