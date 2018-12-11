<template>
  <div class="contact">
    <div class="contact-inner">
      <main class="contact-content card contact__card">
        <section class="contact-section">
          <h4 class="contact-header">
            Envianos un mensaje
          </h4>
          <ContactForm :action="'/contact'" :method="'post'" />
        </section>
      </main>
    </div>
  </div>
</template>
