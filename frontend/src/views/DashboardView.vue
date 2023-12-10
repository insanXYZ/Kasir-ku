<template>
  <BaseTemplate :path="path" header="Dashboard">
    <skeleton v-if="skeleton"></skeleton>
    <div v-if="skeleton == false" class="w-full grid items-center">
      <Card>
        <span class="font-work-b text-5xl">
          {{ toRupiah(income_today) }}
        </span>
        <hr>
        <span>
          Pendapatan hari ini
        </span>
      </Card>
    </div>
    <div class="grid grid-cols-3 gap-4 w-full">
      <Card>
        <span class="font-work-b text-2xl">
          {{ amountProduct.length }}
        </span>
        <hr>
        <span>
          Jumlah produk
        </span>
      </Card>
      <Card>
        <span class="font-work-b text-2xl">
          {{ transaction_today }}
        </span>
        <hr>
        <span>
          Transaksi hari ini
        </span>
      </Card>
      <Card class="py-2 flex items-center justify-center">
        <Bar :now="income_today" :yesterday="income_yesterday"></Bar>
      </Card>
    </div>
    <hr>
    <Table :histories="histories"></Table>
</BaseTemplate>
</template>
<script>
import BaseTemplate from './templates/BaseTemplate.vue';
import Card from "../components/Dashboard/Card.vue"
import Bar from '../components/Dashboard/Bar.vue';
import { getProduct , dashboard} from '../methods/product';
import { useProductStore } from '../stores/product';
import skeleton from '../components/Dashboard/skeleton.vue';
import { toRupiah } from '../methods/helpers';
import Table from '../components/Dashboard/Table.vue';
export default {
  components: {
    BaseTemplate,
    Card,
    Bar,
    skeleton,
    Table
  },
  props: ["path"],
  data(){
    return{
      amountProduct : [],
      histories : [],
      transaction_today : 0,
      income_today: 0,
      income_yesterday: 0,
      skeleton : true
    }
  },
  created(){
    this.getProduct(),
    dashboard().then(response => {
      let data = response.data
      this.histories = data.histories
      this.transaction_today = data.transaction_today
      this.income_today = data.income_today
      this.income_yesterday = data.income_yesterday
    }).catch(error => {
      console.log(error.response);
    })
  },
  methods: {
    toRupiah,
    skeletonToggle(){
      this.skeleton = !this.skeleton
    },  
    getProduct(){
      let store = useProductStore()
      if(store.getProduct.length != 0){
        this.skeletonToggle()
        this.amountProduct = store.getProduct
      } else {
        this.setProduct()
      }
    },
    setProduct(){
      let store = useProductStore()
      getProduct().then(response => {
          this.skeletonToggle()
          store.setProduct(response.data.data)
          this.amountProduct = response.data.data
        }).catch(error => {
          console.log(error.response);
        })
    },
  }
}
</script>