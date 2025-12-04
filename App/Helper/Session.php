<?php

namespace App\Helper;

class Session {
    private static $instances=[];
    private $signedIn=false;
    public $costumerId;
    public $workerId;
    public $message;

    protected function __construct() {
        session_start();
        $this->checkLogin();
        $this->checkMessage();
    }
    protected function __clone() {

    }

    public static function getInstance(): Session
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }


    public function isSignedIn() {
        return $this->signedIn;
    }

    // public function checkLogin() {
    //     if(isset($_SESSION['workerId'])){
    //         $this->workerId=$_SESSION['workerId'];
    //         $this->signedIn=true;
    //     }else if(isset($_SESSION['consumerId'])) {
    //         $this->consumerId=$_SESSION['consumerId'];
    //         $this->signedIn=true;
    //     }else{
    //         unset($this->workerId);
    //         unset($this->costumerId);
    //         $this->signedIn=false;
    //     }
    // }

    // public function login ($person) {
    //     if($person==$worker) {
    //         $this->workerId=$worker->id;
    //         $_SESSION['workerId']=$worker->id;
    //         $this->signedIn=true;
    //     }
    //     if($person==$costumer){
    //       $this->costumerId=$costumer->id;
    //       $_SESSION['costumerId']=$costumer->id;
    //       $this->signedIn=true;
    //     }
    // }

    // public function logout() {
    //     if(isset($_SESSION['workerId'])){
    //         unset($_SESSION['workerId']);
    //         unset($this->workerId);
    //         $this->signedIn=false;

    //     }else{
    //         unset($_SESSION['consumerId']);
    //         unset($this->consumer);
    //         $this->signedIn=false;

    //     }
        
        
    // }

    public function checkLogin() {
        if(isset($_SESSION['workerId'])){
            $this->workerId = $_SESSION['workerId'];
            $this->signedIn = true;
        } else if(isset($_SESSION['costumerId'])) {
            $this->costumerId = $_SESSION['costumerId'];
            $this->signedIn = true;
        } else {
            unset($this->workerId);
            unset($this->costumerId);
            $this->signedIn = false;
        }
    }

    // public function login($person) {
    //     if ($person == $worker) {
    //         $this->workerId = $worker->id;
    //         $_SESSION['workerId'] = $worker->id;
    //         $this->signedIn = true;
    //     }
    //     if ($person == $costumer) {
    //         $this->costumerId = $costumer->id;
    //         $_SESSION['costumerId'] = $costumer->id;
    //         $this->signedIn = true;
    //     }
    // }
    public function login($worker, $costumer) {
        if ($worker && $costumer) {
            // Both worker and costumer are attempting to log in, handle the error or choose a priority
            $this->signedIn = false;
            return;
        }
    
        if ($worker) {
            $this->workerId = $worker->id;
            $_SESSION['workerId'] = $worker->id;
            $this->costumerId = null; // Ensure costumerId is null when a worker logs in
            $_SESSION['costumerId'] = null;
            $this->signedIn = true;
        }
    
        if ($costumer) {
            $this->costumerId = $costumer->id;
            $_SESSION['costumerId'] = $costumer->id;
            $this->workerId = null; // Ensure workerId is null when a costumer logs in
            $_SESSION['workerId'] = null;
            $this->signedIn = true;
        }
    }
   
    
    // public function logout() {
    //     if(isset($_SESSION['workerId'])){
    //         unset($_SESSION['workerId']);
    //         unset($this->workerId);
    //         $this->signedIn = false;
    //     } else {
    //         unset($_SESSION['costumerId']);
    //         unset($this->costumerId);
    //         $this->signedIn = false;
    //     }
    // }
    public function logout() {
        unset($_SESSION['workerId']);
        unset($this->workerId);
        unset($_SESSION['costumerId']);
        unset($this->costumerId);
        $this->signedIn = false;
    }
    public function message() {
        if (!empty($msg)) {
            $this->message = $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    public function checkMessage()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
}
