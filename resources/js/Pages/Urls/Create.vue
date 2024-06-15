<template>
    <div>
        <router-link to="/">Take me to homepage</router-link>
    </div>
    <div>
        Let's create some short urls
    </div>
    <div>
        <label for="destination_url">Destination Url</label>
        <input id="destination_url" type="text" v-model="destination_url">
        <span v-if="errors?.destination_url">{{ errors?.destination_url[0] }}</span>
        <span v-if="google_error">{{ google_error }}</span>
    </div>
    <button @click="submit">
        Create
    </button>

    <div v-if="shortUrl">
        Your new short url: <a target="_blank" :href="shortUrl">{{ shortUrl }}</a>
    </div>
</template>
<script setup>
import axios from "axios";
import { ref } from "vue";

const submitted = ref(false);

const shortUrl = ref('');
const destination_url = ref('');
const errors = ref(null)
const google_error = ref(null)

function submit() {
    let data = {
        destination_url: destination_url.value,
    };

    axios.post("/api/urls", data)
    .then(response => {
        submitted.value = true;
        shortUrl.value = response.data.short_url;
    })
    .catch(error => {
        console.log(error);
        errors.value = error.response.data.errors;
        if(error.response.data.message){
            google_error.value = error.response.data.message;
        }
    });
};
</script>