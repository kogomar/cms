
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    @vite('resources/js/article.js')
</head>
<body>
<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a class="text-white text-lg font-bold" href="/">Articles</a>
        <div>
            @guest
                <a class="text-gray-300 hover:text-white mr-4" href="{{ route('login') }}">Login</a>
            @else
                <form action="{{ route('logout') }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-white">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>


<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-4">
        @foreach ($articles as $article)
            <div class="border-b border-gray-200 py-2">
                <h2 class="text-xl font-semibold text-center">{{ $article->title }}</h2>
                <p class="text-gray-600 text-center">{{ $article->content }}</p>
                <b><p class="text-gray-600 text-left mt-1">{{ $article->created_at }}</p></b>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button" data-id="{{ $article->id }}" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto deleteArticle">Delete</button>
                    <button type="button" data-id="{{ $article->id }}" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto editArticle">Edit</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            {{ $articles->links('pagination::simple-tailwind') }}
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ $articles->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $articles->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $articles->total() }}</span>
                    results
                </p>
            </div>
            <div>
                {{ $articles->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>


<div id="editModal">
    @include('article.edit')
</div>
</body>
</html>
