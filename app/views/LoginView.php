<?php

include_once 'header.php';

?>

<div class="row">
    <div class="col-12">

        <form action="index.php?url=LoginController/login/" method="POST">

            <div class="row form-group">
                <div class="col-12">
                    <label for="nick_email">Nickname o email (*)</label>
                    <input type="text" name="nick_email" class="form-control" id="nick_email" />
                </div>
            </div>

            <div class="row form-group">
                <div class="col-12">
                    <label for="pass">Contraseña (*)</label>
                    <input type="password" name="pass" class="form-control" />
                </div>
            </div>

            <div class="row form-group">
                <div class="col-12">
                    <label for="remember">Recordar usuario</label>
                    <input type="checkbox" name="remember" id="remember">
                </div>
            </div>

            <div class="row form-group">
                <div class="col-6">
                    <button type="submit" name="action" class="btn btn-primary btn-block">Login</button>
                </div>
                <div class="col-6">
                    <button type="submit" name="back" class="btn btn-primary btn-block">Volver</button>
                </div>
            </div>

        </form>

    </div>
</div>





<?php

include_once 'footer.php';

?>