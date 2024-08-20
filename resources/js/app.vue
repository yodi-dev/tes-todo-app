<script setup>
import create from "../js/components/create-tasks.vue";
</script>
<template>
    <div class="wrapper">
        <section class="content mt-5">
            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-3 mx-auto mt-5 text-center mb-2">
                        <img
                            src="/public/logo-energeek.png"
                            alt="logo energeek"
                        />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-10 mx-auto">
                        <create />
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
img {
    width: 300px;
}
</style>
