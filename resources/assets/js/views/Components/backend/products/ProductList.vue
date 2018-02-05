<template>
	<section id="content">
		<!--breadcrumbs start-->
		<breadcrumb1btn 
			v-bind:breadcrumb-item="breadcrumbs"
			v-bind:btn-new-url="btnNewUrl"
			v-bind:breadcrumb-title="breadcrumbTitle"
		></breadcrumb1btn>

		<!--Data table component-->

		<div>
			<v-app id="inspire">
				<!-- <v-breadcrumbs>
			        <v-icon slot="divider">chevron_right</v-icon>

		        	<v-breadcrumbs-item v-for="item in items" :key="item.text" :disabled="item.disabled">

		          		{{ item.text }}

		        	</v-breadcrumbs-item>
			    </v-breadcrumbs> -->

				<data-table 
		    	v-bind:list-title="listTitle"
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="products"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="true">
		    </data-table>
		    	<!-- v-bind:get-api="getApiUrl"
		    	v-bind:delete-api="deleteApiUrl"
	    		v-bind:edit-url="urlEdit"
	    		v-bind:btn-new-url="btnNewUrl" -->

			</v-app>
		</div>
	</section>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/tables/dataTable.vue'
	import breadcrumb1btn from '../commons/breadcrumb/breadcrumb1btn.vue'
	export default{
		props:['id'],
		data(){
			return{
				// getApiUrl:'/api/user/list/',
				// deleteApiUrl:'/api/user/delete/',
				// urlEdit:'/admin/user/edit/',
				// btnNewUrl:'/admin/user/add',
				url:'/admin/api/products/',
				deleteMessage:'',
				productsName:'',
				productsID:'',
				dialog:false,
				max25chars: (v) => v.length <= 25 || 'Input too long!',
				tmp: '',
				search: '',
				pagination: {},
				headers: [
					{ text: 'Product ID',align: 'left' ,value: 'product_id'},
					{ text: 'Image',align: 'left',value: 'image'},
			        { text: 'Name',align: 'left',value: 'name'},
			        { text: 'Model',align:'left', value: 'model' },
			        { text: 'Price',align:'left', value: 'price' },
			        { text: 'Quantity',align:'left', value: 'quantity' },
			        { text: 'Sort Order',align:'left', value: 'sort_order' },
			        { text: 'Status',align:'left', value: 'status' },
			        { text: 'Action', value: 'product_id',align:'center',sortable:false }

			    ],
				products:[],
			    btnNewUrl:'/admin/products/add',
				breadcrumbTitle:'Products List',
				listTitle:'Products',
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
		components:{'dataTable':dataTable,'breadcrumb1btn':breadcrumb1btn},
		created(){
			this.fetchData()
			document.title = 'Products List';
		},
		methods:{
			fetchData(){
				axios.get('/admin/api/products').then(response=>{
					this.products=response.data;
				});
			},
			confirmDel(id,name){
				this.deleteMessage='Are you sure you want to delete product with ID:'
				this.dialog=true;
				this.productsName=name
				this.productsID=id
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