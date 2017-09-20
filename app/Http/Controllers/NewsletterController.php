<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;

use App\Newsletter;
use App\User;

class NewsletterController extends Controller
{
  public function index()
  {
    $newsletters = Newsletter::orderBy('id','desc')->get();

    return Response::json(['newsletters' =>$newsletters]);
  }

  public function store(Request $request)
  {
    $rules = [
      'title' => 'required',
      'companyName' => 'required',
      'url' => 'required',
      'description' => 'required',
      'logo' => 'required',
    ];

    $validator = Validator::make(Purifier::clean($request->all()), $rules);

    if($validator->fails())
    {
      return Response::json(['error' => 'Please fill out all fields.']);
    }

    $title = $request->input('title');
    $companyName = $request->input('companyName');
    $url = $request->input('url');
    $description = $request->input('description');

    $logoInput = $request->file('logo');
    $logoName = $logoInput->getClientOriginalName();
    $logoInput->move("storage/", $logoName);

    $newsletter = new Newsletter;
    $newsletter->title = $title;
    $newsletter->companyName = $companyName;
    $newsletter->url = $url;
    $newsletter->description = $description;
    $newsletter->logo = $request->root(). "/storage/".$logoName;

    $newsletter->save();

    return Response::json(['success' => 'Newsletter saved.']);

    //Response-used to send data back to the frontend
  }

  public function show($id)
  {
    $newsletters = Newsletters::find($id);

    return Response::json(['newsletters' => $newsletters]);
  }
}
