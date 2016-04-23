<?php
namespace Acme\Controllers;

use Acme\Models\User;
use Acme\Validation\Validator;
use Acme\Auth\LoggedIn;

class AuthenticationController extends BaseController
{


    public  function  getShowLoginPage()
    {
        echo $this->blade->render('login', [
            'signer' => $this->signer,
        ]);
    }

    public function postShowLoginPage()
    {
        if(!$this->signer->validateSignature($_POST['_token'])){
            header('HTTP/1.0 400 Bad Request');
            exit();
        }
        $okay = true;

        // look up the user
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $user = User::where('email', '=', $email)->first();

        // validate credentials
        if($user != null) {
            if (!password_verify($password, $user->password)) {
                $okay = false;
            }
        } else {
            $okay = false;
        }
        if($user->active == 0){
            $okay = false;
            $_SESSION['msg'] = ["The user: <b>". $user->email ."</b> is not activated, please verify your email and confirm registration"];
            echo $this->blade->render('login', ['signer' => $this->signer]);
            unset($_SESSION['msg']);
        } elseif($okay)
        // if valid, log them in
        {
            $_SESSION['user'] = $user;
            header("Location: /");
            exit();

            // if not valid, redirect to login
        } else {
            $_SESSION['msg'] = ['Invalid login'];
            echo $this->blade->render('login', ['signer' => $this->signer]);
            unset($_SESSION['msg']);
        }

    }


    public function getLogout(){
        unset($_SESSION['user']);
        session_destroy();
        header("Location: /login");

    }
    public  function getTestUser(){
       // $n = new LoggedIn();
       // dd($n->user());

        dd(LoggedIn::user()->first_name);
    }

}

