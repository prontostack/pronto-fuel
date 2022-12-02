<?php

namespace App\Forms;

use App\Fields\RichText;
use App\Forms\Form;
use App\Models\Post;

class PostForm extends Form
{
    protected function createResource()
    {
        return new Post;
    }

    protected function editResource()
    {
        return $this->request->post;
    }

    protected function createMethod()
    {
        return 'post';
    }

    protected function editMethod()
    {
        return 'put';
    }

    protected function createAction()
    {
        return route('posts.index');
    }

    protected function editAction()
    {
        return route('posts.update', $this->resource);
    }

    protected function fields()
    {
        return [
            RichText::for('contents')
        ];
    }

    protected function trans()
    {
        return [
            // ...
        ];
    }

    protected function props()
    {
        return [
            // ...
        ];
    }

    protected function toast()
    {
        return trans('Post saved');
    }
}
