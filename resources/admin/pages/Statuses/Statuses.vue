<template>
  <card>
    <div>
     <b-row  :style="{'text-align':isRTL?'right':'left'}">
      <b-col  md="6" class="my-1">
        <div v-if="user.role =='super'">
          <b-button class="btn btn-primary" size="sm" @click="addTouranments()">{{$t('add')}}</b-button>
        </div> 
        <div v-for="(permission,index) in user.permissions" v-bind:key="index">
          <div v-if="permission.name=='Add Stadium'">      
           <b-button class="btn btn-primary" size="sm" @click="addTouranments()">{{$t('add')}}</b-button>
         </div>
       </div>  
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
    :class="isRTL?'text-right':'text-left'"     
    id="stadiums"
    show-empty
    stacked="md"
    head-variant="light"
    
    :sort-direction="sortDirection"
    :sort-by.sync="sortBy"
    :sort-desc.sync="sortDesc"
    :items="stadiums"
    :fields="fields"
    :filter="filter"
    :filterIncludedFields="filterOn"      
    @filtered="onFiltered">

    <template v-slot:cell(actions)="row">
      <div v-if="user.role =='super'">
        <b-button size="sm" class="mr-1 btn btn-success" @click="editStadium(row.item)">{{$t('edit')}}</b-button>
        <b-button size="sm" class="mr-1 btn btn-danger" @click="deleteStadium(row.item)">{{$t('delete')}}</b-button>
      </div>  
      <div v-for="(permission,index) in user.permissions" v-bind:key="index">
        <div v-if="permission.name=='Edit Stadium'">
          <b-button size="sm" class="mr-1 btn btn-success" @click="editStadium(row.item)">{{$t('edit')}}</b-button>
        </div>
         <div v-if="permission.name=='Remove Stadium'">    
         <b-button size="sm" class="mr-1 btn btn-danger" @click="deleteStadium(row.item)">{{$t('delete')}}</b-button>
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
    aria-controls="stadiums"
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
    name:'Touranments',
    mounted(){
     
      this.getStadium();
    },
    methods:{
      getStadium(){
        axios.get(apiUrls.stadiums(),{params:{'page':this.currentPage}}).then((response)=>{
          this.stadiums=response.data.data;
          this.perPage=response.data.per_page;
          this.total=response.data.total;
        });
      },
      onFiltered(filteredItems) {
          // Trigger pagination to update the number of buttons/pages due to filtering
          this.totalRows = filteredItems.length ;
          this.currentPage = 1 ;
        },
      editStadium(row){
         localStorage.setItem('stadia',JSON.stringify(row));
         this.$router.push({name:'edit-stadium',params:{row}});
       },

      deleteStadium(row){
         swal({
          title: this.$t('Are_you_sure'),
          text:this.$t('once_record_deleted_cannot_restord'),
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
         .then((willDelete) => {
          if (willDelete) {
            axios.delete(apiUrls.deleteStadium(row.id),{params:{'stadium_id':row.id}})
            .then((response)=>{
              const index=this.stadiums.indexOf(row)
                this.stadiums.splice(index,1);
                swal(this.$t('record_deleted'), {icon: "success",});
            
            }).catch(error=>{
              $.each(error.response.data.error, function(key, value) {
               toastr.error(value);
             });         
            });  
            }
            else {
              swal(this.$t("Your_imaginary_record_is_safe!"));
            }
          });
       },



       addTouranments(){
        this.$router.push({name:'add-stadium'});
      }
      
    },
    data(){
      return{
       sortDirection:'asc',
       sortBy: null,
       sortDesc: false, 
       stadiums:[],
       currentPage:1,
       perPage:null,
       total:null,
       fields:[
       {
        key:'en_name',
        label:this.$t('name'),
        sortable:true
      },
      {
        label:this.$t('actions'),
        key:'actions',
        sortable:false
      }
      ],
      totalRows: 1,
      filterOn:null,
      filter: null,
    }

  },
  watch:{
   currentPage(){
     this.getStadium();      
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
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control
{
  color:antiquewhite !important
}
</style>