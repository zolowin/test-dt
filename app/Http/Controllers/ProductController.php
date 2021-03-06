<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        return $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(7);
        return view('admin.dashboard', compact('categories','products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.create_product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd(22);
//        dd($request->all());

        $product = Product::create($request->all());
        $product->product_slug = strtolower(str_replace(' ', '-',$product->product_name));
        if ($request->hasFile('product_image')) {
            $image = base64_encode(file_get_contents($request->file('product_image')));
            $product->product_image = $image;
        }
        $product->save();
        $success = "Product has been added";

        return redirect('admin/dashboard/')->with('success', $success);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::findOrFail($product->product_category_id);
        $categories = Category::all();
        return view('admin.edit_product', compact('product' , 'categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        if ($request->hasFile('product_image')) {
            $image = base64_encode(file_get_contents($request->file('product_image')));
            $product->product_image = $image;
        }

        $product->save();
        $success = "Product has been updated";

        return redirect()->route('admin.dashboard')->with('success', $success);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete($product->product_id);
        $success = "$product->product_name has been deleted";

        return redirect()->route('admin.dashboard')->with('success', $success);
    }
}
