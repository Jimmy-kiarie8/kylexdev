<template>
  <v-layout row justify-center>
    <v-dialog v-model="openRequest" persistent max-width="700px">
      <v-card v-if="openRequest">
        <v-card-title fixed>
          <span class="headline">{{client.name}}' Details</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <div class="col-md-12 col-sm-12">
            <ul class="list-group">
              <li class="list-group-item row active">
                <label class="col-md-5 col-lg-5"><b>Member Bio Data</b></label>
              </li>

              <li class="list-group-item row">
                <label class="col-md-5 col-lg-5"><b>Name</b></label> {{ client.name }}
              </li>
              <li class="list-group-item row">
                <label class="col-md-5 col-lg-5"><b>Id Number</b></label> {{ client.id_no }}
              </li>


              <li class="list-group-item row active">
                <label class="col-md-5 col-lg-5"><b>Member Address</b></label>
              </li>
              <li class="list-group-item row">
                <label class="col-md-5 col-lg-5"><b>Email</b></label> {{ client.email }}
              </li>
              <li class="list-group-item row">
                <label class="col-md-5 col-lg-5"><b>Phone Number</b></label> {{ client.phone }}
              </li>
              <li class="list-group-item row">
                <label class="col-md-5 col-lg-5"><b>Address</b></label> {{ client.address }}
              </li>
            </ul>
          </div>
          </v-container>
        </v-card-text>
        <v-btn flat @click="close">Close</v-btn>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
export default {
  props: ['openRequest', 'client'],
  data() {
    return{
      list: {}
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
