<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
// Don't forget the Intertia Package ;)
use Inertia\Inertia;
 
class FooController extends Controller
{
 
    public function index(Request $request)
    {
        return Inertia::render('MyComponent/Hello', [
           'bar' => "Hello World",
        ]);
    }
}