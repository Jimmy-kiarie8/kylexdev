<template>
  <v-app>
 <div>
  <v-content>
   <v-container fluid fill-height>
    <v-layout justify-center align-center>
    <div v-show="loader" style="text-align: center">
      <v-progress-circular :width="3" indeterminate color="red" style="margin: 1rem"></v-progress-circular>
    </div>
     <div class="container" v-show="!loader">
       <!-- clients display -->
       <div>
        <v-card-title>
         <v-btn color="primary" flat @click="openUser">Add Receipt</v-btn>
         <v-spacer></v-spacer>
         <v-text-field
         v-model="search"
         append-icon="search"
         label="Search"
         single-line
         hide-details
         ></v-text-field>
       </v-card-title>
       <v-data-table
       :headers="headers"
       :items="AllRecepts"
       :search="search"
       counter
       class="elevation-1"
       >
       <template slot="items" slot-scope="props">
        <td>
          {{ props.item.receipt_no }}
        </td>
        <td class="text-xs-right">{{ props.item.receipt_date }}</td>
        <td class="text-xs-right">{{ props.item.payment_mode }}</td>
        <td class="text-xs-right">{{ props.item.payment_type }}</td>
         <td class="text-xs-right">{{ props.item.period }}</td>
         <td class="text-xs-right">{{ props.item.remarks }}</td>
           <td class="justify-center layout px-0">
            <v-btn icon class="mx-0" @click="editItem(props.item)">
              <v-icon color="blue darken-2">edit</v-icon>
            </v-btn>
          <v-btn icon class="mx-0" @click="deleteItem(props.item)">
            <v-icon color="pink darken-2">delete</v-icon>
          </v-btn>
          <v-btn icon class="mx-0" @click="seeDocs(props.item)">
            <v-icon color="blue darken-2">visibility</v-icon>
          </v-btn>
          
        </td> 
      </template>
      <v-alert slot="no-results" :value="true" color="error" icon="warning">
       Your search for "{{ search }}" found no results.
     </v-alert>
     <template slot="pageText" slot-scope="{ pageStart, pageStop }">
       From {{ pageStart }} to {{ pageStop }}
     </template>
   </v-data-table>
 </div>
</div>
<!-- Data table -->
</v-layout>
</v-container>
<v-snackbar
:timeout="timeout"
bottom
:color="color"
left
v-model="snackbar"
>
{{ message }}
<v-icon dark right>check_circle</v-icon>
</v-snackbar>
</v-content>
<AddReceipt @closeRequest="close" :openAddRequest="dispAdd" @alertRequest="showAlert" :clients="AllClient"></AddReceipt>
<EditReceipt @closeRequest="close" :openEditRequest="pdialog2" :editedItemCon="editedItem" @alertRequest="showAlert" :clients="AllClient"></EditReceipt>
<!-- <ShowReceipt @closeRequest="close" :openProRequest="docsdialog2" :users="AllRecepts"></ShowReceipt> -->
</div>
</v-app>
</template>

<script>
let AddReceipt = require('./AddReceipt.vue')
// let ShowReceipt = require('./ShowReceipt.vue')
let EditReceipt = require('./EditReceipt.vue')
export default {
  props: ['user', 'role'],
  components: {
    AddReceipt, EditReceipt
    // ShowReceipt, 
  }, 
  data() {
    return{
      headers: [
      { text: 'Receipt Number', align: 'left', value: 'receipt_no'},
      { text: 'Receipt Date', value: 'receipt_date' },
      { text: 'Payment Mode', value: 'payment_mode' },
      { text: 'Payment Type', value: 'payment_type' },
      { text: 'Period', value: 'period' },
      { text: 'Remarks', value: 'remarks' },
    { text: 'Actions', value: 'name', sortable: false }
    ],
    search: '',
    loader: false,
    loading: false,
    dispAdd: false,
    docsdialog2: false,
    pdialog2: false,
    snackbar: false,
    commdialog2: false,
    pdialog: false,
    timeout: 5000,
    color: '',
    message: '',
    AllRecepts: [],
    AllClient: {},
    editedItem: {},
    delItem: {},
    emailRules: [
    v => {
      return !!v || 'E-mail is required'
    },
    v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
    ],
    rules: {
      age: [
      val => val < 10 || `I don't believe you!`
      ],
      name: [val => (val || '').length > 0 || 'This field is required']
    },
  }
},
methods: {  
  openUser(){
    this.dispAdd  = true
  },
  editItem(item) {
    this.editedItem = Object.assign({}, item)
    this.editedIndex = this.AllRecepts.indexOf(item)
    // console.log(this.editedItem);
    this.pdialog2 = true
  },

  showAlert(){
    this.message = 'Successifully Added';
    this.snackbar = true;
    this.color = 'indigo';
  },
  deleteItem(item) {
    this.delItem = Object.assign({}, item)
    this.editedIndex = this.AllRecepts.indexOf(item)
    const index = this.AllRecepts.indexOf(item)
    if (confirm('Are you sure you want to delete this item?')) {
      // this.loading = true
      axios.delete(`/clients/${this.delItem.id}`)
      .then((response) => {
        this.AllRecepts.splice(index, 1)
        // this.loading = false
        this.message = 'deleted successifully'
        this.color = 'indigo'
        this.snackbar = true
      })
      .catch((error) => {
        // this.loading = false
        this.message = 'something went wrong'
        this.color = 'red'
        this.snackbar = true
        this.errors = error.response.data.errors
      })
    }
  },
  close() {
    this.dispAdd= this.docsdialog2 = this.pdialog2 = false
  },
},
mounted() {
  this.loader=true
  axios.post('getReceipts')
  .then((response) => {
    this.loader=false
    this.AllRecepts = response.data
  })
  .catch((error) => {
    this.loader=false
    this.errors = error.response.data.errors
  })


  this.loader=true
  axios.post('getClients')
  .then((response) => {
    this.loader=false
    this.AllClient = response.data
  })
  .catch((error) => {
    this.loader=false
    this.errors = error.response.data.errors
  })


  /*axios.post('getRoles')
  .then((response) => {
    this.loader=false
    this.AllRoles = response.data
  })
  .catch((error) => {
    this.loader=false
    this.errors = error.response.data.errors
  })*/

 /*beforeRouteEnter(to, from, next) {
   next(vm => {
    if (vm.role === 'Admin' || vm.role === 'companyAdmin') {
      next(); 
    } else {
      next('/');
    }
  })
}*/
}
}
</script>


<style scoped>
.content--wrap{
 margin-top: -100px
}
#profile { 
 width: 70px;
 height: 60px;
 border-radius: 50%;
 margin-left: 80px;
 margin-top: -30px;
}
i{
 padding: 7px;
 background: #f0f0f0;
 border-radius: 50%;
}
.list-group-item:hover, .list-group-item:focus {
 z-index: 1;
 background: #f9f9f9;
 text-decoration: none;
}
</style>