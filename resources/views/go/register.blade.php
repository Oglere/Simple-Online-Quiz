@if (Auth::check())
    <script>window.location.href = "{{ url('/') }}";</script>
    <?php exit(); ?>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mainpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logo.css') }}">
</head>
<body> 
    <main>
        <div class="contents">
            <div class="logo" style="margin-bottom: 20px">
                <span class="g">Q</span>
                <span class="o1">u</span>
                <span class="o2">i</span>
                <span class="g2">z</span>
                <span class="l">z</span>
                <span class="e">i</span>
                <span class="o1">n</span>
                <span class="g">'</span>
            </div>

            <form method="POST" action="/create">
                @csrf
                <div class="inputs">
                    <div class="user">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <input type="email" name="email" required placeholder="Email">
                    </div>
                    
                    <div class="user">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input type="text" name="first_name" required placeholder="First Name">
                    </div>

                    <div class="user">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input type="text" name="last_name" required placeholder="Last Name">
                    </div>

                    <div class="pass">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key">
                            <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                        </svg>
                        <input type="password" name="password" required placeholder="Password"></div>    

                    <div class="pass">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <input type="password" name="password_confirmation" required placeholder="Confirm Password">
                        <input type="hidden" name="role" value="Student" required placeholder="Confirm Password">
                        <input type="hidden" name="status" value="Active" required placeholder="Confirm Password">
                    </div>    
                </div>

                <div class="ubos">
                    <button type="submit">L O G I N</button>
                    @if ($errors->createErrors->any())
                        <div style="color: red;">
                            @foreach ($errors->createErrors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <a href="/">Already had an account?</a>
                </div>
            </form>
        </div>
    </main>
    @if (session('createErrors'))
        <div style="color: red; margin-top: 10px;">
            @foreach (session('createErrors')->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    
</div>

</body>
</html>
