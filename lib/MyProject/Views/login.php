<div id="content" class="d-flex justify-content-center">
    <form id="login-form" method="POST" action="/login">
        <div class="mb-3">
            <label for="email" class="form-label required">Email</label>
        <input required type="email" class="form-control" id="email" name=data[email]>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label required">Password</label>
            <input required type="password" class="form-control" id="password" name=data[password]>
        </div>
        <input type="text" id="url" name="url" value="/login">
        <button type="submit" class="btn btn-secondary">Connexion</button>
    </form>
</div>