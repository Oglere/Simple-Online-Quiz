@if ($errors->getBag('createErrors')->any())
    <script>
        alert(`{!! implode('\n', $errors->getBag('createErrors')->all()) !!}`);
    </script>
@endif

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - User Control</title>
        <link rel="stylesheet" href="{{ asset('CSS/std.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/mainpage.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/std_control.css') }}">
        <link rel="stylesheet" href="{{ asset('CSS/usercontrol.css') }}">
        <link rel="stylesheet" href="{{ asset('../../css/yey.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body style="overflow: hidden; height: calc(100% - 61px)">
        <main>
            <header> 
                <div class="ahh">
                    <img src="../../Imgs/DARA.png" alt="DARA Logo" class="ahh">
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
                        <a href="recovery" class="unq">Recovery</a>

                        <div class="asd2" style=" width: 100%; display: flex; justify-content: center;">
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

                @if (session('success'))
                    <div class="frbg" style="height: auto;">
                        <div class="notif" style="display: flex; flex-direction: column; align-items: center;">
                            <div class="imghere">
                                <img src="../../imgs/verified-account.png" alt="" />
                            </div>
                            <div
                                class="teksto"
                                style="display: flex; margin-top: -16px; text-align: center"
                            >
                            </div>
                        </div>
                    </div>
                @endif
                    
                <div id="add-user-form" class="{{ $errors->getBag('createErrors')->any() ? '' : 'hidden' }}">

                        <h2>Add New User</h2>
                        <form id="user-form" method="post" action="create">
                            @csrf
                            <div class="suloda">
                                <div class="form-group">
                                    <label for="first-name">First Name</label>
                                    <input type="text" id="first-name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Last Name</label>
                                    <input type="text" id="last-name" name="last_name" required>
                                </div> 
                                <div class="form-group">
                                    <label for="password_hash">Password</label>
                                    <input type="password" id="pass" name="password_hash" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select id="role" name="role" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input style="display: none;" name="status" value="Active" required>
                            </div>
                            <div class="botoning">
                                <button class="sab">Add</button>
                                <button type="button" class="nac" id="cancel-add">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="overlay {{ $errors->getBag('createErrors')->any() ? '' : 'hidden' }}"></div>

                    <div id="user-list">
                        <div class="actions">
                            <div class="filter-group">
                                <input type="text" id="search-bar" placeholder="Search users by name or email..." oninput="filterUsers()">
                                <div class="aridiri">
                                    <button class="btn-primary filter-btn" data-role="all">All</button>
                                    <button class="btn-secondary filter-btn" data-role="Admin">Admins</button>
                                    <button class="btn-secondary filter-btn" data-role="Teacher">Teachers</button>
                                    <button class="btn-secondary filter-btn" data-role="Student">Students</button>
                                </div>
                            </div>
                            <button id="add-user-btn" class="adda">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="22"
                                    height="22"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-user-plus"
                                    >
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="8.5" cy="7" r="4" />
                                    <line x1="20" y1="8" x2="20" y2="14" />
                                    <line x1="23" y1="11" x2="17" y2="11" />
                                </svg>

                                Add New User
                            </button>
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
                                        <button class="edit-btn" data-id="{{ $organization->user_id }}">Edit</button>
                                        <button class="delete-btn" data-id="{{ $organization->user_id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="delete-modal" class="modal hidden">
                        <div class="modal-content">
                            <form id="delete-user-form" method="POST" action="">
                                @csrf
                                <h2>Confirm Deletion</h2>
                                <p>Are you sure you want to delete this user?</p>
                                
                                <input type="hidden" id="delete-user-id" name="user_id">

                                <div class="botoning">
                                    <button type="submit" id="confirm-delete" class="sab">Delete</button>
                                    <button type="button" id="cancel-delete" class="nac">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
    
                        @if ($errors->getBag('editErrors')->any())
                            <div id="edit-modal" class="tree">
                            <form method="POST" action="" id="edit-user-form" class="asdasd" data-user-id="USER_ID_PLACEHOLDER">
                                @csrf
                                <input type="hidden" id="edit-user_id" name="user_id" required>

                                <label style="margin-bottom: 5px;" for="edit-first_name">First Name</label>
                                <input type="text" id="edit-fname" name="first_name" required>

                                <label style="margin-bottom: 5px;" for="edit-last_name">Last Name</label>
                                <input type="text" id="edit-lname" name="last_name" required>

                                <label style="margin-bottom: 5px;" for="edit-email">Email</label>
                                <input type="email" id="edit-email" name="email" required>

                                <label style="margin-bottom: 5px;" for="edit-password_hash">Password (leave blank to keep current password)</label>
                                <input id="edit-password" name="password_hash">

                                <label style="margin-bottom: 5px;" for="edit-role">Role</label>
                                <select id="edit-role" name="role" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>

                                <label for="edit-status" style="margin-bottom: 5px;">Status</label>

                                <select id="edit-status" name="status" required>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>

                                <div class="botoning">
                                    <button type="submit" class="sab">Save</button>
                                    <button type="button" id="cancel-edit" class="nac">Cancel</button>
                                </div>
                            </form>
                        @else
                            <div id="edit-modal" class="hidden tree">
                            <form method="POST" action="" id="edit-user-form" class="asdasd" data-user-id="USER_ID_PLACEHOLDER">
                                @csrf
                                <input type="hidden" id="edit-user_id" name="user_id" required>

                                <label style="margin-bottom: 5px;" for="edit-first_name">First Name</label>
                                <input type="text" id="edit-fname" name="first_name" required>

                                <label style="margin-bottom: 5px;" for="edit-last_name">Last Name</label>
                                <input type="text" id="edit-lname" name="last_name" required>

                                <label style="margin-bottom: 5px;" for="edit-email">Email</label>
                                <input type="email" id="edit-email" name="email" required>

                                <label style="margin-bottom: 5px;" for="edit-password_hash">Password (leave blank to keep current password)</label>
                                <input id="edit-password" name="password_hash">

                                <label style="margin-bottom: 5px;" for="edit-role">Role</label>
                                <select id="edit-role" name="role" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                    @endforeach
                                </select>

                                <label for="edit-status" style="margin-bottom: 5px;">Status</label>

                                <select id="edit-status" name="status" required>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>

                                <div class="botoning">
                                    <button type="submit" class="sab">Save</button>
                                    <button type="button" id="cancel-edit" class="nac">Cancel</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

            </div>
        </div>
            <footer>
            </footer>
        </main>
    </body>
</html>

<script src="{{ asset('js/usercontrol.js') }}"> </script>
<script>
    function updateUSR(userId) {
        let form = document.getElementById("edit-user-form");
        form.action = "/edit/" + userId;
        form.submit();
    }

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

    @if ($errors->getBag('editErrors')->any() && session('editUserId'))
        let errorMessages = @json($errors->getBag('editErrors')->all()).join('\n');
        alert(errorMessages);

        document.addEventListener('DOMContentLoaded', function () {
            const userId = '{{ session('editUserId') }}';
            const editBtn = document.querySelector(`.edit-btn[data-id="${userId}"]`);
            if (editBtn) {
                editBtn.click(); 
            }

            document.getElementById('edit-user_id').value = userId;
            document.getElementById('edit-fname').value = '{{ old('first_name') }}';
            document.getElementById('edit-lname').value = '{{ old('last_name') }}';
            document.getElementById('edit-email').value = '{{ old('email') }}';
            document.getElementById('edit-role').value = '{{ old('role') }}';
            document.getElementById('edit-status').value = '{{ old('status') }}';
        });
    @endif
</script>

