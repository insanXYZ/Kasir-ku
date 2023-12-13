<template>
   <div class="bg-white w-2/5 p-10 flex flex-col gap-4">
      <div class="flex flex-col items-center justify-between gap-5">
        <div class="flex flex-col gap-2 w-full">
        <span class="text-lg">
          Diskon
        </span>
        <input v-model="discount" type="number" class="p-1 border focus:outline-none w-full rounded-md ">
        </div>
        <div class="flex flex-col gap-2 w-full">
          <span class="text-lg">
            Uang
          </span>
          <input v-model="money" type="number" class="p-1 border focus:outline-none w-full rounded-md ">
        </div>
      </div>
      <hr>
      <div class="flex flex-col justify-between gap-3">
        <span class=" text-lg">Kembalian</span>
        <span class="font-work-b text-2xl">{{ toRupiah(money - (price-discount) < 0 ? 0 : money - (price-discount)) }}</span>
      </div>
      <div class="flex flex-col justify-between gap-3">
        <span class="text-lg">Total</span>
        <span class="font-work-b text-2xl">{{ toRupiah(price - discount) }}</span>
      </div>
      <hr>
      <input type="submit" @click="print" value="Print" class="w-full bg-Abu py-1 font-work-b text-center text-white rounded-sm cursor-pointer" />
    </div>
</template>
<script>
import {toRupiah} from "../../methods/helpers"

export default {
  data(){
    return {
      discount : 0,
      money: 0
    }
  },
  watch : {
    discount(){
      this.$emit('discount',this.discount)
    },
    money(){
      this.$emit('money',this.money)
    },
  },
  methods: {
    toRupiah,
    print(){
      this.$emit('print')
    }
  },
  emits : ["discount","money","print"],
  props : ["price"]
}
</script>