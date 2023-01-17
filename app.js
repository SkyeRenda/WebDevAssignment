function putTodo(todo) {
  // implement your code here
  fetch(window.localStorage.href + "api/todo", {
    method: "PUT",
    body: JSON.stringify(todo),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => console.log(response.json()))
    .then((response) => showToastMessage(response.JSON()))
    .catch((error) => showToastMessage("Failed to post"));
  console.log("calling putTodo with request");
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
    .then((response) => console.log(response.json()))
    .then((response) => showToastMessage(response.json()))
    .catch((error) => showToastMessage("Failed to post"));
  console.log("calling postTodo with stringify");
  console.log(JSON.stringify(todo));
}

function deleteTodo(todo) {
  // implement your code here
  fetch(window.location.href + "api/todo", {
    method: "DELETE",
    body: {
      id: todo.id,
    },
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => console.log(response.json()))
    .then((response) => showToastMessage(response.json()))
    .catch((error) => showToastMessage("Failed to delete"));
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
