<template>
    <div class="row">
        <div class="col-md-12">
            <button type="button" @click="newEmployee()" class="btn btn-primary" data-toggle="modal" data-target="#employeeModal">
                New Employee
            </button>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(employee, index) in employees" :key="index">
                        <tr class="text-center">
                            <th scope="row">{{ employee.id }}</th>
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.email }}</td>
                            <td>{{ employee.phone }}</td>
                            <td>
                                <button class="btn btn-primary mr-3" data-toggle="modal" data-target="#employeeModal" @click="editEmployee(employee)" >Edit</button>
                                <button class="btn btn-danger" @click="deleteEmployee(employee.id)" >Delete</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-danger" v-if="errors != ''">
                                <p v-for="(error, index) in errors" :key="index" >{{ error }}</p>
                            </div>
                        </div>
                        <input type="hidden" name="id" v-model="from.id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" v-model="from.name" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" v-model="from.email" aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" v-model="from.phone" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" v-if="from.id == ''" class="btn btn-primary" @click="storeEmployee(); fromReset();" >Add</button>
                    <button type="button" v-else="from.id != ''" class="btn btn-primary" @click="storeEmployee(); fromReset();" >Update</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';
export default {
    setup() {
        const employees = ref([]);
        const errors = ref([]);
        const from = reactive({
            id:'',
            name:'',
            email:'',
            phone:'',
        });
        const getEmployee = async() => {
            let res = await axios.get('/get/employee');
            employees.value = res.data;
        };
        const fromReset = async () => {
            from.id = '';
            from.name = '';
            from.email = '';
            from.phone = '';
        };
        
        const storeEmployee = async () => {
                await axios.post('/store/employee', from).then(res => {
                    fromReset();
                    getEmployee();
                    $("#employeeModal").modal('hide');
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Employee save successfully",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }).catch(e => {
                    var data = [];
                    for (const key in e.response.data.errors) {
                        data.push(e.response.data.errors[key][0]);
                    }
                    errors.value = data;
                });
        };
        const deleteEmployee =  (id) => {
            let res = axios.get('/delete/employee/' + id).then(response => {
                if (response.status == 200) {
                    getEmployee();
                    Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Employee delete successfully",
                    showConfirmButton: false,
                    timer: 1500
                    });
                }
                console.log(response);
            }).catch(error => {

            });
        };

        const newEmployee = async () => {
            fromReset();
        };

        const editEmployee = (employee) => {
            from.id = employee.id;
            from.name = employee.name;
            from.email = employee.email;
            from.phone = employee.phone;
        };
        onMounted(getEmployee());

        return {
            employees,
            from,
            storeEmployee,
            editEmployee,
            errors,
            newEmployee,
            deleteEmployee,
        };
    }
};
</script>