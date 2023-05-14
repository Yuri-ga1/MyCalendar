<html>
    <head>
        <link rel="stylesheet" href="css.css" type="text/css"/>
    </head>
    <body>
        <div class='active_tasks'>
            <table>
                <?php
                    $dbname = 'notes_db';
                    $username = 'root';
                    $password ='';
                    $table_name = 'tasks';
                    $dbo = new PDO('mysql:host=localhost;dbname=' . $dbname, $username, $password);

                    $p = 1;
                    foreach ($dbo->query("SELECT * FROM `$table_name`;") as $row)
                    {
                        if ($p % 2 === 1){
                            echo '<tr class=\'color_bg\'>';
                        }else{
                            echo '<tr>';
                        }
                        $p++;

                        $type = $row['type_id'];
                        foreach ($dbo->query("SELECT `name` FROM `type` WHERE `id` = $type LIMIT 1;") as $type1){
                            $type = $type1['name'];
                        }

                        echo '<td class=\'right_border\'>',$type ,'</td>';
                        echo '<td class=\'right_border\'>',$row['name'] ,'</td>';
                        echo '<td class=\'right_border\'>',$row['place'] ,'</td>';
                        echo '<td>',$row['date'] ,'</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>

        <div class="create_note">
            <form action="php.php" method="post">
                <p><input name="theme" type="text" placeholder="Theme"/></p>

                <p><input name="type_name" type="radio" value="Meeting"/>Meeting
                <input name="type_name" type="radio" value="Call"/>Call
                <input name="type_name" type="radio" value="Conference"/>Conference
                <input name="type_name" type="radio" value="Work"/>Work</p>

                <p><input name="place" type="text" placeholder="Place"/></p>

                <p><input name="dateandtime" type="date"/></p>

                <p><input name="duration" type="number" placeholder="duration"/></p>

                <p><input name="comment" type="text" placeholder="Comment"/></p>

                <button type="submit">Create note</button>
            </form>
        </div>
    </body>
</html>