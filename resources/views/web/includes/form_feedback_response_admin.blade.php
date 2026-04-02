<div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-5">

        <h2 class="text-lg font-semibold text-gray-900">
            Update Feedback
        </h2>


        @if ($errors->any())
        <div class="p-3 bg-red-50 text-red-700 text-sm rounded-lg border border-red-200">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <form method="POST" action="{{ route('feedbacks.admin_response', $data->id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- STATUS -->
            <div>
                <label class="text-sm font-medium text-gray-700">Status</label>

                <select name="status"
                        class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500">

                    <option value="waiting" {{ old('status',$data->status)=='waiting'?'selected':'' }}>Waiting</option>
                    <option value="in_progress" {{ old('status',$data->status)=='in_progress'?'selected':'' }}>In Progress</option>
                    <option value="completed" {{ old('status',$data->status)=='completed'?'selected':'' }}>Completed</option>
                    <option value="rejected" {{ old('status',$data->status)=='rejected'?'selected':'' }}>Rejected</option>

                </select>
            </div>


            <!-- RESPONSE -->
            <div>
                <label class="text-sm font-medium text-gray-700">
                    Admin Response
                </label>

                <textarea name="admin_response"
                          rows="4"
                          class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500"
                          placeholder="Add response...">{{ old('admin_response',$data->admin_response) }}</textarea>

                <p class="text-xs text-gray-500 mt-1">
                    Visible to the student
                </p>
            </div>


            <!-- ACTIONS -->
            <div class= pt-2">
                <button type="submit"
                        class="w-1/2 bg-blue-600 text-white rounded-md py-2 hover:bg-blue-700">
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>
