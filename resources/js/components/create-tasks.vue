<template>
    <form method="post" @submit.prevent="submitForm">
        <!-- form bagian user -->
        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <!-- form bagian user -->
                    <div class="row">
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
                            <label for="username" class="form-label"
                                >Username</label
                            >
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
                    </div>
                </div>
            </div>
        </div>

        <!-- header dan add button -->
        <div class="row justify-content-between">
            <div class="col-3">
                <h1>To Do List</h1>
            </div>
            <div class="col-2">
                <button
                    type="button"
                    @click="addTask"
                    class="btn btn-sm text-danger"
                    style="
                        background-color: rgba(255, 0, 0, 0.25);
                        font-weight: 500;
                    "
                >
                    + Tambah To Do
                </button>
            </div>
        </div>

        <!-- form bagian task -->
        <div class="row">
            <div
                v-for="(task, index) in form.tasks"
                :key="index"
                class="col-12 mt-3"
            >
                <div class="row">
                    <div class="col-9">
                        <label for="task" class="form-label">Task</label>
                        <input
                            type="text"
                            v-model="task.name"
                            class="form-control"
                            placeholder="Task Name"
                        />
                    </div>
                    <div class="col-3">
                        <label for="category" class="form-label"
                            >Kategori</label
                        >
                        <select v-model="task.category_id" class="form-control">
                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="category.id"
                            >
                                {{ category.name }}
                            </option>
                        </select>
                        <button
                            type="button"
                            @click="removeTask(index)"
                            class="btn btn-sm btn-danger mt-2"
                        >
                            -
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <button type="submit" class="col-12 btn btn-success mt-3">
                Simpan
            </button>
        </div>
    </form>
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
                tasks: [
                    { name: "", category_id: null }, // Task pertama
                ],
                categories: [],
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
        addTask() {
            this.form.tasks.push({ name: "", category_id: null });
        },
        removeTask(index) {
            this.form.tasks.splice(index, 1);
        },
        submitForm() {
            if (!this.errors.username && !this.errors.email) {
                axios
                    .post("/api/tasks", this.form)
                    .then((response) => {
                        console.log("Data berhasil disimpan");
                    })
                    .catch((error) => {
                        console.log("Terjadi kesalahan:", error);
                    });
            }
        },
        fetchCategories() {
            axios.get("/api/categories").then((response) => {
                this.categories = response.data;
            });
        },
    },
    mounted() {
        this.fetchCategories(); // Ambil data kategori saat komponen dimuat
    },
};
</script>
