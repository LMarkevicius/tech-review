<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\SubCategory;
use Session;

class DashboardCategoryController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::with('SubCategory')->get();

      return view('dashboard.categories.index')->withCategories($categories);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name'  => 'required|max:255'
      ]);

      $category = new Category;

      $category->name = $request->name;

      $category->save();

      Session::flash('success', 'You successfully created category!');

      return redirect()->route('dashboard.categories.index');
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
        //
    }

    public function subCategoryStore(Request $request) {
      $this->validate($request, [
        'name'  => 'required|max:255',
        'category_id' => 'required'
      ]);

      $subcategory = new SubCategory;

      $subcategory->name = $request->name;
      $subcategory->category_id = $request->category_id;

      $subcategory->save();

      Session::flash('success', 'You successfully created sub category!');

      return redirect()->route('dashboard.categories.index');
    }

    // public function subCategoryShow($category_id, $id) {
    //   $category = SubCategory::find($id);
    //
    //   return view('subcategories.show')->withCategory($category);
    // }
}
