<template>
  <div class="main auth">
    <div class="auth-inner">
      <main class="card">
        <section>
          <h4 class="main-header">
            Ingresá a tu cuenta
          </h4>
          <LoginForm
            :action="'/login'"
            :method="'post'"
          />
        </section>
      </main>
    </div>
  </div>
</template>
