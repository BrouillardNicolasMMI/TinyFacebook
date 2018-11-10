<div class="align">

    <div class="grid">

        <form action="index.php?action=connexion" method="POST" class="form login">

            <div class="form__field">
                <label for="login__username"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Username</span></label>
                <input id="login__username" type="text" name="login" class="form__input" placeholder="Nom d'utilisateur" required>
            </div>

            <div class="form__field">
                <label for="login__password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
                <input id="login__password" type="password" name="mdp" class="form__input" placeholder="Mot de passe" required>
            </div>

            <div class="form__field">
                <input type="submit" value="Se connecter">
            </div>

        </form>

        <p class="text--center">Pas encore membre ? <a href="index.php?action=create">S'inscrire</a> <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="assets/images/icons.svg#arrow-right"></use></svg></p>
    </div>
</div>
