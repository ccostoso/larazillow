<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::user());

        return inertia(
            'Index/Index',
            [
                'message' => 'Hello from Laravel!',
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(/*string $id*/)
    {
        return inertia('Index/Show');
    }
}
