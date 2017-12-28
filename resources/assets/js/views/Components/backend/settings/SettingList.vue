<template>
	<div>
		<v-app id="inspire">
			<v-breadcrumbs>
		        <v-icon slot="divider">chevron_right</v-icon>

	        	<v-breadcrumbs-item v-for="item in items" :key="item.text" :disabled="item.disabled">

	          		{{ item.text }}

	        	</v-breadcrumbs-item>
		    </v-breadcrumbs>

			<v-card>
			  
		      <v-card-title>
		        <v-spacer>
		        	<div>
		                <router-link to="/admin/settings/add" replace><v-btn color="primary">Create New</v-btn></router-link>
		            </div>
		        </v-spacer>
		        <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
		      </v-card-title>
			    <v-data-table v-bind:headers="headers" :items="settings" v-bind:search="search" class="elevation-1" >
					<template slot="items" slot-scope="props">
						<td class="text-xs-center">{{ props.item.setting_id }}</td>
						<td class="text-xs-left">{{ props.item.name }}</td>
						<td class="text-xs-left">{{ props.item.code }}</td>
						<td class="text-xs-left">{{ props.item.key }}</td>
						<td class="text-xs-left">{{ props.item.value }}</td>
						<td class="text-xs-left">{{ props.item.serialized }}</td>
						<td class="text-xs-center">
							<span style="cursor:pointer;" @click="editSetting(props.item.setting_id)"">
								<i class="material-icons">edit</i>
							</span>
							<span style="cursor:pointer;color:red;" v-on:click="confirmDel(props.item.setting_id,props.item.name)"><i class="material-icons">delete_forever</i></span>
						</td>
					</template>
					<template slot="pageText" slot-scope="{ pageStart, pageStop }">
			          From {{ pageStart }} to {{ pageStop }}
			        </template>
			    </v-data-table>
		    </v-card>
		    <v-layout row justify-center>
		      <v-dialog v-model="dialog" persistent max-width="290">
		        <v-card>
		          <v-card-title class="headline">Message</v-card-title>
		          	<v-card-text>
		          		{{ deleteMessage }} {{ settingID }}?
		          	</v-card-text>
		          <v-card-actions>
		            <v-spacer></v-spacer>
		            <v-btn color="green darken-1" flat @click="deleteItem(settingID,0)">Cancle</v-btn>
		            <v-btn color="green darken-1" flat @click="deleteItem(settingID,1)">Agree</v-btn>
		          </v-card-actions>
		        </v-card>
		      </v-dialog>
		    </v-layout>
		</v-app>
	</div>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	export default{
		props:['settingid'],
		data(){
			return{
				deleteMessage:'',
				settingName:'',
				settingID:'',
				dialog:false,
				max25chars: (v) => v.length <= 25 || 'Input too long!',
				tmp: '',
				search: '',
				pagination: {},
				headers: [
			        { text: 'Setting ID',align: 'left',value: 'setting_id'},
			        { text: 'Store Name',align:'center', value: 'name' },
			        { text: 'code',align:'center', value: 'code' },
			        { text: 'Key',align:'center', value: 'key' },
			        { text: 'Value',align:'center', value: 'value' },
			        { text: 'Serialized',align:'center', value: 'serialized' },
			        { text: 'Action', value: 'action',align:'center',sortable:false }
			    ],
				settings:[],
				items: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Users',
			          disabled: false
			        },
			        {
			          text: 'List',
			          disabled: true
			        }
			    ]
			}
		},
		created(){
			this.fetchSettings()
			document.title = 'Setting List';
		},
		methods:{
			fetchSettings(){
				axios.get('/api/setting/list').then(response=>{
					this.settings=response.data;
				});
			},
			confirmDel(id,name){
				this.deleteMessage='Are you sure you want to delete setting with ID:'
				this.dialog=true;
				this.settingName=name
				this.settingID=id
			},
			deleteItem(id,opt){
				if(opt==1){
					this.deleteMessage='Deleting...'
					axios.delete('/api/setting/delete/'+id).then((res)=>{
						
						if(res.data.deleted==true){
							this.deleteMessage='Delete Successfully'
							this.dialog=false
							this.fetchSettings()
						}
						
					})
				}else{
					this.dialog=false
				}
			},
			editSetting(id){
				//this.components.push(id)
				this.$router.push('/admin/settings/edit/'+id)
			}
		}
	}
</script>