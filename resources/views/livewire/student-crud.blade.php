<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">Student Management</h2>

    {{-- Success message --}}
    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-3">
            {{ session('message') }}
        </div>
    @endif

    {{-- Form Section --}}
    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="mb-6 space-y-3 bg-gray-50 p-4 rounded border">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Name</label>
                <input type="text" wire:model="name" placeholder="Enter name"
                    class="border rounded p-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Email</label>
                <input type="email" wire:model="email" placeholder="Enter email"
                    class="border rounded p-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Course</label>
                <input type="text" wire:model="course" placeholder="Enter course"
                    class="border rounded p-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('course') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Age</label>
                <input type="number" wire:model="age" placeholder="Enter age"
                    class="border rounded p-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none">
                @error('age') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-wrap gap-2 mt-3">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">
                {{ $isEditMode ? 'Update' : 'Save' }}
            </button>

            <button type="button" wire:click="resetFields"
                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">
                {{ $isEditMode ? 'Cancel' : 'Clear' }}
            </button>
        </div>
    </form>

    {{-- Table Section --}}
    <h3 class="text-xl font-semibold mb-2">Student List</h3>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Course</th>
                    <th class="px-4 py-2 border">Age</th>
                    <th class="px-4 py-2 border text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $student)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $student->id }}</td>
                        <td class="border px-4 py-2">{{ $student->name }}</td>
                        <td class="border px-4 py-2">{{ $student->email }}</td>
                        <td class="border px-4 py-2">{{ $student->course }}</td>
                        <td class="border px-4 py-2">{{ $student->age }}</td>
                        <td class="border px-4 py-2 text-center space-x-2">
                            <button wire:click="edit({{ $student->id }})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded transition">
                                Edit
                            </button>
                            <button wire:click="delete({{ $student->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-4">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
