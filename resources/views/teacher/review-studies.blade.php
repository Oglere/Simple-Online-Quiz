

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DARA - Review Studies</title>
    <link rel="stylesheet" href="{{ asset ('css/std.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/mainpage.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/std_control.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/tch.pdf.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/notif.css')}}">
    <link rel="stylesheet" href="{{ asset ('css/usercontrol.css')}}">
    <link rel="stylesheet" href="{{ asset ('css/svg.css') }}">
</head>
<body style="height: calc(100%)">
    <main>
        <header> 
            <div class="ahh">
                <img src="../../Imgs/DARA.png" alt="" class="ahh">
            </div>
        </header>
         
        <div class="main" style="height: calc(100% - 61px)">
            <div class="left">
                <div class="profile">
                    <h2> {{ auth()->user()->first_name }} </h2> 
                    
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
 
            <div class="right" style="overflow-x: auto; height: 100%;"></div>
            
        </div>
    </main>
</body>
</html>

<script src="{{ asset('js/notif.js') }}"> </script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Toggle dropdown
        document.querySelectorAll('.chd').forEach(chd => {
            const toggleBtn = chd.querySelector('.asd');
            const dropdown = chd.querySelector('.dropdown');

            toggleBtn.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent the event from bubbling up
                // Hide other open dropdowns
                document.querySelectorAll('.dropdown').forEach(d => {
                    if (d !== dropdown) d.classList.add('hidden');
                });
                dropdown.classList.toggle('hidden');
            });
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        });
    });
</script>