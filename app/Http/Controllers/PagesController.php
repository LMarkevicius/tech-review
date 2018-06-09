<?php

namespace App\Http\Controllers;

use Mail;
use Session;
use App\User;
use App\Product;
use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class PagesController extends Controller {
  public function getIndex() {
    $users = User::all();
    $products = Product::orderBy('id', 'desc')->take(10)->get();
    $categories = Category::with('SubCategory')->get();

    return view('pages.index')->withProducts($products)->withUsers($users)->withCategories($categories);
  }

  public function getAbout() {
    return view('pages.about');
  }

  public function getContact() {
    return view('pages.contact');
  }

  public function postContact(Request $request) {
    $this->validate($request, [
      'email'   => 'required|email',
      'subject' => 'min:3',
      'message' => 'min:10'
    ]);

    $data = [
      'email'       => $request->email,
      'subject'     => $request->subject,
      'bodyMessage' => $request->message
    ];

    Mail::send('emails.contact', $data, function($message) use ($data) {
      $message->from($data['email']);
      $message->to('vysniukass@gmail.com');
      $message->subject($data['subject']);
    });

    Session::flash('success', 'Your Email was Sent');

    return redirect('/');
  }
}
