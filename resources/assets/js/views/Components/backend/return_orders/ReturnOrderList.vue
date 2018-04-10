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
						<v-flex xs12 sm4 md4>
							<v-text-field label="Return ID" v-model="filter.order_id"></v-text-field>
						</v-flex>
						<v-flex xs12 sm4 md4>
							<v-text-field label="Order ID" v-model="filter.order_id"></v-text-field>
						</v-flex>
						<v-flex xs12 sm4 md4>
							<v-text-field label="Customer" v-model="filter.customer"></v-text-field>
						</v-flex>
						<v-flex xs12 sm4 md4>
							<v-text-field label="Product" v-model="filter.total"></v-text-field>
						</v-flex>
						<v-flex xs12 sm4 md4>
							<v-select label="Status" :items="status" v-model="filter.status"></v-select>
						</v-flex>
						<v-flex xs12 sm4 md4>
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
						<v-flex xs12 sm4 md4>
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
							<v-btn @click="filterOrder" :disabled="!valid">Filter</v-btn>
							<v-btn @click="clear">clear</v-btn>
						</v-flex>
					</v-layout>
				</v-container>
			    </v-form>
				<v-divider></v-divider>
			</v-card>
		    <data-table 
		    	v-bind:list-title="listTitle"
		    	v-bind:data-header="headers" 
		    	v-bind:data-value="data"
		    	v-bind:url="url"
	    		v-bind:btn-new-url="btnNewUrl"
		    	v-on:change="fetchData"
		    	v-bind:del="true"
		    	v-bind:eye="'view'">
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
			'id'
		],
		data(){
			return{
				listTitle:'Return Order',
				url:'/admin/api/return_order/',
				btnNewUrl:'/admin/return_order/add',
				menu:null,
				menu2:null,
				valid:true,
				headers: [
			        { text: 'ID',align: 'left',class:'text-xs-left',value: 'order_id'},
			        { text: 'Order ID',align:'left',class:'text-xs-left', value: 'firstname' },
			        { text: 'Customer',align:'left',class:'text-xs-left', value: 'lastname' },
			        { text: 'Product',align:'left',class:'text-xs-left', value: 'status' },
			        { text: 'Model',align:'left',class:'text-xs-left', value: 'total' },
			        { text: 'Status',align:'left',class:'text-xs-left', value: 'date_added' },
							{ text: 'Date Added',align:'left',class:'text-xs-left', value: 'date_added' },
			        { text: 'Date Modified',align:'left',class:'text-xs-left', value: 'date_added' },
			        { text: 'Action', value: 'order_id',status:'status',class:'text-xs-center',align:'center',sortable:false }
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
				data:[],
				status:[
					{text:'Active',value:1},
                    {text:'Inactive',value:0},
				],
				filter:{},
				breadcrumbTitle:'Return Order',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Return Order',
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
			document.title = 'Order List';
		},
		methods:{
			fetchData(){
				axios.get(this.url).then(response=>{
					this.data=response.data;
				});
			},
			filterOrder(){
				axios.post('/api/filterOrder',this.filter).then(res=>{
					if(res.data.result==true){
						this.customers=res.data.data
					}
				})
			},
			clear(){
				this.$refs.formFilter.reset()
				this.fetchData()
			}
		}
	}
</script>