<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Convert form</title>
</head>
<body>

    @if(session('newPath'))
        <a href="{{ asset(session('newPath')) }}" target="_blank">{{ session('newPath') }}</a>
    @endif
    @if(session('error'))
        <span style="color: red;">{{ session('error') }}</span>
    @endif
    <form action="{{ route('webp.convert') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="file" name="image" required>
        <button type="submit">Convert</button>
    </form>
</body>
</html>