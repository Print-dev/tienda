<script setup>
import { computed, nextTick, ref, watch } from 'vue'
import { RouterLink, useRoute, useRouter } from 'vue-router'
import AppHeader from '../components/common/AppHeader.vue'
import CategoryTile from '../components/home/CategoryTile.vue'
import HeroCarousel from '../components/home/HeroCarousel.vue'
import ProductCard from '../components/products/ProductCard.vue'
import { categories, formatPrice, products, storeIdentity } from '../data/store'
import { useShoppingBag } from '../composables/useShoppingBag'

const route = useRoute()
const router = useRouter()
const { lines, favorites, itemCount, subtotal, remove, toggleFavorite, productForLine } = useShoppingBag()

const query = ref('')
const cartOpen = ref(false)
const favoritesOnly = ref(false)
const toast = ref('')
const newsletterEmail = ref('')
let toastTimer

const activeCategory = computed(() => {
  const slug = route.params.slug
  return categories.find((category) => category.slug === slug) ?? null
})

const visibleProducts = computed(() => {
  let result = products
  if (activeCategory.value) result = result.filter((product) => product.category === activeCategory.value.slug)
  if (favoritesOnly.value) result = result.filter((product) => favorites.value.includes(product.id))
  const term = query.value.trim().toLocaleLowerCase('es')
  if (term) {
    result = result.filter((product) =>
      [product.name, product.brand, product.color, product.category].some((value) => value.toLocaleLowerCase('es').includes(term)),
    )
  }
  return result
})

function scrollToProducts() {
  document.querySelector('#recomendados')?.scrollIntoView({ behavior: 'smooth' })
}

watch(
  () => route.name,
  async (name) => {
    cartOpen.value = false
    if (name === 'category') {
      favoritesOnly.value = false
      await nextTick()
      document.querySelector('#recomendados')?.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }
  },
  { immediate: true },
)

function notify(message) {
  toast.value = message
  window.clearTimeout(toastTimer)
  toastTimer = window.setTimeout(() => (toast.value = ''), 2600)
}

function showFavorites() {
  favoritesOnly.value = !favoritesOnly.value
  activeCategory.value && router.push({ name: 'home' })
  nextTick(() => document.querySelector('#recomendados')?.scrollIntoView({ behavior: 'smooth' }))
}

function subscribe() {
  if (!newsletterEmail.value.trim()) return
  notify('¡Listo! Guardamos tu correo en esta demostración.')
  newsletterEmail.value = ''
}
</script>

