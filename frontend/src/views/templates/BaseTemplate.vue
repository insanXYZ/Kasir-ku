<template>
  <div class="w-full h-screen flex overflow-y-hidden bg-slate-100">
    <Sidebar :path="path"></Sidebar>
    <div class="w-full h-full overflow-y-auto p-10">
      <div class="w-full h-full flex flex-col gap-5">
        <span class="font-work-b text-3xl">{{ header }}</span>
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script>
import Sidebar from "../../components/baseTemplate/Sidebar.vue"
export default {
  components: {
    Sidebar,
  },
  props: ["path","header"]
}
</script>