<?php
require_once(ROOT."/db.config.php");
class DB
{
    static function connect()
    {
        try {
            $dbh = new PDO('mysql:host=' . servername . ';dbname=' . database . '', username, password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}