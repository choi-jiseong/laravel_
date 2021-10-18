<template>
    <app-layout>
        <template #header>
            <div>
                <chat-room-selection
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomChanged="setRoom($event)"
                />
            </div>
        </template>
        <!-- <message-container :messages="messages"/> -->
        <styled-message-container :messages="messages"/>
        <input-message :room="currentRoom"
            v-on:messagesent="getMessages"/>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import MessageContainer from './messageContainer.vue'
import InputMessage from './inputMessage.vue'
import ChatRoomSelection from './chatRoomSelection.vue'
import StyledMessageContainer from './styledMessageContainer.vue'
import axios from 'axios'

export default {
    components: {
        AppLayout,
        MessageContainer,
        InputMessage,
        ChatRoomSelection,
        StyledMessageContainer,

    },
    data() {
        return {
            chatRooms : [],
            currentRoom : {},
            messages : [],
        }
    },
    watch: {
        currentRoom(val, oldVal) {
            // alert('watch:currentRoom');
            if(oldVal.id) {
                this.disconnect(oldVal);
            }
            this.connect();
        }
    },
    methods: {
        connect() {
            // alert('connect');
            // 방이 변경되었을 때, 이 메소드가 호출되니
            // 이 방의 메시지를 불러와 디스플레이 해준다.
            // 변경된 방은 currentRoom
            this.getMessages();
            const vm = this;
            window.Echo.private('chat.'+this.currentRoom.id)
                .listen('.message.new', e=>{
                    // alert("new Message");
                    vm.getMessages();
                })
        },
        disconnect(room) {
            // alert('disconnect');
            window.Echo.leave('chat.'+room.id);
        },
        getRooms() {
            axios.get('/chat/rooms')
                .then(response => {
                    this.chatRooms = response.data;
                    this.setRoom(response.data[0]);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        setRoom(room) {
            // if(this.currentRoom != null && this.currentRoom.id != room.id){
            //     this.disconnect(this.currentRoom);
            // }
            this.currentRoom = room;
            // this.connect();
            // this.getMessages();
        },
        getMessages() {
            axios.get('/chat/room/'+this.currentRoom.id+'/messages')
                .then(response => {
                    this.messages = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
    },

    created() {
        this.getRooms();
    }

}
</script>
