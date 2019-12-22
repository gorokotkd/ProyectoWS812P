function verFormulario() {
    clean();
    $('#form').show();
}

function enviarForm() {
    var form = $('#fquestion')[0];
    var data = new FormData(form);

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../php/AddQuestionWithImage.php",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
            $("#tabla-preguntas").html(data);
        }
    });
}

