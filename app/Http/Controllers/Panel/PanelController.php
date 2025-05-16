<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PanelController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:panel.index')->only('index');
    }
  public function index()
    {
        return view('panel.index');
    }
}
