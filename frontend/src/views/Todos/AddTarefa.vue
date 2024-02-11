<template>


<div class="container">
    <h1 class="p-3">Adicionar Tarefa</h1>
    <form action="#" method="post"  @submit.prevent="addTarefa" class="mx-auto mt-4 container-fluid">

<div class="form-group row p-1">
    <label for="inputPassword" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="inputPassword" placeholder="nome" name="name" v-model="tarefa.name">
    <span v-if="errors.name" class="text-danger">{{ errors.name }}</span>
    </div>
</div>
<div class="form-group row p-1">
    <label for="inputPassword" class="col-sm-2 col-form-label">Endereço</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="inputPassword" placeholder="endereço" name="address" v-model="tarefa.address">
    <span v-if="errors.address" class="text-danger">{{ errors.address }}</span>
    </div>
</div>
<div class="form-group row p-1">
    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
    <input type="email" class="form-control" id="inputPassword" placeholder="email" name="email" v-model="tarefa.email">
    <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
    </div>
</div>
<div class="form-group row p-1">
    <label for="inputPassword" class="col-sm-2 col-form-label">Telefone</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="inputPassword" placeholder="telefone" name="telephone" v-model="tarefa.telephone">
    <span v-if="errors.telephone" class="text-danger">{{ errors.telephone }}</span>
    </div>
</div>
<div class="form-group row">
        <div class="col-sm-12 text-end">
          <button class="btn btn-primary" type="submit">Criar</button>
        </div>
      </div>
</form>
</div>
</template>

<script>
import TodoService from '@/services/todo-services';
import { ref, reactive } from 'vue';
import router from '@/router';

export default {
    name: 'AddTarefa',
    setup(){
/*         const name = ref('')
        const address = ref('')
        const email = ref('')
        const telephone = ref('') */

        const errors = reactive({})
        
        const tarefa = reactive({
            name: '',
            address: '',
            email: '',
            telephone: '',
        })

        const addTarefa =() => {
            const params = {
                name: tarefa.name,
                address: tarefa.address,
                email: tarefa.email,
                telephone: tarefa.telephone
            }
            TodoService.addTarefa(tarefa).then(()=> router.push({name: 'todo.index'})).catch((error)=>
            {
                if (error.response && error.response.status === 422) {
                    const responseData = error.response.data;
                    errors.name = responseData.errors.name ? responseData.errors.name[0] : '';
                    errors.address = responseData.errors.address ? responseData.errors.address[0] : '';
                    errors.email = responseData.errors.email ? responseData.errors.email[0] : '';
                    errors.telephone = responseData.errors.telephone ? responseData.errors.telephone[0] : '';
                    console.log('ola', errors.email);
                }

            })
        }
        return {
            tarefa, addTarefa, errors
        }
    }
}
</script>