<template>
    <div class="position-fixed ws-badge-container">
        <div v-if="hasUpdate" class="badge badge-warning p-4 ws-badge position-fixed">
            <h3 class="h3">Пост <i>{{ this.title }}</i> обновлен</h3>
            <p class="font-weight-bold mb-0">Изменились поля:</p>
            <ul>
                <li v-for="field in this.fields">
                    {{ field }}
                </li>
            </ul>
            <a class="btn btn-primary" :href="this.slug">Перейти к статье</a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            hasUpdate: false
        }
    },

    mounted() {
        Echo
            .private('post')
            .listen('PostEdited', (data) => {
                this.slug = data.slug;
                this.title = data.title;
                this.fields = data.fields;
                this.hasUpdate = true;
            });
    }
}
</script>
