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
		    	v-bind:data-value="taxRateToCustomerGroup"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="false">
		    </data-table>

		    <!--End of data table-->

		</v-app>

</template>

<script>
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../../commons/tables/dataTable.vue'
	import breadcrumb1btn from '../../commons/breadcrumb/breadcrumb1btn.vue'
	export default{
		props:[
			'id'//this use to pass id of record to data table component
		],
		data(){
			return{
				url:'/admin/api/tax_rate_to_customer_group/',
				btnNewUrl:'/admin/tax_rate_customer_group/add',
				listTitle:'Tax Rate To Customer Group List',
				headers: [
			        { text: 'Tax Rate ID',align: 'left',class:'text-xs-left',value: 'tax_rate_id'},
			        { text: 'Customer Group',align:'left',class:'text-xs-left', value: 'customer_group' },
			        { text: 'Tax Rate',align:'left',class:'text-xs-left', value: 'tax_rate' },
			        { text: 'Language',align:'left',class:'text-xs-left', value: 'language' },
			        { text: 'Description',align:'left',class:'text-xs-left', value: 'description' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'tax_rate_id',sortable: false}
			    ],
				taxRateToCustomerGroup:[],
				breadcrumbTitle:'Tax Rate To Customer Group List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Tax Rate To Customer Group',
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
			document.title = 'Tax Rate To Customer Group List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.taxRateToCustomerGroup=response.data;
				});
			}
		}
	}
</script>