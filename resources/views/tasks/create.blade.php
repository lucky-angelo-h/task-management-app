<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <!-- Task Name -->
            <div class="mb-4">
                <label for="task_name" class="block text-gray-700">Task Name</label>
                <input type="text" name="task_name" id="task_name" class="border rounded w-full py-2 px-3 text-gray-700 @error('task_name') border-red-500 @enderror" value="{{ old('task_name') }}" required>
                @error('task_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Task Description -->
            <div class="mb-4">
                <label for="task_description" class="block text-gray-700">Task Description</label>
                <input type="text" name="task_description" id="task_description" class="border rounded w-full py-2 px-3 text-gray-700 @error('task_description') border-red-500 @enderror" value="{{ old('task_description') }}" required>
                @error('task_description')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category Dropdown -->
            <div class="mb-4">
                <label for="category_id" class="block text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="border rounded w-full py-2 px-3 text-gray-700">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                    Create Task
                </button>
            </div>
        </form>
      </div>
    </div>
</x-app-layout>