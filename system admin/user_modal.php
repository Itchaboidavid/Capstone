<!-- MODAL ADD ADVISER -->
<div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-light">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Registration form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <form action="add_user.php" method="POST" class="needs-validation" novalidate>
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="name" placeholder="name" class="form-control bg-body-tertiary" required />
                        <label for="name">Name</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a name.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="username" id="username" placeholder="username" class="form-control bg-body-tertiary" required />
                        <label for="username">Username</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a username.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" id="password" placeholder="password" class="form-control bg-body-tertiary" required />
                        <label for="password">Password</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please enter a password.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select bg-body-tertiary" name="user_type" id="user_type">
                            <option value="" selected>User type</option>
                            <option value="adviser">Adviser</option>
                            <option value="clinic staff">Clinic staff</option>
                            <option value="human resources">Human Resources</option>
                            <option value="registrar">Registrar</option>
                        </select>
                        <label for="user_type">User type</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please select type of user.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select bg-body-tertiary" name="status" id="status">
                            <option value="" selected>Status</option>
                            <option value="active" class="text-success">Active</option>
                            <option value="disabled" class="text-danger">Disabled</option>
                        </select>
                        <label for="status">Status</label>
                        <div class="valid-feedback ps-1">Great!</div>
                        <div class="invalid-feedback ps-1"> Please select the status.</div>
                    </div>
                    <div class="mt-4 me-auto">
                        <input type="submit" value="Register" class="btn btn-primary" name="submit">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>