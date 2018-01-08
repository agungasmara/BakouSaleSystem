<template>
	<section id="content">
		<!--breadcrumbs start-->
		<div id="breadcrumbs-wrapper">
			<!-- Search for small screen -->
			<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
			  <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
			</div>
			<div class="container">
			  <div class="row">
			    <div class="col s10 m6 l6">
			      <h5 class="breadcrumbs-title">Product</h5>
			      <!-- <ol class="breadcrumbs">
			        <li><a href="index.html">Dashboard</a>
			        </li>
			        <li><a href="#">List</a>
			        </li>
			        <li class="active">Attributes</li>
			      </ol> -->
			      	<v-breadcrumbs>
			        	<v-icon slot="divider">/</v-icon>
		        		<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
		          			{{ item.text }}
		        		</v-breadcrumbs-item>
		      		</v-breadcrumbs>
			    </div>
			    <div class="col s2 m6 l6">
			      	<router-link to="/admin/attributes/add" replace><v-btn class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="primary">Create New</v-btn></router-link>
			    </div>
			  </div>
			</div>
		</div>
		<!--breadcrumbs end-->

		<div>
			<v-app id="inspire">
				<!-- <v-breadcrumbs>
			        <v-icon slot="divider">chevron_right</v-icon>

		        	<v-breadcrumbs-item v-for="item in items" :key="item.text" :disabled="item.disabled">

		          		{{ item.text }}

		        	</v-breadcrumbs-item>
			    </v-breadcrumbs> -->

				<v-card>
				  
			      <v-card-title>
			        <v-spacer>
			        	<div>
			                Product List
			            </div>
			        </v-spacer>
			        <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
			      </v-card-title>
				    <v-data-table v-bind:headers="headers" :items="settings" v-bind:search="search" class="elevation-1" >
						<template slot="items" slot-scope="props">
							<td class="text-xs-center">{{ props.item.product_id }}</td>
							<td class="text-xs-left">{{ props.item.name }}</td>
							<td class="text-xs-left">{{ props.item.price }}</td>
							<td class="text-xs-left">{{ props.item.quantity }}</td>
							<td class="text-xs-left">{{ props.item.sort_order }}</td>
							<td class="text-xs-left">{{ props.item.status }}</td>
							<td class="text-xs-center">
								<span style="cursor:pointer;" @click="editSetting(props.item.setting_id)"">
									<i class="material-icons">edit</i>
								</span>
								<span style="cursor:pointer;" v-on:click="confirmDel(props.item.product_id,props.item.name)"><i class="material-icons">delete_forever</i></span>
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
	</section>
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
			        { text: 'Name',align: 'left',value: 'product_id'},
			        { text: 'Model',align:'center', value: 'name' },
			        { text: 'Price',align:'center', value: 'price' },
			        { text: 'Quantity',align:'center', value: 'quantity' },
			        { text: 'Sort Order',align:'center', value: 'sort_order' },
			        { text: 'Status',align:'center', value: 'status' },
			        { text: 'Action', value: 'action',align:'center',sortable:false }

			    ],
				settings:[],
				breadcrumbs: [
			        {
			          text: 'Dashboard',
			          disabled: false
			        },
			        {
			          text: 'Product',
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
			this.fetchData()
			document.title = 'Attributes';
		},
		methods:{
			fetchData(){
				axios.get('/admin/api/product/list').then(response=>{
					this.settings=response.data;
				});
			},
			confirmDel(id,name){
				this.deleteMessage='Are you sure you want to delete product with ID:'
				this.dialog=true;
				this.settingName=name
				this.settingID=id
			},
			deleteItem(id,opt){
				if(opt==1){
					this.deleteMessage='Deleting...'
					axios.delete('/admin/api/product/delete/'+id).then((res)=>{
						
						if(res.success){
							this.deleteMessage=res.message
							this.dialog=false
							this.fetchData()
						}
						
					})
				}else{
					this.dialog=false
				}
			},
			editSetting(id){
				//this.components.push(id)
				this.$router.push('/admin/product/edit/'+id)
			}
		}
	}
</script>