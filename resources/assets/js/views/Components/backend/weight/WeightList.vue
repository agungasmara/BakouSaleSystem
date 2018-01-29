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
		    	v-bind:data-value="weights"
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
				url:'/api/weights/',
				btnNewUrl:'/admin/weights/add',
				listTitle:'Weights List',
				headers: [
			        { text: 'Weight ID',align: 'left',class:'text-xs-left',value: 'weight_class_id'},
			        { text: 'Value',align:'left',class:'text-xs-left', value: 'value' },
			        { text: 'Description',align:'left',class:'text-xs-left', value: 'title' },
			        { text: 'Language',align:'left',class:'text-xs-left', value: 'language' },
			        { text: 'Unit',align:'left',class:'text-xs-left', value: 'unit' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'weight_class_id',sortable: false}
			    ],
				weights:[],
				breadcrumbTitle:'Weights List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Weights',
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
			document.title = 'Weights List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.weights=response.data;
				});
			}
		}
	}
</script>