@if(session()->has('message'))
    <div id="notification" class="position-absolute  alert alert-{{ session('message_type') }} mt-4">
        {{ session('message') }}
    </div>
@endif
