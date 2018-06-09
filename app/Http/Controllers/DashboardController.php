<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Role;
use App\Category;
use Session;
use App\SubCategory;

class DashboardController extends Controller
{
  public function dashboardIndex() {
    $products = Product::all()->count();
    $users = User::all();
    $categories = Category::all()->count();
    $subcategories = SubCategory::all()->count();

    return view('dashboard.index')->withProducts($products)->withUsers($users)->withCategories($categories)->withSubcategories($subcategories);
  }

  public function dashboardProductIndex() {
    $products = Product::all();

    return view('dashboard.products.index')->withProducts($products);
  }

  public function dashboardProductCreate() {
    return view('dashboard.products.create');
  }

  public function dashboardProductStore(Request $request) {
    $this->validate($request, [
      'name'        => 'required|min:3|max:255',
      'slug'        => 'required|alpha_dash|min:3|max:255|unique:products,slug',
      'description' => 'nullable'
    ]);

    $product = new Product;

    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->description = $request->description;

    $product->save();

    Session::flash('success', 'The Product was successfully saved!');

    return redirect()->route('dashboard.products.show', $product->id);
  }

  public function dashboardProductShow($id) {
    $product = Product::find($id);

    return view('dashboard.products.show')->withProduct($product);
  }

  public function dashboardProductEdit($id)
  {
    $product = Product::find($id);

    return view('dashboard.products.edit')->withProduct($product);
  }

  public function dashboardProductUpdate(Request $request, $id)
  {
    $this->validate($request, [
      'name'        => 'required|min:3|max:255',
      'slug'        => 'required|alpha_dash|min:3|max:255|unique:products,slug',
      'description' => 'nullable'
    ]);

    $product = Product::find($id);

    $product->name = $request->name;
    $product->slug = $request->slug;
    $product->description = $request->description;

    $product->save();

    Session::flash('success', 'This Product was successfully saved!');

    return redirect()->route('dashboard.products.show', $product->id);
  }

  public function dashboardProductDestroy($id)
  {
    $product = Product::find($id);

    $product->delete();

    Session::flash('success', 'The Product was successfully deleted!');

    return redirect()->route('dashboard.products.index');
  }
}
