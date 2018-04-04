<template>

		<v-app id="inspire">

			<!--breadcrumbs start-->
		<breadcrumb1btn
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:btn-new-url="btnNewUrl"
				v-bind:breadcrumb-title="breadcrumbTitle"
		></breadcrumb1btn>

		<!--Data table component-->
		<v-card>
			<v-card-title>
	            {{listTitle}}
	        </v-card-title>
			<v-divider></v-divider>
			<v-form v-model="valid" ref="formFilter" lazy-validation>
			<v-container grid-list-md>
				<v-layout row wrap>
					<v-flex xs12 sm3 md3>
						<v-text-field label="Return ID" v-model="filter.return_id"></v-text-field>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-text-field label="Order ID" v-model="filter.order_id"></v-text-field>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-select label="Customer" :items="customers" v-model="filter.customer_group_id" autocomplete></v-select>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-select label="Product" :items="products" v-model="filter.product" autocomplete></v-select>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-select label="Model" :items="models" v-model="filter.model" autocomplete></v-select>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-select label="Status" :items="status" v-model="filter.status" autocomplete></v-select>
					</v-flex>
					
					<v-flex xs12 sm3 md3>
						<v-menu
				          lazy
				          :close-on-content-click="false"
				          v-model="menu"
				          transition="scale-transition"
				          offset-y
				          full-width
				          :nudge-right="40"
				          max-width="290px"
				          min-width="290px"
				        >
				          <v-text-field
				            slot="activator"
				            label="Date Added"
				            v-model="filter.date_added"
				            prepend-icon="event"
				            readonly
				          ></v-text-field>
				          <v-date-picker v-model="filter.date_added" no-title scrollable actions>
				            <template slot-scope="{ save, cancel }">
				              <v-card-actions>
				                <v-spacer></v-spacer>
				                <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
				                <v-btn flat color="primary" @click="save">OK</v-btn>
				              </v-card-actions>
				            </template>
				          </v-date-picker>
				        </v-menu>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-menu
				          lazy
				          :close-on-content-click="false"
				          v-model="menu2"
				          transition="scale-transition"
				          offset-y
				          full-width
				          :nudge-right="40"
				          max-width="290px"
				          min-width="290px"
				        >
				          <v-text-field
				            slot="activator"
				            label="Date Modified"
				            v-model="filter.date_modified"
				            prepend-icon="event"
				            readonly
				          ></v-text-field>
				          <v-date-picker v-model="filter.date_modified" no-title scrollable actions>
				            <template slot-scope="{ save, cancel }">
				              <v-card-actions>
				                <v-spacer></v-spacer>
				                <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
				                <v-btn flat color="primary" @click="save">OK</v-btn>
				              </v-card-actions>
				            </template>
				          </v-date-picker>
				        </v-menu>
					</v-flex>
					<v-flex xs12 sm12 md12 class="text-lg-right">
						<v-btn @click="filterCustomer" :disabled="!valid">Filter</v-btn>
						<v-btn @click="clear">clear</v-btn>
					</v-flex>
				</v-layout>
			</v-container>
		    </v-form>
			<v-divider></v-divider>
		</v-card>

			<!--Data table component-->

		    <data-table 
		    	v-bind:list-title="listTitle"
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="returns"
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
	import Flash from '../../../../../helper/flash'
	import axios from 'axios'
	import dataTable from '../../commons/tables/dataTableFilter.vue'
	import breadcrumb1btn from '../../commons/breadcrumb/breadcrumb1btn.vue'
	export default{
		props:[
			'id'//this use to pass id of record to data table component
		],
		data(){
			return{
				url:'/api/return/',
				btnNewUrl:'/admin/returns/add',
				listTitle:'return List',
				menu:null,
				menu2:null,
				headers: [
			        { text: 'Return ID',align: 'left',class:'text-xs-left',value: 'return_id'},
			        { text: 'Order ID',align:'left',class:'text-xs-left', value: 'order_id' },
			        { text: 'Customer',align:'left',class:'text-xs-left', value: 'customer' },
			        { text: 'Product',align:'left',class:'text-xs-left', value: 'product' },
			        { text: 'Model',align:'left',class:'text-xs-left', value: 'model' },
			        { text: 'Status',align:'left',class:'text-xs-left', value: 'status' },
			        { text: 'Date Added',align:'left',class:'text-xs-left', value: 'date_added' },
			        { text: 'Date Modified',align:'left',class:'text-xs-left', value: 'date_modified' },
			        {text: 'Action',align:'center',class:'text-xs-center',value:'return_id',sortable: false}
			    ],
			    returns:[
			    	{
			    		return_id:'1',
			    		order_id:'1',
			    		customer:'Test',
			    		product:'Camera Canon 70D',
			    		model:'Canon 70D',
			    		status:'Pending',
			    		date_added:'2018-03-30',
			    		date_modified:'2018-03-30'
			    	}
			    ],
				filter:{},
				customers:[
					'Test'
				],
				products:[
					'Camera canon 70D',
					'Camera canon 5D',
					'Camera canon 6D'
				],
				models:[
					'Canon 70D',
					'Canon 5D',
					'Canon 6D'
				],
				status:[
					{text:'Pending',value:1},
					{text:'Awaiting',value:2}
				],
				breadcrumbTitle:'Product Return List',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Product Return',
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
			//this.fetchData()
			document.title = 'Product Return List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.option=response.data;
				});
			}
		}
	}
</script>