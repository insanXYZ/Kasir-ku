<template>
  <ModalCreate v-if="modalCreate" @setModalCreate="setModalCreate() , getProductAPI()"></ModalCreate>
  <ModalUpdate v-if="modalUpdate" @setModalUpdate="setModalUpdate([])" @refresh="getProductAPI()" :data="dataUpdate"></ModalUpdate>
  <BaseTemplate :path="path" header="Produk">
    <div class="flex items-center justify-between gap-4">
      <div class="flex items-center gap-4">
        <ButtonMenu @click="setModalCreate">
          <span class="font-work-b">+</span>
          <span>Tambah Produk</span>
        </ButtonMenu>
        <ButtonMenu class="cursor-default">
          <span class="font-work-b">!</span>
          <span>{{ product.length }} Produk tersimpan</span>
        </ButtonMenu>
      </div>
      <div class="flex items-center justify-center gap-2">
        <select v-model="kolom" class="p-[6px]">
          <option value="barqode">Kode</option>
          <option value="name">Nama</option>
          <option value="qty">Jumlah</option>
          <option value="price">Harga</option>
          <option value="profit">Untung</option>
        </select>
        <form @submit.prevent="searchByKolom">
          <input type="text" v-model="search" class="border p-1">
          <button type="submit" class="bg-Abu text-white p-1">Cari</button>
        </form>
      </div>
    </div>
      <Table @setModalUpdate="item => setModalUpdate(item)" :product="product" @delete=" id => deleteProduct(id)"></Table>
  </BaseTemplate>
</template>
<script>
import ModalCreate from "../components/Product/ModalCreate.vue"
import ModalUpdate from "../components/Product/ModalUpdate.vue"
import BaseTemplate from './templates/BaseTemplate.vue';
import ButtonMenu from "../components/Product/ButtonMenu.vue"
import Table from "../components/Product/Table.vue";
import { getProduct } from "../methods/product";
import { useProductStore } from "../stores/product";

export default {
  components: {
    BaseTemplate,
    ButtonMenu,
    ModalCreate,
    Table,
    ModalUpdate
  },
  created(){
    this.getProductAPI()
  },  
  data(){
    return{
      modalCreate : false,
      product : [],
      modalUpdate : false,
      dataUpdate: [],
      kolom: "barqode",
      search : ""
    }
  },
  props: ["path"],
  methods: {
    getProductAPI(){
      let store = useProductStore()
      if(store.getProduct.length != 0){
        this.product = store.getProduct
      } else {
        let store = useProductStore()
        getProduct().then(response => {
            store.setProduct(response.data.data)
            this.setProduct(response.data.data)
          }).catch(error => {
            console.log(error.response);
          })
      }
    },
    deleteProduct(id){
      let store = useProductStore()
      store.deleteProduct(id)
      this.getProductAPI()
    },
    setProduct(data){
      this.product = data
    },
    setModalCreate(){
      this.modalCreate = ! this.modalCreate
    },
    setModalUpdate(dataUpdate){
      this.dataUpdate = dataUpdate
      this.modalUpdate = ! this.modalUpdate
    },
    searchByKolom(){
      let store = useProductStore()
      
      this.product =  store.filterProduct(this.kolom,this.search)
    }
  }
}
</script>