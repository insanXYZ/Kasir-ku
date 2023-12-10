<template>
  <table class="divide-y divide-gray-200 ">
      <thead class="bg-gray-200">
        <tr>
          <Th>Tanggal</Th>
          <Th>Deskripsi</Th>
          <Th>Produk</Th>
          <Th>Total</Th>
          <Th>Keuntungan</Th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200 ">
        <tr v-for="(item , i) in histories" :key="i" class="bg-white rounded-t-lg">
          <Td class="w-[180px]">{{ item.created_at }}</Td>
          <Td>{{ item.description }}</Td>
          <Td>{{ item.products }}</Td>
          <Td>{{ item.price }}</Td>
          <Td>{{ item.profit }}</Td>
        </tr>
      </tbody>
  </table>
</template>
<script>
import Th from "./Table/Th.vue"
import Td from "./Table/Td.vue"

export default {
  components: {
    Th,
    Td,
  },
  props: ["histories"]
}

</script>