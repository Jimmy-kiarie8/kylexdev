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
       <v-card-title>
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
       :items="AllActiveLoans"
       :search="search"
       counter
       class="elevation-1"
       >
       <template slot="items" slot-scope="props">
          <td>
           {{ props.item.loan_id }}
        </td>
        <td class="text-xs-right">{{ props.item.loan_type }}</td>
        <td class="text-xs-right">{{ props.item.interest_rate }}</td>
        <td class="text-xs-right">{{ props.item.balance }}</td>
        <!-- <td class="text-xs-right">{{ props.item.address }}</td> -->
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

</div>


</div>
</div>
<!-- Data table -->
</v-layout>
</v-container>
</v-content>
</div>
</v-app>
</template>

<script>
export default {
 props: ['user'],
 data() {
  return{
     AllReferres: [],
     headers: [
     { text: 'Loan Id', align: 'left', value: 'loan_id'},
     { text: 'Loan Type', value: 'loan_type' },
     { text: 'Interest Rate', value: 'interest_rate' },
      // { text: 'Phone Number', value: 'phone' },
      { text: 'Balance', value: 'balance' },
      { text: 'Actions', value: 'name', sortable: false }
      ],
      search: '',
      AllActiveLoans: [],
   }
},
methods: {  
  close() {
     this.dispAdd= this.dispClient = this.pdialog2 = false
  },
},
mounted() {
 axios.post('getActiveLoans')
 .then((response) => {
  this.loader=false
  this.AllActiveLoans = response.data
})
 .catch((error) => {
  this.errors = error.response.data.errors
})
}
}
</script>
