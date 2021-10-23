<template>
    <div>
        <div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
            <div class="chat-message" v-if="message.user.id != $page.props.user.id">
                    <div class="flex items-end">
                        <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                        <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">
                            {{ message.user.name }} : {{ message.message }}
                            </span></div>
                        </div>
                        <img class="h-8 w-8 rounded-full object-cover" :src="message.user.profile_photo_url" :alt="message.user.name" />
                    </div>
            </div>
            <div class="chat-message" v-if="message.user.id == $page.props.user.id">
                    <div class="flex items-end justify-end">
                        <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
                        <div><span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">
                            {{ message.user.name }} :{{ message.message }}
                            </span></div>
                        </div>
                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                    </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props:['message'],

}
</script>


