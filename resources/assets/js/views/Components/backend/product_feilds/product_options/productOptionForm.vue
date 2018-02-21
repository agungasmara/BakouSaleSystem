<template>
	<div>
				<v-flex xs12 sm12 md12>
					<v-select :label="'Option'" id="optSelect" autocomplete :search-input.sync="search" v-model="opt" :items="options" item-value="value" item-text="text"></v-select>
		            <div class="chip-box" v-for="(optItem,index) in formDatas" :key="index" :class="{'current':show==index}" @click="getChildOption(optItem.product_option_id)">
			            <span @click="show = index">
			            	{{optItem.text.toUpperCase()}}
			                
			            </span>
			            <v-icon color="red" dark right @click="removeOpt(index)" style="cursor: pointer;">remove_circle</v-icon>
					</div>
				</v-flex>
				<v-flex xs12 sm12 md12 l12>
					<div v-for="(optItem,index) in formDatas" :key="index">
					
		          	<div v-if="show==index">
		          		<v-layout row wrap>
			          		<v-flex xs12 sm6 md6 l6>
			          			<v-select :label="'Required'" v-model="optItem.required" :items="selectItem"></v-select>
			          		</v-flex>

			          		<div v-if="optItem.text=='checkbox' || optItem.text=='radio' || optItem.text=='select'">
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
				          								<v-select :label="'select'" v-model="checkItm.option_value_id" :items="checkItem"></v-select>
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
		          			<v-flex v-if="optItem.text=='date'" xs12 sm6 md6 l6>
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
						          <v-date-picker v-model="optItem.value"  no-title scrollable actionsv :date-format="date=>new Date(date).toTimeSting()" :formatted-value.sync="optItem.value">
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
						    <v-flex v-if="optItem.text=='time'" xs12 sm6 md6 l6>
						    	<v-menu
						          ref="menuTime"
						          lazy
						          :close-on-content-click="false"
						          v-model="menu2"
						          transition="scale-transition"
						          offset-y
						          full-width
						          :nudge-right="40"
						          max-width="290px"
						          min-width="290px"
						          :return-value.sync="optItem.value"
						        >
						          <v-text-field
						            slot="activator"
						            label="Picker in menuTime"
						            v-model="optItem.value"
						            prepend-icon="access_time"
						            readonly
						          ></v-text-field>
						          <v-time-picker v-model="optItem.value" @change="$refs.menuTime.save(time)"></v-time-picker>
						        </v-menu>
						    </v-flex>
		          			<v-flex v-if="optItem.text=='text'" xs12 sm6 md6 l6>
		          				<v-text-field label="Option Value" v-model="optItem.value" />
		          			</v-flex>
		          			<v-flex v-if="optItem.text=='textarea'" xs12 sm12 md12 l12>
		          				<v-text-field label="Option Value" v-model="optItem.value" textarea />
		          			</v-flex>
		          		</v-layout>
		          	</div>
		          </div>
				</v-flex>
	</div>
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
		props:['formDatas'],
		data(){
			return {
				search:null,//for option search
				time: null,//time Picker
				date: null,//date picker
    			menu: false,//menu of date picker
    			menu2:false,//menu of time picker
				options:[],//for option to select as product option
				product_option_id:0,
				opt:'text',
				// formDatas:[],
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
			this.show=this.formDatas[0]
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
						vm.formDatas.push(itemArr)
						vm.getChildOption(vm.opt)
						vm.formDatas.forEach(function(v,i){
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
			getChildOption:function(optID){
				axios.get('/api/getChildOption/'+optID).then(res=>{
					this.checkItem=res.data
				})
			},
			showOpt:function(str){
				alert(str)
			},
			addOption:function(index){
				var vm=this
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
				this.formDatas[index].checkItem.push(optionArr)
				
				vm.getChildOption(vm.opt)
				vm.show=index
			},
			removeOpt:function(index){
				var vm=this
				this.formDatas.splice(index,1)
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
	.chip-box{
		display: inline-block;
		width: auto;
		padding: 3px 3px 3px 3px;
		border-radius: 2px;
		top: 10px !important;
		margin-bottom: 2px !important;
		margin-right: 3px !important;
		border: solid 1px #42c0ff;
		cursor: pointer;
	}
</style>