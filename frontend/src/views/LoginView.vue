<template>
  <Auth @store="store">
    <div class="w-full flex flex-col gap-3">
      <Input @input="item => id = item" For="id" Type="text">Id Kasir</Input>
      <Input @input="item => password = item " For="password" Type="password">Kata Sandi</Input>
    </div>
    <Button :loading="loading">Masuk</Button>
  </Auth>
</template>
<script>

import Auth from "./templates/AuthTemplate.vue"
import Input from "../components/auth/Input.vue";
import Button from "../components/auth/Button.vue";
import authMethod from "../methods/auth"
import cookies from "js-cookie"
import { toast } from "vue3-toastify";

export default {
  data(){
    return{
      id : '',
      password : '',
      loading : false
    }
  },
  components:{
    Auth,
    Input,
    Button
  },
  methods: {
    toggleLoading(){
      this.loading = ! this.loading
    },
    store(){
      
      this.toggleLoading()

      const data = {
        cashier_id : this.id,
        password : this.password
      }

      authMethod.login(data).then(response => {
        this.toggleLoading()
        cookies.set("token",response.data.token)
        this.$router.go()
      }).catch(() => {
        this.toggleLoading()
        toast.error("Gagal login")
      })
    }
  }
}
</script>