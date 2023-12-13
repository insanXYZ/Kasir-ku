<template>
  <PrintPaper :code="transaction" :money="money" :price="price" :discount="discount" :product="productPrint" class="hidden print:flex"></PrintPaper>
  <BaseTemplate :path="path" header="Kasir" class="print:hidden">
    <skeleton v-if="skeleton == true"></skeleton>
    <div v-if="skeleton == false" class="flex w-full gap-10">
      <div class="flex flex-col w-full gap-5">
        <div class="flex justify-between items-center gap-10">
          <form @submit.prevent="store" class="flex items-center w-full shadow-md rounded-l-md rounded-r-full">
            <input v-model="barqode" ref="input" type="text" class=" p-2 border-Abu bg-white w-full focus:outline-none" placeholder="tekan '/'" autofocus>
            <button class="flex items-center justify-center p-[5px] border-none rounded-r-full bg-Abu"><img src="svg/search.svg" class="w-[33px]"></button>
          </form>
          <ButtonMenu @click="removeAll()">
            <div class="font-work-b">!</div>
            <div class="whitespace-nowrap">Hapus semua</div>
          </ButtonMenu>
        </div>
        <Table @refreshPrice="setPrice" :product="listProduct"></Table>
      </div>
       <RightBar @discount="item => discount = item" @money="item => money = item" @print="print" :price="price"></RightBar>
    </div>
  </BaseTemplate>
</template>
<script>
import RightBar from '../components/Cashier/RightBar.vue';
import PrintPaper from "../components/Cashier/PrintPaper.vue"
import BaseTemplate from './templates/BaseTemplate.vue';
import ButtonMenu from "../components/Product/ButtonMenu.vue";
import { useProductStore } from '../stores/product';
import { getProduct , cashier} from '../methods/product';
import Table from "../components/Cashier/Table.vue";
import { useCashierStore } from '../stores/cashier';
import { toRupiah , randomString } from '../methods/helpers';
import skeleton from '../components/Cashier/skeleton.vue';
import { toast } from 'vue3-toastify';

export default {
  mounted() {
    window.addEventListener("keypress", this.onKeyPress);
  },
  beforeDestroy() {
    window.removeEventListener("keypress", this.onKeyPress);
  },
  data(){
    return {
      product : [],
      transaction : "",
      productPrint : [],
      listProduct : [],
      productId : [],
      barqode : "",
      price : 0 ,
      money : 0 ,
      discount : 0,
      skeleton: true
    }
  },
  methods:{
    onKeyPress(event) {
      if (event.key !== "/") {
        return;
      }
      if (document.activeElement === this.$refs.searchInput) {
        return;
      }
      event.preventDefault();
      this.$refs.input.focus();
    },
    print(){
      let d = new Date().toLocaleDateString().split("/")
      let store = useCashierStore()
      this.productPrint = store.getProduct
      this.transaction = d[0]+d[1]+randomString(6)
      let data = {
        product : this.productPrint.map(item => (
          {
            barqode : item.barqode,
            amount : item.amount
          }
        )),
        desc : this.getDesc(this.productPrint),
        money : this.money,
        profit: this.productPrint.reduce((a,b)=> a + (parseInt(b.profit) * b.amount)   , 0 ) ,
        total : this.productPrint.reduce((a,b) => parseInt(a) + parseInt(b.total) ,0) - parseInt(this.discount) ,
        numberTransaction : this.transaction
      }
      cashier(data).then(response => {
        setTimeout(() => {
          window.print()
          this.$router.go()
        }, 500);
      }).catch(error => {
        toast.error("Server error")
        console.log(error.response.data);
      })
    },  
    getDesc(data){
      let each = []
      data.forEach(element => {
        each.push(`${element.name}(x${element.amount})`)
      });
      let join = each.join(" ")
      return join
    },
    skeletonToggle(){
      this.skeleton = ! this.skeleton
    },
    store(){
      let store = useCashierStore()
      let result = this.product.filter(item => item.barqode == this.barqode.trim())
      this.barqode = ""
      if(! this.productId.includes(result["0"]["id"])){
        let data = {
          name : result["0"]["name"],
          qty : result["0"]["qty"],
          price : result["0"]["price"],
        }
        this.listProduct.push(data)
        data.profit = result["0"]["profit"]
        data.barqode = result["0"]["barqode"]
        data.amount = 1
        data.total = data.amount * data.price
        store.setProduct(data)
        this.setPrice()
      }
    },
    getProductAPI(){
      let store = useProductStore()
      if(store.getProduct.length != 0){
        this.product = store.getProduct
        this.skeletonToggle()
      } else {
        let store = useProductStore()
        getProduct().then(response => {
          store.setProduct(response.data.data)
          this.setProduct(response.data.data)
          this.skeletonToggle()
          }).catch(error => {
            console.log(error.response);
            this.skeletonToggle()
          })
      }
    },
    removeAll(){
      let store = useCashierStore()
      this.transaction = "",
      this.product = [],
      this.listProduct = [],
      this.productId = [],
      this.productPrint = [],
      this.barqode = "",
      this.price = 0
      store.removeAll
    },
    setProduct(data){
      this.product = data
    },
    setPrice(){
      let store = useCashierStore()
      this.price = store.getPrice
    },
    toRupiah
  },
  components: {
    BaseTemplate,
    ButtonMenu,
    Table,
    RightBar,
    PrintPaper,
    skeleton
  },
  props: ["path"],
  created(){
    let store = useCashierStore()
    store.removeAll
    this.getProductAPI(),
    this.transaction = "",
    this.productPrint = [],
    this.listProduct = [],
    this.productId = [],
    this.barqode = "",
    this.price = 0 ,
    this.money = 0 ,
    this.discount = 0
  }
}
</script>