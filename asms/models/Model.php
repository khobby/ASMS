<?php
require_once __DIR__ . '/../config/database.php';
abstract class Model {
    protected $db;
    protected $table;
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    public function findAll($conditions = [], $order = 'created_at DESC', $limit = null) {
        $sql = "SELECT * FROM " . $this->table;
        $params = [];
        if ($conditions) {
            $parts = [];
            foreach ($conditions as $k=>$v) { $parts[] = "`$k`=?"; $params[]=$v; }
            $sql .= ' WHERE ' . implode(' AND ', $parts);
        }
        if ($order) $sql .= " ORDER BY $order";
        if ($limit) $sql .= " LIMIT $limit";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id=? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($data) {
        $keys = array_keys($data);
        $place = implode(',', array_fill(0,count($keys),'?'));
        $sql = "INSERT INTO {$this->table} (".implode(',', $keys).") VALUES ($place)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array_values($data));
        return $this->db->lastInsertId();
    }
    public function update($id, $data) {
        $parts = [];$vals=[];
        foreach($data as $k=>$v){$parts[]="`$k`=?";$vals[]=$v;}
        $vals[]=$id;
        $sql = "UPDATE {$this->table} SET " . implode(',', $parts) . " WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($vals);
    }
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $stmt->execute([$id]);
    }
}
