@if (Auth::check())
    @php
        $role = Auth::user()->role;
        switch ($role) {
            case 'Admin':
                return redirect("/admin");
            case 'Teacher':
                header("Location: /teacher");
                exit();
            case 'Student':
                header("Location: /student");
                exit();
            default:
                header("Location: /home");
                exit();
        }
    @endphp
@endif


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @auth
        <p>Welcome, {{ auth()->user()->first_name }}!</p>
        <form action="/out" method="POST">
            @csrf
            <button>Logout</button>
        </form>
    @else
        <p>Make an account, bro...</p>
        
        <form action="/create" method="POST">
            @csrf
            <label for="last_name">Last Name: </label>
            <input name="last_name" type="text" required><br>
            <label for="first_name">First Name: </label>
            <input name="first_name" type="text" required><br>
            <label for="usn">Username: </label>
            <input name="usn" type="text" required><br>
            <label for="password_hash">Password: </label>
            <input name="password_hash" type="password" required><br>
            <label for="email">Email: </label>
            <input name="email" type="email" required><br>
            <label for="role">Role: </label>
            <input name="role" type="text" required><br>
            <label for="status">Status: </label>
            <input name="status" type="text" required><br>
            <button>Submit</button>
        </form>

        <div>----------------------------------------------------</div>

        <p>Login Section</p>
        <form action="/lagin" method="POST">
            @csrf
            <input name="usn_login" type="text" placeholder="USN" required>
            <input name="password_hash_login" type="password" placeholder="Password" required>
            <button>Submit</button>
        </form>
    @endauth

    @if(auth()->check())
        <p>Session Active: {{ auth()->user()->usn }}</p>
    @else
        <p>No active session.</p>
    @endif

</body>
</html>
