jQuery(function($){

    $(document).on('click', '.create-book-button', function(){

        var create_book_html=`
            <div id='read-books' class='btn btn-primary pull-right m-b-15px read-books-button'>
                <span class='glyphicon glyphicon-list'></span> Все книги
            </div>
            <form id='create-book-form' action='#' method='post' border='0'>
                <table class='table table-hover table-responsive table-bordered'>
            
                    <tr>
                        <td>Название</td>
                        <td><input type='text' name='book_name' class='form-control' required /></td>
                    </tr>                           
            
                    <tr>
                        <td>
                            Автор <br>
                            (Можно задать несколько имен, <br> записывая каждоe с новой строки)
                        </td>
                        <td><textarea name='author_names' class='form-control' required></textarea></td>
                    </tr>
                    
                    <tr>
                        <td>Издательство</td>
                        <td><input type='text' min='1' name='publisher_name' class='form-control' required /></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <button type='submit' class='btn btn-primary'>
                                <span class='glyphicon glyphicon-plus'></span> Создать книгу
                            </button>
                        </td>
                    </tr>
            
                </table>
            </form>`;

        $("#page-content").html(create_book_html);

        changePageTitle("Создать новую книгу");
    });

    $(document).on('submit', '#create-book-form', function(){

        var form_data=JSON.stringify($(this).serializeObject());

        $.ajax({
            url: "api/book/create.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                showBooks();
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });

        return false;
    });
});