<template>
  <card>
  <div>
    

 <b-row :style="{'text-align':isRTL?'right':'left'}">
      <b-col  md="6" class="my-1"> 
      </b-col>
      <b-col  md="4" class="my-1">
        <base-input
        v-model="filter"
        type="search"
        id="filterInput"
        placeholder="Type to Search"
        >
      </base-input>
    </b-col>
    <b-col  md="2" class="my-1">
      <b-button class="btn btn-warning" size="sm" :disabled="!filter" @click="filter = ''">{{$t('clear')}}</b-button>

    </b-col>
  </b-row>    

    <b-row>
      <b-col md="12" class="my-1"> 
        <b-table    
        id="users"
        show-empty
        stacked="md"
        :sort-direction="sortDirection"
        :sort-by.sync="sortBy"
        :sort-desc.sync="sortDesc"
         head-variant="light"
        :items="users"
        :fields="fields"
      :filter="filter"
      :filterIncludedFields="filterOn"      
      @filtered="onFiltered">

       <template  v-slot:cell(photo)="data">
          <div  class="img-row">
            <b-img :src="data.item.photo ? data.item.photo.path : 'default/default.png'" alt="User image" />
          </div>
        </template>

        <template v-slot:cell(actions)="row">
          <div v-if="user.role =='super'">
             <div v-if="row.item.blocked==0">
              <b-button size="sm"   class="mr-1 btn btn-danger" @click="blockUser(row,1)">{{$t('block')}}</b-button>
             </div>
             <div v-else>
               <b-button size="sm"  class="mr-1 btn btn-success" @click="blockUser(row,0)">{{$t('unblock')}}</b-button>
             </div>
          </div> 
          <div v-for="(permission,index) in user.permissions" v-bind:key="index">
            <div v-if="permission.name=='Block User'">
              <div v-if="row.item.blocked==0"> 
                <b-button size="sm"  class="mr-1 btn btn-danger" @click="blockUser(row,1)">{{$t('block')}}</b-button>
              </div>
              <div v-else>
                <b-button size="sm"  class="mr-1 btn btn-success" @click="blockUser(row,0)">{{$t('unblock')}}</b-button>
              </div>
            </div>
          </div>

        </template>

      </b-table>
    </b-col>
  </b-row>
  <b-row>
  <b-col  md="6" class="my-1">

    <b-pagination
    v-model="currentPage"
    :total-rows="total"
    :per-page="perPage"
    aria-controls="users"
    >
  </b-pagination>
</b-col>
</b-row>
</div>
  </card>
</template>
<script>
  import apiUrls from '../../helpers/apiUrls';

  export default{
    name:'Users',
    mounted(){

      this.getUsers();
    },
    methods:{
      getUsers(){
        
        axios.get(apiUrls.users(),{params:{'page':this.currentPage,'query':this.filter}}).then((response)=>{
          this.users=response.data.users.data;
          this.perPage=response.data.users.per_page;
          this.total=response.data.users.total;

        });
      },
       onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      },

      editUser(row){
       localStorage.setItem('users',JSON.stringify(row));
       this.$router.push({name:'edit-users',params:{row}});
     },

     blockUser(row, block){
      if(block==1){
        swal({
          title: this.$t('Are_you_sure'),
          text:this.$t('you_want_to_block_this_user'),
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
       .then((willBlocked) => {
        if (willBlocked) {
          axios.put(apiUrls.blockUser(row.id),{
            'user_id':row.item.id,
            'blocked':block
          })
          .then((response)=>{
           swal(this.$t('user_blocked'), {icon: "success",}).then(()=>{
             window.location.href="/users";
           });
         });
        }
        else {
         swal(this.$t("cancelled"));
        }
       });
      }
      else{
        swal({
          title: this.$t('Are_you_sure'),
          text:this.$t('you_want_to_unblock_this_user'),
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
       .then((willBlocked) => {
        if (willBlocked) {
          axios.put(apiUrls.blockUser(row.id),{
            'user_id':row.item.id,
            'blocked':block
          })
          .then((response)=>{
           swal(this.$t('user_unblocked'), {icon: "success",}).then(()=>{
             window.location.href="/users";
           });
         });
        }
        else {
         swal(this.$t("cancelled"));
        }
       });
      }

     },


   },
   data(){
    return{
     hide:false, 
     sortDirection:'asc',
     sortBy: null,
     sortDesc: false, 
     users:[],
     currentPage:1,
     perPage:null,
     total:null,
       totalRows: 1,
        currentPage: 1,
        filterOn:null,
        filter: null, 
     fields:[
     {
            label:"#",
            key:'id',
            sortable:true
      },
      {
            label:this.$t('image'),
            key:'photo',
            sortable:true
      },
     {
      key:'name',
      sortable:true
    },
    {
      key:'email',
      sortable:true
    },
    
    {
      key:'actions',
      sortable:false
    }
    ]
  }

},
watch:{
 currentPage(){
   this.getUsers();      
 },
  filter(){
             this.getUsers(); 
          }
},
computed:{
 user(){
   return this.$store.getters.user;
 },
 sortOptions() {
        // Create an options list from our fields
        return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key }
        })
      },
      isRTL() {
        return this.$rtl.isRTL;
      },
}
}


</script>
<style>
