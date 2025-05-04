<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/std.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mainpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/std_control.css') }}">
    <link rel="stylesheet" href="{{ asset('css/svg.css') }}">
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../Imgs/DARA.png" alt="" class="ahh">
            </div>
        </header> 
         
        <div class="main" style="height: 100%;">
            <div class="left">
                <div class="profile">
                    <h2>{{ auth()->user()->first_name }}</h2>
                    
                </div>

                <nav class="nav-links">
                    <a href="" style="color: #04128e; font-weight: normal;"> 
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
                            class="feather feather-home"
                            >
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                            <polyline points="9 22 9 12 15 12 15 22" />
                        </svg>

                        Home
                    </a>
                    <a href="student/history">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>

                        History
                    </a>

                    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>
                    
                    <a href="student/edit" class="unq">Edit Account</a>

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

            <div class="right" style="overflow-x: auto; padding: 20px;">
                <h2 style="font-size: 22px; margin-bottom: 20px;">Available Quizzes</h2>

                @if($quizzes->isEmpty())
                    <table style="width: 100%; border-collapse: collapse; font-size: 16px;">
                        <thead style="background-color: #f0f0f0;">
                            <tr>
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ccc;">
                                    No ongoing quizzes available.
                                </th>
                            </tr>
                        </thead>
                    </table>
                @else
                    <table style="width: 100%; border-collapse: collapse; font-size: 16px;">
                        <thead style="background-color: #f0f0f0;">
                            <tr>
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ccc;">Title</th>
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ccc;">Description</th>
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ccc;">Duration</th>
                                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ccc;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                                <tr style="border-bottom: 1px solid #eee;">
                                    <td style="padding: 10px;">{{ $quiz->title }}</td>
                                    <td style="padding: 10px;">{{ $quiz->description }}</td>
                                    <td style="padding: 10px;">{{ $quiz->duration }} min</td>
                                    <td style="padding: 10px;">
                                        @if ($results->has($quiz->quiz_id))
                                            <a href="{{ url('student/result/' . $quiz->quiz_id) }}" 
                                            style="color: green; text-decoration: underline;">View Score</a>

                                        @elseif (isset($activeSessions[$quiz->quiz_id]))
                                            <a href="{{ url('student/quiz/' . $quiz->quiz_id) }}" 
                                            style="color: orange; text-decoration: underline;">Continue</a>

                                        @elseif (!in_array($quiz->quiz_id, $startedQuizIds))
                                            <form action="{{ url('student/start-quiz/' . $quiz->quiz_id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="quiz_id" value="{{ $quiz->quiz_id }}">
                                                <button type="submit" style="
                                                    background-color: #007bff;
                                                    color: white;
                                                    border: none;
                                                    padding: 6px 14px;
                                                    border-radius: 5px;
                                                    cursor: pointer;">
                                                    Start Quiz
                                                </button>
                                            </form>

                                        @else
                                            <span style="color: #999;">Session expired</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <footer>
        </footer>
    </main>
</body>
</html>
<script src="js/index.js"></script>
