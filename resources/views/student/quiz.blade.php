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
            <div class="timer">
                Time Left: <span id="timer"></span>
            </div>
            <div class="ahh">
                <img src="../Imgs/DARA.png" alt="" class="ahh">
            </div>
        </header> 
         
        <div class="main">
            <div class="quiz-sidebar timer-sticky">
                <div class="quiz-title">{{ $quiz->title }}</div>
                <div class="quiz-desc">{{ $quiz->description }}</div>
                
            </div>

            <div>
                <form method="POST" action="submitanswers/{{ $quiz->quiz_id }}">
                    @csrf
                    @foreach($qna as $index => $item)
                        <div class="question-block">
                            <div class="question-text">{{ $index + 1 }}. {{ $item->question }}</div>
                            
                            <label class="answer-option">
                                <input type="radio" name="answers[{{ $item->id }}]" value="option_a" required>
                                {{ $item->option_a }}
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="answers[{{ $item->id }}]" value="option_b">
                                {{ $item->option_b }}
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="answers[{{ $item->id }}]" value="option_c">
                                {{ $item->option_c }}
                            </label>
                            <label class="answer-option">
                                <input type="radio" name="answers[{{ $item->id }}]" value="option_d">
                                {{ $item->option_d }}
                            </label>
                        </div>
                    @endforeach

                    <button type="submit" class="submit-btn">Submit Quiz</button>
                </form>
            </div>
        </div>


        <footer>
        </footer>
    </main>
</body>
</html>
<script src="js/index.js"></script>
<script>
    const endTime = new Date("{{ \Carbon\Carbon::parse($session->time_end)->format('Y-m-d H:i:s') }}").getTime();

    const timerInterval = setInterval(() => {
        const now = new Date().getTime();
        const remaining = endTime - now;

        if (remaining <= 0) {
            clearInterval(timerInterval);
            document.getElementById("timer").textContent = "Time's up!";
            alert("Time is up! Your quiz will be submitted automatically.");
            document.querySelector('form').submit();
        } else {
            const minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remaining % (1000 * 60)) / 1000);
            document.getElementById("timer").textContent = `${minutes}m ${seconds}s`;
        }
    }, 1000);
</script>
<style>
.main {
    overflow: auto;
    display: grid;
    grid-template-columns: 1fr 3fr;
    gap: 2rem;
    padding: 2rem;
    max-width: 1200px;
    margin: auto;
}

/* Sidebar */
.quiz-sidebar {
    background-color: #e3ecf5;
    padding: 2rem;
    border-radius: 12px;
}

/* Title, description, timer */
.quiz-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.quiz-desc {
    font-size: 1rem;
    color: #444;
    margin-bottom: 1rem;
}

.timer {
    color: #e53935;
    font-size: 1.2rem;
    font-weight: 600;
}

/* Sticky timer if needed */
.timer-sticky {
    position: sticky;
    top: 1rem;
}

/* Question block card */
.question-block {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Question text */
.question-text {
    font-weight: 600;
    margin-bottom: 1rem;
}

/* Answer options */
.answer-option {
    display: flex;
    align-items: center;
    margin: 0.5rem 0;
    cursor: pointer;
    transition: background 0.2s;
}

.answer-option:hover {
    background-color: #f0f0f0;
    border-radius: 6px;
    padding-left: 0.5rem;
}

.answer-option input[type="radio"] {
    margin-right: 0.6rem;
    accent-color: #007bff;
}

/* Submit button */
.submit-btn {
    background-color: #007bff;
    color: #ffffff;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.3s ease;
    display: inline-block;
}

.submit-btn:hover {
    background-color: #0056b3;
}

/* Responsive */
@media (max-width: 768px) {
    .main {
        grid-template-columns: 1fr;
    }

    .quiz-sidebar {
        margin-bottom: 2rem;
    }
}
</style>