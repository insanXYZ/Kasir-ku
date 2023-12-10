<template>
  <button class="w-full flex items-center justify-center gap-2 bg-Abu py-1 font-semibold text-white rounded-sm" :class="{'cursor-wait': loading}"  >
    <img v-show="loading" src="svg/loading.svg" class="w-4">
    <span><slot></slot></span>
</button>
</template>
<script>
export default {
  props: ["loading"]
}
</script>