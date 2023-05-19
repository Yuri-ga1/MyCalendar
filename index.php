<html>
    <head>
        <link rel="stylesheet" href="css.css" type="text/css"/>
    </head>
    <body>
        <div class='active_tasks'>
            <div class='task_filter'>
                <input name="date_filter" type="radio" value="today" checked/>сегодня
                <input name="date_filter" type="radio" value="tomorrow"/>завтра
                <input name="date_filter" type="radio" value="thisWeek"/>на эту неделю
                <input name="date_filter" type="radio" value="nextWeek"/>на след неделю
            </div>
            <table class='task_table'>
                <tr class='tablehead'>
                    <td class='left_padding'>Тип</td>
                    <td class='left_padding'>Задача</td>
                    <td class='left_padding'>Место</td>
                    <td class='left_padding'>Дата</td>
                </tr>
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

                        echo '<td class=\'left_padding\'>',$type ,'</td>';
                        echo '<td class=\'left_padding\'>',$row['name'] ,'</td>';
                        echo '<td class=\'left_padding\'>',$row['place'] ,'</td>';
                        echo '<td class=\'left_padding\'>',$row['date'] ,'</td>';
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

                <p><input name="place" type="text" placeholder="Place" defaultValue=""/></p>

                <p><input name="dateandtime" type="date"/></p>

                <p><input name="duration" type="number" placeholder="duration (minutes)" defaultValue="1"/></p>

                <p><input name="comment" type="text" placeholder="Comment" defaultValue="1"/></p>

                <button type="submit">Create note</button>
            </form>
        </div>
    </body>
</html>