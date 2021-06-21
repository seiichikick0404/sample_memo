
$(function(){

    $(".edit-position").on('click', function(){
        var folderId = $(this).data('id');
        var folderName = $(this).data('name');

        console.log(folderId);
        console.log(folderName);

        $("#edit_folder").val(folderName);
        $("#edit_id").val(folderId);
    })
    
})