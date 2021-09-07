<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://tra.in/todo/assets/css/main.css">
    <title>tasks</title>
</head>
<body>

<div class="container">
    <div class="row">

        <div class="col-3 left-side">
            <ul>
                <?php
foreach ($folders as $folder) {
    echo "<li><a href=\"?folder_id={$folder->id}\">{$folder->folderName}</a> <a class=\"remove\" href=\"?delete_folder={$folder->id}\">X</a></li>";
}
?>
            </ul>

            <form action="<?=$_SERVER["PHP_SELF"]?>">

                <input type="text" placeholder="add new folder"><button>+</button>

            </form>
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
</body>
</html>
