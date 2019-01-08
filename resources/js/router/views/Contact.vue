<template>
  <div class="main contact">
    <div class="contact-inner">
      <main class="card">
        <section>
          <h4 class="main-header">
            Envianos un mensaje
          </h4>
          <ContactForm
            :action="'/contact'"
            :method="'post'"
          />
        </section>
      </main>
    </div>
  </div>
</template>
