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

            <form method="POST" action="/go/login">
                @csrf
                <div class="inputs">
                    <div class="user">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input type="email" name="usn_login" value="{{ old('usn') }}" required placeholder="Email">
                        
                    </div>

                    <div class="pass">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key">
                            <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                        </svg>
                        <input type="password" name="password_hash_login" required placeholder="Password">
                        
                    </div>    
                </div>

                <div class="ubos">
                    <button type="submit">L O G I N</button>
                    <a href="/register"
                    style="
                        text-decoration: none;
                        margin-top: 5px;
                        border-radius: 5px;
                        height: 35px;
                        width: 100%;
                        border: 1px solid #8e0404;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        color: #8e0404;
                        background-color: white;
                        cursor: pointer;
                    "
                    >Create Account</a>

                    @if (session('error'))
                        
                    @endif
                    @if ($errors->error)
                        <div style="color: red; margin-top: 10px;">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="/go/recovery">Forgot Password?</a>
                </div>
            </form>
        </div>
    </main>

    
</div>

</body>
</html>
