<template>
  <h1> Generate Pin codes </h1>
    <div class="row text-center p-3">
         <div class="form-group">
          <div class="col-sm-12">
            <input type="text" class="form-control"
                   placeholder="Enter Number of Pin codes"  v-model="num_pin_code" />
          </div>
           <div class="col-sm-12">
            <br/>
           </div>
          <div class="col-sm-12">
            <input type="button" class="btn btn-primary" value="Generate"  @click="getData"/>
          </div>
       </div>
    </div>
<div>
</div>
  <div class="row" >
    <div class="col-sm-12">
      <div class="form-group ">
        <table class="table table-striped">
          <tr v-for="(row,index) in rows">
            <td>{{index+1}}</td>
            <td>{{row}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
//import "bootstrap";
export default {
  data(){
    return {num_pin_code:1 , data_loaded:false , rows:[] , counter:0}
  },
  methods:{
      getData(){
        return axios({
          method:'get',
          url:'http://127.0.0.1:8000/gen_pin?num_pin_code='+this.num_pin_code,
          data:this.num_pin_code
        })
            .then(response => {
               this.rows=response.data.data;
               this.data_loaded=true;
            }).catch(error => {
              alert("Please set the backend  url in App.vue file");
              return error.response;
            })  .finally(() => this.loading = false);

      }
  }
}

</script>