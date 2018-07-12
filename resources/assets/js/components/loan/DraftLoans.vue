<template>
 <div>
  <v-content>
   <v-container fluid fill-height>
    <v-layout justify-center align-center>
      <div class="container">
       <!-- clients display -->
       <div>

         <div id="table">
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
           :items="AllDraftLoans"
           :search="search"
           counter
           class="elevation-1"
           >
           <template slot="items" slot-scope="props">
              <td>
                {{ props.item.loan_id }}
             </td>
             <td class="text-xs-right">{{ props.item.loan_type }}</td>
             <td class="text-xs-right">{{ props.item.amount }}</td>
             <td class="text-xs-right">{{ props.item.interest_rate }}</td>
             <td class="text-xs-right">{{ props.item.repayment_period }}</td>
             <td class="text-xs-right">{{ props.item.application_date }}</td>
             <td class="text-xs-right">{{ props.item.status }}</td> 
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
</template>

<style scoped>
#table{
   margin-top: -100px;
}
.v-content__wrap{
   margin-left: -150px;
   width: 1000px;
}
</style>


<script>
export default {
  props: ['user'],
  data() {
    return{
       AllReferres: [],
       headers: [
       { text: 'Loan Id', align: 'left', value: 'loan_id'},
       { text: 'Loan Type', value: 'loan_type' },
       { text: 'Amount', value: 'amount' },
       { text: 'Interest Rate', value: 'interest_rate' },
       { text: 'Application Date', value: 'application_date' },
       { text: 'Status', value: 'status' },
      ],
      search: '',
      AllDraftLoans: [],
   }
},
methods: {  
 close() {
    this.dispAdd= this.dispClient = this.pdialog2 = false
 },
},
mounted() {
  axios.post('getDraftLoans')
  .then((response) => {
    this.loader=false
    this.AllDraftLoans = response.data
 })
  .catch((error) => {
    this.errors = error.response.data.errors
 })
}
}
</script>
