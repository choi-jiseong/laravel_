<template>
    <div class="grid grid-cols">
        <div v-if="currentRoom" class="font-bold text-xl">
            {{ currentRoom.name }} Chatting Room
        </div>
        <select class="float-right" v-model="currentRoom" @change="$emit('roomChanged', currentRoom)">
            <option v-for="(room, index) in rooms" :key="index" :value="room">
                {{ room.name }}
            </option>
        </select>
    </div>
</template>

<script>
export default {
    props : ['rooms', 'currentRoom'],
    data() {
        return {
            // selected: {},
        }
    },
    created() {
        // alert('scretae');
        // this.currentRoom = this.currentRoom;
    },
}
</script>
