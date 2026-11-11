<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Livre;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Livre $livre)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'livre_id' => $livre->id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès !');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Commentaire supprimé avec succès !');
    }
}