<?php
    $dbname = 'calendardyegor92';
    $username = 'calendardyegor92';
    $password ='NZ9Ije1S';
    $table_name = 'tasks';

    $dbo = new PDO('mysql:host=localhost;dbname=' . $dbname, $username, $password);
    $dbo->exec('SET NAMES "utf8";');
    
    $p = 1;
    $html = '<table class=\'task_table\'><tr class=\'tablehead\'><td class=\'left_padding\'>Выбрать</td><td class=\'left_padding\'>Тип</td><td class=\'left_padding\'>Задача</td><td class=\'left_padding\'>Место</td><td class=\'left_padding\'>Дата</td></tr>';
    $edwin='<div id="modal_window">';

    $comid = [];
    $comcom = [];

    $range = [
        'all' => '',
        'today' => ' WHERE CURDATE() = `date`',
        'tomorrow' => ' WHERE CURDATE()+1 = `date`',
        'thisweek' => ' WHERE DAYOFYEAR(`date`) - DAYOFYEAR(CURTIME()) BETWEEN 0 AND 7',
        'nextweek' => ' WHERE DAYOFYEAR(`date`) - DAYOFYEAR(CURTIME()) BETWEEN 7 AND 14',
        'overdue' => ' WHERE `date`< CURDATE()',
        'currect' => ' WHERE `date`> CURDATE()'
    ]; 
    $sort = $range[$_GET['option']];

    $show_script = '';

    foreach ($dbo->query("SELECT * FROM `$table_name` $sort;") as $row)
    {
        if ($p % 2 === 1){
            $html .= '<tr class=\'color_bg\'>';
        }else{
            $html .= '<tr>';
        }
        $p++;
        $id = $row['id'];
        $name = $row['name'];
        $type = $row['type_id'];
        $place = $row['place'];
        $date = $row['date'];
        $duration = $row['duration'];
        $comment = $row['comment'];

        foreach ($dbo->query("SELECT `name` FROM `type` WHERE `id` = $type LIMIT 1;") as $type1){
            $type = $type1['name'];
        }
        $html .= "<td class='left_padding center'><input type='checkbox' name='rowDelete[]' value='$id' /></td>";
        $html .= '<td class=\'left_padding\'>'. $type .'</td>';
        $html .= "<td class='left_padding onhover' onClick='showHide($id)'>". $row['name'] .'</td>';
        $html .= '<td class=\'left_padding\'>'. $row['place'] .'</td>';
        $html .= '<td class=\'left_padding\'>'. $row['date'] .'</td>';
        $html .= '</tr>';

        $edwin .= '<div class="comment" id="'.$id.'">';
        $edwin .= "<div class='close' onClick='showHide($id)'>X</div>";
        $edwin .= "<div class='main_part'>";
        $edwin .= "<form action='scripts/edit.php' method='post'>
        <input name='id' value='$id' type='hidden'>
        <p>Задача: <input name='theme' type='text' placeholder='Theme' required value='$name'/></p>

        <p>Тип:     <input id='meeting$id' name='type_name' type='radio' value='Meeting'/>
        <label for='meeting$id'>Встреча</label>
        <input id='call$id' name='type_name' type='radio' value='Call'/>
        <label for='call$id'>Звонок</label>
        <input id='conference$id' name='type_name' type='radio' value='Conference'/>
        <label for='conference$id'>Совещание</label>
        <input id='work$id' name='type_name' type='radio' value='Work'/>
        <label for='work$id'>Работа</label></p>

        <p>Место: <input name='place' type='text' placeholder='Place' value='$place'/></p>

        <p>Дата: <input name='dateandtime' type='date' value='$date'/></p>

        <p>Длительность(минуты): <input name='duration' type='number' placeholder='duration (minutes)' value='$duration'/></p>

        <p>Комментарий: <input name='comment' type='text' placeholder='Comment' value='$comment'/></p>

        <button type=\'submit\'>Изменить</button>
    </form>";
        $edwin .= "</div>";
        $edwin .= '</div>';
    }

    echo $html. '</table>';
    echo $edwin.'</div>';
?>