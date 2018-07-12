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

            <div>
             <v-toolbar color="indigo" dark tabs>
              <v-tabs
              v-model="tab"
              color="indigo"
              align-with-title
              >
              <v-tabs-slider color="yellow"></v-tabs-slider>

              <v-tab v-for="item in items" :key="item">
                {{ item }}
             </v-tab>
          </v-tabs>
       </v-toolbar>
       <v-tabs-items v-model="tab">
        <v-tab-item>
         <v-btn color="primary" flat @click="openUser">Add Loan</v-btn>
         <ShowLoan :openRequest="dispClient" :client="editedItem"></ShowLoan>
      </v-tab-item>

      
      <v-tab-item>
        <v-card-title>
          <!-- <v-btn color="primary" flat @click="openUser">Add Client</v-btn> -->
          <v-spacer></v-spacer>
          <v-text-field
          v-model="searchArchived"
          append-icon="search"
          label="Search"
          single-line
          hide-details
          ></v-text-field>
       </v-card-title>
       <v-data-table
       :headers="Refheaders"
       :items="AllReferres"
       :search="search"
       counter
       class="elevation-1"
       >
       <template slot="items" slot-scope="props">
          <td>
           {{ props.item.client_id }}
        </td>
        <td class="text-xs-right">{{ props.item.amount }}</td>
        <td class="text-xs-right">{{ props.item.id_no }}</td>
        <td class="text-xs-right">{{ props.item.amount }}</td>
        <td class="text-xs-right">{{ props.item.loan_id }}</td>
        <td class="justify-center layout px-0">
           <v-btn icon class="mx-0" @click="refresh(props.item)">
            <v-icon color="blue darken-2">refresh</v-icon>
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
</v-tab-item>
</v-tabs-items>

</div>


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
<AddLoan @closeRequest="close" :openAddRequest="dispAdd" @alertRequest="showAlert" :clients="AllClientLoans" :clientsDetails="AllClientsDetails"></AddLoan>
<EditLoan @closeRequest="close" :openEditRequest="pdialog2" :editedItemCon="editedItem" @alertRequest="showAlert" :Showrole="AllRoles"></EditLoan>
<ShowLoan @closeRequest="close" :openRequest="dispClient" :client="editedItem"></ShowLoan>
</div>
</v-app>
</template>

<script>
let AddLoan = require('./AddLoan.vue')
let ShowLoan = require('./ShowLoan.vue')
let EditLoan = require('./EditLoan.vue')
export default {
 props: ['user', 'role'],
 components: {
  AddLoan, EditLoan, ShowLoan, 
}, 
data() {
  return{
     tab: null,
     items: [
     'Details', 'Referees'
     ],
     AllReferres: [],
     headers: [
     { text: 'Loan Id', align: 'left', value: 'loan_id'},
     { text: 'Loan Type', value: 'loan_type' },
     { text: 'Interest Rate', value: 'interest_rate' },
      // { text: 'Phone Number', value: 'phone' },
      { text: 'Balance', value: 'balance' },
      { text: 'Actions', value: 'name', sortable: false }
      ],
      Refheaders: [
      { text: 'Client Id', align: 'left', value: 'client_id'},
      { text: 'Amount', value: 'amount' },
      { text: 'Id Number', value: 'id_no' },
      { text: 'Amount Number', value: 'amount' },
      { text: 'Loan Id', value: 'loan_id' },
      { text: 'Actions', value: 'name', sortable: false }
      ],
      AllRoles: {},
      search: '',
      searchArchived: '',
      loader: false,
      loading: false,
      dispAdd: false,
      dispClient: false,
      pdialog2: false,
      snackbar: false,
      commdialog2: false,
      pdialog: false,
      timeout: 5000,
      color: '',
      message: '',
      AllClientLoans: [],
      AllClientsDetails: {},
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
 ClientShow(item) {
  this.editedItem = Object.assign({}, item)
  this.editedIndex = this.AllClientLoans.indexOf(item)
  this.dispClient = true
},
openUser(){
  this.dispAdd  = true
},
editItem(item) {
  this.editedItem = Object.assign({}, item)
  this.editedIndex = this.AllClientLoans.indexOf(item)
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
  this.editedIndex = this.AllClientLoans.indexOf(item)
  const index = this.AllClientLoans.indexOf(item)
  if (confirm('Are you sure you want to delete this item?')) {
      // this.loading = true
      axios.delete(`/clients/${this.delItem.id}`)
      .then((response) => {
       this.AllClientLoans.splice(index, 1)
        // this.loading = false
        this.message = 'deleted successifully'
        this.color = 'indigo'
        this.snackbar = true
        this.AllReferres.push(response.data) 
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
refresh(item) {
   this.delItem = Object.assign({}, item)
   this.editedIndex = this.AllReferres.indexOf(item)
   const index = this.AllReferres.indexOf(item)
   if (confirm('Are you sure you?')) {
        // this.loading = true
        axios.post(`/ArchivedClients/${this.delItem.id}`)
        .then((response) => {
           this.AllReferres.splice(index, 1)
           this.AllClientLoans.push(response.data) 
          // this.loading = false
          this.message = 'successifully'
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
     this.dispAdd= this.dispClient = this.pdialog2 = false
  },
},
mounted() {
 this.loader=true
 axios.post('getLoans')
 .then((response) => {
  this.loader=false
  this.AllClientLoans = response.data
})
 .catch((error) => {
  this.loader=false
  this.errors = error.response.data.errors
})

 axios.post('getClients')
 .then((response) => {
  this.AllClientsDetails = response.data
})
 .catch((error) => {
  this.errors = error.response.data.errors
})

 axios.post('getReferees')
 .then((response) => {
  this.loader=false
  this.AllReferres = response.data
})
 .catch((error) => {
  this.loader=false
  this.errors = error.response.data.errors
})
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