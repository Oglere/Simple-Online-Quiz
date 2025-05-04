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
            <a class="death" href="{{ url('/go/login') }}">
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
                
                @include ('layouts/search_material/search_bar');
                
            </div>
        </header>

        <div class="contents">
            <div class="recovery-container">
                <h2 style="color: #8e0404;">OTP Sent!</h2>
                <p class="instructions" style="line-height: normal; color: #8e0404 !important;">
                    Please enter the six (6) digit code we've sent to your email:
                    @php
                        $email = session('recovery_email');
                    @endphp
                    <strong> {{ $email }} </strong>
                    that u input a while ago
                </p>
                @error('otp')
                    <div class="message error">
                        {{ $message }}
                    </div>
                @enderror
                @error('otp1')
                    <div class="message error">
                        <a href="/go/recovery">{{ $message }}</a>
                    </div>
                @enderror
                <form action="verify/otp" method="POST" class="recovery-form">
                    @csrf
                    <label style="display: flex;" for="email" class="form-label">OTP: 
                    <div style="margin-left: auto; color: grey;" id="timer">
                        
                    </div>
                </label>
                    <input 
                        type="text" 
                        id="otp" 
                        name="otp" 
                        class="form-input" 
                        placeholder="Enter the OTP" 
                        required
                    >

                    <button type="submit" class="submit-btn">Verify OTP</button>
                    <p class="instructions" style="line-height: normal; font-weight: normal; color: #8e0404 !important;">
                        
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<script src="../js/results.js"></script>
@php
    $expiresAt = session('timer');
@endphp

<script>
    const expiresAt = new Date("{{ \Carbon\Carbon::parse($expiresAt)->toIso8601String() }}").getTime();
    const now = new Date().getTime();
    const remainingTime = Math.floor((expiresAt - now) / 1000);

    function startCountdown(durationInSeconds, display) {
        let timer = durationInSeconds;
        let interval = setInterval(() => {
            let minutes = Math.floor(timer / 60);
            let seconds = timer % 60;

            display.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

            if (--timer < 0) {
                clearInterval(interval);
                display.textContent = "Expired";
                display.style.color = "red";
            }
        }, 1000);
    }

    window.onload = function () {
        const display = document.getElementById('timer');
        if (remainingTime > 0) {
            startCountdown(remainingTime, display);
        } else {
            display.textContent = "Expired";
            display.style.color = "red";
        }
    };
</script>

