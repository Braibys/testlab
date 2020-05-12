<?php

require_once 'api/config/database.php';

$database = Database::getInstance();
$db = $database->getConnection();

$sql_tables = "
    CREATE TABLE IF NOT EXISTS  books(
        book_id integer NOT NULL auto_increment primary key,
        book_name varchar(32) NOT NULL)
        ENGINE=InnoDB DEFAULT CHARSET=utf8;
    INSERT INTO books (book_name) VALUES ('book1'), ('book2'), ('book3'), ('book4'), ('book5');

    CREATE TABLE IF NOT EXISTS  authors(
        author_id integer NOT NULL auto_increment primary key, 
        author_name varchar(32) NOT NULL UNIQUE)
        ENGINE=InnoDB DEFAULT CHARSET=utf8;
    INSERT INTO authors (author_name) VALUES ('author1'), ('author2'), ('author3');
    
    CREATE TABLE IF NOT EXISTS  publishers(
        publisher_id integer NOT NULL auto_increment primary key, 
        publisher_name varchar(32) NOT NULL UNIQUE)
        ENGINE=InnoDB DEFAULT CHARSET=utf8;
    INSERT INTO publishers (publisher_name) VALUES ('publisher1'), ('publisher2'), ('publisher3');
    
    CREATE TABLE IF NOT EXISTS  author_to_book(
        author_id integer  NOT NULL,
        book_id integer NOT NULL,
        PRIMARY KEY (book_id , author_id ),
        FOREIGN KEY (book_id) REFERENCES books(book_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
        FOREIGN KEY (author_id) REFERENCES authors(author_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE)
        ENGINE=InnoDB DEFAULT CHARSET=utf8;
    INSERT INTO author_to_book (author_id, book_id) VALUES (1,1), (1,2), (1,3), (2,4), (2,5), (3,2), (3,5);
    
    CREATE TABLE IF NOT EXISTS  publisher_to_book(
        publisher_id integer  NOT NULL,
        book_id integer NOT NULL UNIQUE,
        PRIMARY KEY (book_id , publisher_id ),
        FOREIGN KEY (book_id) REFERENCES books(book_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
        FOREIGN KEY (publisher_id) REFERENCES publishers(publisher_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE)
        ENGINE=InnoDB DEFAULT CHARSET=utf8;
    INSERT INTO publisher_to_book (publisher_id, book_id) VALUES (1,1), (1,2), (1,3), (2,4), (2,5);
";

$db->exec($sql_tables);

echo 'Таблицы добавлены';
