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
		    	v-bind:data-value="categoryTypes"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="false"
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
				url:'/admin/api/category_type/',
				btnNewUrl:'/admin/category_type/add',
				listTitle:'Category Type List',
				headers: [
			        { text: 'CategoryType ID',align: 'left',class:'text-xs-left',value: 'category_type_id'},
			        { text: 'CategoryType Name',align:'left',class:'text-xs-left', value: 'name' },
			        { text: 'Language',align:'left',class:'text-xs-left', value: 'language' },
			        { text: 'Description',align:'left',class:'text-xs-left', value: 'description' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'category_type_id',status:'status',sortable: false}
			    ],
				categoryTypes:[],
				breadcrumbTitle:'CategoryType List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'CategoryType',
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
			document.title = 'CategoryType List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.categoryTypes=response.data;
				});
			}
		}
	}
</script>