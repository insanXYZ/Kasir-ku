<template>
  <div class="w-screen h-screen fixed backdrop-blur-sm bg-black bg-opacity-10 flex justify-center items-center">
    <form @submit.prevent="store" class="bg-white p-5 rounded-md flex flex-col gap-6">
      <span class="font-work-b">Buat produk</span>
      <div class="w-[400px] flex flex-col gap-3">
        <Input @input="(item)=> name = item" type="text" placeholder="nama barang"/>
        <Input @input="(item)=> barqode = item" type="text" placeholder="kode barqode"/>
        <Input @input="(item)=> qty = item" type="number" placeholder="jumlah"/>
        <Input @input="(item)=> price = item" type="number" placeholder="harga"/>
        <Input @input="(item)=> profit = item" type="number" placeholder="keuntungan"/>
      </div>
      <div class="flex justify-end gap-2 items-center">
        <ButtonDiv @click="$emit('setModalCreate')">Batal</ButtonDiv>
        <Button :class="{'cursor-wait': loading}"><img v-if="loading" src="svg/loading.svg" class="w-5" alt="">Kirim</Button>
      </div>
    </form>
  </div>
</template>
<script>
import Input from './ModalCreate/Input.vue';
import Button from "./ModalCreate/Button.vue"
import ButtonDiv from "./ModalCreate/ButtonDiv.vue"
import {input} from "../../methods/product"
import { useProductStore } from '../../stores/product';
import { toast } from 'vue3-toastify';

export default {
  data(){
    return {
      name : "",
      barqode : "",
      qty: "",
      price : "",
      profit : "",
      loading : false
    }
  },
  components: {
    Input,
    Button,
    ButtonDiv
  },
  emits : ["setModalCreate"],
  methods: {
    store(){
      let data = {
        name : this.name,
        barqode : this.barqode,
        qty : this.qty,
        price : this.price,
        profit : this.profit
      }
      this.toggleLoading()
      input(data).then(response => {
        this.toggleLoading()
        let store = useProductStore()
        toast.info("Barang berhasil di tambahkan")
        store.addProduct(response.data.product)
        this.$emit('setModalCreate')
      }).catch(error => {
        toast.error("Barang gagal di tambahkan")
        this.toggleLoading()
        console.log(error.response);
      })
    },
    toggleLoading(){
      this.loading = ! this.loading
    }
  }
}
</script>