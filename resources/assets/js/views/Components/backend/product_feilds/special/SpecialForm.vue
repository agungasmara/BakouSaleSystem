<template>
	<div>
		<table class="chk-tbl">
			<thead>
				<tr>
					<th>Customer Group</th>
					<th style="width: 80px;">Priority</th>
					<th style="width: 50px;">Price</th>
					<th>Date Start</th>
					<th>Date End</th>
					<th style="width: 50px;">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr v-if="formDatas.length>0" v-for="(dis,index) in formDatas">
					<td align="center">
						<v-flex xs12 sm10 md10>
							<v-select :label="'Customer Group'"  :rules="rules" v-model="dis.customer_group_id" :items="customerGroup" required></v-select>
						</v-flex>
					</td>
					<td align="center">
						<v-flex xs12 sm10 md10>
							<v-text-field :label="'Priority'" :rules="[(v) => !!v || 'Priority is required']" v-model="dis.priority"></v-text-field>
						</v-flex>
					</td>
					<td align="center">
						<v-flex xs12 sm10 md10>
							<v-text-field :label="'Price'" :rules="[(v) => !!v || 'Price is required']" v-model="dis.price"></v-text-field>
						</v-flex>
					</td>
					<td align="center">
						<v-flex xs12 sm11 md11>
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
						            label="Date Start"
						            v-model="dis.date_start"
						            prepend-icon="event"
						            readonly
						          ></v-text-field>
						          <v-date-picker v-model="dis.date_start"  no-title scrollable actionsv :date-format="date=>new Date(date).toTimeSting()" :formatted-value.sync="dis.date_start">
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
					</td>
					<td align="center">
						<v-flex xs12 sm11 md11>
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
						            label="Date End"
						            v-model="dis.date_end"
						            prepend-icon="event"
						            readonly
						          ></v-text-field>
						          <v-date-picker v-model="dis.date_end"  no-title scrollable actionsv :date-format="date=>new Date(date).toTimeSting()" :formatted-value.sync="dis.date_end">
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
					</td>
					<td align="center" style="width: 50px;">
						<span @click="formDatas.splice(index,1)" :disabled="!isValid" style="cursor: pointer;"> 
							<v-icon large material-icons color="red darken">indeterminate_check_box</v-icon>
				     	</span>
			     	</td>
				</tr>
				<tr >
					<td colspan="5" ></td>
					<td align="center">
						<span @click="addAttribute" :disabled="!isValid" style="cursor: pointer;">
				     		<v-icon large material-icons color="blue darken">add_box</v-icon>
				     	</span>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>
<script>
	import axios from 'axios'
	export default{
		props:['formDatas'],
		data(){
			return{
				menu: false,//menu of date_start picker
    			menu2:false,//menu of time_end picker
				isValid:true,
				attruibuteID:0,
				customerGroup:[],
				languages:[],
				rules:[(v) => !!v || 'Group Name is required']
			}
		},
		created(){
			this.getCustomerGroup()
			this.getLanguage()
		},
		methods:{
			getCustomerGroup(){
				axios.get('/api/getCustomerGroup').then((res)=>{
					this.customerGroup=res.data
				})
			},
			getLanguage(){
				axios.get('/api/getLanguage').then((res)=>{
					this.languages=res.data
				})
			},
			addAttribute(){
				var attrArr={
					customer_group_id:1,
					priority:'',
					price:'',
					date_start:'',
					date_end:'',
					language_id:1

				}
				this.formDatas.push(attrArr)
			}
		}
	}
</script>

<style type="text/css">
	.current{
		background-color: #b3d4fc;
	}
	table.chk-tbl{
		background-color: #FFFFFF !important;
		border-radius:2px;
		border-collapse:collapse;
		border-spacing:0;
		table-layout:fixed;
		width: 100%;
		max-width: 100%;
	}
	table.chk-tbl tr th{
		border: solid 1px #d9dbdd;
		text-align: center;
	}
	table.chk-tbl tr.chk-row td{
		background-color: #edeff2;
	}
	table.chk-tbl tr td{
		border: solid 1px #d9dbdd;
	}
</style>