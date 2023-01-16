function putTodo(todo) {
  console.log("calling putTodo ");
  console.log(JSON.stringify(todo));
}

function postTodo(todo) {
  // implement your code here
  fetch(window.location.href + "api/todo", {
    method: "POST",
    body: JSON.stringify(todo),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => console.log(response))
    .then((response) => console.log(response))
    .catch((error) => showToastMessage("Failed to post"));
  console.log("calling postTodo with stringify");
  console.log(JSON.stringify(todo));
}

function deleteTodo(todo) {
  // implement your code here
  console.log("calling deleteTodo");
  console.log(todo);
}

// example using the FETCH API to do a GET request
function getTodos() {
  fetch(window.location.href + "api/todo")
    .then((response) => response.json())
    .then((json) => drawTodos(json))
    .catch((error) => showToastMessage("Failed to retrieve todos..."));
}

getTodos();
