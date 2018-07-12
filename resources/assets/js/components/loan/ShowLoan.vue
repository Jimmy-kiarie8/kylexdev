<template>
 <v-layout row justify-center>
    <v-card>
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
       <AppliedLoan></AppliedLoan>
    </v-card>
 </v-tab-item>
 <!-- Applied Loans End -->

 <!-- Rejected Loans -->
 <v-tab-item>
  <v-card flat>
    <RejectedLoans></RejectedLoans>
 </v-card>
</v-tab-item>
<!-- Rejected Loans End -->

<!-- Draft Loans -->
<v-tab-item>
  <v-card flat>
    <DraftLoans></DraftLoans>
 </v-card>
</v-tab-item>
<!-- Draft Loans End -->

<!-- Defaulted Loans -->
<v-tab-item>
  <v-card flat>
    <DefaultedLoans></DefaultedLoans>
 </v-card>
</v-tab-item>
<!-- Defaulted Loans End -->

<!-- Repaid Loans -->
<v-tab-item>
  <v-card flat>
    <RepaidLoans></RepaidLoans>
 </v-card>
</v-tab-item>
<!-- Repaid Loans End -->
</v-tabs-items>
</div>
<!-- Tabs -->
</v-card-text>
</v-card>
</v-layout>
</v-container>
</v-card-text>
</v-card>
</v-layout>
</template>

<script>
let ActiveLoan = require('./ActiveLoans')
let AppliedLoan = require('./AppliedLoans')
let DefaultedLoans = require('./DefaultedLoans')
let DraftLoans = require('./DraftLoans')
let RejectedLoans = require('./RejectedLoans')
let RepaidLoans = require('./RepaidLoans')
export default {
 props: ['openRequest', 'client'],
 components: {
  ActiveLoan, AppliedLoan, RejectedLoans, DraftLoans, DefaultedLoans, RepaidLoans
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
},
mounted() {

}
}
</script>
