
<?php 
$this->load->view('plantillas/header');
?>
<section class="content">
  <div class="error-page">
    <h2 class="headline text-red">500</h2>

    <div class="error-content">
      <h3><i class="fa fa-warning text-red"></i> Oops! Ocurrió un error en el servidor.</h3>

      <p>
        Por favor contacte con el administrador del sitio.
        Puede regresar al inicio <a href="<?= getUrlControlador('inicio','index'); ?>">regresar al inicio</a>.
      </p>

    </div>
  </div>
</section>

<?php $this->load->view('plantillas/footer');  ?>