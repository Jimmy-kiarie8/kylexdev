<template>

<!-- Edit User -->
<v-dialog v-model="openEditRequest" max-width="800px" persistent>
  <v-card>
    <v-card-title>
      {{ editedItemCon.name }}
    </v-card-title>
    <v-card-text>
      <v-form ref="form" @submit.prevent="update">
        <v-container grid-list-xl fluid>
              <v-layout wrap>
                <v-flex xs12 sm6>
                  <v-text-field
                  v-model="editedItemCon.receipt_no"
                  :rules="rules.name"
                  color="blue darken-2"
                  label="Receipt Number"
                  required
                  ></v-text-field>
                  <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
               </v-flex>
               <v-flex xs12 sm6>
                  <v-text-field
                  v-model="editedItemCon.receipt_date"
                  color="blue darken-2"
                  label="Receipt Date"
                  type="date"
                  required
                  ></v-text-field>
                  <!-- <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
               </v-flex>
               <v-flex xs12 sm6>
                  <v-text-field
                  v-model="editedItemCon.amount"
                  color="blue darken-2"
                  label="Amount"
                  required
                  ></v-text-field>
                  <!-- <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small> -->
               </v-flex>
               <v-flex xs12 sm6>
                  <v-text-field
                  v-model="editedItemCon.period"
                  color="blue darken-2"
                  label="Period"
                  required
                  ></v-text-field>
                  <!-- <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small> -->
               </v-flex>
<!--                <v-flex xs12>
                   <v-textarea
                     v-model="editedItemCon.remarks"
                     color="blue"
                   >
                     <div slot="label">
                       Remark
                     </div>
                   </v-textarea>
                </v-flex> -->
               
               <div class="form-group col-md-6">
                 <label for="password" class="col-md-8 col-form-label text-md-right">Member Name</label>
                 <div class="col-md-12">
                     <select class="custom-select" v-model="editedItemCon.client_id">
                       <option v-for="client in clients" data-subtext="" :value="client.client_id">{{client.name}}</option>
                     </select>
                 </div>
               </div>
               <div class="form-group col-md-6">
                 <label for="password" class="col-md-8 col-form-label text-md-right">Account</label>
                 <div class="col-md-12">
                     <select class="custom-select" v-model="editedItemCon.account">
                       <option data-subtext="" value="Savings">Savings</option>
                       <option data-subtext="" value="mpesa">mpesa</option>
                     </select>
                 </div>
               </div>
               <div class="form-group col-md-6">
                 <label for="password" class="col-md-8 col-form-label text-md-right">Payment Mode</label>
                 <div class="col-md-12">
                     <select class="custom-select" v-model="editedItemCon.payment_mode">
                       <option data-subtext="" value="Cash">Cash</option>
                       <option data-subtext="" value="Check">Check</option>
                       <option data-subtext="" value="Mpesa">Mpesa</option>
                       <option data-subtext="" value="EFT">EFT</option>
                     </select>
                 </div>
               </div><div class="form-group col-md-6">
                 <label for="password" class="col-md-8 col-form-label text-md-right">Payment Type</label>
                 <div class="col-md-12">
                     <select class="custom-select" v-model="editedItemCon.payment_type">
                       <option data-subtext="" value="Principal">Principal</option>
                       <option data-subtext="" value="interest">interest</option>
                       <option data-subtext="" value="Savings">Savings</option>
                       <option data-subtext="" value="Charges">Charges</option>
                       <option data-subtext="" value="Insurance">Insurance</option>
                     </select>
                 </div>
               </div>
            </v-layout>
          </v-container>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-btn color="primary" flat @click.stop="close">Close</v-btn>
        <v-spacer></v-spacer>
        <v-btn 
          color="primary" 
          flat 
          @click="update"
          :loading="loading"
          :disabled="loading"
          >Update</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
  <!-- Edit User -->

</template>

<script>
export default {
  props: ['editedItemCon', 'openEditRequest', 'clients'],
  data() {
    return{
      e1: true,
      loader: false,
      loading:false,
      list: {},
      emailRules: [
        v => {
          return !!v || 'E-mail is required'
        },
        v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
      ],
      rules: {
        name: [val => (val || '').length > 0 || 'This field is required']
      },
    }
  },
  methods: {
    update() {
      this.loading=true
      axios.patch(`/receipts/${this.editedItemCon.id}`, this.editedItemCon)
      .then((response) => {
            this.loading=false
            this.close;
            this.$emit('alertRequest');
            this.$emit('closeRequest');
            Object.assign(this.$parent.AllClient[this.$parent.editedIndex], this.$parent.editedItem)

      })
      .catch((error) => {
      this.errors = error.response.data.errors
      this.loading=false
    })
    },
    /*resetForm () {
        this.form = Object.assign({}, this.defaultForm)
        this.$refs.form.reset()
      },*/
    close() {
      this.$emit('closeRequest')
    },
  },
  mounted() {

  }
}
</script>
