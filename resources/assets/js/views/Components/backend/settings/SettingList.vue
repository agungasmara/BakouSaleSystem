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
		    	v-bind:data-value="settings"
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
				url:'/api/settings/',
				deleteApiUrl:'/api/settings/delete/',
				urlEdit:'/admin/settings/edit/',
				btnNewUrl:'/admin/settings/add',
				listTitle:'Setting List',
				headers: [
			        { text: 'Setting ID',align: 'center',class:'text-xs-center',value: 'id'},
			        { text: 'Store Name',align:'center',class:'text-xs-left', value: 'name' },
			        { text: 'code',align:'center',class:'text-xs-left', value: 'code' },
			        { text: 'Key',align:'center',class:'text-xs-left', value: 'key' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'id',sortable: false}
			    ],
				settings:[],
				breadcrumbTitle:'Settings List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Settings',
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
			document.title = 'Setting List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.settings=response.data;
				});
			}
		}
	}
</script>