<template>
    <div class="form-group">
        <label class="form-control-label">Select media</label>
        <div v-show="!image.length" transition="bounce" class="custom-file">
            <input type="file" class="custom-file-input" @change="onFileChange" id="customFileLang">
            <label class="custom-file-label" for="customFileLang">Select media</label>
        </div>
        <div v-if="image.length" class="image-preview">
            <img class="img-fluid w-100" :src="image" alt="">
            <a role="button" @click="removeImage" class="remove-image text-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MediaInputComponent",
        data() {
            return{
                image: ''
            }
        },
        methods:{
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length) {
                    return;
                }
                this.createImage(files[0]);
            },
            createImage(file) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            removeImage: function (e) {
                this.image = '';
            }
        }
    }
</script>

<style lang="scss" scoped>
    .image-preview{
        max-width: 150px;
        position: relative;
        a.remove-image{
            position: absolute;
            top: 0;
            right: 0;
            cursor: pointer;
        }
    }
</style>
