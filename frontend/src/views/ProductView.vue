<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
import 'datatables.net-responsive';
import 'datatables.net-select';
DataTable.use(DataTablesCore);
</script>
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
      </div>
    </div>
    <DataTable
        :columns="columns"
        :options="options"
        :data="product"
        class="display nowrap"
        @click="handleCellClick"
    />
    <!-- <Table @setModalUpdate="item => setModalUpdate(item)" :product="product" @delete=" id => deleteProduct(id)"></Table> -->
</BaseTemplate>
</template>
<script>
import ModalCreate from "../components/Product/ModalCreate.vue"
import ModalUpdate from "../components/Product/ModalUpdate.vue"
import BaseTemplate from './templates/BaseTemplate.vue';
import ButtonMenu from "../components/Product/ButtonMenu.vue"
import Table from "../components/Product/Table.vue";
import { getProduct , deleteProduct } from "../methods/product";
import { useProductStore } from "../stores/product";
import { toRupiah } from '../methods/helpers';
import { confirm } from '../methods/alert';
import { toast } from "vue3-toastify"

export default {
  components: {
    BaseTemplate,
    ButtonMenu,
    ModalCreate,
    Table,
    ModalUpdate,
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
      search : "",
      columns : [
        { data: 'barqode', title: 'Kode Barqode' },
        { data: 'name', title: 'Nama Barang' },
        { data: 'qty',title: 'Jumlah' },
        { data: null,
          title: 'Harga',
          render: function(data,type,row){
            return toRupiah(row.price)
          } 
        },
        { data: null,
          title: 'Keuntungan',
          render: function(data,type,row){
            return toRupiah(row.profit)
          } 
        },
        {
          data: null,
          title: 'Aksi',
          sortable : false,
          render: function(data, type, row) {
            console.log(row);
            return `
              <div class='flex items-center gap-2'>
                <img data-name="${row.name}" data-barqode="${row.barqode}" data-qty="${row.qty}" data-price="${row.price}" data-profit="${row.profit}" data-id="${row.id}" data-action="edit" src="svg/pen.svg" class="w-6 cursor-pointer rounded-md p-1 bg-yellow-200">
                <img data-id="${row.id}" data-action="delete" src="svg/trash.svg" class="w-6 cursor-pointer rounded-md p-1 bg-red-300">
              </div>
            `;
          }
        }
      ],
      options : {
        responsive: true,
      }
    }
  },
  props: ["path"],
  methods: {
    toRupiah,
    handleCellClick(event){
      let set = event.srcElement.dataset
      if(set.action == "delete"){
        let id = event.srcElement.dataset.id
        this.deleteProduct(id)
      } 
      if(set.action == "edit"){
        let data = {
          name : set.name,
          barqode : set.barqode,
          qty : set.qty,
          price : set.price,
          profit : set.profit,
          id : set.id
        }

        this.setModalUpdate(data)
      }
    },  
    deleteProduct(id){
      confirm(this,"svg/trash.svg","Kamu yakin menghapus ini?").then(result => {
        if(result.isConfirmed){
          deleteProduct(id).then(response => {
            this.deleteProductById(id)
            toast.info("Produk berhasil dihapus")
          }).catch(error => {
            console.log(error.response);
            toast.error("Produk gagal dihapus")
          })
        }
      })
    },
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
    deleteProductById(id){
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
