<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - <?= htmlspecialchars($title) ?></title>
        <link rel="stylesheet" href="{{asset ('css/std.css')}}">
        <link rel="stylesheet" href="{{asset ('css/mainpage.css')}}">
        <link rel="stylesheet" href="{{asset ('css/std_control.css')}}">
        <link rel="stylesheet" href="{{asset ('css/usercontrol.css')}}">
        <link rel="stylesheet" href="{{ asset('css/results.css') }}">
        <link rel="stylesheet" href="{{ asset('css/std.pdf.css') }}">
    </head>
    <body style="height: calc(100% - 61px);">
        <main>
            <header> 
                <div class="ahh">
                    <img src="../../../Imgs/DARA.png" alt="DARA Logo" class="ahh">
                </div>
            </header>

            <div class="main" style="height: 100%;">
                <div class="left">
                    <div class="profile">
                        <h2>{{ auth()->user()->first_name }}</h2>
                    </div>

                    <nav class="nav-links">
                        <a href="/admin"> 
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
                        <a href="/admin/user-control">
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
                                class="feather feather-users"
                                >
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                            Manage Users
                        </a>

                        <a href="/admin/storage">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
                                <ellipse cx="12" cy="5" rx="9" ry="3"/>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                            </svg>

                            Storage
                        </a>

                        <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                            <div class="asd3" style="border-bottom: 1px solid rgb(0, 0, 0, 0.2); width: 150px;"></div>
                        </div>

                        <a href="/" class="unq">Search Studies</a>
                        <a href="/admin/edit" class="unq">Edit Account</a>
                        <a href="/admin/recovery" class="unq">Recovery</a>

                        <div class="asd2" style=" width: 100%; 10px; display: flex; justify-content: center;">
                            <div class="asd3" style="border-bottom: 1px solid rgb(0, 0, 0, 0.2); width: 150px;"></div>
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

                <div class="right" style="overflow-x: hidden; padding: 20px; display: flex; width: 100%;" >
                    @include('layouts.pdf')
                </div>
            </div>
        </div>
            <footer>
            </footer>
        </main>
    </body>
</html>

<script src="{{ asset('js/docu.js') }}"> </script>
<script>
    function confirmAction(form) {
        if (confirm('Are you sure you want to mark this request as Done?')) {
            form.submit();
        } else {
            return false;
        }
    }
</script>