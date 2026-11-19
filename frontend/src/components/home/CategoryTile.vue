<script setup>
import { RouterLink } from 'vue-router'

defineProps({ category: { type: Object, required: true }, large: Boolean })
</script>

<template>
  <RouterLink class="category-tile" :class="{ 'category-tile-large': large }" :to="{ name: 'category', params: { slug: category.slug } }">
    <img :src="category.image" :alt="`Ropa de la categoría ${category.name}`" :style="{ objectPosition: category.position }" loading="lazy" />
    <span class="category-tile-shade" aria-hidden="true"></span>
    <span class="category-label">{{ category.name }}<span aria-hidden="true">↗</span></span>
  </RouterLink>
</template>

