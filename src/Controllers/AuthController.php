<?php


namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;

class AuthController extends Controller
{


    public function login()
    {
        $_SESSION['message'] = [];

        if (isset($_SESSION['user']) || !empty($_SESSION['user'])) {
            $this->redirect('posts');
        }
        if (!empty($_POST)) {
            if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['message']['erreur'][] = "Veuillez renseigner une adresse email valide";
                } else {
                    $user = (new UserRepository($this->db))->findByEmail($_POST['email']);

                    if (!$user) {
                        $_SESSION['message']['erreur'][] = "Email ou identifiant incorrect";
                    } else {
                        if (password_verify($_POST['password'], $user->getPassword()) == true) {
                            $_SESSION['user'] = [
                                'id' => $user->getId(),
                                'username' => $user->getUsername(),
                                'email' => $user->getEmail(),
                                'isAdmin' => (int)$user->getIsAdmin()
                            ];
                            $_SESSION['token'] = md5(uniqid(mt_rand(), true));
                            if ($_SESSION['user']['isAdmin'] === 1) {
                                $this->redirect('admin?success=1');
                            } else {
                                $this->redirect('posts?success=1');
                            }
                        } else
                            $_SESSION['message']['erreur'][] = "Email ou identifiant incorrect";
                    }
                }
            } else
                $_SESSION['message']["erreur"][] = "Veuillez renseigner tout les champs";

            if (isset($_SESSION['message']['erreur']) && !empty($_SESSION['message']['erreur'])) {
                $this->render('auth/login', ['post' => $_POST]);
                exit();
            }
        } else
            $this->render('auth/login');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['token']);
        $this->redirect("posts");
    }

    public function register()
    {
        $_SESSION['message'] = [];

        if (isset($_SESSION["user"])) {
            $this->redirect('posts');
        }

        if (!empty($_POST)) {

            $user = (new UserRepository($this->db))->findByEmail($_POST['email']);

            if (isset($_POST['email']) && !empty($_POST['email']) && $user) {
                $_SESSION['message']['erreur'][] = "Un compte avec cette adresse mail existe déjà";
            }
            if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                $_SESSION['message']['erreur'][] = "Veuillez renseigner tout les champs";
            }
            if (isset($_POST['username']) && !empty($_POST['username']) && strlen($_POST['username']) < 3) {
                $_SESSION['message']['erreur'][] = "Le nom doit contenir au moins 3 caractères";
            }
            if (isset($_POST['email']) && !empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['message']['erreur'][] = "Veuillez renseigner une adresse email valide";
            }
            if (isset($_POST['password']) && !empty($_POST['password']) && strlen($_POST['password']) < 8) {
                $_SESSION['message']['erreur'][] = "Le mot de passe doit contenir au moins 8 caractères";
            }
            if (isset($_SESSION['message']['erreur']) && !empty($_SESSION['message']['erreur'])) {
                $this->render('auth/register', ['post' => $_POST]);
                exit();
            }

            $user = new User($this->db);
            $userRepo = new UserRepository($this->db);
            $user
                ->setUsername($_POST['username'])
                ->setEmail($_POST['email'])
                ->setPassword($_POST['password']);
            $userRepo->create($user);
            $this->redirect('login?success=1');
        } else {
            $this->render('auth/register');
        }
    }
}
