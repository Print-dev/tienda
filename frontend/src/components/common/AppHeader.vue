<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'
import { categories, storeIdentity } from '../../data/store'

defineProps({
  cartCount: { type: Number, default: 0 },
  favoriteCount: { type: Number, default: 0 },
})

const emit = defineEmits(['toggle-cart', 'show-favorites', 'notify'])
const menuOpen = ref(false)
const mobileOpen = ref(false)

function closeMenus() {
  menuOpen.value = false
  mobileOpen.value = false
}
</script>

<template>
  <header class="site-header" @keydown.esc="closeMenus" @mouseleave="menuOpen = false">
    <div class="header-inner page-wrap">
      <RouterLink class="wordmark" :to="{ name: 'home' }" aria-label="Noma, inicio" @click="closeMenus">
        <span class="wordmark-mark">{{ storeIdentity.mark }}</span>
        <span>{{ storeIdentity.name }}</span>
      </RouterLink>

      <button
        class="mobile-menu-toggle icon-button"
        type="button"
        :aria-expanded="mobileOpen"
        aria-label="Abrir menú de categorías"
        @click="mobileOpen = !mobileOpen; menuOpen = mobileOpen"
      >
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" /></svg>
      </button>

      <nav class="main-nav" :class="{ 'is-open': mobileOpen }" aria-label="Categorías principales">
        <button
          class="nav-category"
          type="button"
          :aria-expanded="menuOpen"
          aria-controls="category-menu"
          @mouseenter="menuOpen = true"
          @focus="menuOpen = true"
          @click="menuOpen = !menuOpen"
        >
          Ropa
          <svg class="nav-chevron" viewBox="0 0 16 16" aria-hidden="true"><path d="m4 6 4 4 4-4" /></svg>
        </button>
        <RouterLink :to="{ name: 'category', params: { slug: 'polos' } }" @click="closeMenus">Polos</RouterLink>
        <RouterLink :to="{ name: 'category', params: { slug: 'pantalones' } }" @click="closeMenus">Pantalones</RouterLink>
        <RouterLink :to="{ name: 'category', params: { slug: 'zapatillas' } }" @click="closeMenus">Zapatillas</RouterLink>
      </nav>

      <div class="header-actions" aria-label="Accesos de cuenta y compra">
        <button class="icon-button account-button" type="button" aria-label="Mi cuenta" @click="emit('notify', 'Tu espacio personal estará listo pronto.')">
          <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="3.5" /><path d="M5.5 20c.7-3.4 3-5 6.5-5s5.8 1.6 6.5 5" /></svg>
        </button>
        <button class="icon-button" type="button" :aria-label="`Favoritos, ${favoriteCount} productos`" @click="emit('show-favorites')">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.3 5.8a5 5 0 0 0-7.1 0L12 7l-1.2-1.2a5 5 0 0 0-7.1 7.1L12 21l8.3-8.1a5 5 0 0 0 0-7.1Z" /></svg>
          <span v-if="favoriteCount" class="action-count">{{ favoriteCount }}</span>
        </button>
        <button class="icon-button" type="button" :aria-label="`Bolsa, ${cartCount} productos`" @click="emit('toggle-cart')">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 8h14l1 13H4L5 8Z" /><path d="M9 9V6a3 3 0 0 1 6 0v3" /></svg>
          <span v-if="cartCount" class="action-count">{{ cartCount }}</span>
        </button>
      </div>
    </div>

    <Transition name="menu-fade">
      <section
        v-if="menuOpen"
        id="category-menu"
        class="mega-menu"
        aria-label="Explora ropa por categoría"
        @mouseenter="menuOpen = true"
        @mouseleave="menuOpen = false"
      >
        <div class="mega-menu-inner page-wrap">
          <div class="mega-menu-intro">
            <span class="eyebrow">ENCUENTRA TU ESTILO</span>
            <h2>Lo que buscas,<br />a tu manera.</h2>
            <RouterLink :to="{ name: 'category', params: { slug: 'ropa' } }" class="text-link" @click="closeMenus">
              Ver toda la ropa <span aria-hidden="true">↗</span>
            </RouterLink>
          </div>
          <div class="mega-categories">
            <RouterLink v-for="category in categories" :key="category.slug" :to="{ name: 'category', params: { slug: category.slug } }" @click="closeMenus">
              <span>{{ category.name }}</span><span aria-hidden="true">↗</span>
            </RouterLink>
          </div>
          <RouterLink class="mega-feature" :to="{ name: 'category', params: { slug: 'novedades' } }" @click="closeMenus">
            <img :src="categories[0].image" alt="" loading="lazy" />
            <span>Una nueva forma de combinar lo de siempre <b aria-hidden="true">↗</b></span>
          </RouterLink>
        </div>
      </section>
    </Transition>
  </header>
</template>

