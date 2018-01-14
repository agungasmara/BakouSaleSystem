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
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="settings"
		    	v-bind:get-api="getApiUrl"
		    	v-bind:delete-api="deleteApiUrl"
	    		v-bind:edit-url="urlEdit"
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
				getApiUrl:'/api/languages/list/',
				deleteApiUrl:'/api/languages/delete/',
				urlEdit:'/admin/languages/edit/',
				btnNewUrl:'/admin/languages/add',
				headers: [
			        { text: 'Language ID',align: 'center',value: 'id'},
			        { text: 'Name',align:'center', value: 'name' },
			        { text: 'Code',align:'center', value: 'code' },
			        { text: 'Local',align:'center', value: 'locale' },
			        { text: 'Image',align:'center', value: 'image' },
			        { text: 'Directory',align:'center', value: 'directory' },
			        { text: 'Status',align:'center', value: 'status' },
			        {text: 'Action',align:'center',sortable: false}
			    ],
				settings:[],
				breadcrumbTitle:'Languages List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Languages',
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
			document.title = 'Language List';
		},
		methods:{
			fetchData(){
				axios.get(this.getApiUrl).then(response=>{
					this.settings=response.data;
				});
			}
		}
	}
</script>