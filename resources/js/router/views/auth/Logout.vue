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
        let a = window.axios.post("/logout"),
            b = this.$store.dispatch("auth/logout")

        return Promise.all([a,b])
            .then(values => {
                return this.$router.push({ path: values[0].data.redirect })
            })
    }
}
</script>
