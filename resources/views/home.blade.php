<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background: url('https://source.unsplash.com/1600x900/?movie,cinema') no-repeat center center/cover;
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
        }
        .content {
            position: relative;
            z-index: 2;
        }
        input, button {
            padding: 10px;
            margin: 10px;
            width: 300px;
            border: none;
            border-radius: 5px;
        }
        input {
            background: rgba(255, 255, 255, 0.8);
            color: black;
        }
        button {
            background: #ff4757;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #e84118;
        }
        #result {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
    <script>
        async function register() {
            window.location.href = "http://localhost:8000/register.html";
            try {
                let response = await fetch('http://localhost:8000/api/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        name: 'Test User',
                        email: 'test@example.com',
                        password: 'password123'
                    })
                });
                let data = await response.json();
                document.getElementById("result").innerText = data.message || 'Registration successful!';
            } catch (error) {
                console.error(error);
                document.getElementById("result").innerText = 'Registration failed!';
            }
        }

        async function searchMovie() {
            let title = document.getElementById("title").value;
            if (!title) {
                document.getElementById("result").innerText = 'Please enter a movie title!';
                return;
            }
            try {
                let response = await fetch(`http://localhost:8000/api/movies/search?title=${encodeURIComponent(title)}`);
                let movie = await response.json();
                document.getElementById("result").innerText = movie.title ? `Found: ${movie.title}` : 'Movie not found!';
            } catch (error) {
                console.error(error);
                document.getElementById("result").innerText = 'Error fetching movie data!';
            }
        }
    </script>
</head>
<body>
    <div class="overlay"></div>
    <div class="content">
        <h1>Movie App</h1>
        <input type="text" id="title" placeholder="Enter movie title">
        <button onclick="searchMovie()">Search</button>
        <button onclick="register()">Register</button>
        <div id="result"></div>
    </div>
</body>
</html>
