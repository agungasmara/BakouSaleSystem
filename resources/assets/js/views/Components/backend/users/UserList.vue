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
		                <router-link to="/admin/user/add" replace><v-btn color="primary">Create New</v-btn></router-link>
		            </div>
		        </v-spacer>
		        <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
		      </v-card-title>
			    <v-data-table v-bind:headers="headers" :items="users" v-bind:search="search" class="elevation-1" >
					<template slot="items" slot-scope="props">
						<td class="text-xs-center">{{ props.item.user_id }}</td>
						<td class="text-xs-left">{{ props.item.group }}</td>
						<td class="text-xs-left">{{ props.item.username }}</td>
						<td class="text-xs-left">{{ props.item.firstname }}</td>
						<td class="text-xs-left">{{ props.item.lastname }}</td>
						<td class="text-xs-left">{{ props.item.email }}</td>
						<td class="text-xs-left">{{ props.item.code }}</td>
						<td class="text-xs-left"><img :src=props.item.image width="50"></td>
						<td class="text-xs-left">{{ props.item.date_added }}</td>
						<td class="text-xs-center">
							<span style="cursor:pointer;" @click="editUser(props.item.user_id)"">
								<i class="material-icons">edit</i>
							</span>
							<span style="cursor:pointer;color:red;" v-on:click="confirmDel(props.item.user_id,props.item.username)"><i class="material-icons">delete_forever</i></span>
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
		          		{{ deleteMessage }} {{ userID }}?
		          	</v-card-text>
		          <v-card-actions>
		            <v-spacer></v-spacer>
		            <v-btn color="green darken-1" flat @click="deleteItem(userID,0)">Cancle</v-btn>
		            <v-btn color="green darken-1" flat @click="deleteItem(userID,1)">Agree</v-btn>
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
		props:['userID'],
		data(){
			return{
				deleteMessage:'',
				userName:'',
				dialog:false,
				max25chars: (v) => v.length <= 25 || 'Input too long!',
				tmp: '',
				search: '',
				pagination: {},
				headers: [
			        { text: 'User ID',align: 'left',value: 'user_id'},
			        { text: 'Group',align:'center', value: 'group' },
			        { text: 'Username',align:'center', value: 'username' },
			        { text: 'First Name',align:'center', value: 'fisrtame' },
			        { text: 'Last Name',align:'center', value: 'lastName' },
			        { text: 'Email',align:'center', value: 'email' },
			        { text: 'Code',align:'center', value: 'code' },
			        { text: 'Image',align:'center', value: 'image' },
			        { text: 'Date Added',align:'center', value: 'date_added' },
			        { text: 'Action', value: 'action',align:'center',sortable:false }
			    ],
				users:[],
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
			this.fetchUsers()
			document.title = 'User List';
		},
		methods:{
			fetchUsers(){
				axios.get('/api/user/list').then(response=>{
					this.users=response.data;
				});
			},
			confirmDel(id,name){
				this.deleteMessage='Are you sure you want to delete user with ID:'
				this.dialog=true;
				this.userName=name
				this.userID=id
			},
			deleteItem(id,opt){
				if(opt==1){
					this.deleteMessage='Deleting...'
					axios.delete('/api/user/delete/'+id).then((res)=>{
						
						if(res.data.deleted==true){
							this.deleteMessage='Delete Successfully'
							this.dialog=false
							this.fetchUsers()
						}
						
					})
				}else{
					this.dialog=false
				}
			},
			editUser(id){
				//this.components.push(id)
				this.$router.push('/admin/user/edit/'+id)
			}
		}
	}
</script>