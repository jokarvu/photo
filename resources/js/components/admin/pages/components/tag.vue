<template>
    <div class="form-group">
        <label for="tags">Tags</label>
        <select name="tag" id="tags" class="form-control form-control-alternative">
            <option v-for="item in tags" :key="item.id" :value="item.id">{{ item.name }}</option>
        </select>
    </div>
</template>
<script>
    import 'select2';
    export default {
        props: ['tags'],
        mounted () {
            var self = this;
            $('#tags').select2({
                multiple: true,
                closeOnSelect: false,
                matcher: this.matchCustom,
                placeholder: 'Select books..'
            }).on('change', function () {
                self.$emit('tag_change', $('#tags').val());
            })
        },
        methods: {
            matchCustom(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                return data;
                }
                // Do not display the item if there is no 'text' property
                if (typeof data.text === 'undefined') {
                return null;
                }
                // `params.term` should be the term that is used for searching
                // `data.text` is the text that is displayed for the data object
                if (data.text.indexOf(params.term) > -1) {
                var modifiedData = $.extend({}, data, true);
                modifiedData.text += ' (matched)';
                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
                }
                // Return `null` if the term should not be displayed
                return null;
            },
        }
    }
</script>
<style>
    @import '~select2/dist/css/select2.css';
</style>