export const storeIdentity = {
  name: 'Noma',
  mark: 'n.',
  note: 'Una tienda de ropa para todos los días.',
}

const photo = (id, width = 900) =>
  `https://images.unsplash.com/${id}?auto=format&fit=crop&w=${width}&q=85`

export const categories = [
  {
    name: 'Polos',
    slug: 'polos',
    description: 'Los esenciales que siempre vuelven.',
    image: photo('photo-1521572163474-6864f9cf17ab', 1000),
    position: 'center 48%',
  },
  {
    name: 'Pantalones',
    slug: 'pantalones',
    description: 'Calces cómodos, de la mañana a la noche.',
    image: photo('photo-1542272604-787c3835535d', 1000),
    position: 'center 45%',
  },
  {
    name: 'Zapatillas',
    slug: 'zapatillas',
    description: 'Un buen paso cambia el día.',
    image: photo('photo-1542291026-7eec264c27ff', 1000),
    position: 'center 50%',
  },
  {
    name: 'Casacas',
    slug: 'casacas',
    description: 'Una capa más, sin complicarse.',
    image: photo('photo-1551028719-00167b16eac5', 1000),
    position: 'center 40%',
  },
  {
    name: 'Accesorios',
    slug: 'accesorios',
    description: 'Pequeños detalles, muchas formas de llevarlos.',
    image: photo('photo-1553062407-98eeb64c6a62', 1000),
    position: 'center 45%',
  },
]

