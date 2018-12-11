<template>
  <footer class="page-footer text-center">
    <div class="page-footer__legal"><a 
      class="page-footer__link" 
      href="#" 
      role="button" 
      data-toggle="modal" 
      data-target="#modalTermsAndConditions">Términos y Condiciones</a> | <a 
        class="page-footer__link" 
        href="#" 
        role="button" 
        data-toggle="modal" 
        data-target="#modalPolicyOfPrivacy">Políticas de Privacidad</a> | <a 
          class="page-footer__link" 
          href="#" 
          role="button" 
          data-toggle="modal" 
          data-target="#modalAccessPersonalData">Acceso a Datos Personales</a> | <a
            class="page-footer__link"
            href="https://www.argentina.gob.ar/defensadelconsumidor"
            target="_blank">Defensa del Consumidor</a>
    </div>
    <div class="page-footer__copyright">&copy; Laravel 5.6</div>
  </footer>
</template>

<script>
export default {
    name: "PageFooter",
}
</script>