<template>
  <div class="storefront">
    <AppHeader
      :cart-count="itemCount"
      :favorite-count="favorites.length"
      @toggle-cart="cartOpen = !cartOpen"
      @show-favorites="showFavorites"
      @notify="notify"
    />

    <Transition name="cart-pop">
      <aside v-if="cartOpen" class="cart-popover" aria-label="Resumen de la bolsa">
        <div class="cart-popover-heading">
          <div><span class="eyebrow">TU SELECCIÓN</span><h2>Tu bolsa <span>({{ itemCount }})</span></h2></div>
          <button class="plain-icon" type="button" aria-label="Cerrar bolsa" @click="cartOpen = false">×</button>
        </div>
        <p v-if="!lines.length" class="cart-empty">Todavía no has agregado prendas.<br />Hay algo para cada día.</p>
        <div v-else class="cart-lines">
          <div v-for="line in lines" :key="`${line.id}-${line.sku}`" class="cart-line">
            <img :src="productForLine(line).image" :alt="productForLine(line).imageAlt" />
            <div class="cart-line-copy"><strong>{{ line.name }}</strong><span>{{ line.color }} · {{ line.sku }}</span><span>{{ line.quantity }} × {{ formatPrice(line.price) }}</span></div>
            <button class="plain-icon remove-line" type="button" :aria-label="`Quitar ${line.name}`" @click="remove(line.id, line.sku)">×</button>
          </div>
          <div class="cart-subtotal"><span>Subtotal</span><strong>{{ formatPrice(subtotal) }}</strong></div>
        </div>
        <RouterLink class="button button-dark cart-continue" :to="{ name: 'home', hash: '#recomendados' }" @click="cartOpen = false">Seguir explorando</RouterLink>
      </aside>
    </Transition>

    <main>
      <HeroCarousel />

      <div class="search-sticky-shell">
        <div class="search-sticky page-wrap">
          <form class="search-form" role="search" @submit.prevent="scrollToProducts">
            <svg class="search-icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8" /><path d="m16 16 4 4" /></svg>
            <input v-model="query" type="search" placeholder="¿Qué estás buscando?" aria-label="Buscar ropa" />
            <button class="search-submit" type="submit" aria-label="Buscar"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3.5 10h12m-5-5 5 5-5 5" /></svg></button>
          </form>
          <div class="category-pills" aria-label="Explorar categorías">
            <RouterLink class="category-pill" :class="{ 'is-active': !activeCategory }" :to="{ name: 'home' }"><span class="pill-dot"></span>Todo</RouterLink>
            <RouterLink v-for="category in categories" :key="category.slug" class="category-pill" :class="{ 'is-active': activeCategory?.slug === category.slug }" :to="{ name: 'category', params: { slug: category.slug } }"><span class="pill-dot"></span>{{ category.name }}</RouterLink>
          </div>
        </div>
      </div>

      <section id="categorias" class="category-section page-wrap section-space">
        <div class="section-heading">
          <div><span class="eyebrow">ELIGE POR DÓNDE EMPEZAR</span><h2>Ropa que va contigo.</h2></div>
          <RouterLink class="text-link heading-link" :to="{ name: 'category', params: { slug: 'ropa' } }">Ver colección completa <span aria-hidden="true">↗</span></RouterLink>
        </div>
        <div class="category-grid">
          <CategoryTile v-for="(category, index) in categories" :key="category.slug" :category="category" :large="index < 2" />
        </div>
      </section>

      <section class="editorial-band">
        <div class="editorial-photo">
          <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1600&q=85" alt="Amigas recorriendo juntas una tienda de ropa" loading="lazy" />
        </div>
        <div class="editorial-copy">
          <span class="eyebrow">VESTIRSE A TU MANERA</span>
          <h2>Las mejores prendas son las que se sienten tuyas.</h2>
          <p>Arma tu propio ritmo con básicos, texturas y detalles que dicen algo de ti.</p>
          <RouterLink class="text-link" :to="{ name: 'category', params: { slug: 'novedades' } }">Descubrir Noma <span aria-hidden="true">↗</span></RouterLink>
        </div>
      </section>

      <section id="recomendados" class="products-section page-wrap section-space">
        <div class="section-heading products-heading">
          <div>
            <span class="eyebrow">{{ favoritesOnly ? 'TUS GUARDADOS' : 'SELECCIÓN NOMA' }}</span>
            <h2>{{ activeCategory ? activeCategory.name : favoritesOnly ? 'Tus favoritos.' : query ? 'Encontramos esto.' : 'Para llevar más seguido.' }}</h2>
            <p class="section-intro">{{ activeCategory?.description || (query ? `Resultados para “${query}”` : 'Piezas fáciles de combinar, elegidas para acompañarte.') }}</p>
          </div>
          <span class="result-count">{{ visibleProducts.length }} {{ visibleProducts.length === 1 ? 'prenda' : 'prendas' }}</span>
        </div>

        <div v-if="visibleProducts.length" class="product-grid">
          <ProductCard
            v-for="product in visibleProducts"
            :key="product.id"
            :product="product"
            :favorite="favorites.includes(product.id)"
            @favorite="toggleFavorite"
          />
        </div>
        <div v-else class="empty-results">
          <span class="empty-mark">n.</span>
          <h3>{{ favoritesOnly ? 'Todavía no guardas favoritos.' : 'No encontramos esa prenda.' }}</h3>
          <p>{{ favoritesOnly ? 'Toca el corazón de una prenda y aparecerá aquí.' : 'Prueba con otro nombre o explora nuestras categorías.' }}</p>
          <button v-if="favoritesOnly" class="button button-dark" type="button" @click="favoritesOnly = false">Volver a la selección</button>
          <button v-else class="button button-dark" type="button" @click="query = ''; router.push({ name: 'home' })">Ver toda la selección</button>
        </div>
      </section>

      <section class="brand-note page-wrap">
        <span class="brand-note-mark">{{ storeIdentity.mark }}</span>
        <p>Elegir menos, combinar mejor.<br /><span>{{ storeIdentity.note }}</span></p>
        <RouterLink :to="{ name: 'home', hash: '#categorias' }" class="round-control brand-note-arrow" aria-label="Volver a categorías"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3.5 10h12m-5-5 5 5-5 5" /></svg></RouterLink>
      </section>

      <section class="newsletter-section">
        <div class="newsletter-inner page-wrap">
          <div><span class="eyebrow">UNA NOTA DE VEZ EN CUANDO</span><h2>Buenas ideas para vestirte mejor.</h2><p>Novedades, combinaciones y hallazgos de la tienda.</p></div>
          <form class="newsletter-form" @submit.prevent="subscribe">
            <label class="sr-only" for="newsletter-email">Tu correo electrónico</label>
            <input id="newsletter-email" v-model="newsletterEmail" type="email" placeholder="Tu correo electrónico" required />
            <button type="submit" aria-label="Suscribirme"><svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3.5 10h12m-5-5 5 5-5 5" /></svg></button>
          </form>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="footer-main page-wrap">
        <div class="footer-brand"><RouterLink class="wordmark wordmark-footer" :to="{ name: 'home' }"><span class="wordmark-mark">{{ storeIdentity.mark }}</span><span>{{ storeIdentity.name }}</span></RouterLink><p>Ropa para todos los días.<br />Encuentra algo que se sienta como tú.</p></div>
        <div class="footer-column"><span class="footer-label">EXPLORAR</span><RouterLink v-for="category in categories" :key="category.slug" :to="{ name: 'category', params: { slug: category.slug } }">{{ category.name }}</RouterLink></div>
        <div class="footer-column"><span class="footer-label">AYUDA</span><a href="mailto:hola@noma.example">Escríbenos</a><a href="#newsletter-email">Novedades</a><RouterLink :to="{ name: 'home', hash: '#categorias' }">Sobre Noma</RouterLink></div>
      </div>
      <div class="footer-bottom page-wrap"><span>© 2026 Noma · Tienda de demostración</span><span>Hecho para descubrir, elegir y volver.</span></div>
    </footer>

    <Transition name="toast"><div v-if="toast" class="toast-message" role="status">{{ toast }}<button type="button" aria-label="Cerrar aviso" @click="toast = ''">×</button></div></Transition>
  </div>
</template>

