<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/book.php';

$database = Database::getInstance();
$db = $database->getConnection();

$book = new Book($db);

$stmt = $book->read();
$num = $stmt->rowCount();

if ($num > 0) {

    $books_arr = [];
    $books_arr["records"] = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $books_arr["records"][$book_id] = [
            "book_id" => $book_id,
            "book_name" => $book_name,
            "publisher_id" => $publisher_id,
            "publisher_name" => $publisher_name,
            "author_id" => (isset($books_arr["records"][$book_id])) ? $books_arr["records"][$book_id]["author_id"] . ", " . $author_id : $author_id,
            "author_name" => (isset($books_arr["records"][$book_id])) ? $books_arr["records"][$book_id]["author_name"] . ", " . $author_name : $author_name,
        ];
    }

    http_response_code(200);

    echo json_encode($books_arr);
}

else {
    http_response_code(404);

    echo json_encode(array("message" => "Книги не найдены."), JSON_UNESCAPED_UNICODE);
}