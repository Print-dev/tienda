<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'
import { heroSlides } from '../../data/store'

const active = ref(0)
const playing = ref(false)
const autoplayAllowed = !window.matchMedia('(prefers-reduced-motion: reduce)').matches
let intervalId

function show(index) {
  active.value = (index + heroSlides.length) % heroSlides.length
}

onMounted(() => {
  heroSlides.forEach(({ image }) => {
    const preload = new window.Image()
    preload.src = image
  })
  if (!autoplayAllowed) return
  playing.value = true
  intervalId = window.setInterval(() => show(active.value + 1), 6500)
})

function togglePlayback() {
  if (!autoplayAllowed) return
  playing.value = !playing.value
  window.clearInterval(intervalId)
  if (playing.value) intervalId = window.setInterval(() => show(active.value + 1), 6500)
}

onBeforeUnmount(() => window.clearInterval(intervalId))
</script>

<template>
  <section class="hero-carousel" aria-label="Historias de temporada" aria-roledescription="carrusel">
    <Transition name="hero-image">
      <div
        :key="active"
        class="hero-slide"
        :style="{ backgroundImage: `url('${heroSlides[active].image}')`, backgroundPosition: heroSlides[active].position }"
        role="group"
        :aria-label="`Fotografía de moda: ${heroSlides[active].title.replace('\\n', ' ')}`"
      >
        <div class="hero-shade" aria-hidden="true"></div>
        <div class="hero-copy page-wrap">
          <p class="hero-eyebrow hero-copy-item">{{ heroSlides[active].eyebrow }}</p>
          <h1 class="hero-copy-item">{{ heroSlides[active].title }}</h1>
          <p class="hero-description hero-copy-item">{{ heroSlides[active].copy }}</p>
          <RouterLink class="button button-light hero-copy-item" :to="{ name: 'category', params: { slug: 'novedades' } }">
            {{ heroSlides[active].action }}
            <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3.5 10h12m-5-5 5 5-5 5" /></svg>
          </RouterLink>
        </div>
      </div>
    </Transition>

    <div class="hero-controls page-wrap">
      <span class="hero-counter">0{{ active + 1 }} <i></i> 0{{ heroSlides.length }}</span>
      <div class="hero-navigation" aria-label="Controles del carrusel">
        <button v-if="autoplayAllowed" class="round-control playback-control" type="button" :aria-label="playing ? 'Pausar carrusel' : 'Reanudar carrusel'" @click="togglePlayback">
          <svg v-if="playing" viewBox="0 0 20 20" aria-hidden="true"><path d="M7 5v10M13 5v10" /></svg>
          <svg v-else viewBox="0 0 20 20" aria-hidden="true"><path d="m7 4 9 6-9 6V4Z" /></svg>
        </button>
        <button class="round-control" type="button" aria-label="Historia anterior" @click="show(active - 1)">
          <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M16.5 10h-12m5 5-5-5 5-5" /></svg>
        </button>
        <button class="round-control" type="button" aria-label="Historia siguiente" @click="show(active + 1)">
          <svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3.5 10h12m-5-5 5 5-5 5" /></svg>
        </button>
      </div>
    </div>
  </section>
</template>

