
import axios from "axios";

export default class TodoService {

    static async getAll(){
        return axios.get('/')
    }

    static async addTarefa(params){
       return axios.post("/", params) 
    }

    static async editTarefa(id, params){
        return axios.put( `/${id}`, params )
    }

    static async getOne(id){
        return axios.get(`/${id}`)
    }

    static async destroy(id){
        return axios.delete(`/${id}`)
    }
}