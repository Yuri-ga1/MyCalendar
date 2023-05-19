<html>
    <head>
        <link rel="stylesheet" href="css.css" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            </div>

            <div id="fetch">
            </div>
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
            <form action="script/php.php" method="post">
                <p><input name="theme" type="text" placeholder="Theme"/></p>

                <p><input id='meeting' name="type_name" type="radio" value="Meeting"/>
                <label for='meeting'>Meeting</label>
                <input id='call' name="type_name" type="radio" value="Call"/>
                <label for='call'>Call</label>
                <input id='conference' name="type_name" type="radio" value="Conference"/>
                <label for='conference'>Conference</label>
                <input id='work' name="type_name" type="radio" value="Work"/>
                <label for='work'>Work</label></p>

                <p><input name="place" type="text" placeholder="Place" defaultValue=""/></p>

                <p><input name="dateandtime" type="date"/></p>

                <p><input name="duration" type="number" placeholder="duration (minutes)" defaultValue="1"/></p>

                <p><input name="comment" type="text" placeholder="Comment" defaultValue="1"/></p>

                <button type="submit">Create note</button>
            </form>
        </div>
    </body>
</html>