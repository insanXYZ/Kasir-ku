<template>
  <ModalFilter @date="item => handleDate(item)" @between="item => handleBetween(item)" @day="handleDay()" @month="handleMonth()" @week="handleWeek()"  @filterToggle="filterToggle" v-if="modalFilter"></ModalFilter>
  <BaseTemplate :path="path" header="Transaksi">
    <Skeleton v-if="skeleton"></Skeleton>
    <TopBar :title="title" v-show="skeleton == false"  @filterToggle="filterToggle"></TopBar>
    <MainBar v-if="skeleton == false"  :income="income" :profit="profit" :total="total"></MainBar>
    <Table v-if="skeleton == false"  :histories="histories"></Table>
  </BaseTemplate>
</template>
<script>
import BaseTemplate from './templates/BaseTemplate.vue';
import ButtonMenu from '../components/Product/ButtonMenu.vue';
import {transaction} from "../methods/product"
import Card from "../components/Dashboard/Card.vue"
import {toRupiah} from "../methods/helpers.js"
import Table from '../components/Transaction/Table.vue';
import TopBar from "../components/Transaction/TopBar.vue"
import MainBar from '../components/Transaction/MainBar.vue';
import ModalFilter from '../components/Transaction/ModalFilter.vue';
import Skeleton from '../components/Transaction/Skeleton.vue';

export default {
  data(){
    return{
      histories : [],
      income : 0,
      profit : 0,
      total : 0,
      modalFilter : false,
      skeleton : true,
      title : "Bulan ini"
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
      transaction(data).then(response => {
        let data = response.data
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
    Skeleton
  },
  props: ["path"]
}
</script>