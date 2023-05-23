<html>
    <head>
        <link rel="stylesheet" href="css.css" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function showHide(element_id) {
                if (document.getElementById(element_id)) {
                    var window =document.getElementById('modal_window');
                    var obj = document.getElementById(element_id); 
                    if (obj.style.display != "block") { 
                        obj.style.display = "block";
                        window.style.display = "block";
                    }
                    else {
                        obj.style.display = "none";
                        window.style.display = "none";
                    }
                }
                else alert("Элемент с id: " + element_id + " не найден!"); 
            }   
        </script>

    </head>
    <body>
        <div class='active_tasks'>
            <h2>Выберите сортировку</h2>
            <div class='task_filter'>
                <input id='date_filter_id1' name="date_filter" type="radio" value="all"/>
                <label for='date_filter_id1'>все</label>

                <input id='date_filter_id2' name="date_filter" type="radio" value="today"/>
                <label for='date_filter_id2'>сегодня</label>

                <input id='date_filter_id3' name="date_filter"  type="radio" value="tomorrow"/>
                <label for='date_filter_id3'>завтра</label>

                <input id='date_filter_id4' name="date_filter"  type="radio" value="thisweek"/>
                <label for='date_filter_id4'>на эту неделю</label>

                <input id='date_filter_id5' name="date_filter" type="radio" value="nextweek"/>
                <label for='date_filter_id5'>на след неделю</label>

                <input id='date_filter_id6' name="date_filter" type="radio" value="overdue"/>
                <label for='date_filter_id6'>просроченные</label>

                <input id='date_filter_id7' name="date_filter" type="radio" value="currect"/>
                <label for='date_filter_id7'>текущие</label>
            </div>

            <form action="scripts/delete.php" method='post'>
                <div id="fetch">
                </div>
                <input type='submit' value='Удалить'/>
            </form>

            <script>
                $(document).ready(function() {
                    $('input[name="date_filter"]').change(function() {
                        if ($(this).is(':checked')) {
                            var selectedOption = $(this).val();

                            $.ajax({
                                url: 'scripts/sort.php',
                                type: 'GET',
                                data: { option: selectedOption },
                                success: function(response) {
                                    $('#fetch').html(response);
                                }
                            });
                        }
                    });
                });
            </script>
        </div>

        <div class="create_note">
            <div class="form_create_note">
                <form action="scripts/createNote.php" method="post">
                    <p><input name="theme" type="text" placeholder="Theme" required/></p>

                    <p><input id='meeting' name="type_name" type="radio" value="Meeting"/>
                    <label for='meeting'>Встреча</label>
                    <input id='call' name="type_name" type="radio" value="Call"/>
                    <label for='call'>Звонок</label>
                    <input id='conference' name="type_name" type="radio" value="Conference"/>
                    <label for='conference'>Совещание</label>
                    <input id='work' name="type_name" type="radio" value="Work"/>
                    <label for='work'>Работа</label></p>

                    <p><input name="place" type="text" placeholder="Place"/></p>

                    <p><input name="date" type="date"/></p>

                    <p><input name="duration" type="number" placeholder="duration (minutes)"/></p>

                    <p><input name="comment" type="text" placeholder="Comment"/></p>

                    <button type="submit">Создать</button>
                </form>
            </div>
        </div>
    </body>
</html>