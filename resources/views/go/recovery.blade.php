<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    };
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('CSS/recovery.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/results.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/mainpage.css')}}">
    <link rel="stylesheet" href="{{asset('CSS/student_nav.css')}}">
    <title>DARA Main Page</title>
</head>
<body>
    <main>
        <header>
            <a class="death" href="/">
                <div class="loginbutton">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-log-in"
                    >
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                    <h4> &nbsp; Login</h4>
                </div>
            </a>
            
            <div class="ahh">
                    <a href="/" class="help">
                        <img src="{{asset('imgs/dara.png')}}" alt="" style="height: 25px;">
                    </a>
            </div>
        </header>

        <div class="contents">
            <div class="recovery-container">
                <h2 style="color: #8e0404;">Account Recovery</h2>
                <p class="instructions" style="line-height: normal; color: #8e0404 !important;">
                    Enter your registered email address to request account recovery. If it exists in our system, you will receive further instructions.
                </p>
                @error('email')
                    <div class="message error">
                        {{ $message }}
                    </div>
                @enderror

                <form action="recovery/email" method="POST" class="recovery-form">
                    @csrf
                    <label for="email" class="form-label">Email Address:</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="Enter your email" 
                        required
                    >
                    <button type="submit" class="submit-btn">Request Recovery</button>
                    <p class="instructions" style="line-height: normal; font-weight: normal; color: #8e0404 !important;">
                            
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<script src="../js/results.js"></script>

