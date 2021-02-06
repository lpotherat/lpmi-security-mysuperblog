<?php

abstract class base_repository{
    /**
     * @var context $context
     */
    private $context;

    public function __construct(context $context){
        $this->context = $context;
    }

    protected function queryToSingle($query):?array{
        return $this->context->db->query($query)->fetchAll()[0] ?? null;
    }
    protected function queryToArray($query):array{
        return $this->context->db->query($query)->fetchAll();
    }

    protected function insert(string $table, array $data):?int{
        $keys = implode(',',array_keys($data));
        $values = "'".implode("','",array_map('addslashes',array_values($data)))."'";
        $this->context->db->query("INSERT INTO $table ($keys) VALUES ($values) ");
        return $this->context->db->lastInsertId() ?? null;
    }
    protected function update(string $table, int $id, array $data):void{
        $upd = [];
        foreach($data as $key=>$value){
            $value = addslashes($value);
            $upd[] = " $key = '$value' ";
        }
        $this->context->db->query("UPDATE $table SET ".implode(',',$upd));
    }

    
    protected function delete(string $table, int $id):void{
        $this->context->db->query("DELETE FROM $table WHERE id = $id");
    }

}