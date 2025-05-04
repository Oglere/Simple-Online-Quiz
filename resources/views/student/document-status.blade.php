<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> QUIZZIN - Student Dashboard</title>
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
                    <a href="" style="color: #04128e; font-weight: normal;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>

                        History
                    </a>

                    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>
                    
                    <a href="edit" class="unq">Edit Account</a>

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
                <h2 style="font-size: 22px; margin-bottom: 20px;">Recently Answered Quizzes</h2>

                @if($results->isEmpty())
                    <p>You haven't answered any quizzes yet.</p>
                @else
                    <table style="width: 100%; border-collapse: collapse; font-size: 16px;">
                        <thead style="background-color: #f0f0f0;">
                            <tr>
                                <th style="padding: 12px; text-align: left;">Title</th>
                                <th style="padding: 12px;">Score</th>
                                <th style="padding: 12px;">Remarks</th>
                                <th style="padding: 12px;">Date Taken</th>
                                <th style="padding: 12px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results->sortByDesc('created_at') as $result)
                                @php
                                    $quiz = \App\Models\Quiz::find($result->quiz_id);
                                @endphp
                                <tr>
                                    <td style="padding: 10px;">{{ $quiz->title }}</td>
                                    <td style="padding: 10px; text-align: center;">{{ $result->score }} / {{ $result->total_items }}</td>
                                    <td style="padding: 10px; text-align: center;">
                                        <span style="color: {{ $result->remarks == 'Passed' ? 'green' : 'red' }};">
                                            {{ $result->remarks }}
                                        </span>
                                    </td>
                                    <td style="padding: 10px; text-align: center;">{{ \Carbon\Carbon::parse($result->created_at)->format('M d, Y h:i A') }}</td>
                                    <td style="padding: 10px; text-align: center;">
                                        <a href="{{ url('student/result/' . $result->quiz_id) }}" 
                                        style="color: #007bff; text-decoration: underline; text-align: center;">
                                            View Result
                                        </a>
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
