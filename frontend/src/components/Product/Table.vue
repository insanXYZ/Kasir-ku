<template>
  <table v-if="product.length != 0" class="min-w-full divide-y divide-gray-200 ">
      <thead class="bg-gray-200">
        <tr>
          <Th>kode barqode</Th>
          <Th>nama barang</Th>
          <Th>jumlah</Th>
          <Th>harga</Th>
          <Th>keuntungan</Th>
          <Th>aksi</Th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(item,i) in product" :key="i" class="bg-white rounded-t-lg">
          <Td>{{ item.barqode }}</Td>
          <Td>{{ item.name }}</Td>
          <Td>{{ item.qty }}</Td>
          <Td>{{ toRupiah(item.price) }}</Td>
          <Td>{{ toRupiah(item.profit) }}</Td>
          <td>
            <div class="flex justify-center items-center gap-3">
              <img @click="$emit('setModalUpdate',item)" src="svg/pen.svg" class="w-6 cursor-pointer rounded-md p-1 bg-yellow-200">
              <img @click="deleteProduct(item.id)" src="svg/trash.svg" class="w-6 cursor-pointer rounded-md p-1 bg-red-300" >
            </div>
          </td>
        </tr>
      </tbody>
  </table>
</template>
<script>
import Th from "./Table/Th.vue"
import Td from "./Table/Td.vue"
import {toRupiah} from "../../methods/helpers"
import {confirm} from "../../methods/alert"
import {deleteProduct} from "../../methods/product"
import { toast } from "vue3-toastify"

export default {
  data(){
    return{
    }
  },
  components: {
    Th,
    Td,
  },
  props: ["product"],
  methods:{
    toRupiah,
    deleteProduct(id){
      confirm(this,"svg/trash.svg","Kamu yakin menghapus ini?").then(result => {
        if(result.isConfirmed){
          deleteProduct(id).then(response => {
            this.$emit('delete',id)
            toast.info("Produk berhasil dihapus")
          }).catch(error => {
            console.log(error.response);
            toast.error("Produk gagal dihapus")
          })
        }
      })
    }
  },
  emits: ["delete","setModalUpdate"]
}

</script>