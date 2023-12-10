<template>
  <div class="w-screen h-screen fixed backdrop-blur-sm bg-black bg-opacity-10 flex justify-center items-center">
    <form @submit.prevent="store" class="bg-white p-5 rounded-md flex flex-col gap-6">
      <span class="font-work-b">Perbarui produk</span>
      <div class="w-[400px] flex flex-col gap-3">
        <Input :value="name" @input="(item)=> name = item" type="text" placeholder="nama barang"/>
        <Input :value="barqode" @input="(item)=> barqode = item" type="text" placeholder="kode barqode"/>
        <Input :value="qty" @input="(item)=> qty = item" type="number" placeholder="jumlah"/>
        <Input :value="price" @input="(item)=> price = item" type="number" placeholder="harga"/>
        <Input :value="profit" @input="(item)=> profit = item" type="number" placeholder="keuntungan"/>
      </div>
      <div class="flex justify-end gap-2 items-center">
        <ButtonDiv @click="$emit('setModalUpdate')">Batal</ButtonDiv>
        <Button>Perbarui</Button>
      </div>
    </form>
  </div>
</template>
<script>
import Input from './ModalUpdate/Input.vue';
import Button from "./ModalUpdate/Button.vue"
import ButtonDiv from "./ModalUpdate/ButtonDiv.vue"
import { updateProduct } from '../../methods/product';
import { useProductStore } from '../../stores/product';
import {toast} from "vue3-toastify"

export default {
  data(){
    return {
      name : this.data.name,
      barqode : this.data.barqode,
      qty: this.data.qty,
      price : this.data.price,
      profit : this.data.profit,
    }
  },
  components: {
    Input,
    Button,
    ButtonDiv
  },
  props: ["data"],
  emits: ["setModalUpdate","refresh"],
  methods: {
    store(){
      let data = {
        name : this.name,
        barqode : this.barqode,
        qty : this.qty,
        price : this.price,
        profit : this.profit
      }

      updateProduct(this.data.id , data).then(response => {
        let store = useProductStore();
        store.updateProduct(this.data.id , data)
        toast.info("Berhasil memperbarui produk")
        this.$emit('setModalUpdate')
        this.$emit('refresh')
      }).catch(error => {
        toast.error("Gagal memperbarui produk")
        this.$emit('refresh')
        this.$emit('setModalUpdate')
      })
    }
  }
}
</script>