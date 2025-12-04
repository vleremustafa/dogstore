<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Worker;
use \Core\View;
use \Core\Controller;

class WorkerController extends Controller {

    public function __construct() {
        $session = Session::getInstance();
        if (!$session->isSignedIn()){
            header('Location: ');
        }
    }

    public function index() {
        $worker=Worker::orderby('id','desc')->get();
        View::renderTemplate('Workers/index.html',['worker'=>$worker]);
        
    }

    public function create() {
        View::renderTemplate('Workers/create.html');
    }

    public function store() {
        $worker=new Worker();
        $worker->first_name=$_POST['first_name'];
        $worker->last_name=$_POST['last_name'];
        $worker->phone=$_POST['phone'];
        $worker->email=$_POST['email'];
        $worker->password=$_POST['password'];
        $worker->status=$_POST['status'];
        $worker->save();

        header('Location: workers');

    }

    public function edit() {
        
        $id = $_POST['id'];
        var_dump($id); // Check the value of $id
        $worker = Worker::findOrFail($id);
        View::renderTemplate('Workers/edit.html', ['worker' => $worker]);
    }
   

    public function update() {
       $id=$_POST['id'];
        $worker=Worker::findOrFail($id);
        $worker->first_name=$_POST['first_name'];
        $worker->last_name=$_POST['last_name'];
        $worker->phone=$_POST['phone'];
        $worker->status=$_POST['status'];
        $worker->email=$_POST['email'];
        $worker->password=$_POST['password'];
        $worker->save();
        header('Location:workers');
    }

    public function destroy() {
        $id=$_POST['id'];
        $worker=Worker::findOrFail($id);
        $worker->delete();
        header('Location:workers');
    }
}