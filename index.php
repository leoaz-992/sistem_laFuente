<?php
include("includes/header.php");
?>
<h1 class="text-center">Bienvenidos a la Fuente</h1>
<section class="secctionCarrusel">
  <!-- carrusel -->
  <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="public/agua.jpg" class="d-block w-100" alt="agua" />
        <div class="carousel-caption d-none d-md-block fondoTextCarrusel">
          <h5 class="titulo-carrusel">La Fuente</h5>
          <p class="text-carrusel">
            Agua mineral Embotellada.
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="public/agua2.jpg" class="d-block w-100" alt="agua2" />
        <div class="carousel-caption d-none d-md-block fondoTextCarrusel">
          <h5 class="titulo-carrusel">La Fuente</h5>
          <p class="text-carrusel">
            Lo mejor para su mesa.
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="public/botella.jpg" class="d-block w-100" alt="botella" />
        <div class="carousel-caption d-none d-md-block fondoTextCarrusel">
          <h5 class="titulo-carrusel">La Fuente</h5>
          <p class="text-carrusel">
            Animate a probarla.
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="public/water-5173777_1280.jpg" class="d-block w-100" alt="botella" />
        <div class="carousel-caption d-none d-md-block fondoTextCarrusel">
          <h5 class="titulo-carrusel">La Fuente</h5>
          <p class="text-carrusel">
            La mejor agua.
          </p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- fin Carrusel -->
</section>
<!-- añadir seccion productos -->


<section>

  <h2 id="productos" class="text-center">Productos</h2>
  <div class="row ">
    <?php
    include "conn.php";
    $sql = "SELECT * FROM productos";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class="col-md-3 carproducto">
        <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
          <img src="public/<?= $row['imagen_producto'] ?>" class="card-img-top" alt="bidon 20 l">
          <div class="card-body">
            <h4 class="card-title"><?= $row['nombre_producto'] ?></h4>
            <p class="card-text"><?= $row['descripcion_producto'] ?></p>
          </div>
        </div>
      <?php } ?>
      </div>
</section>
<?php
include("includes/footer.php");
?>