<?php namespace Acme\Validation;

use Respect\Validation\Validator as Valid;
use Acme\Models\User;

class Validator
{
    public function isValid($validation_data)
    {
        $errors = [];

        foreach ($validation_data as $name => $value) {

            $rules = explode("|", $value);

               // getting array ['first_name' => 'min:3', 'last_name' => 'min:3'
                foreach ($rules as $rule) {
                    $exploded = explode(":", $rule);

                    switch ($exploded[0]) {
                      case 'min':
                          $min = $exploded[1];
                          if (Valid::stringType()->length($min)->Validate($_REQUEST[$name]) == false) {
                              $errors[] = $name . " must be least " . $min . " characters long";
                          }
                          break;

                      case 'email':
                          if (Valid::email()->Validate($_REQUEST[$name]) == false) {
                              $errors[] = $name . " must be a valid email address!";
                          }
                          break;

                      case 'equalTo':
                          if (Valid::equals($_REQUEST[$name])->Validate($_REQUEST[$exploded[1]]) == false) {
                              $errors[] = $name . " Values does match verification value!";
                          }
                          break;

                      case 'unique':
                          $model = "Acme\\models\\".$exploded[1];
                          $table  = new $model;

                          //where_in('email_tabale' exist 'email_input_form')
                          $result = $table::where($name, '=', $_REQUEST[$name])->get();
                          foreach($result as $item){
                              $errors[] = $_REQUEST[$name]." already exists in the system";
                              //unset($errors);
                          }
                          break;

                      default:
                          //$errors[] = "No value found!";
                    }
                }
            }
        return $errors;
    }
}
