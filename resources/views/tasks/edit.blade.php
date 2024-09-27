<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .dot {
            transition: all 0.3s ease;
        }
        input:checked + .dot {
            transform: translateX(100%);
            background-color: #f9fafb; /* Light mode toggle */
        }
    </style>
</head>
<body class="bg-gray-900 font-sans leading-normal tracking-normal text-gray-200" id="body">

    <div class="container mx-auto mt-8">
        <h1 class="text-4xl font-bold text-center text-gray-100 mb-8">Edit Task</h1>

        <div class="flex justify-end mb-4">
            <label for="toggle" class="flex items-center cursor-pointer">
                <div class="relative">
                    <input id="toggle" type="checkbox" class="hidden" onchange="toggleMode()">
                    <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                    <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                </div>
                <div class="ml-3 text-gray-300 font-medium">Toggle Dark/Light Mode</div>
            </label>
        </div>

        <!-- Edit Task Form -->
        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="mb-8 bg-gray-800 p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-300 font-bold mb-2">Task Title:</label>
                <input type="text" name="title" value="{{ $task->title }}" class="w-full px-3 py-2 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600 bg-gray-700 text-gray-100" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-300 font-bold mb-2">Task Description:</label>
                <textarea name="description" class="w-full px-3 py-2 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600 bg-gray-700 text-gray-100">{{ $task->description }}</textarea>
            </div>
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Update Task</button>
        </form>

        <div class="mt-4">
            <a href="{{ route('tasks.index') }}" class="text-blue-400 hover:underline">Back to Task List</a>
        </div>
    </div>

    <script>
        function toggleMode() {
            const body = document.getElementById('body');
            const toggle = document.getElementById('toggle');
            if (toggle.checked) {
                body.classList.remove('bg-gray-900', 'text-gray-200');
                body.classList.add('bg-gray-100', 'text-gray-900');
            } else {
                body.classList.remove('bg-gray-100', 'text-gray-900');
                body.classList.add('bg-gray-900', 'text-gray-200');
            }
        }
    </script>
</body>
</html>
