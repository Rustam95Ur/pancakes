<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Http\Requests\StoreCommentRequest;
use TCG\Voyager\Models\Page;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $comments = Comment::all();
        $about = Page::where('slug', '=', 'about')->first();
        $products = Product::where('status', '=', Product::STATUS_ACTIVE)->orderBy('id', 'DESC')->limit(12)->get();
        return view('home.index', [
            'products' => $products,
            'comments' => $comments,
            'about' => $about
        ]);
    }


    public function saveComment(StoreCommentRequest $request)
    {
        $comment = new Comment();
        $comment->name = $request['name'];
        $comment->message = $request['message'];
        $comment->type = $request['type'];
        $comment->save();
        return redirect()->back()->with('success', 'Review successfully added');
    }


}
