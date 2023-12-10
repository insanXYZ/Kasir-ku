<template>
  <Td>{{ i+1 }}</Td>
  <Td>{{ data.name }}</Td>
  <Td><input v-model="qty" type="number" class="border p-1"  min="1" :max="data.qty"></Td>
  <Td>{{ toRupiah(data.price) }}</Td>
</template>
<script>
import { toRupiah } from '../../../methods/helpers';
import { useCashierStore } from '../../../stores/cashier';
import Td from './Td.vue';
export default {
  data(){
    return {
      qty: 1,
    }
  },
  watch: {
    qty(){
      let store = useCashierStore()
      store.editAmountProduct(this.qty,this.i)
      this.$emit('refreshPrice')
    }
  },
  methods: {
    toRupiah
  },
  components: {
    Td
  },
  emits: ["refreshPrice"],
  props: ["data", "i"]
}
</script>