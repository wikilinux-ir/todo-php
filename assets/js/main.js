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
                console.log(result);

                if(result[0] == "true"){
                    console.log("s");
                    $(".items").append('<li><a href="?folder_id='+result[1]+'">'+result[2]+'</a><a class="remove" href="?delete_folder='+result[1]+'">X</a></li>');
                }else if(response == "it,s duplicate"){
                    alert("نام پوشه تکراری است");
                }
            }
        });
    })
});