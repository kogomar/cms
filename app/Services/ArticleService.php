<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public function createArticle(array $data): Article
    {
        $article = new Article();
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->user_id = Auth::id();
        $article->save();

        return $article;
    }

    public function updateArticle(Article $article, array $data): Article
    {
        if (isset($data['title'])) {
            $article->title = $data['title'];
        }

        if (isset($data['content'])) {
            $article->content = $data['content'];
        }

        $article->save();

        return $article;
    }
}
