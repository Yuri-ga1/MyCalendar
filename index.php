<html>
    <head>
        <link rel="stylesheet" href="css.css" type="text/css"/>
        <script src="script.js"></script>
        <script src="today.php"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class='active_tasks'>
            <div class='task_filter'>
                <form>
                    <input id='date_filter_id1' name="date_filter" type="radio" value="today" checked/>
                    <label for='date_filter_id1'>сегодня</label>

                    <input id='date_filter_id2' name="date_filter" value="tomorrow" type="radio"/>
                    <label for='date_filter_id2'>завтра</label>

                    <input id='date_filter_id3' name="date_filter" value="thisweek" type="radio"/>
                    <label for='date_filter_id3'>на эту неделю</label>

                    <input id='date_filter_id4' name="date_filter" value="nextweek" type="radio"/>
                    <label for='date_filter_id4'>на след неделю</label>
                </form>
            </div>

            <div id="fetch">
            </div>
            <script>
                $(document).ready(function() {
                    $('input[name="date_filter"]').change(function() {
                        if ($(this).is(':checked')) {
                            var selectedOption = $(this).val();

                            $.ajax({
                                url: 'sort.php',
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
            <form action="php.php" method="post">
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