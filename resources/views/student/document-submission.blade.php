<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('../../css/mainpage.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/std.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/submit.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/yey.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/svg.css') }}">
</head>
<body>
    <main>
        <header> 
            <div class="ahh">
                <img src="../../Imgs/DARA.png" alt="" class="ahh">
            </div>
        </header>
        
        <div class="main" style="height: 100%; overflow: hidden;">
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

                        Dashboard
                    </a>
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
                            class="feather feather-file-plus"
                            >
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="12" y1="18" x2="12" y2="12" />
                            <line x1="9" y1="15" x2="15" y2="15" />
                        </svg>
                    
                        Submit Studies
                    </a>
                    <a href="document-status">
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
                            class="feather feather-eye"
                            >
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>

                        View Study Status
                    </a>

                    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 150px;"></div>
                    </div>
 
                    <a href="/" class="unq">Search Studies</a>
                    <a href="/student/edit" class="unq">Edit Account</a>

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

            <div class="right">
                <div class="frbg">
                    <div class="notif">
                        <div class="imghere">
                            <img src="../../imgs/review.png" alt="" />
                        </div>
                        <div
                            class="teksto"
                            style="display: flex; margin-top: -16px; text-align: center"
                        >
                            <p>
                            Submitted <br />
                            Succesfully!
                            </p>
                        </div>
                    </div>
                </div>

                <h1 style="font-weight: lighter;">SUBMIT A DOCUMENT</h1>
                <form id="documentForm" method="post" enctype="multipart/form-data" action="submit">
                    @csrf
                    Title: <input type="text" name="title" required><br>
                    Abstract: <textarea name="abstract" required></textarea><br>
                    Co-Authors (comma-separated): <input type="text" name="co_authors"><br>
                    Keywords: <input type="text" name="keywords"><br>
                    Teacher: 
                    <select name="teacher_id" required>
                        <option id="teachers" value="empty">Select a Teacher</option>
                        @foreach ($teacher as $t)
                            <option value="{{ $t->user_id }}">{{ $t->first_name }} {{ $t->last_name }}</option>
                        @endforeach
                    </select><br>
                    Publication Date: <input type="date" name="publication_date"><br>
                    Citations (comma-separated): <input type="text" name="citations"><br>

                    <div class="container">
                        <div class="card"> 
                            <h3>Upload File</h3> 
                            <div class="drop_box">
                                <div class="header">
                                    <h4>Select File here</h4>
                                </div>
                                <p>Files Supported: PDF</p>
                                <input type="file" name="file" accept=".pdf" id="fileID" style="display:none;" required>
                                <button class="sbt" type="button" class="btn" id="chooseFileBtn">Choose File</button>
                                <p id="fileNameDisplay" style="color: red;"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                        <div class="asd3" style="border-bottom: 1px solid grey; width: 100%; margin-bottom: 20px;"></div>
                    </div>

                    <div class="checkboxes">
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="Case Study">
                            <label class="tada">Case Study</label> 
                        </div>
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="Thesis">
                            <label class="tada">Thesis</label>
                        </div>
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="Proposal">
                            <label class="tada">Proposal</label>
                        </div>
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="Capstone">
                            <label class="tada">Capstone</label>
                        </div>
                        <div class="chkbx">
                            <input class="w3-check" type="checkbox" name="document_types[]" value="System Studies">
                            <label class="tada">System Studies</label>
                        </div>
                    </div>
                    <button class="sbt" type="submit" id="submitButton" disabled>Submit</button>
                    <div id="alrt" style="color: red; margin-top: 10px; text-align: center;"></div>
                </form>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const alrt = document.getElementById('alrt');
                        const chooseFileBtn = document.getElementById("chooseFileBtn");
                        const inputFile = document.getElementById("fileID");
                        const fileNameDisplay = document.getElementById("fileNameDisplay");
                        const submitButton = document.getElementById("submitButton");
                        const checkboxes = document.querySelectorAll('.chkbx input'); 
                        const card = document.getElementsByClassName('card');
                        const teachers = document.getElementById('teachers');

                        chooseFileBtn.addEventListener("click", () => {
                            inputFile.click();
                        });

                        inputFile.addEventListener("change", function () {
                            const file = this.files[0];
                            if (file && file.type === "application/pdf") {
                                document.querySelectorAll('.card').forEach(card => {
                                    card.style.backgroundColor = 'white';
                                });
                                fileNameDisplay.style.color = 'green';
                                fileNameDisplay.innerHTML = `${file.name}`;
                                submitButton.disabled = false;
                            } else {
                                document.querySelectorAll('.card').forEach(card => {
                                    card.style.backgroundColor = '#ffcdcd';
                                });
                                fileNameDisplay.textContent = "No valid file selected";
                                this.value = "";
                                submitButton.disabled = true;
                            }
                        });

                        checkboxes.forEach(chkbx => {
                            chkbx.addEventListener('click', (e) => {
                                if (e.target.tagName !== 'INPUT') {
                                    const checkbox = chkbx.querySelector('input[type="checkbox"]');
                                    checkbox.checked = !checkbox.checked;
                                }
                                
                                const checkbox = chkbx.querySelector('input[type="checkbox"]');
                                chkbx.style.backgroundColor = checkbox.checked ? '#04128e' : ''; 
                                
                                const label = chkbx.querySelector('label');
                                label.style.color = checkbox.checked ? 'white' : '';
                            });
                            
                        });

                        document.getElementById("documentForm").addEventListener("submit", function (event) {
                            if (!inputFile.files[0] || inputFile.files[0].type !== "application/pdf") {
                                event.preventDefault();
                                alert("Please upload a valid PDF file.");
                                return;
                            }

                            let checkboxSelected = false;
                            checkboxes.forEach(checkbox => {
                                if (checkbox.checked) {
                                    checkboxSelected = true;
                                }
                            });

                            if (!checkboxSelected) {
                                event.preventDefault();
                                alrt.textContent = "Input all fields";
                                hasError = true;
                            }
                        });
                    });

                const checkboxes = document.querySelectorAll('.chkbx');

                checkboxes.forEach(chkbx => {
                    chkbx.addEventListener('click', (e) => {
                        if (e.target.tagName !== 'INPUT') {
                            const checkbox = chkbx.querySelector('input[type="checkbox"]');
                            checkbox.checked = !checkbox.checked;
                        }
                        
                        const checkbox = chkbx.querySelector('input[type="checkbox"]');
                        chkbx.style.backgroundColor = checkbox.checked ? '#04128e' : ''; 
                        
                        const label = chkbx.querySelector('label');
                        label.style.color = checkbox.checked ? 'white' : '';
                    });
                });

                @if (session('success'))
                    document.addEventListener('DOMContentLoaded', function() {
                        const frbg = document.querySelector('.frbg');

                        frbg.style.visibility = 'hidden';
                        setTimeout(() => {
                            frbg.classList.add('fade-in');
                            frbg.style.visibility = 'visible';
                        }, 100);

                        setTimeout(() => {
                            frbg.classList.remove('fade-in');
                            frbg.classList.add('fade-out');
                        }, 2000);

                        setTimeout(() => {
                            frbg.style.visibility = 'hidden';
                            frbg.classList.remove('fade-out');
                        }, 2500);
                    });
                @endif

                </script>
            </div>
        </div>

        <footer>
        </footer>
    </main>
</body>
</html>

