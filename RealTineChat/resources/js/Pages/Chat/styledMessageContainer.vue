<template>
    <div>
        <div class="p-2  flex flex-col-reverse overflow-scroll">
            <div v-for="msg in messages" :key="msg.id">
                <styled-message-item :message="msg" />
            </div>
        </div>
    </div>

</template>

<script>
import StyledMessageItem from './styledMessageItem.vue'

export default {
    props:['messages'],
    components: {
        StyledMessageItem
    }
}
</script>
