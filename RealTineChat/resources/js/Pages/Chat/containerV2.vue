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
        <!-- <styled-message-container :messages="messages"/> -->
        <div class="py-12">
            <div class="flex flex-col justify-between flex-1 h-screen p:2 sm:p-6">
                <div v-if="messages" class="p-2  flex flex-col-reverse overflow-scroll">
                    <div v-for="msg in messages.data" :key="msg.id">
                        <styled-message-item :message="msg" />
                    </div>
                </div>
            </div>
        </div>
        <input-message :room="currentRoom"
            v-on:messagesent="getMessages"/>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
// import MessageContainer from './messageContainer.vue'
import InputMessage from './inputMessage.vue'
import ChatRoomSelection from './chatRoomSelection.vue'
// import StyledMessageContainer from './styledMessageContainer.vue'
import StyledMessageItem from './styledMessageItem.vue'
import axios from 'axios'

export default {
    components: {
        AppLayout,
        // MessageContainer,
        InputMessage,
        ChatRoomSelection,
        // StyledMessageContainer,
        StyledMessageItem,

    },
    data() {
        return {
            chatRooms : [],
            currentRoom : {},
            messages : null,
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
                    console.log(JSON.stringify(e));
                    // alert("new Message");
                    // vm.getMessages();
                    this.messages.data = [e.msg, ...this.messages.data];
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
        async getMessages() {
            let response = await axios.get('/chat/room/'+this.currentRoom.id+'/messages');
                this.messages = response.data;
        },
        getMoreMessages() {
            if(this.messages.current_page == this.messages.last_page) {
                // alert('No more message')
                return;
            }
            axios.get(this.messages.next_page_url).then(response => {
                // this.messages = response.data;
                // this.messages.data = [...this.messages.data, ...response.data.data]
                this.messages = {...response.data, 'data' : [...this.messages.data, ...response.data.data]};
            }).catch(error => {
                console.log(error);
            });
        }
    },
    mounted() {
        window.addEventListener('scroll', debounce((e) => {
            // console.log('scroll')
            // console.log("offsetHeight:"+document.documentElement.offsetHeight)
            // console.log("scrollTop:"+document.documentElement.scrollTop)
            // console.log("InnerHeight:"+window.innerHeight)
            if(document.documentElement.scrollTop < 10) {
                this.getMoreMessages();
            }
        }, 100));
    },
    created() {
        this.getRooms();
    }

}
</script>
