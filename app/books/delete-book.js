jQuery(function($){

    $(document).on('click', '.delete-book-button', function(){
        var book_id = $(this).attr('data-id');

        // bootbox для подтверждения во всплывающем окне
        bootbox.confirm({

            message: "<h4>Вы уверены?</h4>",
            buttons: {
                confirm: {
                    label: '<span class="glyphicon glyphicon-ok"></span> Да',
                    className: 'btn-danger'
                },
                cancel: {
                    label: '<span class="glyphicon glyphicon-remove"></span> Нет',
                    className: 'btn-primary'
                }
            },
            callback: function (result) {
                if (result==true) {
                    $.ajax({
                        url: "api/book/delete.php",
                        type : "POST",
                        dataType : 'json',
                        data : JSON.stringify({ id: book_id }),
                        success : function(result) {
                            showBooks();
                        },
                        error: function(xhr, resp, text) {
                            console.log(xhr, resp, text);
                        }
                    });
                }
            }
        });
    });
});