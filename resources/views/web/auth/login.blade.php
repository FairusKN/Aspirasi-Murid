<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-[#E8F1F2]">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <!-- Header Section -->
                <div class="login-header text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h1>
                    <p class="text-gray-600">Sign in to your account</p>
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('auth.login')}}" class="space-y-6">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- Username Field -->
                    <div class="form-group">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                placeholder="username123"
                                required
                            >
                        </div>
                        <x-input-error field="username" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
                                placeholder="••••••••"
                                required
                            >
                        </div>
                        <x-input-error field="password" class="mt-1 text-sm text-red-600" />
                    </div>

                    <!-- Sign In Button -->
                    <button type="submit" class="btn-login w-full bg-[#247BA0] hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 ease-in-out">
                        Sign In
                    </button>
                </form>

                <!-- Error Message -->
                @if ($errors->has('error'))
                    <div style="color: #ef4444; margin-bottom: 8px; text-align:center; margin-top:20px;" class="bg-red-50 border border-red-200 rounded-lg p-3 mt-6">
                        {{ $errors->first('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>

