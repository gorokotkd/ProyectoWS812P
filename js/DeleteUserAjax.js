function deleteUser(button){
    if (confirm("Estas seguro de que deseas eliminar el usuario?")) {
        var str = button['id'].split("-");
        
        $.ajax({
            type: 'GET',
            url: '../php/RemoveUser.php?email='+str[2],
            async: false,
            cache:false,
            success: function(){
                var row = document.getElementById(str[2]);
                row.parentNode.removeChild(row);
            }
            
        });
        
    }
}