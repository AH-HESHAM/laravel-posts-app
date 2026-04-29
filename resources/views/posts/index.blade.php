<x-app-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Posts</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen">
    <nav class="bg-white border-b border-slate-200 py-4 shadow-sm mb-8">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <a href="/posts" class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">PostIt</a>
            <a href="/posts/create" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 font-medium transition">New Post</a>
            <a href="/posts/restore/all" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 font-medium transition">Restore</a>
        </div>
    </nav>

    <div class="container mx-auto px-4 max-w-4xl pb-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Recent Posts</h1>
        </div>

        @if($posts->count() > 0)
            <div class="grid gap-6">
                @foreach($posts as  $post)
                    <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-sm hover:shadow-md transition group">
                        @if($post->image)
                            <img src="{{ asset($post->image) }}" alt="Post Image" class="w-full h-48 object-cover rounded-xl mb-4">
                        @endif
                        <h2 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-indigo-600 transition">{{ $post['title'] }}</h2>
                        <p class="text-slate-600 leading-relaxed mb-4">{{ $post['content'] }}</p>
                        <p class="text-sm text-slate-400 mb-2">
                            Created At :
                            {{ $post->created_at->format('l jS \of F Y h:i:s A') }}
                        </p>
                        <p class="text-sm text-slate-400 mb-2">
                            Created By :
                            {{ $post->post_owner->name}}
                        </p>
                        
                        <div class="flex items-center space-x-4 border-t border-slate-100 pt-4 mt-2">
                            <a href="/posts/{{ $post['id'] }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold transition">View Details →</a>
                            <div class="flex-grow"></div>
                            <a href="/posts/{{ $post['id'] }}/edit" class="text-slate-500 hover:text-blue-600 text-sm font-medium transition">Edit</a>
                            <form action="/posts/{{ $post['id'] }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete?')" class="text-slate-400 hover:text-red-500 text-sm font-medium transition">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-xl border border-dashed border-slate-300 text-slate-400">No posts found.</div>
        @endif
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</body>
</x-app-layout>