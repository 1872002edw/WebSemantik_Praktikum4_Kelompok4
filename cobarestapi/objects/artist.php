<?php

class Artists
{

    // database connection and table name
    private $conn;
    private $table_name = "artists";

    public $idartists;
    public $name;
    public $debut;
    public $company;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read products
    function read()
    {

        // select all query
        $query = "SELECT
               * FROM artists";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // create product
    function create()
    {

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, debut=:debut, company=:company";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->debut = htmlspecialchars(strip_tags($this->debut));
        $this->company = htmlspecialchars(strip_tags($this->company));


        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":debut", $this->debut);
        $stmt->bindParam(":company", $this->company);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // used when filling up the update product form
    function readOne()
    {

        // query to read single record
        $query = "SELECT * FROM artists WHERE idartists = ? LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->idartists);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->debut = $row['debut'];
        $this->company = $row['company'];
    }

    // update the product
    function update()
    {

        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name = :name,
                debut = :debut,
                company = :company
            WHERE
                idartists = :idartists";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->debut = htmlspecialchars(strip_tags($this->debut));
        $this->company = htmlspecialchars(strip_tags($this->company));
        $this->idartists = htmlspecialchars(strip_tags($this->idartists));

        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':debut', $this->debut);
        $stmt->bindParam(':company', $this->company);
        $stmt->bindParam(':idartists', $this->idartists);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // delete the product
    function delete()
    {

        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE idartists = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->idartists = htmlspecialchars(strip_tags($this->idartists));

        // bind id of record to delete
        $stmt->bindParam(1, $this->idartists);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
