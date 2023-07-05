<?php

// var_dump($annonce);

?>
<h1><?= $title ?> N° : <?=$annonce['id_annonce']?></h1>

<h3 class="text-center"><?=$annonce['title']?></h3>
<div class="container d-flex justify-content-center">
    <div class="card" style="width: 30rem;">
      <img src="<?= SITEBASE ?>images/annonces/<?= $annonce['image'] ?>" class="card-img-top" alt="..." >
      <div class="card-body">
        <h5 class="card-title"><?=$annonce['description']?></h5>
        <p class="card-text"><?=$annonce['price']?> €</p>
        <a href="#" class="btn btn-warning">Ajouter au panier</a>
      </div>
    </div>

</div>