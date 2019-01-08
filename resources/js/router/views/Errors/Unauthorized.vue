<template>
  <ErrorPage>
    <h4 
      slot="subtitle" 
      class="error__subtitle"
    >
      Error 401
    </h4>
    <h1 
      slot="title" 
      class="error__title display-4"
    >
      No Autorizado
    </h1>
    <p 
      slot="description" 
      class="error__p"
    >
      No tenés permiso concedido para ingresar a esta página o sección.
    </p>
  </ErrorPage>
</template>
