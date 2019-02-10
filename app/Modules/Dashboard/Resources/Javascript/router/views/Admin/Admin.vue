<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .25s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>

<template>
  <div>
    <div class="main account bg-light">
      <aside
        id="sidebar"
        class="sidebar sidebar--dark collapsed"
      >
        <a
          class="sidebar__toggler sidebar__toggler--dark"
          href="#"
          role="button"
          @click="toggle"
        >
          <span class="icon-bars" />
        </a>
        <nav class="sidebar-nav">
          <h4 class="sidebar-nav-header">
            Admin
          </h4>
          <ul class="sidebar-nav__list">
            <li class="sidebar-nav__item sidebar-nav__item--dark">
              <RouterLink 
                :to="{ name: 'Dashboard' }"
                class="sidebar-nav__link sidebar-nav__link--dark"
              >
                Dashboard
              </RouterLink>
            </li>
          </ul>
        </nav>
      </aside>
      <div
        id="main-inner"
        class="main-inner"
      >
        <Transition 
          name="fade" 
          mode="out-in"
        >
          <KeepAlive>
            <RouterView />
          </KeepAlive>
        </Transition>
      </div>
    </div>
  </div>
</template>

<script>

export default {
    methods: {
        toggle() {
            window.$("#sidebar").toggleClass("collapsed")
            window.$("#main-inner").toggleClass("pushed")
        }
    }
}
</script>
