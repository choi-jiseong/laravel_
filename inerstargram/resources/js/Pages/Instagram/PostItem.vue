<template>
    <div class="rounded overflow-hidden shadow-lg">
      <a @click="imgClicked()"><img class="w-full" :src="'/storage/'+post.image" :alt="post.image"></a>


      <div class="px-6 pt-4 pb-2">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
      </div>
    </div>
    <jet-confirm-modal :show="showPost" @close="showPost = false">
        <template #title>
        </template>
        <template #content>
            <div class="w-full mx-3 overflow-hidden bg-white border rounded md:w-12/12 md:mx-0 lg:mx-0">
                <div class="flex justify-between w-full p-3">
                    <span class="px-2 rounded cursor-pointer hover:bg-gray-300"><i class="pt-2 text-lg fas fa-ellipsis-h"></i></span>
                    <div class="px-3 pb-2">
                        <img class="w-full bg-cover" :src="'/storage/' + post.image" alt="photo" />
                    </div>
                    <div class="mt-2">
                        <span>{{ post.caption }}</span>
                    </div>
                    <div class="pt-2">
                        <i class="cursor-pointer far fa-heart"></i>
                        <span class="text-sm font-medium text-gray-400">12 likes</span>
                    </div>
                    <div class="pt-1">
                        <div class="mb-2 text-sm">
                            <span class="mr-2 font-medium">braydoncoyer</span> Lord of the Rings is my favorite
                        </div>
                    </div>
                    <div class="mb-2 text-sm font-medium text-gray-400 cursor-pointer">View all 14 comment
                        <div class="mb-2">
                            <div class="mb-2 text-sm">
                                <span class="mr-2 font-medium">
                                    razzle_dazzle
                                </span>
                                Dude! How coll! I went to
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #footer>
            <div class="flex flex-row px-6 py-4">
                <button class="pr-4">
                    좋아요
                </button>
                <button class="mr-4">
                    댓글 달기
                </button>
            </div>
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#photography</span>
                <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#travle</span>
                <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">#winter</span>
            </div>
        </template>
    </jet-confirm-modal>
</template>

<script>
import JetConfirmModal from '@/Jetstream/ConfirmationModal.vue'
export default {
    props : ['post'],
    data() {
        return {
            showPost : false,
        }
    },
    components : {
        JetConfirmModal,
    },
    methods: {
        imgClicked() {
            this.showPost = true;
        }
    },
    created() {
        // console.log(this.post.image);
    }
}
</script>
