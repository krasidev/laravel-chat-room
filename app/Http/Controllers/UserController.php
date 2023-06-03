<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Users/Index', [
            'lang.content.users' => __('content.users'),
            'lang.datatables' => __('datatables'),
            'users' => User::all()
        ]);
    }
}
