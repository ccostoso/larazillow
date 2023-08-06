<template>
  <form @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.priceMin" type="text" placeholder="Min. price"
          class="input-filter-l w-28"
        />
        <input
          v-model.number="filterForm.priceMax" type="text" placeholder="Max. price"
          class="input-filter-r w-28"
        />
      </div>

      <div class="flex flex-nowrap items-center">
        <select id="" v-model="filterForm.beds" name="" class="input-filter-l w-28">
          <option :value="null">Beds</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option value="6+">6+</option>
        </select>
        <select id="" v-model="filterForm.baths" name="" class="input-filter-r w-28">
          <option :value="null">Baths</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option value="6+">6+</option>
        </select>
      </div>

      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.areaMin" type="text" placeholder="Min. area"
          class="input-filter-l w-28"
        />
        <input
          v-model.number="filterForm.areaMax" type="text" placeholder="Max. area"
          class="input-filter-r w-28"
        />
      </div>

      <button type="submit" class="btn-primary">Filter</button>
      <button type="reset" class="btn-normal" @click="reset">Clear</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  filters: Object,
})
const filterForm = useForm({
  priceMin: props.filters.priceMin ?? null,
  priceMax: props.filters.priceMax ?? null,
  beds: props.filters.beds ?? null,
  baths: props.filters.baths ?? null,
  areaMin: props.filters.areaMin ?? null,
  areaMax: props.filters.areaMax ?? null,
})
const filter = () => {
  filterForm.get(
    route('listing.index'),
    {
      preserveState: true,
      preserveScroll: true,
    },
  )
}
const reset = () => {
  filterForm.priceMin = null
  filterForm.priceMax = null
  filterForm.beds = null
  filterForm.baths = null
  filterForm.areaMin = null
  filterForm.areaMax = null
  filter()
}
</script>