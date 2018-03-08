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
		    	v-bind:data-value="data"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="true">
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
			'id'
		],
		data(){
			return{
				listTitle:'Order List',
				url:'/admin/api/sale_order/',
				btnNewUrl:'/admin/sale_order/add',
				headers: [
			        { text: 'ID',align: 'left',class:'text-xs-left',value: 'order_id'},
			        { text: 'First Name',align:'left',class:'text-xs-left', value: 'firstname' },
			        { text: 'Last Name',align:'left',class:'text-xs-left', value: 'lastname' },
			        { text: 'Status',align:'left',class:'text-xs-left', value: 'status' },
			        { text: 'Total',align:'left',class:'text-xs-left', value: 'total' },
			        { text: 'Date Add',align:'left',class:'text-xs-left', value: 'date_added' },
			        { text: 'Date Modified',align:'left',class:'text-xs-left', value: 'date_added' },
			        { text: 'Action', value: 'order_id',status:'status',class:'text-xs-center',align:'center',sortable:false }
			    ],
			    actions:[
			    	{
			    		text: 'eye',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye1',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye2',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye3',
			    		value: 'hello'
			    	}
			    ],
				data:[],
				breadcrumbTitle:'Users List',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Sale Orders',
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
			document.title = 'User List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.data=response.data;
				});
			}
		}
	}
</script>