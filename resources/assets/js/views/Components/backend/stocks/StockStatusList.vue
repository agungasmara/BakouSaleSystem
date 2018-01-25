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
		    	v-bind:data-value="stockStatus"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData">
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
				url:'/api/stock_status/',
				btnNewUrl:'/admin/stock_status/add',
				listTitle:'Stock Status List',
				headers: [
			        { text: 'Stock Status ID',align: 'left',class:'text-xs-left',value: 'stock_status_id'},
			        { text: 'Name',align:'left',class:'text-xs-left', value: 'status_name' },
			        { text: 'Language',align:'left',class:'text-xs-left', value: 'language' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'stock_status_id',sortable: false}
			    ],
				stockStatus:[],
				breadcrumbTitle:'Stock Status List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Stock Status',
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
			document.title = 'Stock Status List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.stockStatus=response.data;
				});
			}
		}
	}
</script>