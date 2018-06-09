<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Comment;
use App\Product;

class CommentsController extends Controller
{

  public function __construct() {
    $this->middleware('auth', ['except' => 'store']);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
      $this->validate($request, [
        'name'  => 'required|max:255',
        'email' => 'required|email|max:255',
        'comment' => 'required|min:5|max:255'
      ]);

      $product = Product::find($product_id);

      $comment = new Comment();

      $comment->name = $request->name;
      $comment->email = $request->email;
      $comment->comment = $request->comment;
      $comment->approved = true;
      $comment->product()->associate($product);

      $comment->save();

      Session::flash('success', 'Comment was added');

      return redirect()->route('products.show', $product->slug);
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
      $comment = Comment::find($id);

      return view('comments.edit')->withComment($comment);
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
      $comment = Comment::find($id);

      $this->validate($request, [
        'comment' => 'required'
      ]);

      $comment->comment = $request->comment;

      $comment->save();

      Session::flash('success', 'Comment Updated');

      return redirect()->route('dashboard.products.show', $comment->product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
      $comment = Comment::find($id);

      return view('comments.delete')->withComment($comment);
    }

    public function destroy($id)
    {
      $comment = Comment::find($id);

      $product_id = $comment->product->id;

      $comment->delete();

      Session::flash('success', 'Comment was deleted');

      return redirect()->route('dashboard.products.show', $product_id);
    }
}
