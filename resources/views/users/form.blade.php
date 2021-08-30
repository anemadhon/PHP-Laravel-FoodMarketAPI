<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-flex items-center">
            {{ __('Users') }} 
            <svg class="h-5 w-auto" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg> 
            {{ isset($user) ? "@$user->username" : __('Create') }}
            @if (isset($user))
                <svg class="h-5 w-auto" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            @endif
            {{ isset($user) ? __('Edit') : '' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900"> {{ isset($user) ? "@$user->username Personal Information" : "User Personal Information" }} </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            - This information will be displayed publicly so be careful what you share.
                        </p>
                        <p class="mt-1 text-sm text-gray-600">
                            - Use a permanent address where you can receive mail.
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ isset($user) ? route('users.update', $user->username) : route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                        @endif
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6">
                                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                        <input type="text" name="username" value="{{ old('username', (isset($user) ? $user->username : '')) }}" id="username" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('username')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                                        <input type="text" name="first_name" value="{{ old('first_name', isset($name) ? $name->first() : '') }}" id="first-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('first_name')
                                            <p class="col-span-6 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                        
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                                        <input type="text" name="last_name" value="{{ old('last_name', (isset($name) && $name->count() > 1) ? $name->last() : '') }}" id="last-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('last_name')
                                            <p class="col-span-6 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" value="{{ old('email', (isset($user) ? $user->email : '')) }}" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('email')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    @if (!isset($user))
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                            <input type="password" name="password" value="{{ old('password', '') }}" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                            
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Password Confirmation</label>
                                            <input type="password" name="password_confirmation" value="{{ old('password_confirmation', '') }}" id="password_confirmation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                        @error('password')
                                            <p class="col-span-6 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    @endif
                        
                                    <div class="col-span-6">
                                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                        <input type="text" name="address" value="{{ old('address', (isset($user) ? $user->address : '')) }}" id="address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('address')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                        
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="house-number" class="block text-sm font-medium text-gray-700">House Number</label>
                                        <input type="text" name="house_number" value="{{ old('house_number', (isset($user) ? $user->house_number : '')) }}" id="house-number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('house_number')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                        
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                        <input type="text" name="city" value="{{ old('city', (isset($user) ? $user->city : '')) }}" id="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('city')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                        
                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number', (isset($user) ? $user->phone_number : '')) }}" id="phone-number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('phone_number')
                                            <p class="text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <fieldset class="col-span-6">
                                        <div>
                                            <legend class="text-base font-medium text-gray-900">Role</legend>
                                        </div>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-center">
                                                <input type="radio" name="role" value="ADMIN" {{ ((isset($user) && $user->role === 'ADMIN') || old('role') === 'ADMIN') ? 'checked' : '' }} id="role-admin" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                                <label for="role-admin" class="ml-3 block text-sm font-medium text-gray-700">
                                                    ADMIN
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" name="role" value="USER" {{ ((isset($user) && $user->role === 'USER') || old('role') === 'USER') ? 'checked' : '' }} id="role-user" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                                <label for="role-user" class="ml-3 block text-sm font-medium text-gray-700">
                                                    USER
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    @error('role')
                                        <p class="col-span-6 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    <div class="col-span-6">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Avatar
                                        </label>
                                        <div class="mt-1 flex items-center">
                                            @if (isset($user) && $user->profile_photo_path)
                                                <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                                    <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="users avatar" loading="lazy">
                                                </span>
                                            @endif
                                            @if (!isset($user) || $user->profile_photo_path === null)
                                                <svg class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            @endif
                                            <input type="file" name="profile_photo_path" value="{{ old('profile_photo_path', '') }}" id="avatar" class="appearance-none ml-5 py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded">
                                            @error('profile_photo_path')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ isset($user) ? 'Update' : 'Create' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
