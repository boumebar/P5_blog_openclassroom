<?php


namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;

class AuthController extends Controller
{
    public function index()
    {

        $user = new User($this->db);
        if (!empty($_POST)) {
            $user->setUsername($_POST['username']);
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $userRepo = new UserRepository($this->db);
                try {
                    $userBDD = $userRepo->findByUsername($_POST['username']);
                    if (password_verify($_POST['password'], $userBDD->getPassword()) == true) {
                        header('Location: ' . BASE . "/admin");
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else
                $this->render('auth/login');
        } else
            $this->render('auth/login');
    }
}
