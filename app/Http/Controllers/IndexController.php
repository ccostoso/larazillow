<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
