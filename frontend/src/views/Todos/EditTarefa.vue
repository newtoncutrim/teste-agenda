<template>
  <div class="container">
    <h1 class="p-3">Editar Tarefa</h1>
  <form action="#" method="post"  @submit.prevent="editTarefa" class="mx-auto mt-4 container-fluid">

  <div class="form-group row p-1">
      <label for="inputPassword" class="col-sm-2 col-form-label">Nome</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword" placeholder="nome" name="name" v-model="tarefa.name">
      </div>
  </div>
  <div class="form-group row p-1">
      <label for="inputPassword" class="col-sm-2 col-form-label">Endereço</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword" placeholder="endereço" name="address" v-model="tarefa.address">
      </div>
  </div>
  <div class="form-group row p-1">
      <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
      <input type="email" class="form-control" id="inputPassword" placeholder="email" name="email" v-model="tarefa.email">
      </div>
  </div>
  <div class="form-group row p-1">
      <label for="inputPassword" class="col-sm-2 col-form-label">Telefone</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPassword" placeholder="telefone" name="telephone" v-model="tarefa.telephone">
      </div>
  </div>
  <div class="form-group row">
          <div class="col-sm-12 text-end">
            <button class="btn btn-primary " type="submit">Criar</button>
          </div>
        </div>
  </form>
  </div>
</template>
  
  <script>
  import TodoService from '@/services/todo-services';
  import { reactive, onMounted } from 'vue';
  import router from '@/router';
  import 'bootstrap/dist/css/bootstrap.css';
  
  export default {
    name: 'EditTarefa',
    props: {
      id: {
        required: true
      }
    },
    setup(props) {
      const tarefa = reactive({
        name: '',
        address: '',
        email: '',
        telephone: '',
      })
  
      onMounted(async () => {
        await TodoService.getOne(props.id).then(response => {
          const data = response.data;
          tarefa.name = data.name;
          tarefa.address = data.address;
          tarefa.email = data.email;
          tarefa.telephone = data.telephone;
        })
      })
      
      const editTarefa = () => {
        const params = {
          name: tarefa.name,
          address: tarefa.address,
          email: tarefa.email,
          telephone: tarefa.telephone
        }
  
        TodoService.editTarefa(props.id, tarefa).then(() => router.push({ name: 'todo.index' }))
      }
  
      return {
        tarefa,
        editTarefa
      }
    }
  }
</script>
  