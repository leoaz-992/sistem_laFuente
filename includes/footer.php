</section>
<footer class="container-xxl bg-dark p-3 text-bg-light mt-5">
  <div class="row justify-content-between">
    <div class="col-lg-4 col-sm-6">
      <h5 class="titleFooter">redes sociales</h5>
      <ul class="d-flex">
        <li class="redes-icon">
          <a href="http://www.facebook.com" class="redes-icon" target="_blank" rel="noopener noreferrer"><i class="bi bi-facebook"></i></a>
        </li>
        <li class="redes-icon">
          <a href="http://www.google.com" class="redes-icon" target="_blank" rel="noopener noreferrer"><i class="bi bi-instagram"></i></a>
        </li>
        <li class="redes-icon">
          <a href="http://www.google.com" class="redes-icon" target="_blank" rel="noopener noreferrer"><i class="bi bi-twitter-x"></i></a>
        </li>
        <li class="redes-icon">
          <a href="http://www.youtube.com" class="redes-icon" target="_blank" rel="noopener noreferrer"><i class="bi bi-youtube"></i></a>
        </li>
      </ul>
      <ul>
        <li class="text-light">Direccion: <span class="info-footer">Av. Italia 3374</span></li>
        <li class="text-light">Telefono Contacto: <span class="info-footer">1122334455</span></li>
        <li class="text-light">Correo Contacto: <span class="info-footer">contacto@lafuente.com</span></li>
        <li class="text-light">Horario Atencion: <span class="info-footer">lun-Sab de 8 a 19 hs</span></li>
      </ul>
    </div>
    <div class="col-lg-4 col-sm-6">
      <h5 class="titleFooter">Menu</h5>
      <ul>
        <li><a class="link-footer" href="index.php" target="_blank" rel="noopener noreferrer">Inicio</a></li>
        <li><a class="link-footer" href="#" target="_blank" rel="noopener noreferrer">Hace tu Pedido</a></li>
        <li><a class="link-footer" href="#" target="_blank" rel="noopener noreferrer">Nuestros Productos</a></li>
        <li><a class="link-footer" href="loginForm.php" target="_blank" rel="noopener noreferrer">Login para Empleados</a></li>
      </ul>
    </div>
    <div class="col-lg-4 offset-lg-0 col-sm-8 offset-sm-2 position-relative">
      <!-- Formulario contacto footer -->
      <h5 class="titleFooter">Contactanos:</h5>
      <form class="" id="contactoForm">
        <div class="mb-3 col-auto">
          <label for="nameContacto" class="form-label lb-Footer">Nombre</label>
          <input type="text" class="form-control form-control-sm" id="nameContacto" required />
        </div>
        <div class="mb-3 col-auto">
          <label for="telContacto" class="form-label lb-Footer">Telefono</label>
          <input type="tel" class="form-control form-control-sm" id="telContacto" required />
        </div>
        <div class="mb-3 col-auto">
          <label for="emailContacto" class="form-label lb-Footer">Correo</label>
          <input type="email" class="form-control form-control-sm" id="emailContacto" required />
        </div>
        <div class="mb-3">
          <label for="msjContacto" class="form-label lb-Footer">Mensaje</label>
          <textarea class="form-control" id="msjContacto" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </form>
      <div class="" id="mensajeContact"></div>
      <!-- fin Formulario contacto footer -->
    </div>
  </div>
  <div class="footer-bootom">
    <h6>
      <b>La Fuente</b>©. Proveedores de agua embotellada.
      <span id="dateYear"></span>
    </h6>
    <p class="text-devs">Creado por: Alvarez, Benitez, Mendoza y Ojeda.</p>
  </div>
</footer>
<script>
      const fecha = new Date();
      const año = fecha.getFullYear();
      const year= document.getElementById("dateYear");
      year.innerHTML= año;
    </script>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/login.js"></script>
<script src="js/registrar.js"></script>
<script src="js/contacto.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>