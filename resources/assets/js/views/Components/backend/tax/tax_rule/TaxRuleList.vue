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
		    	v-bind:data-value="taxRule"
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
				url:'/api/tax_rule/',
				btnNewUrl:'/admin/tax_rule/add',
				listTitle:'Tax Rule List',
				headers: [
			        { text: 'Tax Rule ID',align: 'left',class:'text-xs-left',value: 'tax_rule_id'},
			        { text: 'Tax Class',align:'left',class:'text-xs-left', value: 'tax_class' },
			        { text: 'Tax Rate',align:'left',class:'text-xs-left', value: 'tax_rate' },
			        { text: 'Based',align:'left',class:'text-xs-left', value: 'based' },
			        { text: 'Priority',align:'left',class:'text-xs-left', value: 'priority' },	
			        {text: 'Action',align:'center',class:'text-xs-center',value:'tax_rule_id',sortable: false}
			    ],
				taxRule:[],
				breadcrumbTitle:'Tax Rule List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Tax Rule',
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
			document.title = 'Tax Rule List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.taxRule=response.data;
				});
			}
		}
	}
</script>