<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Http\Resources\StoreResource;

class StoreController extends Controller
{
    public function index()
    {
        return StoreResource::collection(
            Store::with('tier')->orderBy('store_name')->get()
        );
    }
}
