@if (count($errors) > 0)
    @foreach ($error->all() as $error)
        <div class="alert alert-warning">{{ $error }}</div>
    @endforeach
@endif