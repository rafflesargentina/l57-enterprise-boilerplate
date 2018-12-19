<template>
  <div class="error_page full-height">
    <div class="error_page-inner">
      <main class="error_page-content">
        <section class="error_page-section">
          <div class="error_page-header">
            <slot name="subtitle" />
            <slot name="title" />
          </div>
          <slot name="description" />
          <div class="row no-gutters">
            <RouterLink 
              to="/" 
              class="col-sm-4 btn btn-lg btn-primary"
            >
              <span class="fa fa-arrow-left pr-2" />Volver al inicio
            </RouterLink>
          </div>
        </section>
      </main>
    </div>
  </div>
</template>

<script>
export default {
    name: "ErrorPage"
}
</script>
