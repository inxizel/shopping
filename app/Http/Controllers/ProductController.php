<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Image;
use App\Brand;
use App\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::get(); // select option brand add new product
        $categories = Category::get(); // select option categories add new product
        $products = Product::orderby('id','desc')->paginate(10);
        return view('admin.product.index',['data'=>$products, 'brands'=>$brands,'categories'=>$categories ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$image = $request->image;
        //$image->move('upload', $image->getClientOriginalName());

        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['slug'] = $request->slug;
        $data['product_code'] = $request->product_code;
        $data['brand_id'] = $request->brand;
        $data['category_id'] = $request->category;
        $data['price'] = $request->price;
        $data['user_id'] = Auth::user()->id;
      
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'product_code' => $data['product_code'],
            'brand_id' => $data['brand_id'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'slug' => $data['slug'],
            'user_id' => $data['user_id']

        ]);
        echo json_encode($data);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/admin/product');
    }

    public function uploadImages(Request $request)
    {
        $images = $request->file('file');
        foreach ($images as $key => $value) {
            $path = $value->storeAs('images', $value->getClientOriginalName() );
            Image::create([
                'product_id' => 1,
                'image'      => $path
            ]);
        }
    }















}
