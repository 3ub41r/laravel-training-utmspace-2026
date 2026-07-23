@extends('app')

@section('title', 'Change Password')

@section('content')
<section class="content-area">
    <div class="content-header">
        <h1 class="content-title">Change Password</h1>
        <p class="content-subtitle">
            Change you password.
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('change-password.update') }}" method="POST" class="w-full mb-10 flex flex-wrap gap-4">
        @csrf

        <div>
            <label
                for="old_password"
                class="block mb-2 text-sm font-medium text-gray-700"
            >
            Old Password
            </label>
            <input type="password"
                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                name="old_password"
                id="old_password" />
        </div>

        <div>
            <label
                for="new_password"
                class="block mb-2 text-sm font-medium text-gray-700"
            >
            New Password
            </label>
            <input type="password"
                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                name="new_password"
                id="new_password" />
        </div>

        <div>
            <label
                for="new_password_confirmation"
                class="block mb-2 text-sm font-medium text-gray-700"
            >
            Confirm Password
            </label>

            <input type="password"
                class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                name="new_password_confirmation"
                id="new_password_confirmation" />
        </div>

        {{-- Submit Button --}}
        <div class="flex-none">
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 text-white font-semibold rounded-lg shadow
               hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">
                Change
            </button>
        </div>
    </form>
</section>
@endsection