<style>
    .VYI { 
        display: none; 
    }
</style>

<h2>Edit Your Account</h2>

<div class="HiOy">
    <form id="edit-account-form" method="post" action="update-acc/{{$user->user_id}}">
        @csrf
        <div class="tanawara">
            <div class="kilidra">
                <label for="edit_first_name">Edit First Name</label>
                <input type="text" id="first_name" name="first_name" value="{{$user->first_name}}">
            </div>
        </div>

        <div class="tanawara">
            <div class="kilidra">
                <label for="edit_last_name">Edit Last Name</label>
                <input type="text" id="last_name" name="last_name" value="{{$user->last_name}}">
            </div>
        </div>

        <div class="tanawara">
            <div class="kilidra">
                <label for="edit_email">Edit Email</label>
                <input type="email" id="email" name="email" value="{{$user->email}}">
            </div>
        </div>

        <div class="tanawara">
            <div class="kilidra">
                <label for="password_hash">New Password (leave blank to keep current password)</label>
                <input type="password" id="password" name="password_hash" placeholder="Enter new password">
            </div>
        </div>

        <div class="botoning">
            <button class="sab">Update Account</button>
            <button type="button" class="nac" onClick="history.back()">Cancel</button>
        </div>
    </form>
</div>