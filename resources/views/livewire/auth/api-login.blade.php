<div>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow">
        <div class="text-center mb-6" >
            <img src="{{ asset('image/logo.png') }}" alt="logo" class="text-center">
        </div>


        <form wire:submit.prevent="login">
{{--            <h2 class="text-2xl font-bold mb-6 text-gray-800">API Login</h2>--}}

            @if ($errorMessage)
                <div class="mb-4 text-red-500">{{ $errorMessage }}</div>
            @endif

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input wire:model="email" type="email" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input wire:model="password" type="password" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Login</button>
        </form>
    </div>

</div>
