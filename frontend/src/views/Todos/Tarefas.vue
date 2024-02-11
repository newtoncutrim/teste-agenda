<template>
 
    <div v-if="loading">
        <h2>Carregando as imagens</h2>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
<link rel="stylesheet" href="{{asset('css/app.css')}}">

<div class="container">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="responsive">
                <div class="table-responsive">
                    <table class="table project-list-table table-nowrap align-middle table-borderless">
                        <thead>
                            <tr>

                                <th scope="col">Nome</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefone</th>
                                <th scope="col" style="width: 200px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="todo in todos" :key="todo.id">

                                <td><a href="#" class="text-body">{{todo.name}}</a></td>
                                <td><span class="badge badge-soft-success mb-0">{{todo.address}}</span></td>
                                <td>{{todo.email}}</td>
                                <td>{{ todo.telephone }}</td>
                                <td>
                                    <ul class="list-inline mb-0">
                                       
                                        <li class="list-inline-item" >
                                            <router-link :to="{name: 'todo.edit', params:{id: todo.id}}">
                                                <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="px-2 text-primary"><i class="bx bx-pencil font-size-18"></i></a>
                                            </router-link>
                                        </li>
                                        <li class="list-inline-item">
                                            <a @click.prevent="deleteTarefa(todo.id)" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="px-2 text-danger"><i class="bx bx-trash-alt font-size-18"></i></a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

</template>

<script>
import { ref } from 'vue';
import TodoService from '@/services/todo-services';
import 'bootstrap/dist/css/bootstrap.css';

import { onMounted } from 'vue';
import router from '@/router';

export default {
    name: 'Tarefas',
    setup() {
        const todos = ref([]);
        const loading = ref(false);

        onMounted(() => {
            loading.value = true;
            TodoService.getAll()
                .then(response => {
                    console.log(response.data);
                    todos.value = response.data;
                })
                .catch(error => console.log(error))
                .finally(() => {
                    loading.value = false;
                });
        });

        const deleteTarefa = (id) => {
            if (confirm('Deseja realmente excluir essa tarefa?')){
                TodoService.destroy(id).then(() => {
                    window.location.reload();
                })
            }
        }


        return {
            todos,
            loading,
            deleteTarefa
        };
    }
};
</script>

<style>
body{margin-top:20px;
    background-color:#eee;
    }
    .project-list-table {
        border-collapse: separate;
        border-spacing: 0 12px
    }

    .project-list-table tr {
        background-color: #fff
    }

    .table-nowrap td, .table-nowrap th {
        white-space: nowrap;
    }
    .table-borderless>:not(caption)>*>* {
        border-bottom-width: 0;
    }
    .table>:not(caption)>*>* {
        padding: 0.75rem 0.75rem;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    .avatar-sm {
        height: 2rem;
        width: 2rem;
    }
    .rounded-circle {
        border-radius: 50%!important;
    }
    .me-2 {
        margin-right: 0.5rem!important;
    }
    img, svg {
        vertical-align: middle;
    }

    a {
        color: #3b76e1;
        text-decoration: none;
    }

    .badge-soft-danger {
        color: #f56e6e !important;
        background-color: rgba(245,110,110,.1);
    }
    .badge-soft-success {
        color: #63ad6f !important;
        background-color: rgba(99,173,111,.1);
    }

    .badge-soft-primary {
        color: #3b76e1 !important;
        background-color: rgba(59,118,225,.1);
    }

    .badge-soft-info {
        color: #57c9eb !important;
        background-color: rgba(87,201,235,.1);
    }

    .avatar-title {
        align-items: center;
        background-color: #3b76e1;
        color: #fff;
        display: flex;
        font-weight: 500;
        height: 100%;
        justify-content: center;
        width: 100%;
    }
    .bg-soft-primary {
        background-color: rgba(59,118,225,.25)!important;
    }

    td, th {
        color: black;
    }
/*     .responsive {
        width: 100%;
        max-width: 1200px;
        min-width: 300px; 
    } */
</style>