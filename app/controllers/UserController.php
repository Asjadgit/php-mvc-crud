<?php

require_once './core/Controller.php';
require_once './app/models/User.php';

class UserController extends Controller
{
    public function index()
    {
        $users = new User();
        $users->all();

        $this->view('users/index', compact('users'));
    }

    public function create()
    {
        $this->view('users/create');
    }

    public function store()
    {
        $data = [
            'name'  => $_POST['name'],
            'email' => $_POST['email'],
        ];

        $user = new User();
        $user->create($data);

        header("Location: /php-mvc-crud/public");
    }

    public function edit($id)
    {
        $user = new User();
        $user->find($id);
        $this->view('users/edit', compact('user'));
    }

    public function update()
    {
        $id = $_POST['id'];

        $data = [
            'name'  => $_POST['name'],
            'email' => $_POST['email'],
        ];

        $user = new User();
        $user->update($id, $data);

        header("Location: /php-mvc-crud/public");
    }

    public function destroy($id)
    {
        $user = new User();
        $user->delete($id);

        header("Location: /php-mvc-crud/public");
    }
}
