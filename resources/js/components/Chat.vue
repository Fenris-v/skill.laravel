<template>
    <div class="chat-popup">
        <h1>Чат</h1>
        <div class="chat-messages">
            <p v-for="message in messages">{{ message }}</p>
        </div>
        <div>
            <input name="message" class="form-control" v-model="message"
                   @keydown="whisperTyping"
                   placeholder="Сообщение">
            <button class="btn btn-primary" @click.prevent="sendMessage">Отправить</button>
        </div>
    </div>
</template>

<style>
.chat-popup {
    display: block;
    position: fixed;
    bottom: 15px;
    right: 15px;
    width: 300px;
    height: 330px;
    padding: 10px;
    background: #fff;
    border: 3px solid #f1f1f1;
    z-index: 10;
    box-sizing: content-box;
}

.chat-popup .chat-messages {
    height: 150px;
    margin-bottom: 10px;
    overflow-y: scroll;
}

.chat-popup input {
    margin-bottom: 10px;
}
</style>

<script>
export default {
    data() {
        return {
            messages: [],
            message: '',
            channel: null
        }
    },

    mounted() {
        this.channel = Echo.join('chat');

        this.channel
            .listen('ChatMessage', (data) => {
                this.addMessage(data.user.name + ': ' + data.message);
            })
            .here((users) => {
                this.addMessage('В чате ' + users.length + ' участников');
            })
            .joining((user) => {
                this.addMessage('Пользователь' + user.name + ' подключился к чату')
            })
            .leaving((user) => {
                this.addMessage('Пользователь' + user.name + ' покинул чат')
            });

        this.channel
        .listenForWhisper('typing', (data) => {
            this.addMessage('Печатает ' + data.name);
        });
    },
    methods: {
        sendMessage() {
            if (this.message.length > 0) {

                let message = this.message;
                this.message = '';
                this.addMessage('Я: ' + message);

                axios
                    .post('/chat', {message: message});
            }
        },
        addMessage(message) {
            this.messages.push(message);
        },
        whisperTyping() {
            this.channel.whisper('typing', {name: 'другой участник'})
        }
    }
}
</script>
