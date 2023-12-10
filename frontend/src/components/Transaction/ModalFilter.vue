<template>
    <div class="w-screen h-screen fixed backdrop-blur-sm bg-black bg-opacity-10 flex justify-center z-40 items-center">
        <div class="p-5 w-[700px] flex flex-col gap-2 bg-white rounded-md shadow-md" >
            <span class="font-work-b">Filter</span>
            <div class="flex w-full gap-2">
                <div class="w-1/3 flex flex-col gap-2">
                    <Button @click="$emit('day')">
                        Hari ini
                    </Button>
                    <Button @click="$emit('week')">
                        Minggu ini
                    </Button>
                    <Button @click="$emit('month')">
                        Bulan ini
                    </Button>
                </div>
                <div class="w-2/3 flex flex-col gap-2">
                    <form @submit.prevent="$emit('between',[start , end])" class="flex items-center justify-between gap-1">
                        <div class="flex items-center gap-1 w-full">
                            <input v-model="start" type="date" class="border p-1 w-full">
                            <span>-</span>
                            <input v-model="end" type="date" class="border p-1 w-full">
                        </div>
                        <button class="bg-Abu rounded-sm p-1 text-white border-Abu">Filter</button>
                    </form>
                    <form @submit.prevent="$emit('date',date)" class="flex items-center gap-1 justify-between">
                        <input v-model="date" type="date" class="border p-1 w-full">
                        <button class="bg-Abu rounded-sm p-1 text-white border-Abu">Filter</button>
                    </form>
                    <div class="flex w-full justify-end">
                        <Button @click="$emit('filterToggle')" class="w-[80px] text-center">
                            Batal
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Input from "./ModalFilter/Input.vue"
import Button from "./ModalFilter/Button.vue"
export default {
    data(){
        return {
            start : null,
            end : null,
            date : null
        }
    },
    components : {
        Input ,
        Button
    },
    emits :[
        "day",'week','month','filterToggle','between','date'
    ]
}
</script>