<template>
    <div class="card p-4">
        <form class="row" method="post" @submit.prevent="submitForm">
            <div class="col-4">
                <label for="name" class="form-label">Nama</label>
                <input
                    type="text"
                    v-model="form.name"
                    class="form-control"
                    id="name"
                    placeholder="Nama"
                />
            </div>
            <div class="col-4">
                <label for="username" class="form-label">Username</label>
                <input
                    type="text"
                    v-model="form.username"
                    :class="{
                        'form-control': true,
                        'is-invalid': errors.username,
                    }"
                    id="username"
                    placeholder="Username"
                />
                <span v-if="errors.username" class="error">{{
                    errors.username
                }}</span>
            </div>
            <div class="col-4">
                <label for="Email" class="form-label">Email</label>
                <input
                    type="email"
                    v-model="form.email"
                    :class="{
                        'form-control': true,
                        'is-invalid': errors.email,
                    }"
                    id="Email"
                    placeholder="Email"
                />
                <span v-if="errors.email" class="error">{{
                    errors.email
                }}</span>
            </div>
        </form>
    </div>
    <div class="row justify-content-between">
        <div class="col-3">
            <h1>To Do List</h1>
        </div>
        <div class="col-2">
            <button
                class="btn text-danger"
                style="
                    background-color: rgba(255, 0, 0, 0.25);
                    font-weight: 500;
                "
            >
                + Tambah To Do
            </button>
        </div>
    </div>
</template>

<script>
import debounce from "lodash/debounce";
import axios from "axios";

export default {
    data() {
        return {
            form: {
                name: "",
                username: "",
                email: "",
            },
            errors: {
                username: null,
                email: null,
            },
        };
    },
    watch: {
        "form.username": debounce(function () {
            this.validateUsername();
        }, 500),
        "form.email": debounce(function () {
            this.validateEmail();
        }, 500),
    },
    methods: {
        validateUsername() {
            axios
                .post("http://127.0.0.1:8000/api/validate-username", {
                    username: this.form.username,
                })
                .then((response) => {
                    this.errors.username = null;
                })
                .catch((error) => {
                    if (error.response) {
                        console.error("Error:", error.response.data);
                        if (
                            error.response.data.errors &&
                            error.response.data.errors.username
                        ) {
                            this.errors.username =
                                error.response.data.errors.username[0];
                        }
                    }
                });
        },
        validateEmail() {
            axios
                .post("/api/validate-email", { email: this.form.email })
                .then((response) => {
                    this.errors.email = null;
                })
                .catch((error) => {
                    if (error.response && error.response.data.errors.email) {
                        this.errors.email = error.response.data.errors.email[0];
                    }
                });
        },
    },
};
</script>
