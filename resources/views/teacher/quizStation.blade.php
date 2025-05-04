<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Teacher Dashboard</title>
    <link rel="stylesheet" href="{{ asset ('css/std.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/mainpage.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/std_control.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/svg.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/quizs.css') }}">
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../../Imgs/DARA.png" alt="" class="ahh">
            </div>
        </header>
         
        <div class="main" style="height: 100%;">
            <div class="left">
                <div class="profile">
                    <h2> {{ auth()->user()->first_name }} </h2> <!-- Display student's username -->
                    
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
                    <a href="../review-quizzes">
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

                    <a href="/teacher/edit" class="unq">Edit Account</a>

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

            <div class="asdmodal hidden" id="deployModalContainer">
                <div class="modal">
                    <div class="modal-content">
                        <h2>Confirm Deployment</h2>
                        <div class="modal-actions">
                            <form action="{{ url('teacher/deployquiz/' . $quiz->quiz_id) }}" method="POST">
                                @csrf
                                <p>Are you sure you want to deploy this quiz?</p>
                                <div class="btnsz">
                                    <button type="submit" class="batan confirm">Yes, Deploy</button>
                                    <button type="button" class="batan cancel" onclick="closeModal('deployModalContainer')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="asdmodal hidden" id="revertModalContainer">
                <div class="modal">
                    <div class="modal-content">
                        <h2>Revert Deployment</h2>
                        <div class="modal-actions">
                            <form action="{{ url('teacher/revertquiz/' . $quiz->quiz_id) }}" method="POST">
                                @csrf
                                <p>Are you sure you want to revert this quiz?</p>
                                <div class="btnsz">
                                    <button type="submit" class="batan confirm">Yes, Revert</button>
                                    <button type="button" class="batan cancel" onclick="closeModal('revertModalContainer')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="asdmodal hidden" id="endModalContainer">
                <div class="modal">
                    <div class="modal-content">
                        <h2>Revert Deployment</h2>
                        <div class="modal-actions">
                            <form action="{{ url('teacher/endquiz/' . $quiz->quiz_id) }}" method="POST">
                                @csrf
                                <p>Are you sure you want to end this quiz?</p>
                                <div class="btnsz">
                                    <button type="submit" class="batan confirm">Yes, end it</button>
                                    <button type="button" class="batan cancel" onclick="closeModal('endModalContainer')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="asdmodal hidden" id="editModalContainer">
                <div class="modal">
                    <div class="modal-content">
                        <h2>Edit Question</h2>
                        <div class="modal-actions">
                            <form action="edit" id="editForm" method="POST">
                                @csrf
                                <textarea name="question" id="edit_question" placeholder="Question" required></textarea>
                                <div class="moby">
                                    <label for="option_a">A: </label>
                                    <input type="text" name="option_a" id="edit_option_A" placeholder="Option A" required>
                                </div>
                                <div class="moby">
                                    <label for="option_a">B: </label>
                                    <input type="text" name="option_b" id="edit_option_B" placeholder="Option B" required>
                                </div>
                                <div class="moby">
                                    <label for="option_a">C: </label>
                                    <input type="text" name="option_c" id="edit_option_C" placeholder="Option C" required>
                                </div>
                                <div class="moby">
                                    <label for="option_a">D: </label>
                                    <input type="text" name="option_d" id="edit_option_D" placeholder="Option D" required>
                                </div>
                                <select name="answer" id="edit_answer" required>
                                    <option value="">Select Answer</option>
                                    <option value="option_a">A</option>
                                    <option value="option_b">B</option>
                                    <option value="option_c">C</option>
                                    <option value="option_d">D</option>
                                </select>
                                <div class="btnsz">
                                    <button type="submit" class="batan confirm">Update</button>
                                    <button type="button" class="batan cancel" onclick="closeModal('editModalContainer')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="deleteModalContainer" class="asdmodal hidden">
                <div class="modal">
                    <div class="modal-content">
                        <h2>Are you sure you want to delete this question?</h2>
                        <form id="deleteForm" method="POST">
                            @csrf
                            <p>This action cannot be undone.</p>
                            <div class="btnsz">
                                <button type="submit" class="batan confirm">Delete</button>
                                <button type="button" class="batan cancel" onclick="closeModal('deleteModalContainer')">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    
            <div class="right" style="height: 100%; overflow: auto;">
                <div class="cntmnt">
                    <div class="lct col">
                        <div class="bkbt">
                            <a href="/teacher"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rewind"><polygon points="11 19 2 12 11 5 11 19"/><polygon points="22 19 13 12 22 5 22 19"/></svg>
                                Back
                            </a>
                            <p>{{ $quiz->title }}</p>
                        </div>
                        <div class="frmc">
                            @if ($quiz->status === 'Draft')
                                <form action="addquestion/{{ $quiz->quiz_id }}" method="POST">
                                    @csrf
                                    <textarea name="question" placeholder="Question" required></textarea>

                                    <div class="lost">
                                        <label for="option_a">A:</label>
                                        <input type="text" name="option_a" placeholder="Option A" required>
                                    </div>
                                    <div class="lost">
                                        <label for="option_b">B:</label>
                                        <input type="text" name="option_b" placeholder="Option B" required>
                                    </div>
                                    <div class="lost">
                                        <label for="option_c">C:</label>
                                        <input type="text" name="option_c" placeholder="Option C" required>
                                    </div>
                                    <div class="lost">
                                        <label for="option_d">D:</label>
                                        <input type="text" name="option_d" placeholder="Option D" required>
                                    </div>

                                    <select name="answer" required>
                                        <option value="">Select Answer</option>
                                        <option value="option_a">A</option>
                                        <option value="option_b">B</option>
                                        <option value="option_c">C</option>
                                        <option value="option_d">D</option>
                                    </select>

                                    <button type="submit">Add Question</button>
                                </form>
                            @else
                                <form action="addquestion/{{ $quiz->quiz_id }}" method="POST">
                                    @csrf
                                    <textarea style="cursor: not-allowed;" name="question" placeholder="Question" disabled></textarea>

                                    <div class="lost">
                                        <label for="option_a">A:</label>
                                        <input style="cursor: not-allowed;" type="text" name="option_a" placeholder="Option A" disabled>
                                    </div>
                                    <div class="lost">
                                        <label for="option_b">B:</label>
                                        <input style="cursor: not-allowed;" type="text" name="option_b" placeholder="Option B" disabled>
                                    </div>
                                    <div class="lost">
                                        <label for="option_c">C:</label>
                                        <input style="cursor: not-allowed;" type="text" name="option_c" placeholder="Option C" disabled>
                                    </div>
                                    <div class="lost">
                                        <label for="option_d">D:</label>
                                        <input style="cursor: not-allowed;" type="text" name="option_d" placeholder="Option D" disabled>
                                    </div>

                                    <select style="cursor: not-allowed;" name="answer" disabled>
                                        <option value="">Select Answer</option>
                                        <option value="option_a">A</option>
                                        <option value="option_b">B</option>
                                        <option value="option_c">C</option>
                                        <option value="option_d">D</option>
                                    </select>

                                    <button style="cursor: not-allowed;" type="submit" disabled >Add Question</button>
                                </form>
                            @endif
                            

                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="rct col">
                        <div class="asd">
                            @if (session('deployed'))
                                <div class="alert alert-success">
                                    {{ session('deployed') }}
                                </div>
                            @endif
                            @if ($quiz->status === 'Ongoing')
                                <button class="depl" onclick="endModal()" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-stop-circle"><circle cx="12" cy="12" r="10"/><rect x="9" y="9" width="6" height="6"/></svg>
                                    End
                                </button>
                                <button class="depl" onclick="revertModal()" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-rotate-ccw"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/></svg>
                                    Revert
                                </button>
                            @elseif ($quiz->status === 'Draft')
                                <button class="depl" onclick="deployModal()" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                                    Deploy
                                </button>
                            @endif
                        </div>
                        <div class="questions">
                            @foreach ($questions as $index => $question)
                                <div class="qrow">
                                    <h3>{{ $index + 1 }}.) {{ $question->question }}</h3>
                                    <ul>
                                        <li @if($question->answer === 'option_a') style="color: green" @endif>
                                            A: {{ $question->option_a }}
                                        </li>
                                        <li @if($question->answer === 'option_b') style="color: green" @endif>
                                            B: {{ $question->option_b }}
                                        </li>
                                        <li @if($question->answer === 'option_c') style="color: green" @endif>
                                            C: {{ $question->option_c }}
                                        </li>
                                        <li @if($question->answer === 'option_d') style="color: green" @endif>
                                            D: {{ $question->option_d }}
                                        </li>
                                    </ul>
                                    <div class="ac">
                                        @if ($quiz->status === 'Ongoing')
                                            <button style="cursor: not-allowed;" onclick="editModal({{ $question->id }})" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </button>
                                            <button style="cursor: not-allowed;" onclick="deleteModal({{ $question->id }})" disabled>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                    <polyline points="3 6 5 6 21 6"/>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                </svg>
                                            </button>
                                        @elseif ($quiz->status === 'Draft')
                                            <button onclick="editModal({{ $question->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                            </button>
                                            <button onclick="deleteModal({{ $question->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                                    <polyline points="3 6 5 6 21 6"/>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                </svg>
                                            </button>
                                        @endif
                                        @if (session('edit') && session('edited_id') == $question->id)
                                            <div class="alert alert-success">
                                                {{ session('edit') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <footer>
        </footer>
    </main>
    <script>
        function deployModal() {
            document.getElementById('deployModalContainer').classList.remove('hidden');
        }

        function revertModal() {
            document.getElementById('revertModalContainer').classList.remove('hidden');
        }

        function endModal() {
            document.getElementById('endModalContainer').classList.remove('hidden');
        }

        function editModal(id) {
            // Fetch the data (AJAX or preload in page)
            fetch(`/teacher/getquestion/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('edit_question').value = data.question;
                    document.getElementById('edit_option_A').value = data.option_a;
                    document.getElementById('edit_option_B').value = data.option_b;
                    document.getElementById('edit_option_C').value = data.option_c;
                    document.getElementById('edit_option_D').value = data.option_d;
                    document.getElementById('edit_answer').value = data.answer;

                    document.getElementById('editForm').action = `/teacher/updatequestion/${id}`;
                    document.getElementById('editModalContainer').classList.remove('hidden');
                }
            );
        }

        function deleteModal(id) {
            const form = document.getElementById('deleteForm');
            form.action = `deletequestion/${id}`; // Set form action dynamically
            document.getElementById('deleteModalContainer').classList.remove('hidden'); // Show modal
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

    </script>

</body>
</html>

