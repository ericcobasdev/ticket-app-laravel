  <template>
    <div>
      <Navbar />
      <main class="p-6 min-h-[80vh]">
        <FlashMessage />
        <slot />
      </main>
      <Footer />
    </div>
  </template>
  
  <script setup>
  import Navbar from '@/Components/Navbar.vue'
  import FlashMessage from '@/Components/FlashMessage.vue'
  import Footer from '@/Components/Footer.vue'
  </script>
  
  
  
  