export const products = [
  {
    id: 'polo-esencial',
    name: 'Polo esencial de algodón',
    brand: 'Noma Studio',
    slug: 'polo-esencial-algodon',
    category: 'polos',
    price: 39,
    previousPrice: 49,
    description: 'Punto suave de algodón, cuello redondo y un calce relajado que combina con capas ligeras o con tus prendas favoritas de diario.',
    color: 'Marfil',
    availableColors: ['Marfil', 'Negro'],
    variantColorTokens: { Marfil: 'MARFIL', Negro: 'NEGRO' },
    image: photo('photo-1521572163474-6864f9cf17ab'),
    imageAlt: 'Polo de algodón en tono claro, sobre fondo neutro',
    imagePosition: 'center 48%',
    sku: 'NOMA-POLO-MARFIL-M',
    sizes: ['S', 'M', 'L', 'XL'],
    variantSkus: { S: 'NOMA-POLO-MARFIL-S', M: 'NOMA-POLO-MARFIL-M', L: 'NOMA-POLO-MARFIL-L', XL: 'NOMA-POLO-MARFIL-XL' },
    badge: 'Favorito',
  },
  {
    id: 'camisa-lino',
    name: 'Polo camisero ligero de lino',
    brand: 'Casa Norte',
    slug: 'camisa-ligera-lino',
    category: 'polos',
    price: 89,
    previousPrice: null,
    description: 'Lino ligero y transpirable con una caída natural. Llévala abierta sobre una camiseta o cerrada para un look más cuidado.',
    color: 'Arena',
    availableColors: ['Arena', 'Blanco'],
    variantColorTokens: { Arena: 'ARENA', Blanco: 'BLANCO' },
    image: photo('photo-1598033129183-c4f50c736f10'),
    imageAlt: 'Camisa ligera en tono arena, exhibida sobre una percha',
    imagePosition: 'center 40%',
    sku: 'CN-CAMISA-ARENA-M',
    sizes: ['S', 'M', 'L'],
    variantSkus: { S: 'CN-CAMISA-ARENA-S', M: 'CN-CAMISA-ARENA-M', L: 'CN-CAMISA-ARENA-L' },
    badge: null,
  },
  {
    id: 'jean-recto',
    name: 'Jean recto de tiro medio',
    brand: 'Noma Studio',
    slug: 'jean-recto-tiro-medio',
    category: 'pantalones',
    price: 109,
    previousPrice: 129,
    description: 'Denim de peso medio y tiro cómodo, con pierna recta para un calce fácil de llevar durante todo el día.',
    color: 'Azul clásico',
    availableColors: ['Azul clásico', 'Negro'],
    variantColorTokens: { 'Azul clásico': 'AZUL', Negro: 'NEGRO' },
    image: photo('photo-1542272604-787c3835535d'),
    imageAlt: 'Jean azul de corte recto fotografiado en detalle',
    imagePosition: 'center 50%',
    sku: 'NOMA-JEAN-AZUL-30',
    sizes: ['28', '30', '32', '34'],
    variantSkus: { 28: 'NOMA-JEAN-AZUL-28', 30: 'NOMA-JEAN-AZUL-30', 32: 'NOMA-JEAN-AZUL-32', 34: 'NOMA-JEAN-AZUL-34' },
    badge: '−15%',
  },
  {
    id: 'zapatilla-canvas',
    name: 'Zapatilla urbana en rojo',
    brand: 'Distrito 04',
    slug: 'zapatilla-urbana-lona',
    category: 'zapatillas',
    price: 119,
    previousPrice: null,
    description: 'Una silueta urbana de lona con suela flexible y cordones clásicos, pensada para acompañarte en tus recorridos cotidianos.',
    color: 'Rojo',
    availableColors: ['Rojo', 'Negro'],
    variantColorTokens: { Rojo: 'BLANCO', Negro: 'NEGRO' },
    image: photo('photo-1542291026-7eec264c27ff'),
    imageAlt: 'Zapatilla roja de perfil sobre un fondo cálido',
    imagePosition: 'center 50%',
    sku: 'D04-CANVAS-BLANCO-39',
    sizes: ['37', '38', '39', '40', '41'],
    variantSkus: { 37: 'D04-CANVAS-BLANCO-37', 38: 'D04-CANVAS-BLANCO-38', 39: 'D04-CANVAS-BLANCO-39', 40: 'D04-CANVAS-BLANCO-40', 41: 'D04-CANVAS-BLANCO-41' },
    badge: null,
  },
  {
    id: 'casaca-denim',
    name: 'Casaca denim relajada',
    brand: 'Casa Norte',
    slug: 'casaca-denim-relajada',
    category: 'casacas',
    price: 149,
    previousPrice: 179,
    description: 'Denim lavado con estructura suave, bolsillos funcionales y espacio para llevarla sobre una camiseta o un tejido ligero.',
    color: 'Azul lavado',
    availableColors: ['Azul lavado', 'Negro'],
    variantColorTokens: { 'Azul lavado': 'AZUL', Negro: 'NEGRO' },
    image: photo('photo-1543076447-215ad9ba6923'),
    imageAlt: 'Prenda denim azul en una composición editorial',
    imagePosition: 'center 45%',
    sku: 'CN-DENIM-AZUL-M',
    sizes: ['S', 'M', 'L', 'XL'],
    variantSkus: { S: 'CN-DENIM-AZUL-S', M: 'CN-DENIM-AZUL-M', L: 'CN-DENIM-AZUL-L', XL: 'CN-DENIM-AZUL-XL' },
    badge: '−17%',
  },
  {
    id: 'bolso-diario',
    name: 'Mochila ligera para diario',
    brand: 'Noma Studio',
    slug: 'bolso-ligero-diario',
    category: 'accesorios',
    price: 79,
    previousPrice: null,
    description: 'Una mochila liviana con espacio para tus básicos, bolsillos prácticos y una forma sencilla que combina con cualquier plan.',
    color: 'Negro',
    image: photo('photo-1553062407-98eeb64c6a62'),
    imageAlt: 'Mochila oscura funcional para llevar a diario',
    imagePosition: 'center 45%',
    sku: 'NOMA-BOLSO-NEGRO-STD',
    sizes: ['Única'],
    variantSkus: { 'Única': 'NOMA-BOLSO-NEGRO-STD' },
    badge: null,
  },
  {
    id: 'polo-rayas',
    name: 'Polo de punto a rayas',
    brand: 'Distrito 04',
    slug: 'polo-punto-rayas',
    category: 'polos',
    price: 59,
    previousPrice: null,
    description: 'Tejido de punto agradable al tacto con un patrón de rayas discreto y un corte cómodo que funciona solo o bajo una casaca.',
    color: 'Marino',
    availableColors: ['Marino', 'Blanco'],
    variantColorTokens: { Marino: 'MARINO', Blanco: 'BLANCO' },
    image: photo('photo-1576566588028-4147f3842f27'),
    imageAlt: 'Polo de punto en tonos neutros',
    imagePosition: 'center 40%',
    sku: 'D04-PUNTO-MARINO-M',
    sizes: ['S', 'M', 'L'],
    variantSkus: { S: 'D04-PUNTO-MARINO-S', M: 'D04-PUNTO-MARINO-M', L: 'D04-PUNTO-MARINO-L' },
    badge: 'Nuevo',
  },
  {
    id: 'casaca-urbana',
    name: 'Casaca urbana liviana',
    brand: 'Noma Studio',
    slug: 'casaca-urbana-liviana',
    category: 'casacas',
    price: 169,
    previousPrice: null,
    description: 'Una capa ligera de inspiración urbana, con bolsillos amplios y un tono fácil de combinar para los días que empiezan frescos.',
    color: 'Oliva',
    availableColors: ['Oliva', 'Negro'],
    variantColorTokens: { Oliva: 'OLIVA', Negro: 'NEGRO' },
    image: photo('photo-1551028719-00167b16eac5'),
    imageAlt: 'Casaca de estilo urbano en una toma de moda',
    imagePosition: 'center 45%',
    sku: 'NOMA-CASACA-OLIVA-M',
    sizes: ['S', 'M', 'L', 'XL'],
    variantSkus: { S: 'NOMA-CASACA-OLIVA-S', M: 'NOMA-CASACA-OLIVA-M', L: 'NOMA-CASACA-OLIVA-L', XL: 'NOMA-CASACA-OLIVA-XL' },
    badge: null,
  },
]

