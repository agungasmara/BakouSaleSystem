<template>

		<v-app id="inspire">

			<!--breadcrumbs start-->
			<breadcrumb v-bind:breadcrumb-item="items"></breadcrumb>

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
	import breadcrumb from '../commons/breadcrumb/breadcrumb.vue'
	export default{
		props:[
			'id'//this use to pass id of record to data table component
		],
		data(){
			return{
				getApiUrl:'/api/setting/list/',
				deleteApiUrl:'/api/setting/delete/',
				urlEdit:'/admin/settings/edit/',
				btnNewUrl:'/admin/settings/add',
				headers: [
			        { text: 'Setting ID',align: 'center',value: 'id'},
			        { text: 'Store Name',align:'center', value: 'name' },
			        { text: 'code',align:'center', value: 'code' },
			        { text: 'Key',align:'center', value: 'key' },
			        { text: 'Value',align:'center', value: 'value' },
			        { text: 'Serialized',align:'center', value: 'serialized' }
			    ],
				settings:[],
				items: [
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
		components:{'dataTable':dataTable,'breadcrumb':breadcrumb},
		created(){
			this.fetchData()
			document.title = 'Setting List';
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