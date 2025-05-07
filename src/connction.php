<?php
class Database {
    public static $connection;

    public static function setUpConnection(){
        if(!isset(self::$connection)){
            self::$connection = new mysqli("localhost", "root", "Shan_200630103728", "walawa_cabana"); // VERIFY THESE DETAILS
            if (self::$connection->connect_error) {
                error_log("Database Connection failed: " . self::$connection->connect_error);
                // For debugging, you can output the error directly, but remove for production
                // die("Connection failed: " . self::$connection->connect_error);
                die("Connection failed. Please try again later.");
            }
            self::$connection->set_charset("utf8mb4");
        }
    }

    public static function getDatabaseConnection(){
        self::setUpConnection();
        return self::$connection;
    }

    public static function iud($query){
        self::setUpConnection();
        $result = self::$connection->query($query);
         if (!$result) {
             error_log("Database IUD Query Failed: " . self::$connection->error . " | Query: " . $query);
         }
        return $result;
    }

    public static function search($query) {
        self::setUpConnection();
        $result = self::$connection->query($query);
        if (!$result) {
            error_log("Database Search Query Failed: " . self::$connection->error . " | Query: " . $query);
            return false;
        }
        return $result;
    }

    public static function closeConnection() {
        if(isset(self::$connection)) {
            self::$connection->close();
            self::$connection = null;
        }
    }
}
?>