export const heroSlides = [
  {
    eyebrow: 'NUEVA TEMPORADA · 01 / 03',
    title: 'Vestirse bien\npuede ser simple.',
    copy: 'Prendas cómodas, buenos cortes y espacio para ser tú.',
    action: 'Explorar novedades',
    image: photo('photo-1529139574466-a303027c1d8b', 2000),
    position: 'center 38%',
  },
  {
    eyebrow: 'HECHAS PARA EL DÍA A DÍA · 02 / 03',
    title: 'Menos vueltas.\nMás estilo propio.',
    copy: 'Encuentra esos básicos que combinan con todo lo que eres.',
    action: 'Ver esenciales',
    image: photo('photo-1539109136881-3be0616acf4b', 2000),
    position: 'center 40%',
  },
  {
    eyebrow: 'IDEAS PARA LLEVAR · 03 / 03',
    title: 'Tu próximo\nfavorito está aquí.',
    copy: 'Una selección de ropa y accesorios para moverte a tu manera.',
    action: 'Descubrir la colección',
    image: photo('photo-1515886657613-9f3515b0c78f', 2000),
    position: 'center 36%',
  },
]

export const formatPrice = (amount) =>
  new Intl.NumberFormat('es-PE', {
    style: 'currency',
    currency: 'PEN',
    maximumFractionDigits: 0,
  }).format(amount)

export const skuForSize = (product, size) => product.variantSkus?.[size] ?? product.sku

export function colorsForProduct(product) {
  return product?.availableColors ?? [product?.color].filter(Boolean)
}

export function skuForVariant(product, size, color) {
  if (!product?.sizes?.includes(size) || !colorsForProduct(product).includes(color)) return null
  const baseSku = skuForSize(product, size)
  if (color === product.color) return baseSku
  const sourceToken = product.variantColorTokens?.[product.color]
  const targetToken = product.variantColorTokens?.[color]
  return sourceToken && targetToken ? baseSku.replace(sourceToken, targetToken) : null
}

export function variantForSku(product, sku) {
  if (!product || !sku) return null
  for (const color of colorsForProduct(product)) {
    for (const size of product.sizes) {
      if (skuForVariant(product, size, color) === sku) return { color, size, sku }
    }
  }
  return null
}

const extraProductViews = {
  'polo-esencial': ['photo-1512436991641-6745cdb1723f', 'photo-1551488831-00ddcb6c6bd3'],
  'camisa-lino': ['photo-1596755094514-f87e34085b2c', 'photo-1603252109303-2751441dd157'],
  'jean-recto': ['photo-1541099649105-f69ad21f3246', 'photo-1515886657613-9f3515b0c78f'],
  'zapatilla-canvas': ['photo-1525966222134-fcfa99b8ae77', 'photo-1519741497674-611481863552'],
  'casaca-denim': ['photo-1516257984-b1b4d707412e', 'photo-1551028719-00167b16eac5'],
  'bolso-diario': ['photo-1548036328-c9fa89d128fa', 'photo-1512436991641-6745cdb1723f'],
  'polo-rayas': ['photo-1564859228273-274232fdb516', 'photo-1551488831-00ddcb6c6bd3'],
  'casaca-urbana': ['photo-1529139574466-a303027c1d8b', 'photo-1516257984-b1b4d707412e'],
}

const alternateColorViews = {
  'polo-esencial': { Negro: 'photo-1503342217505-b0a15ec3261c' },
  'camisa-lino': { Blanco: 'photo-1603252109303-2751441dd157' },
  'jean-recto': { Negro: 'photo-1539533018447-63fcce2678e3' },
  'zapatilla-canvas': { Negro: 'photo-1525966222134-fcfa99b8ae77' },
  'casaca-denim': { Negro: 'photo-1529139574466-a303027c1d8b' },
  'polo-rayas': { Blanco: 'photo-1564859228273-274232fdb516' },
  'casaca-urbana': { Negro: 'photo-1516257984-b1b4d707412e' },
}

export function galleryForProduct(product, color = product?.color) {
  if (!product) return []
  const selectedView = alternateColorViews[product.id]?.[color]
  const candidates = [
    selectedView ? photo(selectedView, 1400) : product.image,
    product.image,
    ...(extraProductViews[product.id] ?? []).map((id) => photo(id, 1400)),
  ]
  const seen = new Set()
  return candidates.filter((url) => {
    if (!url) return false
    const id = url.match(/images\.unsplash\.com\/([^?]+)/)?.[1] ?? url
    if (seen.has(id)) return false
    seen.add(id)
    return true
  }).slice(0, 4)
}
