<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Worker;
use App\Models\Costumer;
// use App\Controllers\CostumerController;
use \Core\View;
use \Core\Controller;


class AuthController extends Controller
{
    public function loginForm() 
    {
        $session=Session::getInstance();
        $message='';
        if(!empty($session->message)){
            $message=$session->message;
        }

        if(isset($_SESSION['workerId'])){
            header('Location:orders');
           
        }else if(isset($_SESSION['costumerId'])){
            header('Location: ""');
        }
        View::renderTemplate('Landing/login.html',['message'=>$message]);
    }

    // public function loginStore() {
    //     $email=$_POST['email'];
    //     $password=$_POST['password'];
    //     $worker=Worker::where('email',$email)->where('password',$password)->latest()->first();
    //     $consumer=Costumer::where('email',$email)->where('password',$password)->latest()->first();
    //     $session=Session::getInstance();
    //     if($worker){
    //         $session->login($worker);
    //         header('Location:orders');
    //         exit();
    //     }else if($consumer){
    //         $session->login($consumer);
    //         header('Location: ""');
    //         exit();
    //     }else {
    //         $session->message("Your email or password is incorrent");
    //         header('Location: login-form');
    //     }
    //     header('Location: login-form');
    // }

    public function loginStore() {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Kërko në bazë të email-it dhe password-it për punonjë
        $worker = Worker::where('email', $email)->where('password', $password)->latest()->first();
    
        // Kërko në bazë të email-it dhe password-it për konsumator
        $consumer = Costumer::where('email', $email)->where('password', $password)->latest()->first();
    
        $session = Session::getInstance();
    
        if ($worker) {
            // Nëse gjetet një punonjë, autentikimi si punonjës
            $session->login($worker, null);
            header('Location: orders');
            exit();
        } elseif ($consumer) {
            // Nëse gjetet një konsumator, autentikimi si konsumator
            $session->login(null, $consumer);
            header('Location: index'); // Update this with the appropriate URL
            exit();
        } else {
            // Nëse nuk gjetet as punonjë as konsumator
            $session->message("Your email or password is incorrect");
            header('Location: login-form');
            exit();
        }
    }
    public function logout()
     {
        $session=Session::getInstance();
        $session->logout();
        header('Location:login-form');

    }
}