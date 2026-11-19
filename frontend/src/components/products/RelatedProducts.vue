<script setup>
import ProductCard from './ProductCard.vue'

defineProps({
  products: { type: Array, default: () => [] },
  favorites: { type: Array, default: () => [] },
})

defineEmits(['favorite'])
</script>

<template>
  <section class="related-section page-wrap" aria-labelledby="related-title">
    <div class="section-heading related-heading">
      <div><span class="eyebrow">MÁS PARA DESCUBRIR</span><h2 id="related-title">También te puede interesar</h2></div>
    </div>
    <div class="product-grid">
      <ProductCard
        v-for="product in products"
        :key="product.id"
        :product="product"
        :favorite="favorites.includes(product.id)"
        @favorite="$emit('favorite', $event)"
      />
    </div>
  </section>
</template>
