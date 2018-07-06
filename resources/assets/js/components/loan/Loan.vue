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

                <v-card-title>
                 <v-btn color="primary" flat @click="openUser">Add Loan</v-btn>
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
                :items="AllClient"
                :search="search"
                counter
                class="elevation-1"
                >
                <template slot="items" slot-scope="props">
                 <td>
                   {{ props.item.name }}
                 </td>
                 <td class="text-xs-right">{{ props.item.email }}</td>
                 <td class="text-xs-right">{{ props.item.id_no }}</td>
                 <td class="text-xs-right">{{ props.item.phone }}</td>
                  <td class="text-xs-right">{{ props.item.address }}</td>
                    <td class="justify-center layout px-0">
                     <v-btn icon class="mx-0" @click="editItem(props.item)">
                       <v-icon color="blue darken-2">edit</v-icon>
                     </v-btn>
                   <v-btn icon class="mx-0" @click="deleteItem(props.item)">
                     <v-icon color="pink darken-2">delete</v-icon>
                   </v-btn>
                   <v-btn icon class="mx-0" @click="ClientShow(props.item)">
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
                :headers="headers"
                :items="AllClientAchived"
                :search="search"
                counter
                class="elevation-1"
                >
                <template slot="items" slot-scope="props">
                 <td>
                   {{ props.item.name }}
                 </td>
                 <td class="text-xs-right">{{ props.item.email }}</td>
                 <td class="text-xs-right">{{ props.item.id_no }}</td>
                 <td class="text-xs-right">{{ props.item.phone }}</td>
                  <td class="text-xs-right">{{ props.item.address }}</td>
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
<AddLoan @closeRequest="close" :openAddRequest="dispAdd" @alertRequest="showAlert" :clients="AllClient"></AddLoan>
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
    AllClientAchived: [],
      headers: [
      { text: 'Name', align: 'left', value: 'name'},
      { text: 'email', value: 'email' },
      { text: 'Id Number', value: 'id_no' },
      { text: 'Phone Number', value: 'phone' },
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
    AllClient: [],
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
    this.editedIndex = this.AllClient.indexOf(item)
    this.dispClient = true
  },
  openUser(){
    this.dispAdd  = true
  },
  editItem(item) {
    this.editedItem = Object.assign({}, item)
    this.editedIndex = this.AllClient.indexOf(item)
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
    this.editedIndex = this.AllClient.indexOf(item)
    const index = this.AllClient.indexOf(item)
    if (confirm('Are you sure you want to delete this item?')) {
      // this.loading = true
      axios.delete(`/clients/${this.delItem.id}`)
      .then((response) => {
        this.AllClient.splice(index, 1)
        // this.loading = false
        this.message = 'deleted successifully'
        this.color = 'indigo'
        this.snackbar = true
        this.AllClientAchived.push(response.data) 
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
      this.editedIndex = this.AllClientAchived.indexOf(item)
      const index = this.AllClientAchived.indexOf(item)
      if (confirm('Are you sure you?')) {
        // this.loading = true
        axios.post(`/ArchivedClients/${this.delItem.id}`)
        .then((response) => {
          this.AllClientAchived.splice(index, 1)
          this.AllClient.push(response.data) 
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
  axios.post('getClients')
  .then((response) => {
    this.loader=false
    this.AllClient = response.data
  })
  .catch((error) => {
    this.loader=false
    this.errors = error.response.data.errors
  })


  axios.post('getArchivedClients')
  .then((response) => {
    this.loader=false
    this.AllClientAchived = response.data
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