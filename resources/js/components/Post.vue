<template>
    <div class="content">
        <div v-for="post in posts">
            <h1>{{ post.title }}</h1>
            <p>{{ post.body }}</p>
            <button class="btn btn-xs btn-primary" @click="modify(post)">修改</button>
            <button class="btn btn-xs btn-danger" @click="remove(post.id)">刪除</button>
            <hr>
        </div>

        <form id="form">
            <div class="form-group" :class="{ 'has-warning': titleWarning }">
                <label class="control-label">標題
                    <span v-if="titleWarning">不能空白</span>
                </label>
                <input class="form-control" v-model="post.title">
            </div>
            <div class="form-group" :class="{ 'has-warning': bodyWarning }">
                <label class="control-label">內容
                    <span v-if="bodyWarning">不能空白</span>
                </label>
                <textarea class="form-control" v-model="post.body"></textarea>
            </div>
            <div class="form-group">
                <div v-if="isSave">
                    <button @click.prevent="save">儲存</button>
                    <button @click.prevent="cancel">取消</button>
                </div>
                <button v-else @click.prevent="publish">發佈</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
            post: {
                id: null,
                title: '',
                body: ''
            },
            titleWarning: false,
            bodyWarning: false,
            isSave: false
        }
    },

    methods: {
        init: function () {
            let self = this;
            axios.get('/api/posts')
                .then(function (response) {
                    self.posts  = response.data;
                })
                .catch(function (response) {
                    console.log(response);
                });
        },

        publish: function () {
            this.titleWarning = (this.post.title.trim().length == 0);
            this.bodyWarning = (this.post.body.trim().length == 0);
            if (this.titleWarning || this.bodyWarning) return;
            //
            let self = this;
            axios.post('/api/posts', this.post)
                .then(function (response) {
                    if (response.data['result']) {
                        self.init();
                        self.titleWarning = false;
                        self.bodyWarning = false;
                        self.post = {id:null, title: '', body:''};
                    }
                })
                .catch(function (response) {
                    console.log(response)
                });
        },

        modify: function (post) {
            location.href = "#form";
            this.post.id = post.id;
            this.post.title = post.title;
            this.post.body = post.body;
            this.isSave = true;
            console.log(this.post);
        },

        save: function () {
            let self = this;
            axios.put('/api/posts/' + this.post.id, this.post)
                .then(function (response) {
                    if (response.data['result']) {
                        self.init();
                        self.isSave = false;
                        self.post = {id:null, title: '', body:''};
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });
        },

        cancel: function () {
            this.post = {id: null, title: '', body: ''};
            this.isSave = false;
        },

        remove: function (id) {
            let self = this;
            axios.delete('/api/posts/' + id)
                .then(function (response) {
                    if (response.data['result']) {
                        self.init();
                    }
                })
                .catch(function (response) {
                    console.log(response);
                });
        }
    },

    mounted: function () {
        this.init();
    }
}
</script>

<style scoped>
    .content {
        padding: 20px;
    }
</style>
