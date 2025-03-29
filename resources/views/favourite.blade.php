<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Movies</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h2>Your Favorite Movies</h2>
        @if(session('message'))
            <p style="color: green;">{{ session('message') }}</p>
        @endif

        @if($favorites->isEmpty())
            <p>No favorite movies yet.</p>
        @else
            <ul>
                @foreach($favorites as $movie)
                    <li>
                        <img src="{{ $movie->poster_url }}" alt="{{ $movie->movie_title }}" width="100">
                        <p>{{ $movie->movie_title }}</p>
                        <form method="POST" action="{{ route('remove.favorite', $movie->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <a href="{{ route('dashboard') }}">Back to Dashboard</a>
    </div>
</body>
</html>
