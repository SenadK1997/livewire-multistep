@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('formData'))
    <pre>{{ json_encode(session('formData'), JSON_PRETTY_PRINT) }}</pre>
@endif
