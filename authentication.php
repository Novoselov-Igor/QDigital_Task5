<?php
require 'doctype.php';
?>

<div class="d-flex h-100 align-items-center justify-content-center col-lg-4 m-auto">
    <form action="functions/checkUser.php" method="post">
        <h1 class="text-center h3 mb-3 fw-normal">Авторизация/Регистрация</h1>

        <div class="form-floating mb-1">
            <input type="text" class="form-control" name="login" id="floatingInput" placeholder="Логин" required>
            <label for="floatingInput">Логин</label>
        </div>
        <div class="form-floating mb-1">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password"
                   required minlength="6">
            <label for="floatingPassword">Пароль</label>
        </div>

        <button class="mt-3 w-100 btn btn-primary py-2" type="submit">Войти/Зарегистрироваться</button>
    </form>
</div>
