<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    public function index()
    {
        $connections = Connection::all();
        return view('admin.connection.index', compact('connections'));
    }
}
