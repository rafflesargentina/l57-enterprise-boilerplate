<template>
  <div class="auth">
    <div class="auth-inner">
      <main class="auth-content card auth__card">
        <section class="auth-section">
          <h4 class="auth-header">
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
