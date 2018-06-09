<?php

namespace App\Http\Controllers;

use Gate;
use Auth;
use Image;
use App\Tag;
use Session;
use Storage;
use Purifier;
use App\Product;
use App\Comment;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function __construct() {
    $this->middleware('auth', ['except' => ['show', 'vue', 'getData']]);
  }

    public function index(Request $request)
    {
      // if ($request->sortBy == 'name') {
      //   $products = Product::where('user_id', '=', Auth::user()->id)->orderBy($request->sortBy, 'asc')->paginate(10);
      // } elseif ($request->sortBy == 'comments') {
      //   $products = Product::where('user_id', '=', Auth::user()->id)->orderBy('id', 'ASC')->paginate(10);
      // } else {
      //   $products = Product::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
      // }

      return view('products.index');
    }

    public function create()
    {
      $categories = Category::with('SubCategory')->get();
      $tags = Tag::all();

      return view('products.create')->withCategories($categories)->withTags($tags);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name'            => 'required|min:3|max:255',
        'slug'            => 'required|alpha_dash|min:3|max:255|unique:products,slug',
        'category_id'     => 'required|integer',
        'subcategory_id'  => 'required|integer',
        'description'     => 'nullable',
        'featured_image'  => 'sometimes|image'
      ]);

      $product = new Product;

      $product->name = $request->name;
      $product->slug = $request->slug;
      $product->category_id = $request->category_id;
      $product->subcategory_id = $request->subcategory_id;
      $product->user_id = Auth::user()->id;
      $product->description = Purifier::clean($request->description);

      if ($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/' . $filename);

        Image::make($image)->resize(800, 400)->save($location);

        $product->image = $filename;
      }

      $product->save();

      if (isset($request->tags)) {
        $product->tags()->sync($request->tags, false);
      } else {
        $product->tags()->sync(array());
      }

      // $product->tags()->sync($request->tags, false);

      Session::flash('success', 'The Product was successfully saved!');

      return redirect()->route('products.show', $product->slug);
    }

    public function show($slug)
    {
      $product = Product::where('slug', '=', $slug)->first();

      return view('products.show')->withProduct($product);
    }

    public function edit($slug)
    {
      $product = Product::where('slug', '=', $slug)->first();

      if (Gate::allows('edit-product', $product)) {
        // var_dump($product);
        $categories = Category::with('SubCategory')->get();
        // $cats = [];
        $tags = Tag::all();
        $tags2 = [];

        foreach ($tags as $tag) {
          $tags2[$tag->id] = $tag->name;
        }

        // foreach ($categories as $category) {
        //   $cats[$category->id] = $category->name;
        // }

        return view('products.edit')->withProduct($product)->withCategories($categories)->withTags($tags2);
      } else {
        Session::flash('alert', 'You cannot edit this post because its not yours');

        return redirect()->back();
      }


    }

    public function update(Request $request, $slug)
    {
      $product = Product::where('slug', '=', $slug)->first();

      // if ($request->slug == $product->slug) {
      //   $this->validate($request, [
      //     'name'        => 'required|min:3|max:255',
      //     'category_id' => 'required|integer',
      //     'subcategory_id' => 'required|integer',
      //     'description' => 'nullable'
      //   ]);
      // } else {
        $this->validate($request, [
          'name'        => 'required|min:3|max:255',
          'slug'        => "required|alpha_dash|min:3|max:255|unique:products,slug,$product->id",
          'category_id' => 'required|integer',
          'subcategory_id' => 'required|integer',
          'description' => 'nullable',
          'featured_image'  => 'image'
        ]);
      // }

      $product->name = $request->name;
      $product->slug = $request->slug;
      $product->category_id = $request->category_id;
      $product->subcategory_id = $request->subcategory_id;
      $product->description = Purifier::clean($request->description);

      if ($request->hasFile('featured_image')) {
        $image = $request->file('featured_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/' . $filename);

        Image::make($image)->resize(800, 400)->save($location);

        $oldFilename = $product->image;

        $product->image = $filename;

        Storage::delete($oldFilename);
      }

      $product->save();

      if (isset($request->tags)) {
        $product->tags()->sync($request->tags);
      } else {
        $product->tags()->sync(array());
      }

      Session::flash('success', 'This Product was successfully saved!');

      return redirect()->route('products.show', $product->slug);
    }

    public function destroy($id)
    {
      $product = Product::find($id);

      if (Gate::allows('delete-product', $product)) {
        $product->tags()->detach();

        Storage::delete($product->image);

        $product->delete();

        Session::flash('success', 'The Product was successfully deleted!');

        return redirect()->route('products.index');
      } else {
        Session::flash('alert', 'You cannot delete this product because its not yours');

        return redirect()->back();
      }
    }

    public function sortBy(Request $request) {
      if (isset($request->sortBy)) {
        $products = Product::where('user_id', '=', Auth::user()->id)->orderBy($request->sortBy, 'asc')->paginate(10);
      }

      return view('products.index')->withProducts($products);
    }

    public function vue() {
      return view('vue');
    }

    public function getData(Request $request) {
      // $model = Product::searchPaginateAndOrder();
      // $columns = Product::$columns;
      //
      // return response()
      //   ->json([
      //       'model'   => $model,
      //       'columns' => $columns
      //   ]);
      if ($request->sortBy == 'Name') {
        $products = Product::where('user_id', '=', Auth::user()->id)->orderBy('name', 'desc')->paginate(10);
      } else {
        $products = Product::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);
      }
      // $products = Product::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

      $response = [
        'pagination'  => [
          'total' => $products->total(),
          'per_page'  => $products->perPage(),
          'current_page'  => $products->currentPage(),
          'last_page' => $products->lastPage(),
          'from'  => $products->firstItem(),
          'to'    => $products->lastItem()
        ],
        'data' => $products
      ];

      return response()->json($response);
    }
}
