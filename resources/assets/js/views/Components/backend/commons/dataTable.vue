<template>
<v-card>
			  
  <v-card-title>
    <v-spacer>
    	<div>
            <router-link to="/admin/settings/add" replace><v-btn color="primary">Create New</v-btn></router-link>
        </div>
    </v-spacer>
    <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
  </v-card-title>
	<v-data-table v-bind:headers="dataHeader" :items="dataValue" v-bind:search="search" class="elevation-1" >
		<template slot="items" slot-scope="props">
			<td v-for="(value,index) in props.item">
				{{ value }}
				<div v-if="index=='name' || index=='username'">
					<span style="cursor:pointer;color:blue;" @click="editData(props.item.id)"">
					Edit
				</span>&nbsp;
				<span style="cursor:pointer;color:red;" v-on:click="confirmDel(props.item.id,props.item.name)">Delete</span>
				</div>
				<img v-if="index=='image'" :src="props.item.image" width="50" height="50">
			</td>
		</template>
		<template slot="pageText" slot-scope="{ pageStart, pageStop }">
          From {{ pageStart }} to {{ pageStop }}
        </template>
    </v-data-table>
    <v-layout row justify-center>
      <v-dialog v-model="dialog" persistent max-width="290">
        <v-card>
          <v-card-title class="headline">Message</v-card-title>
          	<v-card-text>
          		{{ deleteMessage }} {{ dataID }}?
          	</v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" flat @click="deleteItem(dataID,0)">Cancle</v-btn>
            <v-btn color="green darken-1" flat @click="deleteItem(dataID,1)">Agree</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-layout>
</v-card>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	export default{
		props:[
			'dataHeader',
			'dataValue',
			'getApi',
			'deleteApi',
			'editUrl'
		],
		data(){
			return{
				refreshTable:[],
				deleteMessage:'',
				dataName:'',
				dataID:'',
				dialog:false,
				max25chars: (v) => v.length <= 25 || 'Input too long!',
				tmp: '',
				search: '',
				pagination: {},
			}
		},
		methods:{
			fetchData(){
				axios.get(this.getApi).then(response=>{
					this.$emit('change', response.data)
				});
			},
			confirmDel(id,name){
				this.deleteMessage='Are you sure you want to delete setting with ID:'
				this.dialog=true;
				this.settingName=name
				this.dataID=id
			},
			deleteItem(id,opt){
				if(opt==1){
					this.deleteMessage='Deleting...'
					axios.delete(this.deleteApi+id).then((res)=>{
						
						if(res.data.deleted==true){
							this.deleteMessage='Delete Successfully'
							this.dialog=false
							this.fetchData()
						}
						
					})
				}else{
					this.dialog=false
				}
			},
			editData(id){
				//this.components.push(id)
				this.$router.push(this.editUrl+id)
			}
		}
	}
</script>