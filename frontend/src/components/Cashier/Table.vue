<template>
  <table v-if="product.length != 0" class="min-w-full divide-y divide-gray-200 ">
      <thead class="bg-gray-200">
        <tr>
          <Th class="w-[50px]">No</Th>
          <Th>nama barang</Th>
          <Th>jumlah</Th>
          <Th>harga</Th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(item , i) in product" class="bg-white rounded-t-lg">
          <TdList :data="item" :i="i" @refreshPrice="$emit('refreshPrice')"></TdList>
        </tr>
      </tbody>
  </table>
</template>
<script>
import Th from "../Cashier/Table/Th.vue";
import TdList from "../Cashier/Table/TdList.vue";
import { toRupiah } from "../../methods/helpers";

export default {
  components: {
    Th,
    TdList
  },
  data(){
    return{
      qty: 1,
    }
  },
  methods: {
    toRupiah
  },
  emits:["refreshPrice"],
  props: ["product"],
}

</script>