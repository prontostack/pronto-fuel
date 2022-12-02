<?php

namespace App\Http\Controllers;

use App\Forms\PostForm;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        $title = 'Create post';

        $postForm = PostForm::create();

        return inertia()->render('Dashboard/PostForm', compact(
            'title',
            'postForm'
        ));
    }

    public function store(Request $request)
    {
        $postForm = PostForm::create();

        return $postForm->save();
    }

    public function edit(Request $request, Post $post)
    {
        $title = 'Edit post';

        $postForm = (PostForm::edit())->hideSubmit();

        return inertia()->render('Dashboard/PostForm', compact(
            'title',
            'postForm'
        ));
    }

    public function update(Request $request, Post $post)
    {
        $postForm = PostForm::edit();

        return $postForm->save();
    }
}
