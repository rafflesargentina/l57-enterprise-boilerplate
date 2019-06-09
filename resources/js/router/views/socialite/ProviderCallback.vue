<template>
  <div />
</template>

<script>
export default {
    created() {
        return this.authenticate(this.$route.params.provider)
    },

    methods: {
        authenticate(provider) {
            return window.axios.post("/auth/" + provider + "/callback", this.$route.query)
                .then(response => this.login(response.data, provider))
                .catch(error => console.error(error))
        },

        login (data) {
            return this.$store.dispatch("auth/login", data)
                .then(response => {
                    let intended = this.$route.query.intended
                    let redirect = intended || response.redirect
                    return this.$router.push({ path: redirect })
                })
                .catch(error => console.error(error))
        }
    }
}
</script>
