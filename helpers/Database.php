<?php

class Database {

    protected $PDO;
    protected $table_name;
    private $host,$dbname,$user,$pass;

    public function __construct() {
        $this->host = 'localhost';
        $this->dbname = 'postgres';
        $this->user = 'postgres';
        $this->pass = 'stoichev';
        $this->PDO = new PDO("pgsql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);
        $this->table_name = "public.books";
        $this->PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function select_all_books() {
        $statement = $this->PDO->prepare("SELECT * FROM $this->table_name ORDER BY id");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;        
    }  

    public function search_by_author($searh_term) {
        $statement = $this->PDO->prepare("SELECT * FROM $this->table_name WHERE LOWER(author) LIKE :searh_term ORDER BY id");
        $statement->execute(array(":searh_term" => '%'.$searh_term.'%'));
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;        
    }  

    public function update_book($data) {
        $query = "UPDATE books SET author=?, book_name=?, date_added=? WHERE depth=? AND row_number=?";
        $statement = $this->PDO->prepare($query);
        $statement->execute($data);
    }

    public function check_if_book_exists($depth,$row_number) {
        $statement = $this->PDO->prepare("SELECT * FROM $this->table_name WHERE depth=? and row_number=?");
        $statement->execute([$depth,$row_number]);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function insert_rows($data){
        $query = "INSERT INTO $this->table_name (author,book_name,depth,row_number,date_added) VALUES (?,?,?,?,?)";
        $statement = $this->PDO->prepare($query);
        $statement->execute($data);
    }


}