<?php

namespace App\Http\Controllers;

use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

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
    return view('admin.categories.add_category');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $category = new Category();
    $category->name = $request->name;
    $category->description = $request->description;
    $category->url = $request->url;

    $category->save();

    Toastr::success('Category added successfully', 'Category Added!');
    return redirect(route('admin.category.create'));
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Category $category
   * @return \Illuminate\Http\Response
   */
  public function show(Category $category)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Category $category
   * @return \Illuminate\Http\Response
   */
  public function edit(Category $category)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\Category $category
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Category $category)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Category $category
   * @return \Illuminate\Http\Response
   */
  public function destroy(Category $category)
  {
    //
  }
}
