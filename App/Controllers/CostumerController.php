<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Costumer;
use \Core\View;
use \Core\Controller;

class CostumerController extends Controller {

    public function __construct() {
        $session = Session::getInstance();
        if (!$session->isSignedIn()){
            header('Location: ');
        }
    }

    public function index() {
        $costumer=Costumer::orderBy('id','desc')->get();
        View::renderTemplate('Costumers/index.html',['costumer'=>$costumer]);
    }

    public function create() {
        View::renderTemplate('Costumers/create.html');
    }

    public function store() {
        $costumer=new Costumer();
        $costumer->first_name = $_POST['first_name'];
        $costumer->last_name = $_POST['last_name'];
        $costumer->country = $_POST['country'];
        $costumer->city = $_POST['city'];
        $costumer->address = $_POST['address'];
        $costumer->phone = $_POST['phone'];
        $costumer->email = $_POST['email'];
        $costumer->password = $_POST['password'];
        $costumer->status = $_POST['status'];
        $costumer->save();
        
        if(isset($_SESSION['workerId'])){
        header('Location: costumers');
        }else if(!(isset($_SESSION['costumerId']))){
            header('Location: index');
        }
     }

    public function edit() {
        $id=$_POST['id'];
        $costumer=Costumer::findOrFail($id);
        View::renderTemplate('Costumers/edit.html',['costumer'=>$costumer]);
    }

    public function update() {
        $id=$_POST['id'];
        $costumer=Costumer::findOrFail($id);
        $costumer->first_name = $_POST['first_name'];
        $costumer->last_name = $_POST['last_name'];
        $costumer->country = $_POST['country'];
        $costumer->city = $_POST['city'];
        $costumer->address = $_POST['address'];
        $costumer->phone = $_POST['phone'];
        $costumer->email = $_POST['email'];
        $costumer->password = $_POST['password'];
        // $costumer->status = $_POST['status'];
        $costumer->update();
        header('Location: costumers');
    }

    public function destroy() {
        $id=$_POST['id'];
        $costumer=Costumer::findOrFail($id);
        $costumer->delete();
        header('Location: costumers');
    }
}