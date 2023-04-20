<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/app/utils/db.php");

class db_utils {
    private db $db;
    private PDO $conn;

    public function __construct() {
        $this->db  = new db();
        $this->conn = $this->db->getConnection();
    }

    /**
     * Checks if username exists in database
     * @param string $username Username to check
     * @return bool True if username exists, false otherwise
     */
    public function usernamesExists(string $username): bool {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = ?");
            $stmt->bindParam(1, $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                unset($stmt);
                unset($db);
                return true;
            } else {
                unset($stmt);
                unset($db);
                return false;
            }
        } catch (PDOException $e) {
            // Silently fail
            print_messages::printError("Database Error");
            die();
        }
    }
}