<template>
  <h1 class="text-3xl mb-4">Your Listings</h1>
  <section>
    <RealtorFilters :filters="props.filters" />
  </section>

  <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    <Box v-for="(listing, index) in listings" :key="index">
      <div class="flex flex-col md:flex-row md:items-center gap-2 justify-between">
        <section>
          <div class="xl:flex items-center gap-2">
            <Price :price="listing.price" class="text-2xl font-medium" />
            <ListingSpace :listing="listing" />
          </div>
          <ListingAddress :listing="listing" class="text-gray-500" />
        </section>
        <section class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
          <Link :href="route('listing.show', { listing: listing.id })" class="btn-outline text-xs font-medium">
            Preview
          </Link>
          <Link class="btn-outline text-xs font-medium">Edit</Link>
          <Link class="btn-outline text-xs font-medium" :href="route('realtor.listing.destroy', { listing: listing.id })" method="DELETE" as="button">
            Delete
          </Link>
        </section>
      </div>
    </Box>
  </section>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  listings: Array,
  filters: Object,
})
</script>