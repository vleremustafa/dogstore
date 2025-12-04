<?php

namespace App\Controllers;

use App\Helper\Session;
use App\Models\Category;
use \Core\View;
use \Core\Controller;

class CategoryController extends Controller
{

    public function __construct()
    {
        $session = Session::getInstance();
        if (!$session->isSignedIn()){
            header('Location: ');
        }
        
    }

    public function index()
    {
        $cataories = Category::orderBy('id','desc')->get();
        View::renderTemplate('Categories/index.html',['categories' => $cataories]);
    }

    public function create()
    {
        View::renderTemplate('Categories/create.html');
    }

    public function store()
    {
        $category = new Category();
        $category->name = $_POST['name'];
        $category->save();
        header("Location: categories");
    }

    public function show()
    {

    }

    public function edit()
    {
        $category = Category::findOrFail($_POST['id']);
        View::renderTemplate('Categories/edit.html',['category'=>$category]);
    }

    public function update()
    {
        $category = Category::findOrFail($_POST['id']);
        $category->name = $_POST['name'];
        $category->update();
        header("Location: categories");
    }

    public function destroy()
    {
        $category = Category::findOrFail($_POST['id']);
        $category->delete();
        header("Location: categories");
    }
}