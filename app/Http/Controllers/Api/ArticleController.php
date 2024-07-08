<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show(Article $article): JsonResponse
    {
        if (Auth::id() !== $article->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($article);
    }

    public function create(ArticleRequest $request, ArticleService $articleService): JsonResponse
    {
        $article = $articleService->createArticle($request->validated());

        return response()->json($article, 201);
    }

    public function update(ArticleRequest $request, Article $article, ArticleService $articleService): JsonResponse
    {
        if ($article->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $articleService->updateArticle($article, $request->only(['title', 'content']));

        return response()->json($article);
    }

    public function destroy(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $article->delete();

        return response()->json(null, 204);
    }
}

