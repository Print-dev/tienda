<script setup>
import { RouterLink } from 'vue-router'
import { formatPrice } from '../../data/store'

defineProps({ product: { type: Object, required: true }, favorite: Boolean })
defineEmits(['favorite'])
</script>

<template>
  <article class="product-card">
    <div class="product-card-image-wrap">
      <img class="product-card-image" :src="product.image" :alt="product.imageAlt" :style="{ objectPosition: product.imagePosition }" loading="lazy" />
      <span v-if="product.badge" class="product-badge">{{ product.badge }}</span>
      <button class="favorite-button" :class="{ 'is-favorite': favorite }" type="button" :aria-label="favorite ? 'Quitar de favoritos' : 'Agregar a favoritos'" :aria-pressed="favorite" @click="$emit('favorite', product.id)">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.3 5.8a5 5 0 0 0-7.1 0L12 7l-1.2-1.2a5 5 0 0 0-7.1 7.1L12 21l8.3-8.1a5 5 0 0 0 0-7.1Z" /></svg>
      </button>
    </div>
    <div class="product-card-copy">
      <div class="product-card-heading">
        <span class="product-card-name">{{ product.name }}</span>
        <span class="product-price">{{ formatPrice(product.price) }}</span>
      </div>
      <div class="product-card-meta">
        <span>{{ product.brand }} · {{ product.color }}</span>
        <span v-if="product.previousPrice" class="previous-price">{{ formatPrice(product.previousPrice) }}</span>
      </div>
    </div>
    <RouterLink class="product-card-overlay" :to="{ name: 'product', params: { slug: product.slug }, query: { variante: product.sku } }" :aria-label="`Ver ${product.name}`" />
  </article>
</template>

