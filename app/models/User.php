<?php

require_once './core/Database.php';

class User
{
    protected $db;
    protected $table = 'users';

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /**
     * Get all users
     */
    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get one user
     */
    public function find($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE id = ? AND LIMIT = 1"
        );
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        // 1. Get column names
        $columns = array_keys($data);

        // 2. Create placeholders (?, ?, ?)
        $placeholders = array_fill(0, count($columns), '?');

        // 3. Build SQL
        $sql = sprintf(
            "INSERT INTO users (%s) VALUES (%s)",
            implode(', ', $columns),
            implode(', ', $placeholders)
        );

        // 4. Prepare & execute
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($data));

        // 5. Return inserted ID
        return $this->db->lastInsertId();
    }

    public function update($id, array $data)
    {
        $fields = [];

        foreach ($data as $column => $value) {
            $fields[] = "$column = ?";
        }

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([...array_values($data), $id]);

        return true;
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
