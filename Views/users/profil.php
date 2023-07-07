<?= $title ?>

<!-- Affichage des annonces -->
<div class="container border border-secondary p-5">
    <div class="row justify-content-around">
        <?php foreach ($annonces as $key => $annonce) : ?>
            <div class="card" style="width: 18rem;">
                <img src="<?= SITEBASE ?>img/annonces/<?= $annonce['image'] ?>" class="card-img-top" alt="<?= $annonce['title'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $annonce['title'] ?>, categorie : <?= $annonce['titleCat'] ?></h5>
                    <p class="card-text"><?= $annonce['description'] ?></p>
                    <p><?= $annonce['price'] ?> €</p>
                    <a href="annonceModif?id=<?= $annonce['id_annonce'] ?>" class="btn btn-warning">Modifier</a>
                    <a href="annonceSupp?id=<?= $annonce['id_annonce'] ?>" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>