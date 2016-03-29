<?php
namespace Acme\Controllers;

use Acme\Models\User;
use Acme\Validation\Validator;

class RegisterController extends BaseController
{




    public function getShowRegisterPage()
    {
      // include(__DIR__ . "/../../views/register.html");
        echo $this->blade->render('register');
    }

    public function postShowRegisterPage()
    {
        // the rules validation data
        $validation_data = [
            'first_name' => 'min:3',
            'last_name'  => 'min:3',
            'email'      => 'email|equalTo:verify_email',
            'verify_email' => 'verify_email',
            'password'     => 'min:3|equalTo:verify_password',
        ];

        // validate data
        $validator = new Validator();
        $errors = $validator->isValid($validation_data);

        if(sizeOf($errors) > 0 )
        {
            $_SESSION['msg'] = $errors;
            //header("Location: /register");
            echo $this->blade->render('register', ['errors' => $errors]);
            unset($_SESSION['msg']);
            exit();

        }

        $user = new User;
        $user->first_name = $_REQUEST['first_name'];
        $user->last_name = $_REQUEST['last_name'];
        $user->email     = $_REQUEST['email'];
        $user->password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        $user->save();

        echo "posted !";
    }

    public  function  getShowLoginPage()
    {
       // include(__DIR__.'/../../views/login.html');
        //echo $this->twig->render('login.html');
        echo $this->blade->render('login');
    }

}

