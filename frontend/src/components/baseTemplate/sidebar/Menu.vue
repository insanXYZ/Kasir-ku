<template>
  <router-link :to="path" class="flex items-center gap-3 pr-5 w-[calc(100%-20px)] py-1 hover:rounded-l-full hover:bg-slate-100 transition-all" :class="{'rounded-l-full' : path ==  pathNow}" :style="{ backgroundColor: path === pathNow ? '#f1f5f9' : '' }">
        <img :src="'svg/'+img" class="w-11 p-2">
        <span class="font-work-b"><slot></slot></span>
  </router-link>
</template>
<script>

export default {  
  props: ["img", "path","pathNow"],

}
</script>