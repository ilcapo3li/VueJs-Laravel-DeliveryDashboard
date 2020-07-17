<template>
    <div>
        <b-row>
            <b-form-textarea
                id="textarea"
                v-model="text"
                placeholder="Enter something..."
                rows="2"
                max-rows="6"
            ></b-form-textarea>
            <b-btn class="btn btn-primary" @click="sendMessage()">SEND</b-btn>
        </b-row>
    </div>
</template>
<script>
import apiUrls from "../helpers/apiUrls";
export default {
    name: "Chat",
    mounted() {
        // setTimeout(() => {
            axios.get(apiUrls.messages()).then(res => {
                console.log(res);
            });
            this.$echo.channel("public-chat").listen("MessageSent", payload => {
                console.log(payload);
            });
            // .channel(`channel.${this.channel_id}`)
            // .listen("ChannelComment", payload => {
            //     console.log(payload);
            // });
        // }, 1000);
    },
    data() {
        return {
            channel_id: 1,
            messages: [],
            text: null,
            receiver_id: 2
        };
    },
    computed: {
        user() {
            return this.$store.getters.user;
        }
    },
    methods: {
        sendMessage() {
            axios
                .post(apiUrls.sendMessage(), {
                    message: this.text,
                    receiver_id: this.receiver_id
                })
                .then(res => {});
        }
    }
};
</script>
