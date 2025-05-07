<?php
class Database {
    public static $connection;

    public static function setUpConnection(){
        if(!isset(self::$connection)){
            // Replace with your actual database credentials
            self::$connection = new mysqli("localhost", "root", "Shan_200630103728", "walawa_cabana");
            if (self::$connection->connect_error) {
                error_log("Database Connection failed: " . self::$connection->connect_error);
                // In a production environment, you might want a more user-friendly error page
                // or to handle this without dying, but for development, this is okay.
                die("Connection failed. Please try again later.");
            }
            self::$connection->set_charset("utf8mb4");
        }
    }

    /**
     * Returns the active database connection object.
     * @return mysqli The mysqli connection object.
     */
    public static function getDatabaseConnection(){
        self::setUpConnection(); // Ensures the connection is established
        return self::$connection;
    }

    /**
     * Executes an INSERT, UPDATE, or DELETE query.
     * @param string $query The SQL query.
     * @return bool|mysqli_result True on success (for some IUD operations) or mysqli_result object, false on failure.
     */
    public static function iud($query){
        self::setUpConnection();
        $result = self::$connection->query($query);
         if (!$result) {
             error_log("Database IUD Query Failed: " . self::$connection->error . " | Query: " . $query);
         }
        return $result;
    }

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
            return false;
        }
        return $result;
    }

    /**
     * Optional: Closes the database connection.
     */
    public static function closeConnection() {
        if(isset(self::$connection)) {
            self::$connection->close();
            self::$connection = null; // Reset static variable
        }
    }
}
?>