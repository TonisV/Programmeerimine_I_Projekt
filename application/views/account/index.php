<div class="container">
    <div class="login-form">
        <form action="<?= APP_URL ?>?controller=account&action=login" method="post">
            <div class="row">
                <div class="col-4">
                    <input id="user_name" type="text" name="user_name" placeholder="Kasutaja" required>
                </div>
                <div class="col-4">
                    <input id="password" type="password" name="user_password" placeholder="Salasõna" required>
                </div>
            </div>
            <input class="button  button-login" type="submit" value="Logi sisse">
        </form>
    </div>
</div>