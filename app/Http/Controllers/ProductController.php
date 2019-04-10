<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Image;
use App\Brand;
use App\Category;
use App\ProductDetail;
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
        // $products = Product::join('brands', 'brands.id', '=', "products.brand_id")
        // ->join('product_details', 'product_details.product_id', '=', 'products.id')
        // ->join('option_values', 'option_values.id', '=', 'product_details.size')
        // //->where('option_values.option_id', 2)
        // ->select('brands.id as brand_id', 'products.id as product_id', 'products.*', 'brands.name as brand_name', 'option_values.value as name_size', 'product_details.*')
        // ->orderby('products.id','desc')
        // ->paginate(10);
        //ok oke
        //$product_detail = ProductDetail::join('')

        $products = Product::join('brands', 'brands.id', '=', "products.brand_id")
        ->join('categories', 'categories.id', '=', "products.category_id")
        ->select('brands.id as brand_id', 'products.id as product_id', 'products.*', 'brands.name as brand_name','categories.name as category_name')
        ->orderby('products.id','desc')
        ->paginate(10);
        //dd($products);
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
        $data = Product::find($id);
        return $data;
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
        $data['product_code'] = $request->code;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['price'] = $request->price;
        $data['brand_id'] = $request->brand;
        $data['category_id'] = $request->category;
        
    
        $input =Product::find($id)->update([
            'product_code' => $data['product_code'],
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'brand_id' => $data['brand_id'],
            'category_id' => $data['category_id']
        
        ]);

        echo json_encode($data);  
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

    public function detail($id)
    {
        // $products = Product::join('brands', 'brands.id', '=', "products.brand_id")
        // ->join('product_details', 'product_details.product_id', '=', 'products.id')
        // ->join('option_values', 'option_values.id', '=', 'product_details.size')
        // //->where('option_values.option_id', 2)
        // ->select('brands.id as brand_id', 'products.id as product_id', 'products.*', 'brands.name as brand_name', 'option_values.value as name_size', 'product_details.*')
        // ->orderby('products.id','desc')
        // ->paginate(10);
        //ok oke
        //$product_detail = ProductDetail::join('')

        $products = Product::join('brands', 'brands.id', '=', "products.brand_id")
        ->join('categories', 'categories.id', '=', "products.category_id")
        ->select('products.*','brands.name as brand_name','categories.name as category_name')->find($id);

        $product_details = ProductDetail::join('colors', 'product_details.color_id', '=', "colors.id")
        ->join('sizes', 'product_details.size_id', '=', "sizes.id")
        ->select('product_details.*','sizes.value as size_name','colors.value as color_name')

       
        ->where('product_id', $id)->get();

        //dd($product_details);
        return view('admin.product.product_detail',['row'=>$products,'data'=>$product_details]);
    }















}
