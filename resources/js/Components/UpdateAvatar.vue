
<template>
        <label :for="id" class="relative overflow-hidden rounded h-40
flex justify-center w-full px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
        <input
            :id="id"
            type="file"
            class="overlayed hidden"
            :multiple="false"
            accept="image/jpeg, image/gif, image/png"
            @change="handleUpload"
            @input="forms.avatar = $event.target.files[0]"
        />
        <span
            :class="`overlayed  bg-gray-100 border-gray-200 border-2 text-gray-800 pointer-events-none flex justify-center items-center`"
        >
        <div class="text-center align-middle h-40">
             <span class="font-medium text-gray-600">
                Перетащите файл с новым аватаром сюда или
                <span class="text-blue-600 underline">выберите тут</span>
            </span>

            <small v-if="files.length" :class="`flex justify-center items-center`">
              <slot name="file" :files="files" :uploadInfo="uploadInfo">
                {{ uploadInfo }}
              </slot>
            </small>
        </div>
        </span>
    </label>
</template>

<style scoped>

.overlayed {
    @apply absolute top-0 left-0 right-0 bottom-0 w-full  block ;
}
</style>

<script>
import {ref, computed} from 'vue'
import {usePage} from "@inertiajs/vue3";
import axios from "axios";
export default {
    // props seem best defined in the Object API style as we're used to
    props: {
        id: {type: String, default: 'drag-and-drop-input'},
        multiple: {type: Boolean, default: false},
        color: {type: String, default: 'gray'},
    },


    // Everything else goes in a setup function
    setup(props, {emit}) {
        // keep up with the files state (think data)
        const files = ref([])

        // display the uploaded file names (think computed)
        const uploadInfo = computed(() => {
            return files.value.length === 1
                ? files.value[0].name
                : `${files.value.length} files selected`
        })

        // handle the file upload event (think methods)
        const handleUpload = (e) => {


            files.value = Array.from(e.target.files) || []
            emit('input', files)

            // const file = e.target.files[0];
            // const formData = new FormData();
            // formData.append('file', file);
            //
            // axios.post(route('profile.avatar.update', usePage().props.country.id), formData,{
            //         headers: {
            //             'Content-Type': 'multipart/form-data'
            //         }
            //     }
            // ).then(function(){
            //     console.log('SUCCESS!!');
            // })
            //     .catch(function(){
            //         console.log('FAILURE!!');
            //     });
            //

        }

        return {files, uploadInfo, handleUpload}
    },
    ref() {
        const files = ref([])
    },

}
</script>

