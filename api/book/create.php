<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/book.php';

$database = Database::getInstance();
$db = $database->getConnection();

$book = new Book($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->book_name) &&
    !empty($data->author_names) &&
    !empty($data->publisher_name)
) {
    $book_name = htmlspecialchars(strip_tags($data->book_name));
    $publisher_name = htmlspecialchars(strip_tags($data->publisher_name));

    $book_id = $book->createBook($book_name);

    if($book->existPublisher($publisher_name)['publisher_id']){
        $publisher_id = $book->existPublisher($publisher_name)['publisher_id'];
    } else {
        $publisher_id = $book->createPublisher($publisher_name);
    }

    $book->AddPublisherToBook($publisher_id, $book_id);

    // Несколько авторов
    $author_names = explode("\r\n", $data->author_names);

    foreach($author_names as $author_name){
        $author_name = htmlspecialchars(strip_tags($author_name));
        if($book->existAuthor($author_name)['author_id']){
            $author_id = $book->existAuthor($author_name)['author_id'];
        } else {
            $author_id = $book->createAuthor($author_name);
        }

        $book->AddAuthorToBook($author_id, $book_id);
    }

    if($book_id){

        http_response_code(201);

        echo json_encode(array("message" => "Книга была создана"), JSON_UNESCAPED_UNICODE);
    } else {

        http_response_code(503);

        echo json_encode(array("message" => "Невозможно создать книгу"), JSON_UNESCAPED_UNICODE);
    }
} else {

    http_response_code(400);

    echo json_encode(array("message" => "Недостаточно данных для создания книги"), JSON_UNESCAPED_UNICODE);
}
?>