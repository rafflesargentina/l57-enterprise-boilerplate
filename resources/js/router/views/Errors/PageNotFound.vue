<template>
  <ErrorPage>
    <h4 
      slot="subtitle" 
      class="error__subtitle"
    >
      Error 404
    </h4>
    <h1 
      slot="title" 
      class="error__title display-4"
    >
      No Encontrado
    </h1>
    <p 
      slot="description" 
      class="error__p"
    >
      La página a la que estás intentando acceder no pudo ser encontrada.
    </p>
  </ErrorPage>
</template>
