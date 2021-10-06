<template>
    <div>
        <div v-for="msg in messages" :key="msg.id">
        {{ msg.message }}
        </div>
    </div>
</template>

<script>
export default {
    props:['messages'],
}
</script>
