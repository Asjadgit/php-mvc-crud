<?php

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/app/models/User.php';


class UserController extends Controller
{
    public function index()
    {
        $users = (new User())->all();

        $this->view('user/index', compact('users'));
    }

    public function create()
    {
        $this->view('user/create');
    }

    public function store()
    {
        $data = [
            'name'  => $_POST['name'],
            'email' => $_POST['email'],
        ];

        $user = new User();
        if ($user->create($data)) {
            $this->setFlash('success', 'User created successfully!');
        } else {
            $this->setFlash('error', 'Failed to create user.');
        }

        header("Location: " . BASE_URL . "/user");
        exit;
    }

    public function edit($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);
        $this->view('user/edit', compact('user'));
    }

    public function update()
    {
        $id = $_POST['id'];

        $data = [
            'name'  => $_POST['name'],
            'email' => $_POST['email'],
        ];

        $user = new User();

        if ($user->update($id, $data)) {
            $this->setFlash('success', 'User updated successfully!');
        } else {
            $this->setFlash('error', 'Failed to update user.');
        }

        header("Location: " . BASE_URL . "/user");
        exit;
    }

    public function destroy($id)
    {
        $user = new User();

        if ($user->delete($id)) {
            $this->setFlash('success', 'User deleted successfully!');
        } else {
            $this->setFlash('error', 'Failed to delete user.');
        }

        header("Location: " . BASE_URL . "/user");
        exit;
    }
}
