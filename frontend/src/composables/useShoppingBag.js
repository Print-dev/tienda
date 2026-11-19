import { computed, ref } from 'vue'
import { products } from '../data/store'

const readSaved = (key, fallback) => {
  try {
    return JSON.parse(localStorage.getItem(key) || 'null') ?? fallback
  } catch {
    return fallback
  }
}

const lines = ref(readSaved('noma-demo-cart', []))
const favorites = ref(readSaved('noma-demo-favorites', []))

function persist(key, value) {
  try {
    localStorage.setItem(key, JSON.stringify(value))
  } catch {
    // The in-memory demo state remains usable when browser storage is unavailable.
  }
}

export function useShoppingBag() {
  const itemCount = computed(() => lines.value.reduce((sum, line) => sum + line.quantity, 0))
  const subtotal = computed(() =>
    lines.value.reduce((sum, line) => sum + line.price * line.quantity, 0),
  )

  function add(product, quantity = 1, sku = product.sku) {
    const existing = lines.value.find((line) => line.id === product.id && line.sku === sku)
    lines.value = existing
      ? lines.value.map((line) =>
          line.id === product.id && line.sku === sku
            ? { ...line, quantity: line.quantity + quantity }
            : line,
        )
      : [...lines.value, { ...product, sku, quantity }]
    persist('noma-demo-cart', lines.value)
  }

  function remove(id, sku) {
    lines.value = lines.value.filter((line) => line.id !== id || line.sku !== sku)
    persist('noma-demo-cart', lines.value)
  }

  function toggleFavorite(id) {
    favorites.value = favorites.value.includes(id)
      ? favorites.value.filter((item) => item !== id)
      : [...favorites.value, id]
    persist('noma-demo-favorites', favorites.value)
  }

  function productForLine(line) {
    return products.find((product) => product.id === line.id) ?? line
  }

  return { lines, favorites, itemCount, subtotal, add, remove, toggleFavorite, productForLine }
}
