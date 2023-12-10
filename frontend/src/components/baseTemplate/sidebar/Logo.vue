<template>
   <div class="w-full justify-between flex px-5 my-4 items-center">
      <img src="svg/favicon.svg" class="w-11">
      <div @click="out" class="p-2 hover:bg-zinc-100 rounded-full cursor-pointer">
        <img src="svg/logout.svg" class="w-7">
      </div>
    </div>
</template>
<script>
import Cookies from 'js-cookie';
import { confirm } from '../../../methods/alert';
import auth from "../../../methods/auth"
import router from '../../../router';
export default{
  methods : {
    out(){
      confirm(this,"svg/logout.svg","Kamu yakin mau keluar").then(result => {
        if(result.isConfirmed){
          auth.logout().then(response => {
            Cookies.remove("token")
            router.go()
          }).catch(error => {
            console.log(error.response);
          })
        }
      })
    }
  }

}
</script>