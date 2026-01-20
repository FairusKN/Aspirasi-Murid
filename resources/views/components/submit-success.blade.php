@if(session('success'))
    <span class="text-danger" style="color: green; font-size: 0.875em;">
        {{ session('success') }}
    </span>
@endif
