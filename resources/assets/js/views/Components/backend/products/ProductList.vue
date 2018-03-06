<template>

		<v-app id="inspire">

			<!--breadcrumbs start-->
			<breadcrumb1btn 
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:btn-new-url="btnNewUrl"
				v-bind:breadcrumb-title="breadcrumbTitle"
			></breadcrumb1btn>

			<!--Data table component-->

		    <data-table 
		    	v-bind:list-title="listTitle"
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="products"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="true"
		    	v-bind:eye="false">
		    </data-table>

		    <!--End of data table-->

		</v-app>

</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/tables/dataTable.vue'
	import breadcrumb1btn from '../commons/breadcrumb/breadcrumb1btn.vue'
	export default{
		props:[
			'id'//this use to pass id of record to data table component
		],
		data(){
			return{
				url:'/admin/api/products/',
				btnNewUrl:'/admin/products/add',
				breadcrumbTitle:'Products List',
				listTitle:'Products',
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
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Product',
			          disabled: false
			        },
			        {
			          text: 'Lists',
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
				axios.get(this.url).then(response=>{
					this.products=response.data;
				});
			}
		}
	}
</script>

