<?php namespace Acme\Validation;

use Respect\Validation\Validator as Valid;

class Validator
{

    public function isValid($validation_data)
    {
        $errors = [];

        foreach ($validation_data as $name => $value) {
            if (isset($_REQUEST[$name])) {
                $rules = explode("|", $value);
                foreach ($rules as $rule) {
                    $exploded = explode(":", $rule);

                    switch ($exploded[0]) {
                    case 'min':
                        $min = $exploded[1];
                        if (Valid::stringType()->length($min)->Validate($_REQUEST[$name]) == false) {
                            $errors[] = $name . " must be least " . $min . "characters long";
                        }
                        break;
                    case 'email':
                        if (Valid::email()->Validate($_REQUEST[$name]) == false) {
                            $errors[] = $name . " must be a valid email address!";
                        }
                        break;
                    case 'equalTo':
                        if (Valid::equals($_REQUEST[$name])->Validate($_REQUEST[$exploded[1]]) == false) {
                            $errors[] = $name . "Values does match verification value!";
                        }
                        break;
                    default:
                        // do nothing
                }
                }
            } else {
                $errors[] = "No value found!";
            }
        }


//
//        if( Validator::stringType()->length(3, null)->validate($_REQUEST['first_name']) == false ){
//            $errors[] = "First name must have minimum 3 charachter!";
//        }
//
//        if( Validator::stringType()->length(3, null)->validate($_REQUEST['first_name']) == false ){
//            $errors[] = "Last name must have minimum 3 charachter!";
//        }
//
//        if( Validator::email()->validate($_REQUEST['email']) == false){
//            $errors[] = "Must be a valid email adress";
//        }
//
//        if( $_REQUEST['verify_email'] != $_REQUEST['email'] ){
//            $errors[] = "The re-type password don't match";
//        }
//
//        if( Validator::stringType()->length(5, null)->validate($_REQUEST['password']) == false ){
//            $errors[] = "Password must have minimum 5 charachter!";
//        }
//
//        if( $_REQUEST['password'] != $_REQUEST['verify_password'] ){
//            $errors[] = "The re-type password not same with password";
//        }
//
//        if(empty($errors)){
//            echo "Succesfully!";
//        }
//
//        print_r($errors);
//        exit();


        return $errors;
    }
}
