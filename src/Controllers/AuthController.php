<?php


namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;

class AuthController extends Controller
{


    public function login()
    {

        $user = new User($this->db);
        if (!empty($_POST)) {
            $user->setUsername($_POST['username']);
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $userRepo = new UserRepository($this->db);
                try {
                    $userBDD = $userRepo->findByUsername($_POST['username']);
                    if (password_verify($_POST['password'], $userBDD->getPassword()) == true) {
                        $_SESSION['auth'] = (int)$userBDD->getIsAdmin();
                        $this->redirect('admin?success=1');
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
}
