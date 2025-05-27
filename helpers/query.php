<?php

class Query{
    protected $pdo;
    protected $table;
    protected $selects = '*';
    protected $wheres = [];
    protected $bindings = [];

    public function __construct($pdo = DB) {
        $this->pdo = $pdo;
    }

    public function table($table) {
        $this->table = $table;
        return $this;
    }

    public function select($columns = ['*']) {
        $this->selects = implode(', ', $columns);
        return $this;
    }

    public function raw($sql) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $class = getClass($this->table);
        if($class){
            $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        }
        return $stmt;
    }
    public function where($column, $operator, $value) {
        $this->wheres[] = "$column $operator ?";
        $this->bindings[] = $value;
        return $this;
    }
    public function find($id) {
        $sql = "SELECT {$this->selects} FROM {$this->table}";

        $sql .= ' WHERE id = :id';

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $class = getClass($this->table);
        if($class){
            $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        }
        return $stmt->fetch();
    }

    public function get() {
        $sql = "SELECT {$this->selects} FROM {$this->table}";
        if (!empty($this->wheres)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->wheres);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($this->bindings);

        return $stmt->fetchAll();
    }

    public function first() {
        $sql = "SELECT {$this->selects} FROM {$this->table}";
        if (!empty($this->wheres)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->wheres);
        }

        $sql .= " LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($this->bindings);
        $class = getClass($this->table);
        if($class){
            $stmt->setFetchMode(PDO::FETCH_CLASS, $class);
        }
        return $stmt->fetch();
    }
    public function create($data){
        $cols = array_keys($data);
        $sql = "INSERT INTO {$this->table} (".implode(',',$cols).",created_at) VALUES (:".implode(',:',$cols).", NOW())";

        $stmt = $this->pdo->prepare($sql);
        $status = $stmt->execute(array_values($data));
        if($status){
            $id = $this->pdo->lastInsertId();
            return $this->find($id);
        }
        return $status;
    }
    public function delete(){
        $sql = "DELETE FROM {$this->table}";
        if (!empty($this->wheres)) {
            $sql .= ' WHERE ' . implode(' AND ', $this->wheres);
        }

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($this->bindings);
    }
}
