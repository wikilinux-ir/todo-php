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
echo "<li><a href=\"?folder_id=all\">All</a></li>";

foreach ($folders as $folder):  ?>
    <li><a href="<?="?folder_id={$folder->id}"?>"><?=$folder->folderName?></a> <a onclick="return confirm('آیا مطمئن هستید که می‌خواهید پوشه‌ی <?=$folder->folderName?> را حذف کنید؟');" class="remove" href="?delete_folder=<?=$folder->id?>">X</a></li>

<?php endforeach;?>
            </ul>


                <input id="folderNameInp"type="text" placeholder="add new folder"><button id="btnAddFolder">+</button>

        </div>
        <div class="col-9 right-side">
        <a href="?logout=1">logout</a>
        <table>
<div style="display:<?=(!isset($_GET["folder_id"]) || $_GET["folder_id"] == "all") ? "none" : "inline-block"?>">
        <input style="margin-top:15px;" id="taskNameInp" type="text" placeholder="add new task"><button id="btnAddTask">+</button></div>
        <hr>

<?php if (sizeof($tasks)): ?>
<?php foreach ($tasks as $task): ?>
    <tr class="rowdata"><td><?=$task->title?></td><td><?=$task->create_at?></td><td class="rowTask"><input data-id="<?=$task->id?>" id="checkBtn" type="checkbox" <?=$task->isComplete ? 'checked' : '';?>></td><td> <a  href="javascript:void(0)" class="remove-Task" data-id="<?=$task->id?>">X</a></td></tr>
<!--    <tr><td><?=$task->text?></td></tr> -->


<?php endforeach;?>
<?php else: ?>
    <tr><td>no task  here</td></tr>

<?php endif;?>
            </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://tra.in/todo/assets/js/main.js"></script>
<script>
    $(document).ready(function(){
    $("#btnAddTask").click(function(){
        var inpTask = $("#taskNameInp");
        $.ajax({
            url: "http://tra.in/todo/tasks/ajaxHandler.php",
            method: "post",
            data : {action : "createTask" , taskName : inpTask.val(),folderId : "<?=isset($_GET["folder_id"]) ? intval($_GET["folder_id"]) : "all"?>"},
            success : function(response){
                console.log(response)
                if(response == "true"){
                    location.reload()
                }
                else if(response == "task is duplicate"){
                    alert("تسک تکراری است")
                }
                else if(response == "folder not found!")
                {
                    alert("پوشه مورد نظر پیدا نشد");
                }
            }
        })
    })
})
</script>
</body>
</html>
