<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DARA - Edit Account</title>
    <link rel="stylesheet" href="{{ asset ('css/std.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/mainpage.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/std_control.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/usercontrol.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/atayaanioy.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/svg.css') }}">
</head>
<body>
    <main>
        <header>
            <div class="ahh">
                <img src="../../Imgs/DARA.png" alt="DARA Logo" class="ahh">
            </div>
        </header>

        <div class="main" style="height: 100%;">
            <div class="left">
                <div class="profile">
                    <h2>
                        {{ auth()->user()->first_name }}
                    </h2>
                </div>

                <nav class="nav-links">
                    <a href="/teacher"> 
                        <svg
                            style="margin-right: 10px;"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-home"
                            >
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>

                        Home
                    </a>
                    <a href="/teacher/review-quizzes">
                        <svg
                            style="margin-right: 10px;"
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-book-open"
                            >
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                        </svg>

                        Review Quizzes
                    </a>

                    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>

                    <a href="" class="unq" style="color: #8e0404; font-weight: normal;">Edit Account</a>

                    <div class="asd2" style=" width: 100%; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>

                    <form action="/out" method="POST">
                        @csrf
                        <button class="lgt">
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
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <polyline points="10 17 15 12 10 7" />
                                <line x1="15" y1="12" x2="3" y2="12" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </nav> 
            </div>

            <div class="right" style="overflow: auto; padding: 20px;">
                <div id="edit-account-section">
                    <div class="right" style="overflow: auto; padding: 20px;">
                        <div id="edit-account-section">
                            <div id="verify-user" class="VYI">
                                <h2>VERIFY YOUR IDENTITY</h2>
                                <form id="verify-form" action="editacc/{{ auth()->user()->user_id }}" method="post">
                                    @csrf
                                    <label for="password_hash">Enter your password:</label>
                                    <input type="password" id="password" name="password_hash" required>
                                    <button class="kapoya">Verify</button>
                                </form>
                                @if ($errors->any())
                                    <div style="color: red; margin-top: 10px; text-align: center;">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div style="color: green; margin-top: 10px; text-align: center;">
                                    Nice
                                    </div>
                                @endif
                            </div>

                            <div id="edit-account-container">
                                @if (session('editForm'))
                                    {!! session('editForm') !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
        </footer>
    </main>
</body>
</html>

<script src="../../js/hawa.js"></script>