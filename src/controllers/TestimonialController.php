<?php
namespace Acme\controllers;

use duncan3dc\Laravel\BladeInstance;
use Acme\models\Testimonial;
use Acme\Validation\Validator;
use Acme\Auth\LoggedIn;


class TestimonialController extends BaseController
{
    public  function getShowTestimonials()
    {
        $testimonials = Testimonial::all();
        echo $this->blade->render('testimonials', ['testimonials' => $testimonials]);
    }

    public  function getShowAdd()
    {
        echo $this->blade->render('add-testimonial');
    }



    public function postShowAdd()
    {
        // the rules validation data
        $validation_data = [
            'title' => 'min:3',
            'testimonial' => 'min:10',
        ];

        // validate data
        $validator = new Validator();
        $errors = $validator->isValid($validation_data);

        // if validation fails, go back to register
        // page and display error message

        if(sizeOf($errors) > 0 )
        {
            $_SESSION['msg'] = $errors;
            //header("Location: /register");
            echo $this->blade->render('add-testimonial');
            unset($_SESSION['msg']);
            exit();

        }
        // save this data into a database

        $testimonial = new Testimonial;
        $testimonial->title = $_REQUEST['title'];
        $testimonial->testimonials = $_REQUEST['testimonial'];
        $testimonial->user_id = LoggedIn::user()->id;
        $testimonial->save();

        header("Location: /testimonial-saved");
        exit();
    }

}
