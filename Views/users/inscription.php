<?= $title ?>



<div class="container">
<?php if($errMsg !=""): ?>
        <div class="alert alert-danger">
            <p><?php echo $errMsg; ?></p>
        </div>
    <?php endif; ?> 
<form method="POST">
        <div class="row justify-content-around my-2">
            <div class="col-12 col-md-4">
                <label for="login">Email</label>
                <input type="text" name="login" id="email" placeholder="Votre email" class="form-control">
            </div>
            <div class="col-12 col-md-3">
                <label for="firstname">Prénom</label>
                <input type="text" name="firstname" id="firstname" placeholder="Votre prénom" class="form-control">
            </div>
            <div class="col-12 col-md-3">
                <label for="lastname">Nom</label>
                <input type="text" name="lastname" id="lastname" placeholder="Votre Nom" class="form-control">
            </div>
        </div>
        <div class="row justify-content-around my-2">
            <div class="col-12 col-md-4">
                <label for="address">Adresse</label>
                <input type="text" name="adress" id="adress" placeholder="Votre adresse" class="form-control">
            </div>
            <div class="col-12 col-md-3">
                <label for="cp">Code Postal</label>
                <input type="text" name="cp" id="cp" placeholder="Votre code postal" class="form-control">
            </div>
            <div class="col-12 col-md-3">
                <label for="city">Ville</label>
                <input type="text" name="city" id="city" placeholder="Votre Ville" class="form-control">
            </div>

            <div class="col-12 col-md-3">
                <label for="phone">Telephone</label>
                <input type="text" name="phone" id="phone" placeholder="Votre telephone" class="form-control">
            </div>
        </div>
        <div class="row justify-content-around my-5">
            <div class="col-12 col-md-4">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control">
                <small id="passwordHelp" class="form-text text-muted">Votre mot de passe doit contenir 8 caractères minimum</small>
            </div>
            <div class="col-12 col-md-4">
                <label for="confirm">Confirmation de mot de passe</label>
                <input type="password" name="confirm" id="confirm" placeholder="Confirmez votre mot de passe" class="form-control">
            </div>
        </div>
        <button class="btn btn-secondary w-100">S'inscrire</button>
    </form>
</div>
</div>