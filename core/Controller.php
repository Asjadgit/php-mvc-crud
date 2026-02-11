<?php

class Controller
{
    protected function view($view, $data = [])
    {
        $viewPath = "../app/views/$view.php";

        // 🔴 View Not Found
        if (!file_exists($viewPath)) {
            http_response_code(404);
            echo "404 - View Not Found";
            exit;
        }
        extract($data); // This line converts array keys into variables. $data = ['users' => $users];
        // after using extract becomes $users = $users

        require "../app/Views/$view.php";  // manually pass variables.
    }
}
