<template>
	<div>
		<v-app id="inspire">
			<v-breadcrumbs>
		        <v-icon slot="divider">chevron_right</v-icon>

	        	<v-breadcrumbs-item v-for="item in items" :key="item.text" :disabled="item.disabled">

	          		{{ item.text }}

	        	</v-breadcrumbs-item>
		    </v-breadcrumbs>

			    <data-table 
			    	v-bind:data-header="headers" 
			    	v-bind:data-value="settings"
			    	v-bind:get-api="getApiUrl"
			    	v-bind:delete-api="deleteApiUrl"
		    		v-bind:edit-url="urlEdit"
			    	v-on:change="fetchData">
			    </data-table>

		</v-app>
	</div>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/dataTable.vue'
	export default{
		props:[
			'id',
			'dataHeader',
			'dataValue',
			'getApi',
			'deleteApi',
			'editUrl'
		],
		data(){
			return{
				getApiUrl:'/api/setting/list/',
				deleteApiUrl:'/api/setting/delete/',
				urlEdit:'/admin/settings/edit/',
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
			          text: 'Users',
			          disabled: false
			        },
			        {
			          text: 'List',
			          disabled: true
			        }
			    ]
			}
		},
		components:{'dataTable':dataTable},
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