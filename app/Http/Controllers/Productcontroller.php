<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // 👇 আপলোড ফর্ম দেখাবে
    public function create()
    {
        return view('dashboard.upload');
    }

    // 👇 ফর্ম সাবমিট করলে ছবি + নাম সেভ হবে
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'image' => $imagePath
        ]);

        return redirect('/dashboard')->with('success', 'Product added!');
    }

    // 👇 হোমপেজে ছবি সহ প্রোডাক্ট দেখাবে
    public function index()
    {
        $products = Product::all();
        dd($products); // ডিবাগিংয়ের জন্য, পরে সরিয়ে ফেলুন
        return view('welcome', compact('products'));
    }
}
