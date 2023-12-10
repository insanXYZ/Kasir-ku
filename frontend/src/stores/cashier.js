import { defineStore } from 'pinia'

export const useCashierStore = defineStore('cashier', {
  state: () => ({
    product : []
  }),
  getters : {
    getPrice : (state) => {
      let total = 0
      state.product.forEach(item => {
        total += item.total
      });
      return total
    },
    getProduct : (state) => state.product
  },
  actions: {
    setProduct(data){
      this.product.push(data)
    },
    editAmountProduct(amount,index){
      this.product[index].amount = amount
      this.product[index].total = amount * this.product[index].price
    },
    removeAll(){
      this.product = []
    }
  },
})