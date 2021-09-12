$(document).ready(function(){

    $("#btnAddFolder").click(function(e){

        
        e.preventDefault();
        var inp = $("#folderNameInp");

        $.ajax({
            method: "post",
            url: "http://tra.in/todo/tasks/ajaxHandler.php",
            data: {action : "createFolder" , folderName : inp.val()},
            success: function (response) {
                console.log(response)
                var result = response.split("-");

                if(result[0] == "true"){
                    $(".items").append('<li><a href="?folder_id='+result[1]+'">'+result[2]+'</a><a class="remove" href="?delete_folder='+result[1]+'">X</a></li>');
                    inp.val(" ");
                }else if(response == "it,s duplicate"){
                    alert("نام پوشه تکراری است");
                }
            }
        });
    })
});


$(document).ready(function(){
$(".rowTask").click(function(){
    var taskId = ($(this).find("#checkBtn").attr('data-id'));
    var checkOrNot = $(this).find("#checkBtn").prop("checked");
    $.ajax({
        url: "http://tra.in/todo/tasks/ajaxHandler.php",
        method : "post",
        data : {action : "changeTaskComplete" , task : taskId , check : checkOrNot},
        success : function(response){
            if(response == "true"){
                alert("با موفقیت تمام شد");
            }else{
                alert("هنوز تمومش نکردی که");

            }
        }
    })
});
})

$(document).ready(function(){

$(".remove-Task").click(function(){
    var taskId = ($(this).attr('data-id'));
    con = confirm("آیا شما میخواهید حذف شود؟");
    console.log(con);
    var its = $(this).closest(".rowdata");
    if(con == true){
    $.ajax({
        url: "http://tra.in/todo/tasks/ajaxHandler.php",
        method : "post",
        data : {action : "removeTask" , task : taskId },
        success : function(response){
            if(response == "true"){
                its.remove();
            }else if(response == "false"){
                alert("تسک حذف نشد");

            }
        }
    })}
});
})

