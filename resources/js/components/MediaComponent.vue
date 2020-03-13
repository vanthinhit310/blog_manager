<template>

</template>

<script>
    import MediaModal from '../../assets/vendor/MediaManager/js/mixins/modal'
    export default {
        name: 'media-component',
        mixins: [MediaModal],
        data() {
            return {
                cover: '',
                gallery: '',
                links: ''
            }
        },
        methods:{
            removeCoverImage:function () {
                let self = this;
                self.cover = '';
            }
        }

    }
</script>
