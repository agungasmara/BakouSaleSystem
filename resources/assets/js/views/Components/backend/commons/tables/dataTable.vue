<template>
	<v-card>

	<v-card-title>
        {{listTitle}}
        <v-spacer></v-spacer>
        <v-text-field
          append-icon="search"
          label="Search"
          single-line
          hide-details
          v-model="search"
        ></v-text-field>
      </v-card-title>
	<v-data-table v-bind:headers="dataHeader" :items="dataValue" v-bind:search="search" class="elevation-1" :rows-per-page-items="[25,50,100, { text: 'All', value: -1 }]" :loading="tbloading" sort-desc="true">
		<template slot="items" slot-scope="props">

			<td v-for="index in dataHeader" :class="index.class">


				<img v-if="index.value=='image'" :src="props.item.image ? props.item.image:'/images/icon/no-image.png'" style="width: auto;max-width: 30px;height: auto;max-height: 30px;">
				<div v-else-if="index.text=='Action'">

					<span v-if="eye" style="cursor:pointer;" :style="props.item[index.status]>0 ? 'color:green;':'color:red;'"  @click="changeStatus(props.item[index.value],props.item[index.status],index.status)">
						<v-progress-circular v-if="isProgessing && props.item[index.value]==curID" indeterminate :width="2" color="green"></v-progress-circular>
						<i class="material-icons" v-else>remove_red_eye</i>
					</span>
					<span style="cursor:pointer;color:blue;" @click="editData(props.item[index.value],props.item.language_id)"">
						<i class="material-icons">edit</i>
					</span>
					&nbsp;
					<span v-if="del" style="cursor:pointer;color:red;" v-on:click="confirmDel(props.item[index.value],props.item.name)">
						<i class="material-icons">delete_forever</i>
					</span>
				</div>
				<span v-else v-html="props.item[index.value]"></span>

			</td>
			
		</template>
		<template slot="pageText" slot-scope="{ pageStart, pageStop }">
			From {{ pageStart }} to {{ pageStop }}
		</template>
	</v-data-table>
		<v-layout -row -justify-center>
			<v-dialog v-model="dialog" persistent max-width="500px">
				<v-card>
					<v-card-title class="headline">
						<v-icon medium color="primary" dark>
							info
						</v-icon> Message
					</v-card-title>
				<v-card-text>
					{{ deleteMessage }}
				</v-card-text>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="red" dark @click="dialog=false">
						Cancle
						<v-icon dark right>
							block
						</v-icon>
					</v-btn>
					<v-btn color="primary" dark @click="deleteItem(dataID)">
						Agree
						<v-icon dark right>
							check_circle
						</v-icon>
					</v-btn>
				</v-card-actions>
				</v-card>
			</v-dialog>
		</v-layout>
	</v-card>
</template>

<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	export default{
		props:[
			'listTitle',
			'dataHeader',//data table header(column name)
			'dataValue',//fetch record and pass to data table component
			'url',//resource url laravel
			'btnNewUrl',
			'del',
			'eye'
		],
		data(){
			return{
				curID:0,
				isProgessing:false,
				tile:true,
				tbloading:true,
				refreshTable:[],
				Message:'Are you sure you want to delete item with ID=',
				deleteMessage:'',
				dataName:'',
				dataID:'',
				dialog:false,
				max25chars: (v) => v.length <= 25 || 'Input too long!',
				tmp: '',
				search: '',
				pagination: {},
				data:{},
				status:null,
				dataStatus:{}
			}
		},
		mounted(){
			this.tbloading=false
		},
		watch:{
			status:function(status){

				alert(status)
				this.status=status
			}
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{

					//refresh data table when data have changed
					this.$emit('change', response.data)//'change' is the event pass from parent component

					//this.dataValue=response.data

					//this.$emit('change',newData) this use to tell the parent component when chile component have changed

					//vue props not allow to update child props without tell parent

				});
			},
			confirmDel(id,name){
				this.deleteMessage=this.Message+id
				this.dataID=id
				this.dialog=true
			},
			deleteItem(id){
				this.deleteMessage="Deleting..."
				axios.delete(this.url+id).then((res)=>{
					console.log(res.data.deleted);
					if(res.data.deleted==true){
						// alert(1);
						this.fetchData()
					}
					this.dialog=false
					this.deleteMessage='Item have successfully deleted.'
				})
				
			},
			editData(id,lid){
				if(lid>0){
					this.$router.push('edit/'+id+'/'+lid)	
				}else{
					this.$router.push('edit/'+id)	
				}
				
			},
			changeStatus(id,value,field){
				this.curID=id
				
				this.isProgessing=true
				console.log(this.isProgessing)
				if(value==1){
					value=0
				}else if(value==0){
					value=1
				}
				this.dataStatus[field]=value
				axios.put(this.url+id, 
		          this.dataStatus
		        ).then((res)=>{
		        	this.isProgessing=true
		        	if(res.data.success==true){
		        		Flash.setSuccess(res.data.message)
		        		this.fetchData()
		        		this.isProgessing=false
		        	}else{
		        		Flash.setError(res.data.message)
		        	}

              		this.isProgessing=false
		        })
		        .catch((err) => {
                  	if(err.response.status === 422) {
                      	this.error = err.response.message
					}
					Flash.setError('Error while updateing data')
              	})
              	this.isProgessing=false
			}
		}
	}
</script>