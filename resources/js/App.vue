<template>
  <div id="app">
    <PageHeader />
    <RouterView />
    <VueSnotify />
    <PageFooter v-if="false !== $route.meta.footer" />
  </div>
</template>

<script>
export default {
    name: "App",
}
</script>
