<template>
    <div>
        <div v-if="hasReport" class="badge badge-warning p-4 ws-badge position-fixed">
            <h3 class="h3">Отчет готов</h3>
            <a :href="this.file" download="" class="btn btn-outline-primary">Скачать</a>
        </div>
    </div>
</template>

<script>
export default {
    props: ['userId'],
    data() {
        return {
            hasReport: false
        }
    },

    mounted() {
        Echo
            .private('report.user.' + this.userId)
            .listen('ReportRequested', (data) => {
                this.file = data.file;
                this.hasReport = true;
            });
    }
}
</script>
