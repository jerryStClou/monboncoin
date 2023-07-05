<?php
//  echo $annonces;
?>

<h1 class="text-center"><?= $title ?></h1>


<!-- Formulaire de tri et filtre -->
<div>
<form method="GET" class="row justify-content-around mb-5">
        <!-- Filtre par categorie -->
        <div class="m-2 col-12 col-md-4">
            <label for="">Filtrer par catégories</label>
            <select name="id_categorie" id="categorie" class="form-select">
                <option value="">Toutes les catégories</option>
                <?php foreach($categories as $categorie): ?>
                    <option value="<?= $categorie['id_categorie'] ?>"><?= $categorie['title'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <!-- Tri par prix  -->
        <div class="m-2 col-12 col-md-4">
            <label for="">Trier par prix</label>
            <select name="price" id="price" class="form-select">
                <option value="price ASC">Prix Ascendant</option>
                <option value="price DESC">Prix Descendant</option>
            </select>
        </div>
        <button class="btn btn-secondary">Trier</button>
    </form>
</div>


<!-- Affichage des annonces -->
<div class="container border border-secondary p-5">
    <div class="row justify-content-around">
        <?php foreach($annonces as $key => $annonce): ?>
            <div class="card" style="width: 18rem;">
                <img src="<?= SITEBASE ?>images/annonces/<?= $annonce['image'] ?>" class="card-img-top" alt="<?= $annonce['title'] ?>">
                <div class="card-body">
                
                    <h5 class="card-title"><?= $annonce['title'] ?>, categorie : <?= $annonce['titleCat'] ?></h5>
                    <p class="card-text"><?= $annonce['description'] ?></p>
                    <p><?= $annonce['price'] ?> €</p>
                    <a href="annonceDetail?id=<?= $annonce['id_annonce'] ?>" class="btn btn-primary">Voir le detail</a>
                </div>
          </div>
        <?php endforeach ?>    
    </div>
</div>
