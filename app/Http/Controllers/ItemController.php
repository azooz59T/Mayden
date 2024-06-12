<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $items = Item::all(); // Retrieve all items from the database
      $totalPrice = $items->sum('price'); // Calculate the total price
      return view('item.home', compact('items', 'totalPrice')); // Pass the items to the view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {

         // Get the price limit from the session or any other source
         $priceLimit = $request->session()->get('price_limit');

         // Retrieve all the existing items from the database
         $existingItems = Item::all();

         // Calculate the total price of the existing items
         $totalPrice = $existingItems->sum('price');

         // Add the price of the new item to the total price
         $totalPrice += $request->input('price');

         // Check if the total price exceeds the price limit
         if ($priceLimit !== null && $totalPrice > $priceLimit) {
          // Return a JSON response with a message to display in the modal or pop-up
          return response()->json(['message' => 'You have reached the price limit.']);
         }
         // Validate the form data
         $validatedData = $request->validate([
             'name' => 'required',
             'description' => 'required',
             'quantity' => 'required|numeric',
             'price' => 'required|numeric',
         ]);

         // Create a new item
         $item = new Item;
         $item->name = $request->input('name');
         $item->description = $request->input('description');
         $item->quantity = $request->input('quantity');
         $item->price = $request->input('price');
         $item->ticked = $request->input('ticked') == 'on';

         $item->save();

         return redirect('item');
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $item = Item::findOrFail($id);
      $item->delete();

      return redirect('item');
    }

    /**
     * Tick the specified Item from the shopping list
     */
     public function tick($id)
     {
        $item = $item = Item::findOrFail($id);
        $item->ticked = true;
        $item->save();

        return redirect('item');
     }

     /**
      * Set a limit to the total price of shopping list
      */
     public function setPrice(Request $request)
     {
       $request->validate([
          'price_limit' => 'required|numeric|min:0',
       ]);

       $priceLimit = $request->input('price_limit');
       $request->session()->put('price_limit', $priceLimit);// Saves the price limit in a session that can be later retrieved to check before adding an item

       return redirect()->back()->with('success', 'Price limit set successfully.');
     }
}
