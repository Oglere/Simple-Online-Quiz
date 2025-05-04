<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Account Recovery</title>
        <link rel="stylesheet" href="{{ asset('CSS/std.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/mainpage.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/std_control.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/usercontrol.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <main>
            <header> 
                <div class="ahh">
                    <img src="../Imgs/DARA.png" alt="DARA Logo" class="ahh">
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
                        <a href="user-control">
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

                        <div class="asd2" style=" width: 100%; margin-top: 10px; display: flex; justify-content: center;">
                            <div class="asd3" style="border-bottom: 1px solid rgb(0, 0, 0, 0.2); width: 150px;"></div>
                        </div>

                        <a href="edit" class="unq">Edit Account</a>
                        <a href="" style="color: #8e0404; font-weight: normal;" class="unq">Recovery</a>

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

                <div class="right" style="overflow: auto; padding: 20px;">
                    <div id="user-list" >
                        <div class="actions">
                            <div class="filter-group">
                                <input type="text" id="search-bar" placeholder="Search users by name or email..." oninput="filterUsers()">
                                <button class="btn-primary filter-btn" data-role="all">All</button>
                                <button class="btn-secondary filter-btn" data-role="Admin">Admins</button>
                                <button class="btn-secondary filter-btn" data-role="Teacher">Teachers</button>
                                <button class="btn-secondary filter-btn" data-role="Student">Students</button>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="display: none;">ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($org as $organization)
                                    <tr 
                                        style="color: 
                                            {{ $organization->role === 'Admin' ? '#8e0404' : ($organization->role === 'Teacher' ? '#04128e' : 'green') }};" 
                                        data-id="{{ $organization->user_id }}"
                                    >
                                        <td style="display: none;">{{ $organization->user_id }}</td>
                                        <td>{{ $organization->first_name }}</td>
                                        <td>{{ $organization->last_name }}</td>
                                        <td>{{ $organization->email }}</td>
                                        <td>{{ $organization->role }}</td>
                                        <td>{{ $organization->status }}</td>
                                        <td>
                                            <button class="recover-btn" data-id="{{ $organization->user_id }}">Recover</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="recover-modal" class="modal hidden">
                        <div class="modal-content">
                            <form id="recover-user-form" action="" method="POST">
                                @csrf
                                <h2>Recover this account?</h2>
                                <p id="really"></p>
                                <div class="botoning">
                                    <button id="confirm-recover" class="sab">Recover</button>
                                    <button type="button" id="cancel-delete" class="nac">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="overlay hidden"></div>

            </div>
        </div>
            <footer>
            </footer>
        </main>
    </body>
</html>

<script>
    function filterUsers(role = "all") {
        const searchQuery = document.getElementById("search-bar").value.toLowerCase();
        const rows = document.querySelectorAll("tbody tr");

        rows.forEach((row) => {
            const name = `${row.children[1].textContent.toLowerCase()} ${row.children[2].textContent.toLowerCase()}`;
            const email = row.children[3].textContent.toLowerCase();
            const userRole = row.children[4].textContent.toLowerCase();

            const matchesSearch =
            name.includes(searchQuery) || email.includes(searchQuery);
            const matchesRole = role === "all" || userRole === role.toLowerCase();

            row.style.display = matchesSearch && matchesRole ? "" : "none";
        });
    }

    document.querySelectorAll(".filter-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const role = button.getAttribute("data-role");
            filterUsers(role);

            document.querySelectorAll(".filter-btn").forEach((btn) => {
            btn.classList.replace("btn-primary", "btn-secondary");
            });
            button.classList.replace("btn-secondary", "btn-primary");
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        const recoverModal = document.getElementById("recover-modal");
        const confirmRecover = document.getElementById("confirm-recover");
        const cancelRecover = document.getElementById("cancel-delete");
        let currentUserId = null;

        document.querySelectorAll(".recover-btn").forEach((button) => {
            button.addEventListener("click", () => {
                document.querySelector(".overlay").classList.remove("hidden");
                currentUserId = button.getAttribute("data-id");
                document.getElementById("recover-user-form").action = `recovery/${currentUserId}`;
                recoverModal.classList.remove("hidden");

                let row = button.closest("tr");
                let firstName = row.children[1].textContent.trim(); 
                let lastName = row.children[2].textContent.trim(); 
                let currentUserName = firstName + " " + lastName;
                    
                document.getElementById("really").innerHTML = "Are you sure you want to recover this user? (" + currentUserName + ")</strong>";
            });
        });

        cancelRecover.addEventListener("click", () => {
            document.querySelector(".overlay").classList.add("hidden");
            recoverModal.classList.add("hidden");
            currentUserId = null;
        });
    });
</script>
