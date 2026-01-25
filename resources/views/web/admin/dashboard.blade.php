@extends('web.layouts.admin')

@section('title')
 <title> Admin Dashboard </title>
@endsection

@section('content')
  <main class="container mx-auto px-6 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-20 mt-10">
            <!-- Total Feedback Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Total Feedback</h3>
                <p class="text-3xl font-bold text-gray-800">742</p>
            </div>

            <!-- Total Feedback Completed Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Total Feedback Completed</h3>
                <p class="text-3xl font-bold text-green-600">563</p>
            </div>

            <!-- Total Feedback In Progress Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Total Feedback In Progress</h3>
                <p class="text-3xl font-bold text-yellow-600">79</p>
            </div>

            <!-- Total Feedback Waiting Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Total Feedback Waiting</h3>
                <p class="text-3xl font-bold text-red-600">100</p>
            </div>
        </div>

        <!-- Recent Feedbacks Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Recent Feedbacks</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feedback Card 1 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Feedback Title</h3>
                    <p class="text-xl font-bold text-gray-900 mb-6">Imao</p>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">Category</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-gray-300 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">Status</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500">Created at: 12 November 2025</p>
                </div>

                <!-- Feedback Card 2 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Feedback Title</h3>
                    <p class="text-xl font-bold text-gray-900 mb-6">Imao</p>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">Category</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-gray-300 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">Status</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500">Created at: 12 November 2025</p>
                </div>

                <!-- Feedback Card 3 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Feedback Title</h3>
                    <p class="text-xl font-bold text-gray-900 mb-6">Imao</p>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">Category</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-gray-300 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">Status</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500">Created at: 12 November 2025</p>
                </div>
            </div>
        </div>
    </main>
@endsection
