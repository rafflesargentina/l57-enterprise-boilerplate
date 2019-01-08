<template>
  <div class="main auth">
    <div class="auth-inner">
      <main class="card">
        <section>
          <h4 class="main-header">
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
