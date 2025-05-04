<?php

namespace App\Http\Controllers;

use Hamcrest\Core\IsNot;
use Illuminate\Http\Request;
use App\Models\DocumentRepository;
use Illuminate\Support\Facades\Auth;

class QueryController extends Controller
{
    public function index() {
        return view('go.login'); 
    }

}
