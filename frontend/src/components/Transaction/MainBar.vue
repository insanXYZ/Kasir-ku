<template>
  <div class="flex items-center gap-4 w-full">
      <Card class="w-3/6">
        <span class="font-work-b text-5xl">
          {{ toRupiah(income) }}
        </span>
        <hr>
        <span>
          Pendapatan 
        </span>
      </Card>
      <Card class="w-2/6">
        <span class="font-work-b text-3xl">
          {{ toRupiah(profit) }}
        </span>
        <hr>
        <span>
          Keuntungan
        </span>
      </Card>
      <Card class="w-1/6">
        <span class="font-work-b text-2xl">
            {{ total }}
        </span>
        <hr>
        <span>
          Transaksi
        </span>
      </Card>
    </div>
</template>
<script>
import {toRupiah} from "../../methods/helpers"
import Card from "../Dashboard/Card.vue";
export default {
  methods: {
    toRupiah,
  },
  components : {
    Card
  },
  props : ["income","profit","total"]
}
</script>