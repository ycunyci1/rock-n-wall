<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use App\Models\SubEssence;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(app(FavoriteService::class)->getFavorites());
    }

    /**
     * Store a newlycreated resource in storage.
     */
    public function productCreate(Product $product)
    {
        Favorite::create([
            'user_id'           => auth()->user()->id,
            'favoritable_id'    => $product->id,
            'favoritable_type'  => 'App\Models\Product',
            'created_at'        => Carbon::now()
        ]);
    }

    public function subEssenceCreate(SubEssence $subEssence)
    {
        Favorite::create([
            'user_id'           => auth()->user()->id,
            'favoritable_id'    => $subEssence->id,
            'favoritable_type'  => 'App\Models\SubEssence',
            'created_at'        => Carbon::now()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
