<template>
	<div>
		<v-app id="inspire">
			<v-breadcrumbs>
		        <v-icon slot="divider">chevron_right</v-icon>

	        	<v-breadcrumbs-item v-for="item in items" :key="item.text" :disabled="item.disabled">

	          		{{ item.text }}

	        	</v-breadcrumbs-item>
		    </v-breadcrumbs>

			<v-card>
			  
		      <v-card-title>
		        <v-spacer>
		        	<div>
		                <router-link to="create" replace><v-btn color="primary">Create New</v-btn></router-link>
		            </div>
		        </v-spacer>
		        <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
		      </v-card-title>
			    <v-data-table v-bind:headers="headers" :items="settings" v-bind:search="search" class="elevation-1" >
					<template slot="items" slot-scope="props">
						<td class="text-xs-center">{{ props.item.setting_id }}</td>
						<td class="text-xs-left">{{ props.item.name }}</td>
						<td class="text-xs-left">{{ props.item.code }}</td>
						<td class="text-xs-left">{{ props.item.key }}</td>
						<td class="text-xs-left">{{ props.item.value }}</td>
						<td class="text-xs-left">{{ props.item.serialized }}</td>
						<td class="text-xs-center">
							<!--<a href="#" v-on:click="confirmDel(props.item.id,props.item.name)"><i class="fa fa-trash-o"></i></a>-->
						</td>
					</template>
					<template slot="pageText" slot-scope="{ pageStart, pageStop }">
			          From {{ pageStart }} to {{ pageStop }}
			        </template>
			    </v-data-table>
		    </v-card>
		</v-app>
	</div>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	export default{
		data(){
			return{
				max25chars: (v) => v.length <= 25 || 'Input too long!',
				tmp: '',
				search: '',
				pagination: {},
				headers: [
			        { text: 'Setting ID',align: 'left',value: 'setting_id'},
			        { text: 'Store Name',align:'center', value: 'name' },
			        { text: 'code',align:'center', value: 'code' },
			        { text: 'Key',align:'center', value: 'key' },
			        { text: 'Value',align:'center', value: 'value' },
			        { text: 'Serialized',align:'center', value: 'serialized' },
			        { text: 'Action', value: 'action',align:'center',sortable:false }
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
		created(){
			this.fetchSettings()
			document.title = 'Setting List';
		},
		methods:{
			fetchSettings(){
				axios.get('/api/setting/list').then(response=>{
					this.settings=response.data;
				});
			},
		}
	}
</script>