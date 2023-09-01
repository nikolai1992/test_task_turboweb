<?php
//    foreach ($dogs as $dog) {
//        print_r($dog);
//        echo "<br>";
//    }
//?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Введіть команду</h2>
            <form class="command-form">
                <div class="form-group">
                    <label for="command">Команда:</label>
                    <input type="text" class="form-control" id="command" name="command" placeholder="Введіть команду">
                </div>
                <button type="submit" class="btn btn-primary">Виконати</button>
            </form>
        </div>
        <div class="col-md-6">
            <div class="actions-display">

            </div>
        </div>
    </div>

</div>
<script>
    $('body').on('submit', '.command-form', function (e) {
        e.preventDefault();
        $.ajax({
            type: 'get',
            url: '/api/run_command',
            data: $('.command-form').serialize(),
            success: function (res) {
                $('.actions-display').prepend(res);
            }
        });
        console.log($('#command').val());
    })
</script>


