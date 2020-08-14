<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $parent_categories = Category::where('parent_id', 0)->get();

    return view('admin.products.create', compact('parent_categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $product = new Product();

    $name = $request->name;

    $product->category_id = $request->category_id;
    $product->name = $name;
    $product->code = $request->code;
    $product->color = $request->color;
    $product->description = $request->description;
    $product->price = $request->price;

    if ($request->hasFile('image')) {
      $image_temp = Input::file('image');

      if ($image_temp->isValid()) {
        $image_name = $this->createUniqueImageName($name, $image_temp);

        //  Image Path
        $large_image_path = "images/backend_images/products/large/{$image_name}";
        $medium_image_path = "images/backend_images/products/medium/{$image_name}";
        $small_image_path = "images/backend_images/products/small/{$image_name}";

        /*Resize Image*/
        Image::make($image_temp)->save($large_image_path);
        Image::make($image_temp)->resize(600, 600)->save($medium_image_path);
        Image::make($image_temp)->resize(300, 300)->save($small_image_path);

        $product->image = $image_name;
      }
    }

    $product->save();

    Toastr::success('Product added successfully', 'Product Added!');
    return redirect()->back();
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Product $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Product $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Product $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Product $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product)
  {
    //
  }

  private function createUniqueImageName($title, $image)
  {
    $currentDate = Carbon::now()->toDateString();
    $uniqId = uniqid();
    $extension = $image->getClientOriginalExtension();
    $slug = str_slug($title);
    return "{$slug}-{$currentDate}-{$uniqId}.{$extension}";
  }
}
