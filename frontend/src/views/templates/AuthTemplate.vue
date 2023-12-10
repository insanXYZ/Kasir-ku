<template>
  <form @submit.prevent="$emit('store')" class="w-screen h-screen flex justify-center items-center bg-slate-100">
    <div class="w-[380px] rounded-lg bg-white shadow-xl p-6 flex flex-col gap-8 items-center">
      <img src="svg/favicon.svg" class="w-16">
      <slot></slot>
    </div>
  </form>
</template>
<script>
export default {
  emits: ["store"]
}
</script>