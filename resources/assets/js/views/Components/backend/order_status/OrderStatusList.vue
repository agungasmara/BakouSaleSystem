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
		    	v-bind:data-value="orderStatus"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="false">
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
				url:'/api/order_status/',
				btnNewUrl:'/admin/order_status/add',
				listTitle:'Order Status List',
				headers: [
			        { text: 'Order Status ID',align: 'left',class:'text-xs-left',value: 'order_status_id'},
			        { text: 'Name',align:'left',class:'text-xs-left', value: 'status_name' },
			        { text: 'Language',align:'left',class:'text-xs-left', value: 'language' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'order_status_id',sortable: false}
			    ],
				orderStatus:[],
				breadcrumbTitle:'Order Status List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Order Status',
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
			document.title = 'Order Status List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.orderStatus=response.data;
				});
			}
		}
	}
</script>