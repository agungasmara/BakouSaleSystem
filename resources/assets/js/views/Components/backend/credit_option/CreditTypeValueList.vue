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
		    	v-bind:data-value="creditTypeValue"
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
				url:'/api/credit_type_value/',
				btnNewUrl:'/admin/credit_type_value/add',
				listTitle:'Credit Type List',
				headers: [
			        { text: 'Credit Type ID',align: 'left',class:'text-xs-left',value: 'credit_type_value_id'},
			        { text: 'Name',align:'left',class:'text-xs-left', value: 'name' },
			        { text: 'Type',align:'left',class:'text-xs-left', value: 'type' },
			        { text: 'Value',align:'left',class:'text-xs-left', value: 'value' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'credit_type_value_id',sortable: false}
			    ],
				creditTypeValue:[],
				breadcrumbTitle:'Credit Type Value List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Credit Type Value',
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
			document.title = 'Credit Type Value List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.creditTypeValue=response.data;
				});
			}
		}
	}
</script>