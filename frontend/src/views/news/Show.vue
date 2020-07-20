<template>
    <div class="card text-left">
        <div class="card-body">
            <router-link to="/news" class="btn btn-secondary mb-5">Back</router-link>
            <img :src="avatar">
            <img class="card-img-top" :src="'http://localhost:8000/storage/'+news.image_name" alt="">
            <h4 class="font-weight-bold">
                {{ news.title }}
            </h4>
            <small class="text-muted">
                {{ news.created_at }}
            </small>
            <p class="card-text text-justify">
                {{ news.content }}
            </p>
            <hr>
            <h4>Comment ({{comment_count}})</h4>
            <div class="row" v-for="comment in comment" v-bind:key="comment.id">
                <div class="col">
                <div class="card text-left mb-2">
                    <div class="card-body">
                        <h6 class="font-weight-bold">{{ comment.name }}</h6>
                        <p class="card-text">{{ comment.comment_text }}</p>
                    </div>
                </div>
            </div>
            </div>
            <div class="card text-left mt-5">
                <div class="card-body">
                    <h2 class="font-weight-bold text-center mb-5">Comment Here</h2>
                    <form @submit.prevent="addData()">
                        <div class="form-group">
                            <input type="hidden" v-model="form.news_id" placeholder="Input Id News" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Input Your Name" v-model="form.name"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Input Your Email" v-model="form.email"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Comment Text</label>
                            <textarea class="form-control" name="" id="" rows="3" v-model="form.comment_text"
                                required></textarea>
                        </div>
                        <button class="btn btn-primary">Add Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                news: [],
                comment: [],
                comment_count: [],
                form: {
                    name: '',
                    email: '',
                    comment_text: '',
                    news_id: this.$route.params.id
                }
            };
        },
        created() {
            this.loadData();
        },
        methods: {
            loadData() {
                axios
                    .get("http://localhost:8000/api/news/show/" + this.$route.params.id)
                    .then(response => {
                        this.news = response.data;
                    });
                axios
                    .get("http://localhost:8000/api/comment/" + this.$route.params.id)
                    .then(response => {
                        this.comment = response.data;
                    });
                axios
                    .get("http://localhost:8000/api/comment_count/" + this.$route.params.id)
                    .then(response => {
                        this.comment_count = response.data;
                    });
            },
            addData() {
                axios
                    .post("http://localhost:8000/api/comment", {
                        name: this.form.name,
                        email: this.form.email,
                        comment_text: this.form.comment_text,
                        news_id: this.form.news_id
                    })
                    .then(response => {
                        this.$router.push("/news");
                    });
            }
        }
    };
</script>