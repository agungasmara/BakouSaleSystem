<template>
	<div>
		<v-app id="inspire">
			<!--breadcrumbs start-->
			<breadcrumb1btn 
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:btn-new-url="btnNewUrl"
				v-bind:breadcrumb-title="breadcrumbTitle"
			></breadcrumb1btn>

			<v-form v-model="valid" ref="form" lazy-validation>
		    	<v-container grid-list-md>
          			<v-layout wrap>
				    	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Code" v-model="code" :rules="codeRules"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Code" v-model="code" :rules="codeRules"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Code" v-model="code" :rules="codeRules"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Code" v-model="code" :rules="codeRules"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Code" v-model="code" :rules="codeRules"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Code" v-model="code" :rules="codeRules"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Code" v-model="code" :rules="codeRules"></v-text-field>
				      	</v-flex>

				      	<v-flex xs12 sm3 md3>
				      		<v-text-field label="Code" v-model="code" :rules="codeRules"></v-text-field>
				      	</v-flex>

				      	<v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right">Filter</v-btn>
				    </v-layout>
				</v-container>
			</v-form>

			<data-table 
				v-bind:list-title="listTitle"
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="users"
	    		v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-on:data-actions="actions"
		    	v-bind:del="true"
		    	v-bind:eye="true">
		    </data-table>

		</v-app>
	</div>
</template>

<script> 
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../commons/tables/dataTable.vue'
	import breadcrumb1btn from '../commons/breadcrumb/breadcrumb1btn.vue'
	export default{
		props:[
			'id'
		],
		data(){
			return{
				listTitle:'Resellers List',
				url:'/api/carriers/',
				btnNewUrl:'/admin/shipment/add',
				headers: [
			        { text: 'ID',align: 'left',class:'text-xs-left',value: 'id'},
			        { text: 'Username',align:'left',class:'text-xs-left', value: 'username' },
			        { text: 'Group',align:'left',class:'text-xs-left', value: 'group' },
			        { text: 'First Name',align:'left',class:'text-xs-left', value: 'firstname' },
			        { text: 'Last Name',align:'left',class:'text-xs-left', value: 'lastname' },
			        { text: 'Email',align:'left',class:'text-xs-left', value: 'email' },
			        { text: 'Code',align:'left',class:'text-xs-left', value: 'code' },
			        { text: 'Image',align:'left',class:'text-xs-left', value: 'image' },
			        { text: 'Status',align:'left',class:'text-xs-left', value: 'status' },
			        { text: 'Date',align:'left',class:'text-xs-left', value: 'date_added' },
			        { text: 'Action', value: 'id',status:'status',class:'text-xs-center',align:'center',sortable:false }
			    ],
			    actions:[
			    	{
			    		text: 'eye',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye1',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye2',
			    		value: 'hello'
			    	},
			    	{
			    		text: 'eye3',
			    		value: 'hello'
			    	}
			    ],
				users:[],
				breadcrumbTitle:'Users List',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Resellers',
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
			document.title = 'User List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.users=response.data;
				});
			}
		}
	}
</script>