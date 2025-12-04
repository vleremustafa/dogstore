<?php

namespace App\Controllers;

use \Core\View;
use \Core\Controller;
use App\Models\Outfit;
use App\Controllers\OutfitController;

/**
 * Home controller
 */
class HomeController extends Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function index() {
        // Create an instance of OutfitController
        $outfitController = new OutfitController();

        // Call the method to get all outfits
        $outfits = $outfitController->getAllOutfits();

        // Pass the outfit data to the index template
        View::renderTemplate('Landing/index.html', ['outfit' => $outfits]);
    }


    public function form() {
        View::renderTemplate('Landing/login.html');
    }
    
    public function creatacc() {
        View::renderTemplate('Landing/createAcc.html');
    }
}
