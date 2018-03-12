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
				Filter
			</v-card-title>
			<v-divider></v-divider>
			<v-container grid-list-md>
				<v-layout row wrap>
					<v-flex xs12 sm3 md3>
						<v-text-field label="Customer Name"></v-text-field>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-text-field label="Email"></v-text-field>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-select label="Customer Group"></v-select>
					</v-flex>
					<v-flex xs12 sm3 md3>
						<v-select label="Status"></v-select>
					</v-flex>
				</v-layout>
				<v-flex xs12 sm12 md12 class="text-lg-right">
					<v-btn>Filter</v-btn>
				</v-flex>
			</v-container>
			<v-divider></v-divider>
		</v-card>

		<data-table
				v-bind:list-title="listTitle"
				v-bind:data-header="headers"
				v-bind:data-value="attribute"
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
    import dataTable from '../commons/tables/dataTableFilter.vue'
    import breadcrumb1btn from '../commons/breadcrumb/breadcrumb1btn.vue'
    export default{
        props:[
            'id'//this use to pass id of record to data table component
        ],
        data(){
            return{
                url:'/api/customers/',
                btnNewUrl:'/admin/customers/add',
                listTitle:'Customer List',
                headers: [
                    { text: 'Customer ID',align: 'left',class:'text-xs-left',value: 'customer_id'},
                    { text: 'Customer Name',align:'left',class:'text-xs-left', value: 'customer_name' },
                    { text: 'Email',align:'left',class:'text-xs-left', value: 'email' },
                    { text: 'Customer Group',align:'left',class:'text-xs-left', value: 'group' },
                    { text: 'Customer IP',align:'left',class:'text-xs-left', value: 'ip' },
                    { text: 'Date Added',align:'left',class:'text-xs-left', value: 'date_added' },
                    {text: 'Action',align:'center',class:'text-xs-center',value:'customer_id',status:'status',sortable: false}
                ],
                attribute:[],
                breadcrumbTitle:'Customer List',
                breadcrumbs: [
                    {
                        text: 'Administrator',
                        disabled: false
                    },
                    {
                        text: 'Customer',
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
            document.title = 'Customer List';
        },
        methods:{
            fetchData(){
                axios.get(this.url).then(response=>{
                    this.attribute=response.data;
            });
            }
        }
    }
</script>