<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/Database.php");

class DatabaseUtils {
    private Database $db;
    private PDO $conn;

    public function __construct() {
        $this->db  = new Database();
        $this->conn = $this->db->getConnection();
    }

    /**
     * Checks if username exists in database
     * @param string $username Username to check
     * @return bool True if username exists, false otherwise
     */
    public function usernamesExists(string $username): bool {
        $exists = true;
        try {
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = ?");
            $stmt->bindParam(1, $username);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                $exists = false;
            }
        } catch (PDOException $e) {
            // Silently fail
            PrintMessages::printError("Database Error");
            die();
        } finally {
            unset($stmt);
            return $exists;
        }
    }

    public function __destruct() {
        unset($this->conn);
        unset($this->db);
    }
}
