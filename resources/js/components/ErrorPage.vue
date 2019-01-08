<template>
  <div class="error full-height">
    <div class="error-inner">
      <main>
        <section>
          <div class="main-header">
            <slot name="subtitle" />
            <slot name="title" />
            <slot name="description" />
          </div>
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
