<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::paginate(25);

        //dd($comments);

        return view('comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comments = Comment::all();
        //dd($comments);
        return view('comment.create', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request): RedirectResponse
    {
        //dd($request);
        $comment = new Comment();
        $comment->parent_id = $request->parent ? $request->parent : 0;
        $comment->user_id = $request->user_id;
        $comment->content = $request->content;

        if ($comment->save()) {
            return redirect()->route('comment.index');
        }

        return redirect()->route('comment.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //dd($comment);
        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCommentRequest $request, Comment $comment)
    {
        if (! Gate::allows('update-comment', $comment)) {
            abort(403);
        }

        $comment->update($request->validated());

        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (! Gate::allows('delete-comment', $comment)) {
            abort(403);
        }

        $comment->delete();

        return redirect()->route('comment.index');
    }
}
