<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Costumer;
use App\Models\Worker;
use App\Models\Outfit;
use App\Models\Order;
use \Core\View;
use \Core\Controller;

class OrderController extends Controller {

    public function __construct() {
        $session = Session::getInstance();
        if (!$session->isSignedIn()){
            header('Location: ');
        }
    }

    public function index() {
        $order=Order::orderBy('id','asc')->with('costumer')->with('worker')->with('outfit')->get();
        View::renderTemplate('Orders/index.html',['order'=>$order]);

    }

    public function create() {
        $costumers=Costumer::orderBy('id')->get();
        $outfits=Outfit::orderBy('id')->get();
        $workers=Worker::orderBy('id')->get();
        View::renderTemplate('Orders/create.html',['costumers'=>$costumers,'outfits'=>$outfits,'workers'=>$workers]);
    }

    public function store() {
        $order=new Order();
        $order->costumer_id=$_POST['costumer_id'];
        $order->worker_id=$_POST['worker_id'];
        $order->outfit_id=$_POST['outfit_id'];
        $order->comment=$_POST['comment'];
        $order->save();
        header('Location: orders');

    }

    public function edit() {
        $id = $_POST['id']; // Assuming the ID is in the URL as a query parameter
        $costumers = Costumer::orderBy('first_name')->get();
        $outfits = Outfit::orderBy('title')->get();
        $worker = Worker::orderBy('first_name')->get();
        $order = Order::findOrFail($id);
    
        // Pass the retrieved data to the view
        View::renderTemplate('Orders/edit.html', [
            'order' => $order,
            'costumers' => $costumers,
            'outfits' => $outfits,
            'workers' => $worker
        ]);
    }

    public function update() {
        $id=$_POST['id'];
        $order=Order::findOrFail($id);
        $order->costumer_id=$_POST['costumer_id'];
        $order->worker_id=$_POST['worker_id'];
        $order->outfit_id=$_POST['outfit_id'];
        $order->comment=$_POST['comment'];
        $order->update();
        header('Location:orders');
    }

    public function destroy() {
        $id=$_POST['id'];
        $order=Order::findOrFail($id);
        $order->delete();
        header('Location:orders');
    }
}