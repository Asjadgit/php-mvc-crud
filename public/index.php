<?php

/**
 * ------------------------------------------------------------
 * Simple MVC Router
 * ------------------------------------------------------------
 * This file handles incoming requests and maps them to:
 * Controller → Method → Optional Parameter
 *
 * Example URL:
 * http://localhost/php-mvc/public?url=user/edit/5
 *
 * Will resolve to:
 * UserController → edit(5)
 */

// 1️⃣ Get URL from query string
// If no URL is provided, default to "user/index"
$url = $_GET['url'] ?? 'user/index';

// 2️⃣ Convert URL string into array
// Example: "user/edit/5"
// Becomes: ["user", "edit", "5"]
$url = explode('/', $url);

// 3️⃣ Determine Controller Name
// Take first part of URL and convert to Controller class
// Example: "user" → "UserController"
$controllerName = ucfirst($url[0]) . 'Controller';

// 4️⃣ Determine Method Name
// If method not provided, default to "index"
$method = $url[1] ?? 'index';

// 5️⃣ Get Optional Parameter (like ID)
// Example: user/edit/5 → $param = 5
$param = $url[2] ?? null;

if (!file_exists("../app/controllers/$controllerName.php")) {
    die("Controller not found.");
}

// 6️⃣ Load the Controller file
// Example: ../app/controllers/UserController.php
require_once "../app/controllers/$controllerName.php";

// 7️⃣ Create Controller Instance
$controller = new $controllerName();

// ✅ Check if method exists BEFORE calling it
if (!method_exists($controller, $method)) {
    http_response_code(404);
    echo "404 - Method Not Found";
    exit;
}

// 8️⃣ Call the Method Dynamically
// If parameter exists, pass it to the method

if ($param) {
    $controller->$method($param);
} else {
    $controller->$method();
}
