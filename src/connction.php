<?php
class Database {
    public static $connection;

    public static function setUpConnection(){
        if(!isset(self::$connection)){
            self::$connection = new mysqli("localhost", "root", "Shan_200630103728", "walawa_cabana");
            if (self::$connection->connect_error) {
                // Log error instead of dying in production ideally
                error_log("Database Connection failed: " . self::$connection->connect_error);
                die("Connection failed. Please try again later."); // User-friendly message
            }
            // Optional: Set character set for connection
             self::$connection->set_charset("utf8mb4");
        }
    }

    public static function iud($query){
        self::setUpConnection();
        $result = self::$connection->query($query);
         if (!$result) {
             error_log("Database IUD Query Failed: " . self::$connection->error . " | Query: " . $query);
         }
        return $result; // Returns true/false for success/failure of IUD
    }

    // --- ADD THIS METHOD ---
    /**
     * Executes a SELECT query and returns the result set.
     * @param string $query The SQL SELECT query.
     * @return mysqli_result|false The result object on success, false on failure.
     */
    public static function search($query) {
        self::setUpConnection();
        $result = self::$connection->query($query);
        if (!$result) {
            error_log("Database Search Query Failed: " . self::$connection->error . " | Query: " . $query);
            return false; // Return false on error
        }
        return $result; // Return the mysqli_result object
    }

    // Optional: Method to close connection if needed explicitly
    public static function closeConnection() {
        if(isset(self::$connection)) {
            self::$connection->close();
            self::$connection = null; // Reset static variable
        }
    }
}
?>