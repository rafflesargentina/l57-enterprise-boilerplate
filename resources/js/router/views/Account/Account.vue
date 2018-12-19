<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .25s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>

<template>
  <div class="account account-container">
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
        <span class="fa fa-bars" />
      </a>
      <nav class="sidebar-nav">
        <h4 class="sidebar-nav-header">
          Cuenta
        </h4>
        <ul class="sidebar-nav__list">
          <li class="sidebar-nav__item sidebar-nav__item--dark">
            <RouterLink 
              to="/account" 
              class="sidebar-nav__link sidebar-nav__link--dark"
            >
              Datos Personales
            </RouterLink>
          </li>
          <li class="sidebar-nav__item sidebar-nav__item--dark">
            <RouterLink
              to="/account/personal-tokens"
              class="sidebar-nav__link sidebar-nav__link--dark"
            >
              Tokens Personales
            </RouterLink>
          </li>
          <li class="sidebar-nav__item sidebar-nav__item--dark">
            <RouterLink
              to="/account/client-tokens"
              class="sidebar-nav__link sidebar-nav__link--dark"
            >
              Tokens de Clientes OAUTH
            </RouterLink>
          </li>
          <li class="sidebar-nav__item sidebar-nav__item--dark">
            <RouterLink
              to="/account/authorized-client-tokens"
              class="sidebar-nav__link sidebar-nav__link--dark"
            >
              Tokens de Clientes Autorizados
            </RouterLink>
          </li>
        </ul>
      </nav>
    </aside>
    <div
      id="accountInner"
      class="account-inner"
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
</template>

<script>

export default {
    methods: {
        toggle() {
            window.$("#sidebar").toggleClass("collapsed")
            window.$("#accountInner").toggleClass("pushed")
        }
    }
}
</script>
