<?php
class Book {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT
                b.book_id, b.book_name, ab.author_id, a.author_name, pb.publisher_id, p.publisher_name
            FROM
                books b
                JOIN
                    author_to_book ab
                        ON ab.book_id = b.book_id
                JOIN
                    authors a
                        ON ab.author_id = a.author_id
                JOIN
                    publisher_to_book pb
                        ON pb.book_id = b.book_id
                JOIN
                    publishers p
                        ON pb.publisher_id = p.publisher_id       
                ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function createBook($book_name){

        $query = "INSERT INTO books SET book_name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $book_name);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    function createPublisher($publisher_name){

        $query = "INSERT INTO publishers SET publisher_name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $publisher_name);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    function AddAuthorToBook($author_id, $book_id){

        $query = "INSERT INTO author_to_book SET author_id = :author_id, book_id = :book_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':book_id', $book_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function AddPublisherToBook($publisher_id, $book_id){

        $query = "INSERT INTO publisher_to_book SET publisher_id = :publisher_id, book_id = :book_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':publisher_id', $publisher_id);
        $stmt->bindParam(':book_id', $book_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function createAuthor($author_name){

        $query = "INSERT INTO authors SET author_name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $author_name);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    function delete($book_id){
        $query = "DELETE FROM books WHERE book_id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $book_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

// Проверка на существование, имена уникальны.
    function existAuthor($author_name){

        $query = "SELECT author_id FROM authors WHERE author_name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $author_name);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        return false;
    }

    function existPublisher($publisher_name){

        $query = "SELECT publisher_id FROM publishers WHERE publisher_name = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $publisher_name);

        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        return false;
    }
}
?>