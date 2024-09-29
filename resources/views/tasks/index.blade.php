<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
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

        /* Background Blob */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.6;
        }
        .blob-1 {
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #ff7eb9, #ff65a3);
            top: -150px;
            left: -150px;
        }
        .blob-2 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #7afcff, #5bffb1);
            bottom: -150px;
            right: -100px;
        }
        .blob-3 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #feb692, #ff88dc);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body class="relative bg-gray-900 font-sans leading-normal tracking-normal text-gray-200" id="body">

    <!-- Background blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="container mx-auto mt-8 relative z-10">
        <h1 class="text-4xl font-bold text-center text-gray-100 mb-8">To-Do List</h1>

        <!-- Toggle Switch -->
        <div class="flex justify-end mb-4">
            <label for="toggle" class="flex items-center cursor-pointer">
                <div class="relative">
                    <input id="toggle" type="checkbox" class="hidden" onchange="toggleMode()" aria-label="Toggle Dark/Light Mode">
                    <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                    <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                </div>
                <div class="ml-3 text-gray-300 font-medium">Toggle Dark/Light Mode</div>
            </label>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST" class="mb-8 bg-gray-800 p-6 rounded-lg shadow-md relative z-10">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-300 font-bold mb-2">Task Title:</label>
                <input type="text" name="title" id="title" placeholder="Task Title" class="w-full px-3 py-2 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600 bg-gray-700 text-gray-100" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-300 font-bold mb-2">Task Description:</label>
                <textarea name="description" id="description" placeholder="Task Description" class="w-full px-3 py-2 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600 bg-gray-700 text-gray-100"></textarea>
            </div>
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300" aria-label="Add Task">Add Task</button>
        </form>

        <!-- Task List -->
        <h2 class="text-2xl font-semibold text-gray-300 mb-4">Tasks</h2>
        <ul class="space-y-4">
            @foreach($tasks as $task)
                <li class="bg-gray-800 p-4 rounded-lg shadow flex justify-between items-center hover:bg-gray-700 transition duration-300">
                    <div>
                        <h3 class="text-lg font-bold text-gray-100">{{ $task->title }}</h3>
                        <p class="text-gray-400">{{ $task->description }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="text-blue-400 hover:underline" aria-label="Edit Task">Edit</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:underline" aria-label="Delete Task">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Toggle Mode Script -->
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
