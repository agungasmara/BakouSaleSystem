<template>
	<v-app id="inspire">
		<v-container grid-list-md>
			<v-layout row wrap>
				<v-flex xs12 sm3 md3>
					<v-list subheader>
		            
		            <v-list-tile avatar v-for="(optItem,index) in optArr" :key="index" :class="{'current':show==index}">
		              <v-list-tile-action>
		                <v-icon color="blue" dark left @click="removeOpt(index)">remove_circle</v-icon>
		              </v-list-tile-action>
		              <v-list-tile-content  @click="show = index" >
		                	<v-list-tile-title v-html="optItem.text"></v-list-tile-title>
		              </v-list-tile-content>
		            </v-list-tile>
		          </v-list>
					<v-select :label="'Option'" id="optSelect" autocomplete :search-input.sync="search" v-model="opt" :items="options" item-value="value" item-text="text"></v-select>
				</v-flex>
				<v-flex xs12 sm9 md9 l9>
					<div v-for="(optItem,index) in optArr" :key="index">
					
		          	<div v-if="show==index">
		          		<v-flex xs12 sm 6 md6 l6>
		          			<v-select :label="'Required'" v-model="optItem.required" :items="selectItem"></v-select>
		          		</v-flex>
		          		<div v-if="optItem.text=='checkbox'">
		          			<table class="chk-tbl">
		          				<thead>
		          					<tr>
		          						<th><small>Option Value</small></th>
		          						<th><small>Quantity</small></th>
		          						<th><small>Substract Stock</small></th>
		          						<th><small>Price</small></th>
		          						<th><small>Point</small></th>
		          						<th><small>Weight</small></th>
		          						<th><small>Action</small></th>
		          					</tr>
		          				</thead>
		          				<tbody>
			          					<tr v-for="(checkItm,index) in optItem.checkItem" style="border-bottom: solid 1px #ccc;" :class="{'chk-row':index%2==0}">
			          						<td align="center">
			          							<v-flex xs12 sm12 md12>
			          								<v-select :label="'Check'" v-model="checkItm.option_value_id" :items="checkItem"></v-select>
			          							</v-flex>
			          						</td>
			          						<td align="center">
			          							<v-flex xs12 sm8 md8>
			          							
				          							<v-text-field type="number" v-model="checkItm.quantity"></v-text-field>
				          						</v-flex>
				          						
			          						</td>
			          						<td align="center">
			          							<v-flex xs12 sm12 md12>
			          								<v-select v-model="checkItm.substract" :items="selectItem"></v-select>
			          							</v-flex>
			          						</td>
			          						<td align="center">
			          							<v-flex xs12 sm8 md8>
			          								<v-select sm1 md1 v-model="checkItm.price_prefix" :items="signSelect"></v-select>
			          							
			          							
			          								<v-text-field sm1 md1 type="number" v-model="checkItm.price"></v-text-field>
			          							</v-flex>
			          							
			          						</td>
			          						<td align="center">
			          							<v-flex xs12 sm8 md8>
			          								<v-select v-model="checkItm.points_prefix" :items="signSelect"></v-select>
			          							
			          							
			          								<v-text-field type="number" v-model="checkItm.points"></v-text-field>
			          							</v-flex>
			          							
			          						</td>
			          						<td align="center">
			          							<v-flex xs12 sm8 md8>
			          								<v-select v-model="checkItm.weight_prefix" :items="signSelect"></v-select>
			          							
			          							
			          								<v-text-field type="number" v-model="checkItm.weight"></v-text-field>
			          							</v-flex>
			          						</td>
			          						<td align="center">
			          							<span @click="optItem.checkItem.splice(index,1)" style="cursor: pointer;"> 
													<v-icon large material-icons color="red darken">indeterminate_check_box</v-icon>
										     	</span>
			          						</td>
			          					</tr>
		          					<tr >
										<td colspan="6"></td>
										<td align="center">
											<span @click="addOption(show)" style="cursor: pointer;">
									     		<v-icon large material-icons color="blue darken">add_box</v-icon>
									     	</span>
										</td>
									</tr>
		          				</tbody>
		          			</table>
		          		</div>
		          		<div v-if="optItem.text=='date'">
		          			<v-flex xs12 sm6 md6 l6>
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
						            label="Picker in menu"
						            v-model="optItem.value"
						            prepend-icon="event"
						            readonly
						          ></v-text-field>
						          <v-date-picker v-model="optItem.value"  no-title scrollable actions>
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
		          		</div>
		          	</div>
		          </div>
				</v-flex>
			</v-layout>
		</v-container>
	</v-app>
</template>
<script type="text/javascript">
	//import Vue from 'vue'
	import axios from 'axios'
	// Vue.directive('el',{
	// 	bind(el,binding,vnode){
	// 		el.style.color="#000000"
	// 	}
	// })
	export default{

		data(){
			return {
				search:null,//for option search
				date: null,//date picker
    			menu: false,//menu of date picker
				options:[],//for option to select as product option
				product_option_id:0,
				opt:'text',
				optArr:[],
				show:'',
				control:'',
				selectItem:[
					{value:1,text:'Yes'},
					{value:0,text:'No'}
				],
				signSelect:[
					'-','+'
				],
				checkItem:[],
				ckId:0
			}
		},
		created(){
			this.getOptions()
			this.getCheckbox(0)
			this.show=this.optArr[0]
		},
		watch:{
			opt:function(text){
				var vm=this
				this.options.forEach(function(v,i){
					if(v.value==vm.opt){
						var itemArr={
							text:v.text,
							product_option_id:v.value,
							required:1,
							value:null,
							checkItem:[]
						}
						vm.optArr.push(itemArr)
						vm.optArr.forEach(function(v,i){
							vm.show=i
						})	
					}
				})
			}
		},
		methods:{
			getOptions:function(){
				axios.get('/api/getOptions').then(res=>{
					this.options=res.data
				})
			},
			getCheckbox:function(){
				axios.get('/api/getCheckbox').then(res=>{
					this.checkItem=res.data
				})
			},
			showOpt:function(str){
				alert(str)
			},
			addOption:function(index){
				var optionArr={
					option_value_id:0,
					quantity:0,
					substract:1,
					price_prefix:null,
					price:0,
					points_prefix:null,
					points:0,
					weight_prefix:null,
					weight:0
				}
				this.optArr[index].checkItem.push(optionArr)
			},
			removeOpt:function(index){
				var vm=this
				this.optArr.splice(index,1)
				vm.show=index-1
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
		padding: 0 3px !important;
	}
	table.chk-tbl tr.chk-row td{
		background-color: #edeff2;
	}
	table.chk-tbl tr td{
		padding: 0px !important;
	}
	table.chk-tbl tr td{
		border: solid 1px #d9dbdd;
	}
</style>