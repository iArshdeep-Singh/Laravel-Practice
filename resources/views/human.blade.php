<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Human</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <h1>Add Human</h1>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('human.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
        <p style="color: red;">{{ $message }}</p> @enderror

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        @error('email')
        <p style="color: red;">{{ $message }}</p> @enderror

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" value="{{ old('age') }}">
        @error('age') 
            <p style="color: red;">{{ $message }}
        <p /> @enderror

            <label for="password">Set Password:</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}">
            @error('password')
            <p style="color: red;">{{ $message }}</p> @enderror

        <button type="submit">Submit</button>
    </form>

    <a href="{{ route('human.index') }}"
        style="text-decoration: none; color: #007BFF; font-weight: bold; padding: 10px 15px; border: 2px solid #007BFF; border-radius: 5px; background-color: #E7F3FF;">
        View All Humans
    </a>

</body>

</html>