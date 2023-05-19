<?php
    $dbname = 'notes_db';
    $username = 'root';
    $password ='';
    $table_name = 'tasks';
    $dbo = new PDO('mysql:host=localhost;dbname=' . $dbname, $username, $password);
    $p = 1;
    $html = '<table class=\'task_table\'><tr class=\'tablehead\'><td class=\'left_padding\'>Тип</td><td class=\'left_padding\'>Задача</td><td class=\'left_padding\'>Место</td><td class=\'left_padding\'>Дата</td></tr>';

    $range = [
        'all' => '',
        'today' => ' WHERE CURDATE() = `date`',
        'tomorrow' => ' WHERE CURDATE()+1 = `date`',
        'thisweek' => ' WHERE DAYOFYEAR(`date`) - DAYOFYEAR(CURTIME()) BETWEEN 0 AND 7',
        'nextweek' => ' WHERE DAYOFYEAR(`date`) - DAYOFYEAR(CURTIME()) BETWEEN 7 AND 14',
        'overdue' => ' WHERE `date`< CURDATE()'
    ]; 
    $sort = $range[$_GET['option']];
    foreach ($dbo->query("SELECT * FROM `$table_name` $sort;") as $row)
    {
        if ($p % 2 === 1){
            $html .= '<tr class=\'color_bg\'>';
        }else{
            $html .= '<tr>';
        }
        $p++;
        $type = $row['type_id'];
        foreach ($dbo->query("SELECT `name` FROM `type` WHERE `id` = $type LIMIT 1;") as $type1){
            $type = $type1['name'];
        }
        $html .= '<td class=\'left_padding\'>'. $type .'</td>';
        $html .= '<td class=\'left_padding\'>'. $row['name'] .'</td>';
        $html .= '<td class=\'left_padding\'>'. $row['place'] .'</td>';
        $html .= '<td class=\'left_padding\'>'. $row['date'] .'</td>';
        $html .= '</tr>';
    }

    echo $html. '</table>';
?>