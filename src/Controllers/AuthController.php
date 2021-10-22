<?php


namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;

class AuthController extends Controller
{


    public function login()
    {
        if (!empty($_SESSION)) {
            $this->redirect('posts');
        }
        $user = new User($this->db);
        if (!empty($_POST)) {
            $user->setUsername($_POST['username']);
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $userRepo = new UserRepository($this->db);
                try {
                    $userBDD = $userRepo->findByUsername($_POST['username']);
                    if (password_verify($_POST['password'], $userBDD->getPassword()) == true) {
                        if ($userBDD->getIsAdmin()) {
                            $_SESSION['auth'] = (int)$userBDD->getIsAdmin();
                            $this->redirect('admin?success=1');
                        } else {
                            $_SESSION['email'] = $userBDD->getEmail();
                            $this->redirect('posts');
                        }
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else
                $this->redirect('login?error=1');
        } else
            $this->render('auth/login');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('index');
    }

    public function register()
    {
        if (!empty($_SESSION)) {
            $this->redirect('posts');
        }
        if (!empty($_POST)) {
            $user = new User($this->db);
            $userRepo = new UserRepository($this->db);
            $user
                ->setUsername($_POST['username'])
                ->setEmail($_POST['email'])
                ->setPassword($_POST['password']);
            $userRepo->create($user);
            $this->redirect('login?register=1');
        } else
            $this->render('register');
    }
}
