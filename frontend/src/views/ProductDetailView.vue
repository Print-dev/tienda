<script setup>
import { computed, onBeforeUnmount, ref, watch } from 'vue'
import { RouterLink, useRoute, useRouter } from 'vue-router'
import AppHeader from '../components/common/AppHeader.vue'
import RelatedProducts from '../components/products/RelatedProducts.vue'
import { useShoppingBag } from '../composables/useShoppingBag'
import {
  categories,
  colorsForProduct,
  formatPrice,
  galleryForProduct,
  products,
  skuForSize,
  skuForVariant,
  storeIdentity,
  variantForSku,
} from '../data/store'

const route = useRoute()
const router = useRouter()
const { lines, favorites, itemCount, subtotal, add, remove, toggleFavorite, productForLine } = useShoppingBag()
const selectedColor = ref('')
const selectedSize = ref('')
const quantity = ref(1)
const activeImage = ref(0)
const cartOpen = ref(false)
const toast = ref('')
let toastTimer

const product = computed(() => products.find((item) => item.slug === route.params.slug) ?? null)
const category = computed(() => categories.find((item) => item.slug === product.value?.category) ?? null)
const gallery = computed(() => galleryForProduct(product.value, selectedColor.value))
const colors = computed(() => colorsForProduct(product.value))
const selectedSku = computed(() => skuForVariant(product.value, selectedSize.value, selectedColor.value))
const currentVariant = computed(() => selectedSku.value
  ? { sku: selectedSku.value, size: selectedSize.value, color: selectedColor.value }
  : null)
const discount = computed(() => {
  if (!product.value?.previousPrice || product.value.previousPrice <= product.value.price) return 0
  return Math.round((1 - product.value.price / product.value.previousPrice) * 100)
})
const stock = computed(() => selectedSize.value === 'XL' ? 4 : 8)
const demoRelatedProducts = products
const swatchPalette = {
  negro: '#202020',
  blanco: '#e9e7e1',
  marfil: '#e9e4d9',
  rojo: '#a83a32',
  oliva: '#72745b',
  azul: '#43566d',
  marino: '#27394e',
  arena: '#bba98f',
}

function colorForSwatch(color) {
  const key = color.toLocaleLowerCase('es').normalize('NFD').replace(/[\u0300-\u036f]/g, '')
  return Object.entries(swatchPalette).find(([name]) => key.includes(name))?.[1] ?? '#bba98f'
}

watch(
  () => [route.params.slug, route.query.variante],
  ([slug, requestedSku]) => {
    const currentProduct = products.find((item) => item.slug === slug)
    if (!currentProduct) return
    const variant = variantForSku(currentProduct, String(requestedSku || ''))
    selectedColor.value = variant?.color ?? currentProduct.color
    selectedSize.value = variant?.size ?? currentProduct.sizes.find((size) => skuForSize(currentProduct, size) === currentProduct.sku) ?? currentProduct.sizes[0]
    const fallbackSku = skuForVariant(currentProduct, selectedSize.value, selectedColor.value)
    if (fallbackSku && route.query.variante !== fallbackSku) {
      router.replace({ query: { ...route.query, variante: fallbackSku } })
    }
    activeImage.value = 0
    quantity.value = 1
  },
  { immediate: true },
)

watch(
  selectedSku,
  (sku) => {
    if (!product.value || !sku || route.query.variante === sku) return
    router.replace({ query: { ...route.query, variante: sku } })
  },
  { flush: 'post' },
)

function selectColor(color) {
  selectedColor.value = color
  activeImage.value = 0
}

function selectSize(size) {
  selectedSize.value = size
}

function notify(message) {
  toast.value = message
  window.clearTimeout(toastTimer)
  toastTimer = window.setTimeout(() => (toast.value = ''), 2600)
}

