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
		    	v-bind:data-value="currencies"
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
				url:'/api/currencies/',
				btnNewUrl:'/admin/currencies/add',
				listTitle:'Currencies List',
				headers: [
			        { text: 'Currency ID',align: 'left',class:'text-xs-left',value: 'currency_id'},
			        { text: 'Title',align:'left',class:'text-xs-left', value: 'title' },
			        { text: 'code',align:'left',class:'text-xs-left', value: 'code' },
			        { text: 'Symbol Left',align:'left',class:'text-xs-left', value: 'symbol_left' },
			        { text: 'Symbol Right',align:'left',class:'text-xs-left', value: 'symbol_right' },
			        { text: 'Decimal Place',align:'left',class:'text-xs-left', value: 'decimal_place' },
			        { text: 'Value',align:'left',class:'text-xs-left', value: 'value' },
			        { text: 'Status',align:'left',class:'text-xs-left', value: 'status' },
			        { text: 'Date Modified',align:'left',class:'text-xs-left', value: 'date_modified' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'currency_id',sortable: false}
			    ],
				currencies:[],
				breadcrumbTitle:'Currencies List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Currencies',
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
			document.title = 'Currencies List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.currencies=response.data;
				});
			}
		}
	}
</script>