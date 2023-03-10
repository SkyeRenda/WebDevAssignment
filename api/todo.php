<?php
try {
    require_once("todo.controller.php");
    require_once("todo.class.php");
    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = explode( '/', $uri);
    $requestType = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    $pathCount = count($path);

    $controller = new TodoController();
    
    switch($requestType) {
        case 'GET':
            if ($path[$pathCount - 2] == 'todo' && isset($path[$pathCount - 1]) && strlen($path[$pathCount - 1])) {
                $id = $path[$pathCount - 1];
                $todo = $controller->load($id);
                if ($todo) {
                    http_response_code(200);
                    die(json_encode($todo));
                }
                http_response_code(404);
                die();
            } else {
                http_response_code(200);
                die(json_encode($controller->loadAll()));
            }
            break;
        case 'POST':
            //implement your code here
            
            $json = file_get_contents("php://input");
            $data = json_decode($json);
            if ($data){
                $todo = new Todo($data->id, $data->title, $data->description);
                $controller->create($todo);
                http_response_code(200);
                die(json_encode("Successfully created new ToDo"));
            }else {
                http_response_code(501);
                die();
            }
            
            break;

        case 'PUT':
            //implement your code here
            $json = file_get_contents("php://input");
            $data = json_decode($json);
            if ($data){
                $todo = new Todo($data->id, $data->title, $data->description, $data->$done);
                $controller->update($todo->id, $todo);
                http_response_code(200);
                die(json_encode("Successfully updated ToDo"));
            }else {
                http_response_code(501);
            die();
            }

            break;

        case 'DELETE':
            //implement your code here
            $json = file_get_contents("php://input");
            $data = json_decode($json);
            if ($data){
                $controller->delete($data->id);
                http_response_code(200);
                die(json_encode("Successfully deleted ToDo"));
            }else {
                http_response_code(501);
                die(json_encode("Failed to delete ToDo"));
            }
            break;
        default:
            http_response_code(501);
            die();
            break;
    }
} catch(Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    die();
}