function addToBag() {
  if (!product.value || !currentVariant.value) return
  const orderedQuantity = Math.min(stock.value, Math.max(1, Number(quantity.value) || 1))
  quantity.value = orderedQuantity
  add({ ...product.value, color: selectedColor.value }, orderedQuantity, currentVariant.value.sku)
  notify(`${product.value.name} se agregó a tu bolsa`)
}

onBeforeUnmount(() => window.clearTimeout(toastTimer))
</script>

<template>
  <div class="storefront detail-storefront">
    <AppHeader
      :cart-count="itemCount"
      :favorite-count="favorites.length"
      @toggle-cart="cartOpen = !cartOpen"
      @show-favorites="router.push({ name: 'home', hash: '#recomendados' })"
      @notify="notify"
    />

    <main v-if="product" class="product-detail page-wrap">
      <nav class="breadcrumbs" aria-label="Migas de pan">
        <RouterLink :to="{ name: 'home' }">Inicio</RouterLink><span aria-hidden="true">/</span>
        <RouterLink v-if="category" :to="{ name: 'category', params: { slug: category.slug } }">{{ category.name }}</RouterLink><span v-if="category" aria-hidden="true">/</span>
        <span aria-current="page">{{ product.name }}</span>
      </nav>

      <section class="detail-layout" aria-labelledby="product-title">
        <div class="detail-gallery">
          <div class="detail-main-image">
            <img :src="gallery[activeImage]" :alt="`${product.imageAlt}${selectedColor !== product.color ? ` en color ${selectedColor}` : ''} — vista ${activeImage + 1}`" />
            <span v-if="product.badge" class="product-badge">{{ product.badge }}</span>
          </div>
          <div class="detail-thumbnails" role="group" aria-label="Galería del producto">
            <button
              v-for="(image, index) in gallery"
              :key="image"
              class="detail-thumbnail"
              :class="{ 'is-active': activeImage === index }"
              type="button"
              :aria-label="`Mostrar imagen ${index + 1} de ${gallery.length}`"
              :aria-pressed="activeImage === index"
              @click="activeImage = index"
            ><img :src="image" :alt="''" loading="lazy" /></button>
          </div>
        </div>

        <div class="detail-info">
          <span class="eyebrow">{{ product.brand }}</span>
          <h1 id="product-title">{{ product.name }}</h1>
          <div class="detail-price-row">
            <p class="detail-price">{{ formatPrice(product.price) }}</p>
            <del v-if="product.previousPrice" class="detail-old-price">{{ formatPrice(product.previousPrice) }}</del>
            <span v-if="discount" class="detail-discount">-{{ discount }}%</span>
          </div>
          <p class="detail-description">{{ product.description || `${product.name}. Una prenda cómoda y versátil de ${product.brand}, pensada para acompañarte todos los días.` }}</p>

          <fieldset v-if="colors.length > 1" class="detail-option">
            <legend>Color <span>{{ selectedColor }}</span></legend>
            <div class="detail-swatches">
              <button
                v-for="color in colors"
                :key="color"
                class="detail-swatch"
                :class="{ 'is-selected': selectedColor === color }"
                :style="{ '--swatch-color': colorForSwatch(color) }"
                type="button"
                :aria-label="color"
                :aria-pressed="selectedColor === color"
                @click="selectColor(color)"
              ></button>
            </div>
          </fieldset>

          <fieldset class="detail-option detail-size-option">
            <legend>Talla <span>{{ selectedSize }}</span></legend>
            <div class="detail-sizes">
              <button
                v-for="size in product.sizes"
                :key="size"
                class="detail-size"
                :class="{ 'is-selected': selectedSize === size }"
                type="button"
                :aria-pressed="selectedSize === size"
                @click="selectSize(size)"
              >{{ size }}</button>
            </div>
          </fieldset>

          <div class="detail-buy-row">
            <label class="quantity-control"><span class="sr-only">Cantidad</span>
              <button type="button" aria-label="Restar una unidad" :disabled="quantity <= 1" @click="quantity = Math.max(1, quantity - 1)">−</button>
              <input v-model.number="quantity" type="number" min="1" :max="stock" aria-label="Cantidad" @change="quantity = Math.min(stock, Math.max(1, Number(quantity) || 1))" />
              <button type="button" aria-label="Sumar una unidad" :disabled="quantity >= stock" @click="quantity = Math.min(stock, quantity + 1)">+</button>
            </label>
            <button class="button button-dark detail-add-button" type="button" :disabled="!currentVariant" @click="addToBag">Agregar a la bolsa</button>
          </div>
          <p class="detail-stock"><span class="stock-dot"></span>{{ stock }} disponibles en esta variante</p>
          <div class="detail-shipping">
            <div><span class="shipping-icon" aria-hidden="true">↗</span><p><strong>Envío de demostración</strong><br />Entrega estimada en 2–5 días hábiles.</p></div>
            <div><span class="shipping-icon" aria-hidden="true">↺</span><p><strong>Cambios simples</strong><br />Solicítalos dentro de los primeros 30 días.</p></div>
          </div>
          <details class="detail-description-more"><summary>Descripción y cuidado</summary><p>{{ product.description || `Una pieza de ${product.brand}, pensada para combinar con lo que ya tienes.` }} Lavar con colores similares y seguir las indicaciones de la etiqueta.</p></details>
        </div>
      </section>

      <RelatedProducts :products="demoRelatedProducts" :favorites="favorites" @favorite="toggleFavorite" />
    </main>

    <main v-else class="detail-not-found page-wrap">
      <span class="eyebrow">NOMA · TIENDA DE DEMOSTRACIÓN</span>
      <h1>No encontramos este producto.</h1>
      <p>Puede que ya no esté disponible en esta selección.</p>
      <RouterLink class="button button-dark" :to="{ name: 'home' }">Volver a la tienda</RouterLink>
    </main>

    <footer class="detail-footer"><div class="page-wrap"><RouterLink class="wordmark" :to="{ name: 'home' }"><span class="wordmark-mark">{{ storeIdentity.mark }}</span>{{ storeIdentity.name }}</RouterLink><span>Ropa para todos los días.</span><RouterLink :to="{ name: 'home' }">Seguir explorando</RouterLink></div></footer>

    <Transition name="cart-pop">
      <aside v-if="cartOpen" class="cart-popover" aria-label="Resumen de la bolsa">
        <div class="cart-popover-heading"><div><span class="eyebrow">TU SELECCIÓN</span><h2>Tu bolsa <span>({{ itemCount }})</span></h2></div><button class="plain-icon" type="button" aria-label="Cerrar bolsa" @click="cartOpen = false">×</button></div>
        <p v-if="!lines.length" class="cart-empty">Todavía no has agregado prendas.<br />Hay algo para cada día.</p>
        <div v-else class="cart-lines">
          <div v-for="line in lines" :key="`${line.id}-${line.sku}`" class="cart-line">
            <img :src="productForLine(line).image" :alt="productForLine(line).imageAlt" />
            <div class="cart-line-copy"><strong>{{ line.name }}</strong><span>{{ line.color }} · {{ line.sku }}</span><span>{{ line.quantity }} × {{ formatPrice(line.price) }}</span></div>
            <button class="plain-icon remove-line" type="button" :aria-label="`Quitar ${line.name}`" @click="remove(line.id, line.sku)">×</button>
          </div>
          <div class="cart-subtotal"><span>Subtotal</span><strong>{{ formatPrice(subtotal) }}</strong></div>
        </div>
        <RouterLink class="button button-dark cart-continue" :to="{ name: 'home' }" @click="cartOpen = false">Seguir explorando</RouterLink>
      </aside>
    </Transition>
    <Transition name="toast"><div v-if="toast" class="toast-message" role="status">{{ toast }}<button type="button" aria-label="Cerrar aviso" @click="toast = ''">×</button></div></Transition>
  </div>
</template>
