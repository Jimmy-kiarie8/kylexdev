<template>
  <v-layout row justify-center>
    <v-dialog v-model="openRequest" persistent max-width="1300px">
           <v-card>
             <v-card-title fixed> 
               <span class="headline">Add Loan</span>
             </v-card-title>
             <v-card-text>
               <v-container grid-list-md>
                 <v-layout wrap>
                  <v-card flat>
                    <v-card-text>

                     <!-- Tabs -->
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

                     <!-- Active Loans -->
                     <v-tabs-items v-model="tab">
                       <v-tab-item>
                         <v-card flat>
                          <ActiveLoan></ActiveLoan>
                         </v-card>
                       </v-tab-item>
                     <!-- Active Loans End -->

                     <!-- Applied Loans -->
                       <v-tab-item>
                         <v-card flat>

                         </v-card>
                       </v-tab-item>
                     <!-- Applied Loans End -->

                     <!-- Rejected Loans -->
                       <v-tab-item>
                         <v-card flat>

                         </v-card>
                       </v-tab-item>
                     <!-- Rejected Loans End -->

                     <!-- Applied Loans -->
                       <v-tab-item>
                         <v-card flat>

                         </v-card>
                       </v-tab-item>
                     </v-tabs-items>
                     <!-- Applied Loans End -->
                   </div>
                   <!-- Tabs -->
                 </v-card-text>
               </v-card>
             </v-layout>
           </v-container>
         </v-card-text>
       </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
let ActiveLoan = require('./ActiveLoans')
// let ActiveLoan = require('./ActiveLoan')
// let ActiveLoan = require('./ActiveLoan')
export default {
  props: ['openRequest', 'client'],
  components: {
    ActiveLoan
  },
  data() {
    return{
      list: {},
      tab: null,
      items: [
      'Active', 'Applied', 'Rejected', 'Defaulted', 'Repaid', 'Draft'
      ],
    }
  },
  methods: {
    close() {
      this.$emit('closeRequest')
    },
  },
  mounted() {

  }
}
</script>
