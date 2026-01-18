<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Submit Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">We Value Your Feedback</h1>
            <p class="text-gray-600 mt-2">Help us improve by sharing your experience</p>
        </div>

        <form method="POST" action="/feedback">
            @csrf
            <div class="space-y-6">
                <!-- Rating -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">How would you rate your experience?</label>
                    <div class="flex space-x-2">
                        <!-- You can enhance this with JS later -->
                        <select name="rating" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                            <option value="">Select a rating</option>
                            <option value="5">★★★★★ (Excellent)</option>
                            <option value="4">★★★★☆ (Good)</option>
                            <option value="3">★★★☆☆ (Average)</option>
                            <option value="2">★★☆☆☆ (Poor)</option>
                            <option value="1">★☆☆☆☆ (Very Poor)</option>
                        </select>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Category</label>
                    <select name="category" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="">Select a category</option>
                        <option value="product">Product Quality</option>
                        <option value="support">Customer Support</option>
                        <option value="website">Website Experience</option>
                        <option value="delivery">Delivery & Shipping</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Message -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Your Feedback</label>
                    <textarea
                        name="message"
                        rows="5"
                        placeholder="Tell us what you liked or what we can improve..."
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        required
                    ></textarea>
                </div>

                <!-- Optional: Contact Info -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Email (optional, if you'd like a response)</label>
                    <input
                        type="email"
                        name="email"
                        placeholder="you@example.com"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    />
                </div>

                <!-- Submit -->
                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition"
                    >
                        Submit Feedback
                    </button>
                </div>
            </div>
        </form>

        <div class="text-center text-gray-500 text-sm mt-8">
            <p>Your feedback is anonymous unless you provide your email.</p>
        </div>

                <form method="POST" action="{{ route('auth.logout') }}" class="inline">
                    @csrf
                    <button
                        type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700"
                    >
                        Logout
                    </button>
                </form>
    </div>
</body>
</html>
