<?php

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data); // This line converts array keys into variables. $data = ['users' => $users];
                        // after using extract becomes $users = $users

        require "../app/Views/$view.php";  // manually pass variables.
    }
}