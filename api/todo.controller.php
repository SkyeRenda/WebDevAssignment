<?php
require_once("todo.class.php");

class TodoController {
    private const PATH = __DIR__."/todo.json";
    private array $todos = [];

    public function __construct() {
        $content = file_get_contents(self::PATH);
        if ($content === false) {
            throw new Exception(self::PATH . " does not exist");
        }  
        $dataArray = json_decode($content);
        if (!json_last_error()) {
            foreach($dataArray as $data) {
                if (isset($data->id) && isset($data->title))
                $this->todos[] = new Todo($data->id, $data->title, $data->description, $data->done);
            }
        }
    }

    public function loadAll() : array {
        return $this->todos;
    }

    public function load(string $id) : Todo | bool {
        foreach($this->todos as $todo) {
            if ($todo->id == $id) {
                return $todo;
            }
        }
        return false;
    }

    public function create(Todo $todo) : bool {
        // implement your code here
        try{
            array_push($this->todos, $todo);
            $this->writeToJsonFile();
            return true;
        } 
        catch(Exception $e){
            return false;
        }
    }

    public function update(string $id, Todo $todo) : bool {
        // implement your code here
        try {
            $index = array_search(array('id' => $id), $this->todos);
            $this->todos[$index] = $todo;
            $this->writeToJsonFile();
            return true;
        } catch (Exception $e) {
            return false;
        }      
    }

    public function delete(string $id) : bool {
        // implement your code here
        try {
            $index = array_search(array('id' => $id), $this->todos);
            unset($this->todos, $index);
            $this->writeToJsonFile();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // add any additional functions you need below
    private function writeToJsonFile(){
        $jsonData = json_encode($this->todos);
        file_put_contents(self::PATH, $jsonData);
    }
}