<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Teacher Dashboard</title>
    <link rel="stylesheet" href="{{ asset ('css/std.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/mainpage.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/std_control.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/svg.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/addqz.css') }}">
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
                    <h2> {{ auth()->user()->first_name }} </h2> <!-- Display student's username -->
                    
                </div>

                <nav class="nav-links">
                    <a href="" style="color: #04128e; font-weight: normal;"> 
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
                    <a href="teacher/review-quizzes">
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
 
            <div class="right" style="height: 100%; overflow: auto;">

                <div class="asdmodal hidden open-modal">
                    <div id="approveModal" class="modal">
                        <div class="modal-content">
                            <h2>What quiz are we adding?</h2>
                            <div class="modal-actions">
                                <form action="teacher/addquiz" method="POST">
                                    @csrf
                                    <input type="text" name="title" placeholder="Quiz Title">
                                    <div class="txtr">
                                        <textarea name="description" placeholder="Description (Optional)"></textarea>
                                    </div>
                                    <input type="number" name="duration" placeholder="Duration (Minutes)">
                                    <div class="btnsz">
                                        <button type="submit" class="batan confirm">Confirm</button>
                                        <button type="button" class="batan cancel" onclick="closeAnyModal()">Cancel</button>
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
                                <form id="editForm" method="POST">
                                    @csrf
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" id="title" required>
                                    
                                    <label for="description">Description:</label>
                                    <textarea name="description" id="description" placeholder="Description" required></textarea>

                                    <label for="duration">Duration:</label>
                                    <input type="number" name="duration" id="duration" required>

                                    <div class="btnsz">
                                        <button type="submit" class="batan confirm">Update</button>
                                        <button type="button" class="batan cancel" onclick="closeModal('editModalContainer')">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="asdmodal hidden" id="deleteModalContainer">
                    <div class="modal">
                        <div class="modal-content">
                            <h2>Delete Quiz</h2>
                            <p>This action cannot be undone.</p>
                            <form id="deleteForm" method="POST">
                                @csrf
                                <div class="btnsz">
                                    <button type="submit" class="batan confirm">Delete</button>
                                    <button type="button" class="batan cancel" onclick="closeModal('deleteModalContainer')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="dt">
                    <button type="button" onclick="abli()" >
                        <span>
                            ADD
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
                    </button>
                </div>
                <div class="db">
                    @if(session('success'))
                        <div class="dbh">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="dbtb">
                        @forelse($quizzes as $quiz)
                            <div class="row">
                                <div class="rt">
                                    @if ($quiz->status === 'Draft')
                                        <svg style="color: orange;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-codepen">
                                            <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2"/>
                                            <line x1="12" y1="22" x2="12" y2="15.5"/>
                                            <polyline points="22 8.5 12 15.5 2 8.5"/>
                                            <polyline points="2 15.5 12 8.5 22 15.5"/>
                                            <line x1="12" y1="2" x2="12" y2="8.5"/>
                                        </svg>
                                        <a href="teacher/quiz/{{ $quiz->quiz_id }}">{{ $quiz->title }}</a>
                                        <svg class="hey" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal">
                                            <circle cx="12" cy="12" r="1"/>
                                            <circle cx="19" cy="12" r="1"/>
                                            <circle cx="5" cy="12" r="1"/>
                                        </svg>
                                    @else   
                                        <svg style="color: green;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-play"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                                        <a href="teacher/quiz/{{ $quiz->quiz_id }}">{{ $quiz->title }}</a>
                                    @endif
                                </div>

                                <div class="rd">
                                    {{ $quiz->description }}
                                </div>
                                <div class="ac">
                                    <button onclick="editModal({{ $quiz->quiz_id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </button>
                                    <button onclick="deleteModal({{ $quiz->quiz_id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                            <polyline points="3 6 5 6 21 6"/>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="asd12">
                                Empty
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>

        <footer>
        </footer>
    </main>
    <script>
        function editModal(id) {
            fetch(`/teacher/getquiz/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('title').value = data.title;
                    document.getElementById('description').value = data.description;
                    document.getElementById('duration').value = data.duration;

                    document.getElementById('editForm').action = `/teacher/updatequiz/${id}`;
                    document.getElementById('editModalContainer').classList.remove('hidden');
                }
            );
        }

        function abli() {
            document.querySelector('.asdmodal').classList.remove('hidden');
        }

        function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
        }

        function closeAnyModal() {
            document.querySelector('.asdmodal').classList.add('hidden');
        }

        function deleteModal(id) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/teacher/deletequiz/${id}`; // dynamic route
            document.getElementById('deleteModalContainer').classList.remove('hidden');
        }

        function editModal(id) {
            fetch(`/teacher/getquiz/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('title').value = data.title;
                    document.getElementById('description').value = data.description;
                    document.getElementById('duration').value = data.duration;

                    document.getElementById('editForm').action = `/teacher/updatequiz/${id}`;
                    document.getElementById('editModalContainer').classList.remove('hidden');
                });
        }

    </script>

</body>
</html>