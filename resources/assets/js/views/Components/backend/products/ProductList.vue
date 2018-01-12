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
			      	<router-link to="/admin/products/add" replace><v-btn class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="primary">Create New</v-btn></router-link>
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

				<data-table 
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="settings"
		    	v-bind:get-api="getApiUrl"
		    	v-bind:delete-api="deleteApiUrl"
	    		v-bind:edit-url="urlEdit"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData">
		    </data-table>

			</v-app>
		</div>
	</section>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/tables/dataTable.vue'
	export default{
		props:['settingid'],
		data(){
			return{
				getApiUrl:'/api/user/list/',
				deleteApiUrl:'/api/user/delete/',
				urlEdit:'/admin/user/edit/',
				btnNewUrl:'/admin/user/add',
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
		components:{'dataTable':dataTable},
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