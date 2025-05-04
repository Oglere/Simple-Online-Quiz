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
                    <a href="/student"> 
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
 
            <div class="right" style="overflow: auto; justify-content: normal;">
                <div class="results-container" style="padding: 20px; width: 100%">
                    <h2 style="font-size: 24px; margin-bottom: 10px;">Quiz Results: {{ $quiz->title }}</h2>

                    <div class="summary-box" style="margin-bottom: 20px; padding: 15px; border-radius: 8px; background-color: #f5f5f5;">
                        <p><strong>Score:</strong> {{ $result->score }} / {{ $result->total_items }}</p>
                        <p><strong>Percentage:</strong> {{ $result->percentage }}%</p>
                        <p><strong>Remarks:</strong> {{ $result->remarks }}</p>
                    </div>

                    @foreach ($questions as $q)
                        <div class="question-review" style="margin-bottom: 25px; padding: 15px; border: 1px solid #ddd; border-radius: 8px;">
                            <p style="font-weight: bold; margin-bottom: 10px;">Q{{ $loop->iteration }}. {{ $q->question }}</p>
                            
                            @php
                                $selected = $studentAnswers[$q->id] ?? null;
                            @endphp

                            @foreach (['option_a', 'option_b', 'option_c', 'option_d'] as $opt)
                                @php
                                    $isCorrect = $q->answer === $opt;
                                    $isSelected = $selected === $opt;
                                    $bgColor = '';

                                    if ($isCorrect) {
                                        $bgColor = '#d4edda'; // green
                                    }

                                    if ($isSelected && !$isCorrect) {
                                        $bgColor = '#f8d7da'; // red
                                    }
                                @endphp

                                <div style="padding: 8px 12px; margin-bottom: 5px; border-radius: 5px; background-color: {{ $bgColor }}">
                                    <input type="radio" disabled {{ $isSelected ? 'checked' : '' }}> {{ $q->$opt }}

                                    @if ($isCorrect && $isSelected)
                                        <strong style="color: green;">(Your Answer & Correct)</strong>
                                    @elseif ($isCorrect)
                                        <strong style="color: green;">(Correct Answer)</strong>
                                    @elseif ($isSelected)
                                        <strong style="color: red;">(Your Answer)</strong>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </div>

            </div>


        </div>

        <footer>
        </footer>
    </main>
</body>
</html>
<script src="js/index.js"></script>