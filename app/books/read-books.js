jQuery(function($){

    showBooks();

    $(document).on('click', '.read-books-button', function(){
        showBooks();
    });
});

function showBooks(){
    $.getJSON("api/book/read.php", function(data){
        var read_books_html=`
            <div id='create-product' class='btn btn-primary pull-right m-b-15px create-book-button'>
                <span class='glyphicon glyphicon-plus'></span> Создание книги
            </div>
            <table class='table table-bordered table-hover'>
                <tr>
                    <th class='w-15-pct'>Название</th>
                    <th class='w-15-pct'>Автор</th>
                    <th class='w-10-pct'>Издательство</th>
                    <th class='w-5-pct text-align-center'>Удаление</th>
                </tr>`;

                $.each(data.records, function(key, val) {
                    read_books_html+=`
                <tr>
        
                    <td>` + val.book_name + `</td>
                    <td>` + val.author_name + `</td>
                    <td>` + val.publisher_name + `</td>

                    <td class='text-align-center'>
                        <button class='btn btn-danger delete-book-button' data-id='` + val.book_id + `'>
                            <span class='glyphicon glyphicon-remove'></span> Удаление
                        </button>
                    </td>
        
                </tr>`;
                });

            read_books_html+=`</table>`;

        $("#page-content").html(read_books_html);

        changePageTitle("Все книги");
    });
}