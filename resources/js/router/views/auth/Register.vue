<template>
  <div class="auth">
    <div class="auth-inner">
      <main class="auth-content card auth__card">
        <section class="auth-section">
          <h4 class="auth-header">
            Registrate
          </h4>
          <RegisterForm
            :action="'/register'"
            :method="'post'"
          />
        </section>
      </main>
    </div>
  </div>
</template>
