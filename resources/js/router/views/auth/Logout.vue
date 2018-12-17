<template>
  <div class="d-flex align-items-center full-height text-center">
    <h4 class="w-100 display-4">
      Cerrando sesión...
    </h4>
  </div>
</template>

<script>
export default {
    mounted() {
        return this.$store.dispatch("auth/logout")
    }
}
</script>
