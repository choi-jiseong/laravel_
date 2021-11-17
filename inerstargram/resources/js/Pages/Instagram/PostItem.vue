<template>
    <div class="rounded overflow-hidden shadow-lg">
      <a @click="imgClicked()"><img class="w-full" :src="'/storage/'+post.image" :alt="post.image"></a>
      <div class="flex flex-row px-6 py-4">
          <button class="pr-4">
              dsf
          </button>
          <button class="pr-4">
              sdfs
          </button>
      </div>
      <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">Mountain</div>
        <p class="text-gray-700 text-base">
          {{ post.caption }}
        </p>
      </div>
      <div class="px-6 pt-4 pb-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
      </div>
    </div>
    <jet-confirm-modal :show="open" @close="closeModal = false">
        <template #title>
            title
        </template>
        <template #content>
            content
        </template>
        <template #footer>
            footer
        </template>
    </jet-confirm-modal>
</template>

<script>
import JetConfirmModal from '@/Jetstream/ConfirmationModal.vue'
export default {
    props : ['post'],
    components : {
        JetConfirmModal,
    },
    methods: {
        imgClicked() {

        }
    },
    created() {
        // console.log(this.post.image);
    }
}
</script>
