<template>
  <ErrorPage>
    <h4 
      slot="subtitle" 
      class="error_page__subtitle"
    >
      Error 401
    </h4>
    <h1 
      slot="title" 
      class="error_page__title display-4"
    >
      No Autorizado
    </h1>
    <p 
      slot="description" 
      class="error_page__p"
    >
      No tenés permiso concendido para ingresar a esta página o sección.
    </p>
  </ErrorPage>
</template>
