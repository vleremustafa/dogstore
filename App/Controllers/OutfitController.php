<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Outfit;
use App\Models\Category;
use \Core\View;
use \Core\Controller;

class OutfitController extends Controller {
    
    public function __construct() {
        $session = Session::getInstance();
        if (!$session->isSignedIn()){
            header('Location: ');
        }
    }

    public function index() {
        $outfit=Outfit::orderBy('id','asc')->with('category')->get();
        View::renderTemplate('Outfits/index.html',['outfit'=>$outfit]);
       
    }

    public function create() {
        $categories=Category::orderBy('id')->get();
        View::renderTemplate('Outfits/create.html',['categories'=>$categories]);

    }

    public function store() {
        $file_tmp = $_FILES['photo']['tmp_name'];
        $file_name = time() . '-' . $_FILES['photo']['name'];
        move_uploaded_file($file_tmp, "../public/uploads/" . $file_name);

        $outfit=new Outfit();
        $outfit->category_id=$_POST['category_id'];
        $outfit->photo = $file_name;
        $outfit->title=$_POST['title'];
        $outfit->cost=$_POST['cost'];
        $outfit->save();
        header('Location: outfits');

        
    }

    public function edit() {
        $id=$_POST['id'];
       $categories=Category::orderBy('name')->get();
        $outfit=Outfit::with('category')->findOrFail($id);
        View::renderTemplate('Outfits/edit.html',['outfit'=>$outfit,'categories'=>$categories]);
    }

    public  function update() {
        $id=$_POST['id'];
        $outfit=Outfit::findOrFail($id);

        $outfit->title=$_POST['title'];
        $outfit->category_id=$_POST['category_id'];
        $outfit->cost=$_POST['cost'];

        if(isset($_FILES['photo']) && $_FILES['photo']['error']=== UPLOAD_ERR_OK){
            $file_tmp=$_FILES['photo']['tmp_name'];
            $file_name = time() . '-' . $_FILES['photo']['name'];
            move_uploaded_file($file_tmp, "../public/uploads/" . $file_name);
            $outfit->photo = $file_name;
        }

        $outfit->save();
        $outfit->category()->associate($_POST['category_id']);

        header('Location: outfits');
    }

    public function destroy() {
        $id=$_POST['id'];
        $outfit=Outfit::findOrFail($id);
        $outfit->forceDelete();
        header('Location: outfits');
    }

    public function getAllOutfits() {
        // Assuming you have a method in your Outfit model to fetch all outfits
        return Outfit::all(['id', 'title', 'category_id', 'cost', 'photo']);
        
    }

    // public function editOutfit() {
    //     $id=$_POST['id'];
    //     $categories=Category::orderBy('name')->get();
    //      $outfit=Outfit::with('category')->findOrFail($id);
    //      View::renderTemplate('Landing/cart.html',['outfit'=>$outfit,'categories'=>$categories]);
         
    //      if($outfit){
    //         if (empty($_SESSION['shopping_cart'])) {
    //             $_SESSION['shopping_cart']=[];
    //             header('Location: index');
    //             exit();
    //         }
        

    //     if(in_array($outfit,$_SESSION['shopping_cart'])){
    //         echo "This outfit is already selected";
    //         header('Location: index');
    //         exit();
    //     }else{
    //         $_SESSION['shopping_cart'][]=$outfit;
    //         echo "Book added successfully";
    //         header('Location: index');
    //         exit();
    //     }
    // }else{
    //     echo "Book not found";

    // }
// }
public function getId() {
    // Check if 'id' is set in the POST data and is not empty
    // if(isset($_POST['id']) && !empty($_POST['id'])) {
    //     $id = $_POST['id'];

    //     // Assuming you have a method in your Outfit model to fetch an outfit by ID
    //     $outfit = Outfit::findOrFail($id);

    //     if ($outfit) {
    //         // Set 'id' in the session or use other methods to store the value
    //         $_SESSION['cart_id'] = $id;

    //         // Redirect to the 'cart.html' page
    //         header('Location: Landing/cart.html');
    //         exit; // Make sure to exit to prevent further execution
    //     } else {
    //         // Handle the case where outfit with the provided ID is not found
    //         echo "Outfit not found";
    //     }
    // } else {
    //     // Handle the case where 'id' is not set or is empty in the POST data
    //     echo "ID not provided or empty";
    // }
   $id=$_POST['id'];
   echo $id;
// $outfitId = $_POST['outfit_id'];
// echo $outfitId;


// $outfit=Outfit::orderBy('id','asc')->with('category')->get();
//         View::renderTemplate('Landing/cart.html',['outfit'=>$outfit]);
        // $outfit=Outfit::findOrFail($id);
}

    

    // public function getId() {
    //     // Kontrollo nëse 'id' është përcaktuar në $_GET
    //     // if(isset($_GET['id'])) {
    //     //     $id = $_GET['id'];
    //     //     $outfit = Outfit::find($id);
    //     //     return $outfit;
    //     // } else {
    //     //     // Kthimi i një vlerë të caktuar kur 'id' nuk është gjetur
    //     //     echo "Nuk kemi Id";
    //     // }
    //     if(isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $outfit = Outfit::findOrFail($id);
    //         return $outfit;
    //     } else {
    //         // Kthimi i një vlerë të caktuar kur 'id' nuk është gjetur
    //         echo "Nuk kemi Id";
    //     }
    // }
    // public function getId() {
    //     // Kontrollo nëse 'id' është përcaktuar në $_GET
    //     if(isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         // Shto 'id' në sesion ose përdor metoda tjera për të ruajtur vlerën
    //         $_SESSION['cart_id'] = $id;
    //         // Redirecto në faqen Landing/cart.html
    //         header('Location: Landing/cart.html');
    //     } else {
    //         // Kthimi i një vlerë të caktuar kur 'id' nuk është gjetur
    //         echo "Nuk kemi Id";
    //     }
    // }
}