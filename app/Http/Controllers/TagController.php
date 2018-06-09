<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Session;

class TagController extends Controller
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
      $tags = Tag::all();

      return view('tags.index')->withTags($tags);
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name'  => 'required|max:255'
      ]);

      $tag = new Tag;

      $tag->name = $request->name;

      $tag->save();

      Session::flash('success', 'Tag was successfully saved!');

      return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $tag = Tag::find($id);

      return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $tag = Tag::find($id);

      return view('tags.edit')->withTag($tag);
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
      $tag = Tag::find($id);

      $this->validate($request, [
        'name'  => 'required|max:255'
      ]);

      $tag->name = $request->name;

      $tag->save();

      Session::flash('success', 'Tag was successfully saved!');

      return redirect()->route('tags.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tag = Tag::find($id);

      $tag->products()->detach();

      $tag->delete();

      Session::flash('success', 'Tag was successfully deleted!');

      return redirect()->route('tags.index');
    }
}
