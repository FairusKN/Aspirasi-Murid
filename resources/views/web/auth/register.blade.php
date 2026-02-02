<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-[#E8F1F2]">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <!-- Header Section -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h1>
                    <p class="text-gray-600">Fill in your details to register</p>
                </div>
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 mt-6 text-center">
                        <span class="text-sm text-green-600">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('auth.register') }}" class="space-y-6">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input
                                type="text"
                                id="full_name"
                                name="full_name"
                                value="{{ old('full_name') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                placeholder="John Doe"
                                required
                            >
                        </div>
                        <x-input-error field="full_name" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                placeholder="john@example.com"
                                required
                            >
                        </div>
                        <x-input-error field="email" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- NIS (Student ID) -->
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700 mb-2">NIS</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                            <input
                                type="text"
                                id="nis"
                                name="nis"
                                value="{{ old('nis') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                placeholder="1234567890"
                                required
                            >
                        </div>
                        <x-input-error field="nis" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Class -->
                    <div>
                        <label for="class" class="block text-sm font-medium text-gray-700 mb-2">Class</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-school text-gray-400"></i>
                            </div>
                            <input
                                type="text"
                                id="class"
                                name="class"
                                value="{{ old('class') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                placeholder="XII A"
                                required
                            >
                        </div>
                        <x-input-error field="class" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                        <x-input-error field="password" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                        <x-input-error field="password_confirmation" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="w-full bg-[#247BA0] hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 ease-in-out">
                        Register
                    </button>
                </form>

                <!-- Global Error Message -->
                @if ($errors->has('error'))
                    <div class="bg-red-50 border border-red-200 rounded-lg p-3 mt-6 text-center">
                        <span class="text-sm text-red-600">{{ $errors->first('error') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
