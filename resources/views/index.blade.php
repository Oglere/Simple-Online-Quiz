

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('CSS/mainpage.css')}}">
    <title>DARA Main Page</title>
</head>
<body>
    <main>
        <header> 
            @if (Auth::check())
                @php
                    $user = Auth::user();
                    $role = $user->role; // Assuming your User model has a 'role' column
                @endphp

                @if ($role === 'Admin')
                    <a class="death" href="{{ url('admin') }}">
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
                                class="feather feather-user"
                            >
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <h4>&nbsp;{{ $user->first_name }}</h4>
                        </div>
                    </a>

                @elseif ($role === 'Teacher')
                    <a class="death" href="{{ url('teacher') }}">
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
                                class="feather feather-user"
                            >
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <h4>&nbsp;{{ $user->first_name }}</h4>
                        </div>
                    </a>

                @elseif ($role === 'Student')
                    <a class="death" href="{{ url('student') }}">
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
                                class="feather feather-user"
                            >
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <h4>&nbsp;{{ $user->first_name }}</h4>
                        </div>
                    </a>
                @endif

            @else
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
            @endif


        </header>
        
        @include('layouts.main')


        <footer>
        </footer>
    </main>
</body>
</html>
