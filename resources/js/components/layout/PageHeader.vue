<template>
  <header class="page-header page-header--dark">
    <div class="row no-gutters">
      <a
        href="/"
        class="col-9 col-lg-3 page-header-logo"
      >
        Laravel 5.6
      </a>

      <nav class="col-lg-6 main-nav d-none d-lg-inline-block">
        <ul class="main-nav__list">
          <li class="main-nav__item main-nav__item--dark">
            <RouterLink
              to="/"
              class="main-nav__link main-nav__link--dark"
            >
              INICIO
            </RouterLink>
          </li>
          <li class="main-nav__item main-nav__item--dark">
            <RouterLink
              to="/contact"
              class="main-nav__link main-nav__link--dark"
            >
              CONTACTO
            </RouterLink>
          </li>
        </ul>
      </nav>

      <nav
        id="mainNavMenu"
        class="main-nav main-nav-menu collapse d-lg-none"
      >
        <ul class="main-nav__list">
          <li class="main-nav__item main-nav__item--dark">
            <RouterLink
              to="/"
              class="main-nav__link main-nav__link--dark"
            >
              INICIO
            </RouterLink>
          </li>
          <li class="main-nav__item main-nav__item--dark">
            <RouterLink
              to="/contact"
              class="main-nav__link main-nav__link--dark"
            >
              CONTACTO
            </RouterLink>
          </li>
          <li
            v-if="!isAuthenticated"
            class="main-nav__item main-nav__item--dark"
          >
            <RouterLink
              to="/login"
              class="main-nav__link main-nav__link--dark"
            >
              INGRESÁ
            </RouterLink>
          </li>
          <li
            v-if="!isAuthenticated"
            class="main-nav__item main-nav__item--dark"
          >
            <RouterLink
              to="/register"
              class="main-nav__link main-nav__link--dark"
            >
              REGISTRATE
            </RouterLink>
          </li>
        </ul>
      </nav>

      <nav class="col-3 main-nav text-right">
        <ul class="main-nav__list d-lg-none text-right">
          <li class="main-nav__item main-nav__item--dark d-inline-block d-lg-none">
            <a
              class="main-nav__link main-nav__link--dark navbar-toggler"
              data-toggle="collapse"
              data-target="#mainNavMenu"
              aria-controls="mainNavMenu"
              aria-expanded="false"
              aria-label="Toggle navigation"
              href="#"
            >
              <span class="fa fa-bars main-nav__icon" />
            </a>
          </li>
        </ul>


        <ul class="main-nav__list d-none d-lg-inline-block">
          <li
            v-if="!isAuthenticated"
            class="main-nav__item main-nav__item--dark d-none d-lg-inline-block"
          >
            <RouterLink
              to="/login"
              class="main-nav__link main-nav__link--dark"
            >
              INGRESÁ
            </RouterLink>
          </li>
          <li
            v-if="!isAuthenticated"
            class="main-nav__item main-nav__item--dark d-none d-lg-inline-block"
          >
            <RouterLink
              to="/register"
              class="main-nav__link main-nav__link--dark"
            >
              REGISTRATE
            </RouterLink>
          </li>

          <li
            v-if="isAuthenticated"
            class="main-nav__item main-nav__item--dark"
          >
            <a
              id="sessionMenuLink"
              href="#"
              class="main-nav__link main-nav__link--dark dropdown-toggle"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <span class="fa fa-user pr-2" />{{ username }}
            </a>
            <div
              class="dropdown-menu"
              aria-labelledby="sessionMenuLink"
            >
              <RouterLink
                class="dropdown-item"
                to="/account"
              >
                Cuenta
              </RouterLink>
              <div class="dropdown-divider" />
              <RouterLink
                class="dropdown-item"
                to="/logout"
              >
                Cerrar sesión
              </RouterLink>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </header>
</template>

<script>
import { authComputed } from "@/store/helpers"

export default {

    name: "PageHeader",

    computed: {
        ...authComputed
    },

    mounted() {
        return document.addEventListener("click", function(e) {
	        if (e.target.closest("#mainNavMenu")) return;

	        window.$("#mainNavMenu").collapse("hide")
        });
    }
}
</script>
