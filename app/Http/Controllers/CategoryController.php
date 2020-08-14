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
    $categories = Category::all();
    return view('admin.categories.index', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $parent_categories = Category::where('parent_id', 0)->get();
    return view('admin.categories.create', compact('parent_categories'));
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
    $category->parent_id = $request->parent_id;
//    $category->url = str_slug($request->url);

    $category->save();

    Toastr::success('Category added successfully', 'Category Added!');
    return redirect(route('admin.category.index'));
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
    $parent_categories = Category::where('parent_id', 0)->get();
    return view('admin.categories.edit', compact('category', 'parent_categories'));
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
    $category->name = $request->name;
    $category->description = $request->description;
    $category->parent_id = $request->parent_id;

    $category->save();

    Toastr::success('Category Updated Successfully', "Category Updated");
    return redirect(route('admin.category.index'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Category $category
   * @return \Illuminate\Http\Response
   */
  public function destroy(Category $category)
  {
    $category->delete();
    Toastr::success('Category Deleted Successfully', "Category Deleted");
    return redirect()->back();
  }
}
