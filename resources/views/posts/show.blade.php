<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post | PostIt</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">
    <nav class="bg-white border-b border-slate-200 py-4 shadow-sm mb-8">
        <div class="container mx-auto px-4">
            <a href="/posts" class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">PostIt</a>
        </div>
    </nav>

    <div class="container mx-auto px-4 max-w-3xl pb-12">
        <a href="/posts" class="text-slate-500 hover:text-indigo-600 mb-6 inline-flex items-center text-sm font-semibold transition group">
            <span class="mr-2 transform group-hover:-translate-x-1 transition">←</span> Back to all posts
        </a>

        @if(isset($post))
            <article class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mt-4 p-8 md:p-12">
                @if($post->image)
                    <img src="{{ asset($post->image) }}" alt="Post Image" class="w-full max-h-96 object-cover rounded-xl mb-8">
                @endif
                <h1 class="text-4xl font-extrabold text-slate-900 mb-6 leading-tight">{{ $post['title'] }}</h1>
                <p class="text-lg text-slate-600 leading-relaxed whitespace-pre-line mb-10">{{ $post['content'] }}</p>
                
                <div class="pt-8 border-t border-slate-100 flex space-x-4">
                    <a href="/posts/{{ $post->id}}/edit" class="bg-blue-50 text-blue-600 px-5 py-2.5 rounded-lg font-bold hover:bg-blue-100 transition">Edit Post</a>
                    <form action="/posts/{{ $post->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete?')" class="bg-red-50 text-red-600 px-5 py-2.5 rounded-lg font-bold hover:bg-red-100 transition">Delete Post</button>
                    </form>
                </div>
            </article>
        @else
            <div class="text-center py-20 text-slate-800 font-bold">Post not found.</div>
        @endif
    </div>
</body>
</html>