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
 
            <div class="right" style="overflow: auto;">
                @forelse($quizzes as $quiz)
                    <div class="quiz-box">
                        <h3>{{ $quiz->title }}</h3>
                        <p>{{ $quiz->description }}</p>

                        @if ($results->has($quiz->quiz_id))
                            <div> <a href="student/result/{{ $quiz->quiz_id }}">View Score</a> </div>
                        @else
                            <form action="{{ url('student/start-quiz/' . $quiz->quiz_id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quiz_id" value="{{ $quiz->quiz_id }}">
                                <button type="submit">
                                    Answer now! ({{ $quiz->duration }} Minute{{ $quiz->duration > 1 ? 's' : '' }})
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <p>No ongoing quizzes available.</p>
                @endforelse
            </div>


        </div>

        <footer>
        </footer>
    </main>
</body>
</html>
<script src="js/index.js"></script>
<style>
    .right {
    padding: 2rem;
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    justify-content: start;
}

.quiz-box {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    padding: 1.5rem;
    width: 300px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-left: 5px solid #8e0404;
}

.quiz-box:hover {
    transform: scale(1.02);
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
}

.quiz-box h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #1F2937;
}

.quiz-box p {
    font-size: 0.95rem;
    color: #4B5563;
    margin-bottom: 1rem;
}

.quiz-box button {
    background-color: #4F46E5;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.quiz-box button:hover {
    background-color: #4338CA;
}

</style>