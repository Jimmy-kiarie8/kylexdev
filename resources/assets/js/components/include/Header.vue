<template>
 <!-- <div> -->
  <v-app id="inspire">
   <!-- temporary -->
      <!-- <v-navigation-drawer
      right
      temporary
      v-model="right"
      fixed
      >  
   </v-navigation-drawer> -->
   <!-- temporary -->


   <v-navigation-drawer
   fixed
   :color="color"
   :clipped="$vuetify.breakpoint.lgAndUp"
   app
   v-model="drawer"
   >
   <v-list dense>

      <template>
     <!-- <v-list-group
      append-icon=""
      style= "background:#f0f0f0"
      >
      <v-list-tile slot="activator" style="background:#f5f5f5; padding: 0 0 40px 0; margin-top: 10px; padding: 30px 0 0 0;">
        <v-list-tile-content> -->
          <!-- <v-avatar>
            <img :src="user.profile" style="width: 100px; height: 100px;border-radius: 50%; margin-left: 60px;">
            <br> 
            
            <v-divider></v-divider>
          </v-avatar>
        </v-list-tile>
     </v-list-group>-->
     <v-divider></v-divider>
     <router-link to="/" class="list__tile list__tile--link">
       <div class="list__tile__action">
        <!-- <v-icon color="black darken-2">home</v-icon> -->
     </div>
     <div class="list__tile__content">
        <div class="list__tile__title">
         Dashboard
      </div>
   </div>
</router-link>

<v-expansion-panel inset>
   <v-expansion-panel-content>
      <div slot="header" style="margin-left: 40px;"> System settings <span class="caret"></span></div>
    <v-card>
     <v-card-text>
       <router-link to="/users" class="list__tile list__tile--link">
         <div class="list__tile__content">
            <div class="list__tile__title">
             Manage Users
          </div>
       </div>
    </router-link>



    <router-link to="/units" class="list__tile list__tile--link">
      <div class="list__tile__content">
         <div class="list__tile__title">
          Manage Units
       </div>
    </div>
 </router-link>

 <router-link to="/buyers" class="list__tile list__tile--link">
   <div class="list__tile__content">
      <div class="list__tile__title">
       Manage Clients
    </div>
 </div>
</router-link>

<router-link to="/coffee" class="list__tile list__tile--link">
   <div class="list__tile__content">
      <div class="list__tile__title">
       Coffee Type 
    </div>
 </div>
</router-link>



<router-link to="/society" class="list__tile list__tile--link">
   <div class="list__tile__content">
      <div class="list__tile__title">
       Manage Society
    </div>
 </div>
</router-link>
<!-- <router-link to="/supply" class="list__tile list__tile--link">
   <div class="list__tile__content">
      <div class="list__tile__title">
       Manage Supply
    </div>
 </div>
</router-link> -->
<!-- <router-link to="/profile" class="list__tile list__tile--link">
   <div class="list__tile__content">
      <div class="list__tile__title">
       Account Setting
    </div>
 </div>
</router-link> -->

</v-card-text>
</v-card>
</v-expansion-panel-content>
</v-expansion-panel>


<router-link to="/derivery" class="list__tile list__tile--link">
 <div class="list__tile__action">
  <!-- <v-icon color="black darken-2">store</v-icon> -->
</div>
<div class="list__tile__content">
  <div class="list__tile__title">
   Delivery
</div>
</div>
</router-link>

<router-link to="/millers" class="list__tile list__tile--link">
 <div class="list__tile__action">
  <!-- <v-icon color="black darken-2">account_circle</v-icon> -->
</div>
<div class="list__tile__content">
  <div class="list__tile__title">
   Manage Milling
</div>
</div>
</router-link>



<!--  -->

<!-- Debtors/Client Management -->
<v-expansion-panel inset>
 <v-expansion-panel-content>
  <div slot="header" style="margin-left: 40px;">Debtors/Client Management <span class="caret"></span></div>
  <v-card>
   <v-card-text>
     <router-link to="/invoices" class="list__tile list__tile--link">
       <div class="list__tile__content">
          <div class="list__tile__title">
           Manage Invoices
        </div>
     </div>
  </router-link>



  <router-link to="/receipts" class="list__tile list__tile--link">
    <div class="list__tile__content">
       <div class="list__tile__title">
        Manage Receipts
     </div>
  </div>
</router-link>

</v-card-text>
</v-card>
</v-expansion-panel-content>
</v-expansion-panel>


<router-link to="/reports" class="list__tile list__tile--link">
   <div class="list__tile__action">
    <!-- <v-icon color="black darken-2">settings</v-icon> -->
 </div>
 <div class="list__tile__content">
    <div class="list__tile__title">
     Reports
  </div>
</div>
</router-link>
<!-- </v-card> -->

</template> 
</v-list>
</v-navigation-drawer>
<v-toolbar
dark
app
:color="color"
:clipped-left="$vuetify.breakpoint.lgAndUp"
fixed
>
<v-toolbar-title style="width: 500px" class="ml-0 pl-3">
 <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
 {{user.name}}
 <!-- <img :src="user.profile" alt="" style="width: 60px; height: 60px; border-radius: 50%;"> -->
</v-toolbar-title>
<!-- <v-spacer></v-spacer> -->

<!-- <v-menu 
offset-x
:close-on-content-click="false"
:nudge-width="200"
v-model="menu"
>
<v-btn :color="color" dark slot="activator">Change color</v-btn>
<v-card id="card">
 <v-list>
  <v-list-tile avatar  v-for="item in items" :key="item.color" class="col-md-4">
   <v-list-tile-avatar>
    <v-avatar :class="item.color">
     <span class="white--text headline"> {{item.text}} </span> 
  </v-avatar>
</v-list-tile-avatar>
<v-list-tile-content>
 <v-list-tile-title><span class="white--text headline"> {{item.text}} </span></v-list-tile-title>
 <v-radio-group v-model="item.color" row>
  <v-radio
  :value="item.color"
  :color="item.color">
</v-radio>
</v-radio-group>
<input type="radio" >
</v-list-tile-content>
</v-list-tile>
</v-list>
<v-divider></v-divider>
</v-card>


</v-menu>
<v-icon @click.stop="right = !right" style="cursor: pointer">apps</v-icon> -->
<!-- <v-toolbar-side-icon></v-toolbar-side-icon> -->
</v-toolbar>
</v-app>
</div>
</template>

<script>
export default {
 props: ['user', 'role', 'logo'],
 data () {
  return{
   color: 'red',
   items: [
   { color: 'red', text: 'Red' },
   { color: 'green', text: 'Green' },
   { color: 'grey', text: 'grey' },
   { color: 'orange', text: 'Orange' },
   { color: 'purple', text: 'purple' },
   { color: 'blue', text: 'blue' },
   { color: 'indigo', text: 'indigo' },
   { color: 'pink', text: 'pink' },
   { color: 'cyan', text: 'cyan' },
   ],
   sheet: false,
   color: 'indigo',
   dialog: false,
   changeColor: 'item.color',
   drawer: true,
   drawerRight: false,
   right: null,
   menu: false,
   mode: '',
   company: {},
}
},
mounted() { 
},
}
</script>
