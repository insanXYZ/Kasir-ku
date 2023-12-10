import { defineStore } from 'pinia'

export const useProductStore = defineStore('product', {
  state: () => ({
    product : []
  }),
  getters : {
    getProduct : (state) => state.product
  },
  actions: {
    setProduct(data){
      this.product = data
    },
    addProduct(data){
      this.product = [data].concat(this.product)
    },
    deleteProduct(id){
      this.product = this.product.filter(item => item.id != id)
    },
    updateProduct(id, data){
      this.product = this.product.map((obj)=>{
        if(obj.id == id){
          return {...obj,name : data.name, barqode: data.barqode, qty : data.qty, price : data.price , profit: data.profit}
        }
        return obj
      })
    }
  },
})