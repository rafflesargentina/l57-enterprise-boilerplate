<template>
  <ErrorPage>
    <h4 
      slot="subtitle" 
      class="error__subtitle"
    >
      Error 500
    </h4>
    <h1 
      slot="title" 
      class="error__title display-4"
    >
      Error del servidor
    </h1>
    <p 
      slot="description" 
      class="error__p"
    >
      Ocurrió un error interno que no pudo ser manejado. Por favor, volvé a intentar esta operación más tarde, o ponete en contacto con el administrador indicándole el problema.
    </p>
  </ErrorPage>
</template>
