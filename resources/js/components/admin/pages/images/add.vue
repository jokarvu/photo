<template>
    <div class="container-fluid">
        <h1 class="h1-card">Upload image</h1>
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="uploadImage" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="album">Album</label>
                        <select name="album" id="album" class="form-control form-control-alternative" v-model="info.album_id">
                            <option value="0">None</option>
                            <option v-for="item in albums" :key="item.id" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <select name="location" id="location" class="form-control form-control-alternative" v-model="info.location_id">
                            <option value="0">None</option>
                            <option v-for="item in locations" :key="item.id" :value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <Tag :tags="tags" @tag_change="tag_change"></Tag>
                    <div class="form-group">
                        <label for="location">Images</label>
                        <input type="file" @change="fileChange"  name="images" class="form-control form-control-alternative" accept="image/*" multiple>
                    </div>
                    <div class="row">
                        <div class="col-md-2" v-for="item in tmp_url" :key="item">
                            <img :src="item" alt="" srcset="" width="100%">
                        </div>
                    </div>
                    <hr class="my-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" @click="$router.go(-1)" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import Tag from '../components/tag.vue';
export default {
    data () {
        return {
            albums: [],
            locations: [],
            tags: [],
            selected_tags: [],
            images: [],
            info: {
                location_id: 0,
                album_id: 0,
            },
            tmp_url: []
        }
    }, 
    created () {
        axios.get('/api/image/create').then(res => {
            this.locations = res.data.locations;
            this.albums = res.data.albums;
            this.tags = res.data.tags;
        }).catch(error => {
            toastr.error(error.response.data.message);
            this.$route.go(-1);
        });
    },
    methods: {
        uploadImage () {
            console.log(this.selected_tags);
            let formData = new FormData();
            for(let key in this.info) {
                formData.append(key, this.info[key]);
            }
            this.selected_tags.forEach(item => {
                formData.append('tags[]', item);
            })
            this.images.forEach(item => {
                formData.append('images[]', item, item.name);
            })
            axios.post('/api/image', formData).then(res => {
                toastr.success(res.data.message);
                // this.$router.go(-1);
            }).catch(error => {
                toastr.error(error);
                console.log(error);
            })
        },
        fileChange (e) {
            let files = e.target.files || e.dataTransfer.files;
            Array.from(files).forEach(file => {
                this.tmp_url.push(URL.createObjectURL(file));
                this.images.push(file);
            });
        },
        tag_change (e) {
            this.selected_tags = e;
        }
    },
    components: {Tag}
}
</script>
<style>
    @import '~select2/dist/css/select2.css';
</style>