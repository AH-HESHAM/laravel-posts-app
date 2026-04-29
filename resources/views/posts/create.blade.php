<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post | PostIt</title>
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

    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
            <div class="bg-indigo-600 px-8 py-6 text-white font-bold text-2xl">Create New Post</div>
            <form action="/posts" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Title</label>
                    <input value="{{old('title')}}" type="text" name="title" required placeholder="Post title" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Content</label>
                    <input value="{{old('content')}}" name="content" rows="6" required placeholder="Post content..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Image (Optional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none bg-white transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Owner</label>
                    

                </div>
                <div class="flex items-center space-x-4 pt-4">
                    <button type="submit" class="flex-1 bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">Save Post</button>
                    <a href="/posts" class="px-6 py-3 text-slate-500 font-semibold hover:text-slate-700 transition">Cancel</a>
                </div>
            </form>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>   
        </div>
    </div>
</body>
</html>
