<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-bs5';
import 'datatables.net-responsive';
import 'datatables.net-select';
 
DataTable.use(DataTablesCore);
 
const columns = [
  { data: 'created_at', title: 'Tanggal' },
  { data: 'numberTransaction', title: 'Nomor Transaksi' },
  { data: 'description', title: 'Deskripsi' },
  { data: 'products', title: 'Produk' },
  { data: 'price', title: 'Total' },
  { data: 'profit', title: 'Keuntungan' },
];

const options = {
  responsive: true,
  select: true,
};
 
</script>
<template>
  <ModalFilter @date="item => handleDate(item)" @between="item => handleBetween(item)" @day="handleDay()" @month="handleMonth()" @week="handleWeek()"  @filterToggle="filterToggle" v-if="modalFilter"></ModalFilter>
  <BaseTemplate :path="path" header="Dashboard">
    <Skeleton v-if="skeleton"></Skeleton>
    <TopBar :title="title" v-show="skeleton == false"  @filterToggle="filterToggle"></TopBar>
    <MainBar v-if="skeleton == false"  :income="income" :profit="profit" :total="total"></MainBar>
    <div v-if="label.length > 1 ">
      <Bar :label="label" :value="value"></Bar>
    </div>
    <DataTable v-if="skeleton == false"
        :columns="columns"
        :options="options"
        :data="histories"
        class="display nowrap"
    />
  </BaseTemplate>
</template>
<script>
import BaseTemplate from './templates/BaseTemplate.vue';
import ButtonMenu from '../components/Product/ButtonMenu.vue';
import {dashboard} from "../methods/product"
import Card from "../components/Dashboard/Card.vue"
import {toRupiah} from "../methods/helpers.js"
import Table from '../components/Dashboard/Table.vue';
import TopBar from "../components/Dashboard/TopBar.vue"
import MainBar from '../components/Dashboard/MainBar.vue';
import ModalFilter from '../components/Dashboard/ModalFilter.vue';
import Skeleton from '../components/Dashboard/Skeleton.vue';
import Bar from "../components/Dashboard/Bar.vue"

export default {
  data(){
    return{
      histories : [],
      income : 0,
      profit : 0,
      total : 0,
      modalFilter : false,
      skeleton : true,
      title : "Bulan ini",
      label : [],
      value : []
    }
  },
  created(){
    this.getHistories({})
  },
  methods: {
    toRupiah,
    getHistories(data){
      this.modalFilter = false
      this.skeleton = true
      dashboard(data).then(response => {
        let data = response.data
        console.log(data);
        this.label = data.labels ? data.labels : [] 
        this.value = data.value ? data.value : []
        this.skeleton = false
        this.income = data.income
        this.profit = data.profit
        this.histories = data.histories
        this.total = data.total
      }).catch(error => {
        this.skeleton = false
        console.log(error.response);
      })
    },
    filterToggle(){
      this.modalFilter = ! this.modalFilter
    },
    handleDate(data){
      this.getHistories({date : data})
      this.title = `Tanggal ${data}`
    },
    handleWeek(){
      this.getHistories({getting : 'week'})
      this.title = "Minggu ini"
    },
    handleMonth(){
      this.getHistories({getting : 'month'})
      this.title = "Bulan ini"
    },
    handleBetween(data){
      this.getHistories({start : data[0],end : data[1]})
      this.title = `Tanggal ${data[0]} - ${data[1]}`
    },
    handleDay(){
      this.getHistories({getting : 'day'})
      this.title = "Hari ini"
    }
  },
  components: {
    BaseTemplate,
    ButtonMenu,
    Card,
    Table,
    TopBar,
    MainBar,
    ModalFilter,
    Skeleton,
    Bar
  },
  props: ["path"]
}
</script>
<style>
  @import 'datatables.net-dt';
</style>