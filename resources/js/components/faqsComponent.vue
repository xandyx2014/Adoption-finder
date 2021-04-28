<template>
    <div class="card ">
        <div class="card-header">
            <h6 class="card-header text-info">
                {{ pregunta }}
            </h6>
        </div>
        <div>
            <div class="card-block p-3">
                {{ descripcion }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "faqsComponent",
    props: ['pregunta', 'descripcion']
}
</script>

<style scoped>

</style>
