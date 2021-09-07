<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://tra.in/todo/assets/css/main.css">
    <title>tasks</title>
    <script scr="https://releases.jquery.com/git/jquery-git.slim.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">

        <div class="col-3 left-side">
            <ul class="items">
                <?php
echo "<li><a href=\"?folder_id=null\">All</a></li>";

foreach ($folders as $folder) {
    echo "<li><a href=\"?folder_id={$folder->id}\">{$folder->folderName}</a> <a class=\"remove\" href=\"?delete_folder={$folder->id}\">X</a></li>";
}
?>
            </ul>


                <input id="folderNameInp"type="text" placeholder="add new folder"><button id="btnAddFolder">+</button>

        </div>
        <div class="col-9 right-side">

        <table>
            <?php
foreach ($tasks as $task) {
    echo "<tr><td>{$task->title}</td></tr>";
    echo "<tr><td>{$task->text}</td></tr>";
}
?>
            </table>
        </div>

    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://tra.in/todo/assets/js/main.js"></script>
</body>
</html>
