<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<!--<normal-form
			v-bind:url="url"
			v-bind:id="dataID"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="selects"
			v-bind:back-url="backUrl"
		></normal-form>
		</v-card>-->
		<section id="_content">
			<!--breadcrumbs start-->
			<div id="breadcrumbs-wrapper">
				<!-- Search for small screen -->
				<div class="header-search-wrapper grey lighten-2 hide-on-large-only">
					<input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
				</div>
				<div class="row container">
					<div class="container">
					<div class="col s10 m6 l6">
						<h5 class="breadcrumbs-title">Shipments</h5>
						<v-breadcrumbs>
							<v-icon slot="divider">/</v-icon>
							<v-breadcrumbs-item  v-for="item in breadcrumbs" :key="item.text" :disabled="item.disabled">
								{{ item.text }}
							</v-breadcrumbs-item>
						</v-breadcrumbs>
					</div>
					<div class="col s2 m6 l6">
						<router-link to="/admin/carrier/list" replace><v-btn class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right" color="success">Back</v-btn></router-link>
						<router-link to="/admin/shipment/list" replace><v-btn color="primary" class="btn dropdown-settings breadcrumbs-btn right"><i class="material-icons">print</i> &nbsp;Print Shipping</v-btn></router-link>
					</div>
					</div>
				</div>
			</div>
			<!--breadcrumbs end-->
			<div id="basic-form" class="section">
				<div class="row col s12">
					<div class="container">
						<!-- Form with placeholder -->
						<div class="col s12 m12 l12">
							<div class="_card-panel">
								
								<div class="container bootstrap">
									<!-- /start -->
									<div class="row">

											<div class="col s12 m12 l3">
												<div class="row">
													<h4 class="header">Delivery</h4>
													<div>
														Change general information for this product. 
													</div>
												</div>
												<div class="row">
	                    		<h4 class="header">
		                    	<center> Product Image </center>
		                    	</h4>
						              <!-- <form-group
													v-bind:form-items=""
													v-bind:form-rules="rules"
													v-bind:form-datas=""
													v-bind:select-items="select">
													</form-group> -->
					              </div>
											</div>

											<div class="col s12 m12 l9">

													<div class="row">

														<h4 class="header"><i class="material-icons text-left">local_shipping</i> &nbsp; Delivery Information</h4>
														<div class="divider"></div>

														<div class="wrapper_develiery_information">
																<!-- Menu next -->
																<div id="carrier_wizard" class="panel swMain">

																	<ul class="steps nbr_steps_4 anchor">
																		<li class="selected">
																			<a href="javascript:void(0);" @click="onTabAction(1)" class="toggle_1 toggle-class selected" isdone="1" rel="1">
																				<span class="stepNumber">1</span>
																			  <span class="stepDesc">
																					General settings<br>
																				</span>
																				<span class="chevron"></span>
																			</a>
																		</li>
																		<li class="disabled">
																			<a href="javascript:void(0);" @click="onTabAction(2)" class="toggle_2 toggle-class disabled" isdone="0" rel="2">
																				<span class="stepNumber">2</span>
																				<span class="stepDesc">
																					Shipping locations and costs<br>
																											</span>
																				<span class="chevron"></span>
																			</a>
																		</li>
																		<li class="disabled">
																			<a href="javascript:void(0);" @click="onTabAction(3)" class="toggle_3 toggle-class disabled" isdone="0" rel="3">
																				<span class="stepNumber">3</span>
																				<span class="stepDesc">
																					Size, weight, and group access<br>
																											</span>
																				<span class="chevron"></span>
																			</a>
																		</li>
																		<li class="disabled">
																			<a href="javascript:void(0);" @click="onTabAction(4)" class="toggle_4 toggle-class disabled" isdone="0" rel="4">
																				<span class="stepNumber">4</span>
																				<span class="stepDesc">
																					Summary<br>
																											</span>
																				<span class="chevron"></span>
																			</a>
																		</li>
																	</ul>
																	
																</div>
																<!-- End-Menu next -->

																<!--content step-->
																<div class="_stepContainer">

																	<div id="_step-1" class="step_container content">
																			<!--form##################-->
																			<div class="general_setting tab_1 toggle-tab active">
																				<v-container fluid grid-list-md>
																			    <v-layout row wrap>
																			      <v-flex xs12 sm6>
																			        <v-text-field
																			          name="input-1-3"
																			          label="Carriers man"
																			          single-line
																			        ></v-text-field>
																			      </v-flex>
																			      <v-flex xs12 sm6>
																			        <v-text-field
																			          name="input-1-3"
																			          label="Transit time"
																			          single-line
																			        ></v-text-field>
																			      </v-flex>
																			    </v-layout>
																			    <v-layout row wrap>
																			      <v-flex xs12 sm6>
																			        <v-text-field
																			          name="input-1-3"
																			          label="Speed grade"
																			          single-line
																			        ></v-text-field>
																			      </v-flex>
																			      <v-flex xs12 sm6>
																			       	<img :src="imageUrl" height="150" v-if="imageUrl"/>
																							<v-text-field label="Logo" @click='pickFile' v-model='imageName' prepend-icon='attach_file'></v-text-field>
																							<v-subheader>
																								Format: JPG, GIF, PNG. Filesize: 8.00 MB max. Current size: undefined.
																							</v-subheader>
																							<input
																								type="file"
																								style="display: none"
																								ref="image"
																								accept="image/*"
																								@change="onFilePicked"
																							>
																			      </v-flex>

																			    </v-layout>
																			    <v-layout row wrap>
																			      <v-flex xs12 sm6>
																			         <v-text-field
																			          name="input-1-3"
																			          label="Tracking Url"
																			          single-line
																			        ></v-text-field>
																			        <v-subheaser>
																			        	For example: 'http://example.com/track.php?num=@' with '@' where the tracking number should appear.
																			        </v-subheaser>
																			      </v-flex>
																			    </v-layout>
																			  </v-container>
																			</div>

																			<div class="shipping_location tab_2 toggle-tab">
																				<v-container fluid>
																					<v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>
																			        	Add handling costs
																							</v-subheader>
																			      </v-flex>
																			      <v-flex xs2>
																			        <v-radio-group v-model="row" row>
																					      <v-radio label="Yes" value="1"></v-radio>
																					      <v-radio label="No" value="0"></v-radio>
																				    </v-radio-group>
																			      </v-flex>
																			    </v-layout>

																				  <v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>
																			        	Free shipping
																							</v-subheader>
																			      </v-flex>
																			      <v-flex xs2>
																			      	<v-radio-group v-model="row" row>
																					      <v-radio label="Yes" value="1"></v-radio>
																					      <v-radio label="No" value="0"></v-radio>
																				    	</v-radio-group>
																			      </v-flex>
																			    </v-layout>

																			    <v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>Billing</v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			         <v-radio-group v-model="radios" :mandatory="false">
																					      <v-radio label="According to total price." value="radio-1"></v-radio>
																					      <v-radio label="According to total weight." value="radio-2"></v-radio>
																					    </v-radio-group>
																			      </v-flex>
																			    </v-layout>
																			    <v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>Tax</v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			      	<v-select
																				          :items="items"
																				          v-model="e1"
																				          label="No Tax"
																				          single-line
																				      ></v-select>
																			      </v-flex>
																			    </v-layout>
																			    <v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>Out-of-rang behavior</v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			      	<v-select
																				          :items="items"
																				          v-model="e1"
																				          label="Apply the cost of the highest"
																				          single-line
																				        ></v-select>
																			      </v-flex>
																			    </v-layout>
																			    <v-layout row>
																			    	<v-flex xs12>
																			    		<v-subheader><span style="color: red;">Ranges</span><span style="color: red;">*</span></v-subheader>
																			    	</v-flex>
																			    </v-layout>

																			    <!-- <v-layout row>
																			      <v-flex xs4>
																			      	<v-subheader>Will be applied when the weight is	>= <span style="color: red;padding-left: 10px"> kg</span></v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			        <v-text-field
																			          label=""
																			          value="0.000000"
																			          prefix=""
																			        ></v-text-field>
																			      </v-flex>
																			    </v-layout>
																			     -->
																			    <!-- <v-layout row>
																			    	<v-flex xs4>
																			      	<v-subheader>Will be applied when the weight is <
																			      		<span style="color: red;padding-left: 10px"> kg</span></v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			        <v-text-field
																			          label=""
																			          value=""
																			          prefix=""
																			        ></v-text-field>
																			      </v-flex>
																			    </v-layout> -->

																			    <v-layout>
																				  	<table>
																				  		<tr>
																				  			<td class="range_type">
																				  				<v-subheader>Will be applied when the weight is 
																			      			</v-subheader>
																			      		</td>
																			      		<td class="range_sign">
																			      			<span> >= </span>
																			      			<span style="color: red;padding-left: 10px"> 	kg
																			      			</span>
																			      		</td>
																			      		<td class="range_type">
																			      			<v-text-field label="" value="0.000000" prefix="">													
																			        		</v-text-field>
																			      		</td>
																				  		</tr> 

																				  		<tr>
																				  			<td class="range_type">
																				  				<v-subheader>Will be applied when the weight is
																			      			</v-subheader>
																			      		</td>
																			      		<td class="range_sign">
																			      			<span><</span>
																			      			<span style="color: red;padding-left: 10px"> 	kg
																			      			</span>
																			      		</td>
																			      		<td class="range_type">
																			      			<v-text-field label="" value="" prefix="">
																			        		</v-text-field>
																			      		</td>
																				  		</tr>

																				  		<tr>
																				  			<td class="range_type">
																				  				<v-subheader>All
																			      			</v-subheader>
																			      		</td>
																			      		<td class="range_sign">
																			      			<v-checkbox color="light-blue lighten-2" v-model="checked" light></v-checkbox>
																			      		</td>
																			      		<td class="range_type">
																			      			<v-text-field
																						          name="input-1"
																						          label="Label Text"
																						          id="testing"
																						        ></v-text-field>
																			      		</td>
																				  		</tr>

																				  		<tr>
																				  			<td class="range_type">
																				  				<v-subheader>Africa
																			      			</v-subheader>
																			      		</td>
																			      		<td class="range_sign">
																			      			<v-checkbox color="light-blue lighten-2" v-model="checked" light></v-checkbox>
																			      		</td>
																			      		<td class="range_type">
																			      		 <v-text-field
																						          name="input-1"
																						          label="Label Text"
																						          id="testing"
																						        ></v-text-field>
																			      		</td>
																				  		</tr>

																				  	</table>   
																			    </v-layout>

																			    <v-layout row v-for="ingredient in ingredients" :key="ingredient.id">
																			    	 <!-- <v-flex xs6>
										                              <span>{{ingredient.price}} €</span>
										                          </v-flex> -->

														                  <!-- <v-flex xs6>
														                  	 <v-flex xs6>
																					        <v-text-field
																					          label=""
																					          value=""
																					          prefix=""
																					        ></v-text-field>
																					      </v-flex>
																					       <v-flex xs6>
																			        		<v-checkbox color="light-blue lighten-2" v-bind:label="`${ingredient.name}`" v-model="checked" light></v-checkbox>
																			      		</v-flex>
														                  </v-flex> -->

													                </v-layout>

																			    <v-layout row>
																			    	<v-btn>Add new range</v-btn>
																			    </v-layout>

																			  </v-container>
																			</div>

																			<div class="Size_weight_group_acess tab_3 toggle-tab">
																				<v-container fluid grid-list-md>
																					<v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>
																			        	Maximum package width (cm)
																			        </v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			        <v-text-field
																			          name="input-1"
																			          label=""
																			          id="testing"
																			        ></v-text-field>
																			      </v-flex>
																			    </v-layout>
																			    <v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>
																			        	Maximum package height (cm)
																			        </v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			        <v-text-field
																			          name="input-1"
																			          label=""
																			          id="testing"
																			        ></v-text-field>
																			      </v-flex>
																			    </v-layout>
																			     <v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>
																			        	Maximum package depth (cm)
																			        </v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			        <v-text-field
																			          name="input-1"
																			          label=""
																			          id="testing"
																			        ></v-text-field>
																			      </v-flex>
																			    </v-layout>
																			    <v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>
																			        	Maximum package weight (kg)
																			        </v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			        <v-text-field
																			          name="input-1"
																			          label=""
																			          id="testing"
																			        ></v-text-field>
																			      </v-flex>
																			    </v-layout>
																			    <v-layout row>
																			      <v-flex xs4>
																			        <v-subheader>
																			        	Group access
																			        </v-subheader>
																			      </v-flex>
																			      <v-flex xs8>
																			        <table>
																			        	<th>
																			        		<v-checkbox color="light-blue lighten-2" v-model="checked" light></v-checkbox>
																			        	</th>
																			        	<th>ID</th>
																			        	<th>Group name</th>
																			        	<tbody>
																			        		<tr>
																			        			<td>
																			        				<v-checkbox color="light-blue lighten-2" v-model="checked" light></v-checkbox>
																			        			</td>
																			        			<td>1</td>
																			        			<td>Visitor</td>
																			        		</tr>
																			        		<tr>
																			        			<td>
																			        				<v-checkbox color="light-blue lighten-2" v-model="checked" light></v-checkbox>
																			        			</td>
																			        			<td>2</td>
																			        			<td>Guest</td>
																			        		</tr>
																			        		<tr>
																			        			<td>
																			        				<v-checkbox color="light-blue lighten-2" v-model="checked" light></v-checkbox>
																			        			</td>
																			        			<td>3</td>
																			        			<td>Customer</td>
																			        		</tr>
																			        	</tbody>
																			        </table>
																			      </v-flex>
																			    </v-layout>

																			  </v-container>
																			</div>

																			<div class="summary tab_4 toggle-tab">
																				<v-container
																			    fluid
																			    grid-list-sm
																			    tag="section"
																			    id="grid">
																				   <v-layout row wrap>
																				      <v-flex tag="h1" class="headline">
																				      	CARRIER NAME: TEST
																				      </v-flex>
																				      <v-flex d-flex xs12 order-xs5>
																				        <v-layout column>
																				          <v-flex>
																				            <v-card flat>
																				              This carrier is free and the transit time is 12.
																				            </v-card>
																				          </v-flex>

																				          <v-flex>
																				            <v-card flat>
																				              Shipping costs are calculated according to the price and the tax rule No tax will be applied.
																				            </v-card>
																				          </v-flex>
																				          <v-flex>
																				            <v-card flat>
																				              This carrier can deliver orders from [undefined] € to [undefined] €. If the order is out of range, the behavior is to disable carrier.
																				            </v-card>
																				          </v-flex>
																				           <v-flex>
																				            <v-card flat>
																				              This carrier will be proposed for those delivery zones:
																				            </v-card>
																				            <ul class="summary_zones">
																				            	<li><strong>Africa</strong></li>
																				            	<li><strong>Asia</strong></li>
																				            	<li><strong>Central America/Antilla</strong></li>
																				            	<li><strong>Europe</strong></li>
																				            	<li><strong>South America</strong></li>
																				            	<li><strong>Oceania</strong></li>
																				            </ul>
																				          </v-flex>
																				          <v-flex>
																				            <v-card flat>
																				             And it will be proposed for those client groups:
																				            </v-card>
																				            <ul class="summary_zones">
																				            	<li><strong>Visitor</strong></li>
																				            	<li><strong>Guest</strong></li>
																				            	<li><strong>Customer</strong></li>
																				            </ul>
																				          </v-flex>
																				        </v-layout>
																				      </v-flex>
																			    </v-layout>
																			  </v-container>
																			</div>	
																			<!--#End Form##############-->								

																		  <v-layout row>
																		    <v-flex xs6>
																		       <v-btn>Previous</v-btn>
																		       <v-btn v-on:click="nextButton">Next</v-btn>
																		       <v-btn color="success">Finish</v-btn>
																		    </v-flex>   
																		 	</v-layout>  
																	</div>

																</div>																							<!-- end- content step-->					
														</div>

													</div>

											</div>
										</div>
									</div>
									<div class="clearfix"></div>
									<!-- */end  -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</v-app>
</template>

<style>
		.toggle-tab{display: none;}
		.toggle-tab.active{display: block;}
		/*wrapper*/
		.wrapper_develiery_information{
			/*background-color: #fff;*/
		}
    .range_type{
    	width: 116px;
	    text-align: right;
	    font-weight: bold;
    }
    .range_sign{
			width: 30px;
	    font-size: 20px;
	    text-align: right;
    }
    /*Summary*/
    .summary{
    	padding: 20px;
    }
    .summary_zones li{
    	margin-left: 20px;
    }
		.step_container{
			height: auto;
			border: solid 1px #d3d8db;
			background-color: #fff;
			border-radius: 5px;
		}
		.bootstrap #carrier_wizard li a.disabled {
		  color: #777;
		  background-color: #ccc;
		}

		.bootstrap #carrier_wizard li a {
		  color: #ccc;
		  height: 32px;
		  display: block;
		  position: relative;
		  margin: 0 16px 0 0;
		  text-decoration: none;
		  outline-style: none;
		}
		#carrier_wizard {
		  position: relative;
		  padding: 20px;
		  /*margin-bottom: 20px;*/
		  padding-bottom: 50px;
		  /*border: solid 1px #d3d8db;*/
		  /*background-color: #fff;*/
		  -webkit-border-radius: 5px;
		  border-radius: 5px;
		}
		.bootstrap #carrier_wizard {
		  position: relative;
		  display: block;
		width:100%;
		}
		.bootstrap #carrier_wizard li a.selected {
		  color: #F8F8F8;
		  cursor: text;
		  background-color: #363A41;
		}
		.bootstrap #carrier_wizard li a.selected .chevron:after {
		  border-left: 14px solid #363A41;
		}
		.bootstrap #carrier_wizard li a .stepDesc {
		  position: relative;
		  text-align: left;
		  font-size: 13px;
		  height: 32px;
		  display: table-cell;
		  vertical-align: middle;
		  line-height: 13px;
		}
		.bootstrap #carrier_wizard li a .chevron:after {
		      border: 16px solid transparent;
		  border-left: 14px solid #ccc;
		  border-right: 0;
		  position: absolute;
		  content: "";
		  right: -13px;
		  top: 0px;
		}
		.bootstrap #carrier_wizard li a {
		  color: #ccc;
		  height: 32px;
		  display: block;
		  position: relative;
		  margin: 0 16px 0 0;
		  text-decoration: none;
		  outline-style: none;
		}
		.bootstrap .panel, .bootstrap #dash_version, .bootstrap .message-item-initial .message-item-initial-body, .bootstrap .timeline .timeline-item .timeline-caption .timeline-panel {
		  margin-bottom: 17px;
		  background-color: #fff;
		  border: 1px solid transparent;
		  border-radius: 3px;
		  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.05);
		  box-shadow: 0 1px 1px rgba(0,0,0,0.05);
		}
		.bootstrap * {
		  -webkit-box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  box-sizing: border-box;
		}
		.bootstrap #carrier_wizard ul.anchor.nbr_steps_4 li {
		  width: 25%;
		  float: left;
		}

		.bootstrap #carrier_wizard li {
		  position: relative;
		  display: block;
		  overflow: hidden;
		}
		.bootstrap #carrier_wizard ul.anchor {
		  /*position: relative;*/
		  display: block;
		  float: left;
		  list-style: none;
		  padding: 0;
		  margin: 0 0 10px 0;
		  clear: both;
		  width: 100%;
		}
		.bootstrap #carrier_wizard li a .stepNumber {
			position: relative;
			float: left;
			width: 24px;
			height: 32px;
			margin-right: 3px;
			text-align: center;
			padding: 0 5px;
			font-size: 30px;
			line-height: 32px;
			color: #fff;
		}
		.bootstrap * {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		/*.bootstrap #carrier_wizard li a.selected {
			color: #F8F8F8;
			cursor: text;
			background-color: #363A41;
		}
		.bootstrap #carrier_wizard li a.selected {
			color: #F8F8F8;
			cursor: text;
			background-color: #363A41;
		}*/
		.bootstrap #carrier_wizard li a {
			color: #ccc;
			height: 32px;
			display: block;
			position: relative;
			margin: 0 16px 0 0;
			text-decoration: none;
			outline-style: none;
		}
</style>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../commons/form/normalForm.vue'
	export default{
		props:['id'],
		components:{
			'normalForm':normalForm
		},
		data(){
			return {
				dataID:0,
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
				url:'/admin/api/carriers/',
				checked: [],
        checked1: '',
        ingredients: [{
            id: 1,
            name: "All",
            price: 2
        }, {
            id: 2,
            name: "Africa",
            price: 2.0
        }, {
            id: 3,
            name: "Asia",
            price: 2.25
        }, {
            id: 4,
            name: "Central America/Antilla",
            price: 1.6
        }, {
            id: 5,
            name: "Europe",
            price: 2.5
        }, {
            id: 1,
            name: "Europe(non-EU)",
            price: 2.75
        },{
            id: 1,
            name: "North America",
            price: 2.75
        },{
            id: 1,
            name: "Ocenia",
            price: 2.75
        },{
            id: 1,
            name: "South America",
            price: 2.75
        }],
	    	  headers: [
          {
            text: 'Dessert (100g serving)',
            align: 'left',
            sortable: false,
            value: 'name'
          },
          { text: 'Calories', value: 'calories' },
          { text: 'Fat (g)', value: 'fat' },
          { text: 'Carbs (g)', value: 'carbs' },
          { text: 'Protein (g)', value: 'protein' },
          { text: 'Iron (%)', value: 'iron' }
        ],
        items: [
          {
            value: false,
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: '1%'
          },
          {
            value: false,
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%'
          },
          {
            value: false,
            name: 'Eclair',
            calories: 262,
            fat: 16.0,
            carbs: 23,
            protein: 6.0,
            iron: '7%'
          },
          {
            value: false,
            name: 'Cupcake',
            calories: 305,
            fat: 3.7,
            carbs: 67,
            protein: 4.3,
            iron: '8%'
          },
          {
            value: false,
            name: 'Gingerbread',
            calories: 356,
            fat: 16.0,
            carbs: 49,
            protein: 3.9,
            iron: '16%'
          },
          {
            value: false,
            name: 'Jelly bean',
            calories: 375,
            fat: 0.0,
            carbs: 94,
            protein: 0.0,
            iron: '0%'
          },
          {
            value: false,
            name: 'Lollipop',
            calories: 392,
            fat: 0.2,
            carbs: 98,
            protein: 0,
            iron: '2%'
          },
          {
            value: false,
            name: 'Honeycomb',
            calories: 408,
            fat: 3.2,
            carbs: 87,
            protein: 6.5,
            iron: '45%'
          },
          {
            value: false,
            name: 'Donut',
            calories: 452,
            fat: 25.0,
            carbs: 51,
            protein: 4.9,
            iron: '22%'
          },
          {
            value: false,
            name: 'KitKat',
            calories: 518,
            fat: 26.0,
            carbs: 65,
            protein: 7,
            iron: '6%'
          }
        ],
				group:[
					{	class:'xs12 sm6 md6',	 key:'username',	type:'text',	 text:'Username'	},
					{	class:'xs12 sm6 md6',	 key:'user_group_id',	type:'select',items:'userGroupItems',	 text:'User Group'	},
					{	class:'xs12 sm6 md6',	 key:'firstname',	type:'text',	 text:'First Name'	},
					{	class:'xs12 sm6 md6',	 key:'lastname',	type:'text',	 text:'Last Name'	},
					{	class:'xs12 sm4 md4',	 key:'email',	type:'text',	 text:'Email'	},
					{	class:'xs12 sm4 md4',	 key:'code',	type:'text',	 text:'Code'	},
					{	class:'xs12 sm4 md4',	 key:'status',	type:'select',items:'statusItems',	 text:'Status'	},
					{	class:'xs12 sm12 md12',	 key:'image',	type:'image',	 Value:'Photo'	}
					
				],
				rules:{
					username: [
				      (v) => !!v || 'Username is required',
				      (v) => v && v.length <= 16 || 'Username must be less than 16 characters'
				    ],
					firstname: [
				      (v) => !!v || 'First Name is required',
				      (v) => v && v.length <= 10 || 'First Name must be less than 10 characters'
				    ],
				    lastname: [
				      (v) => !!v || 'Last Name is required',
				      (v) => v && v.length <= 10 || 'Last Name must be less than 10 characters'
				    ],
				    email: [
				      (v) => !!v || 'E-mail is required',
				      (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
				    ],
				    code: [
				      (v) => !!v || 'Code is required',
				      (v) => v && v.length <= 8 || 'Code must be less than 8 characters'
				    ]
				},
				data:{
					username:'dgdg',
					firstname: 'dgadg',
					lastname: 'dgdg',
					email:'dgadgad@ddgd.com',
					code: 'dgdag',
					status:0,
					user_group_id:1,
					image:''
				},
				selects:{
					statusItems:[
						{text:'Acitve',value:1},
						{text:'Inactive',value:0}
					],
					userGroupItems:[]
				},
			    error:false,
		    	message:[],
			    select: null,
			    items: [],
			    selectGroup:null,
			    groups:[],
			    breadcrumbTitle:'Edit Carriers',
				breadcrumbs: [
			        {
			          text: 'Home',
			          disabled: false
			        },
			        {
			          text: 'Carriers',
			          disabled: false
			        },
			        {
			          text: 'Edit',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/carrier/list',
				flash:Flash.state
			}
		},
		created(){
			this.dataID=this.id
			this.getUserGroup()
			this.fetchData(this.id)
		},
		computed: {
      checked() {
          return this.checked
      }
  	},
		methods:{
			// onTabAction
			onTabAction(param){
				// active tab
				$(".toggle-class").removeClass('selected');
				$(".toggle-class").addClass('disabled');
				$(".toggle_"+param+"").addClass('selected');
				// list data tab
				$(".toggle-tab").removeClass('active');
				$(".tab_"+param+"").addClass('active');
			},
			//next button is clicked
      nextButton(){
          this.isNextMenu = false
          if(this.currentImg == this.ouvrage.photos.length-1){
              this.currentImg = 0;
          }else{
              this.currentImg += 1;
          }
      },
      //previous button is clicked
      prevImg(){
          this.isNextMenu = true
          if(this.currentImg == 0){
              this.currentImg=this.ouvrage.photos.length-1;
          }else{
              this.currentImg-=1;
          }
      },
			getImage(event){
				console.log('data after child handle: ', event)
			},
			getUserGroup(){
				axios.get('/admin/api/users_group').then((res)=>{
					this.selects.userGroupItems=res.data
				})
			},
			fetchData(id){
				axios.get(this.url+id+'/edit').then((res)=>{
					// this.data.user_group_id=res.data.user_group_id
					// this.data.username=res.data.username
					// this.data.firstname=res.data.firstname
					// this.data.lastname=res.data.lastname
					// this.data.email=res.data.email
					// this.data.code=res.data.code
					// this.data.status=res.data.status
					// this.data.image=res.data.image
					this.data=res.data
				})
			},
			
		    checkPasswordConfirmed(){
	    		if(this.password===this.confirmPassword){
		        	this.error=false
		        }else{
		        	if(this.confirmPassword===""){
		        		this.error=false
		        	}else{
		        		this.error=true
		        	}
		        }
		        return this.error
		    },
		    onPickFile() {
		    	this.btnImageDisabled=true
		    	this.btnText="Uploading..."
		        this.$refs.fileInput.click()
		    },
		    onFilePicked(event){
		    	
		    		
		    	const files=event.target.files
		    	let filename=files[0].name;
		    	if(filename.lastIndexOf('.')<=0){
		    		return alert('Please add a valid file!')
		    	}
		    	const fileReader=new FileReader()
		    	fileReader.addEventListener('load',()=>{
		    		
		    		this.imageUrl=fileReader.result
					this.btnImageDisabled=false
		    		this.btnText="Upload Image"
		    	
		    	})
		    	fileReader.readAsDataURL(files[0])
		    	
		    },
		    clearImage(){
		    	this.imageUrl=''
		    },
			   pickFile () {
	          this.$refs.image.click ()
	       },
			
				onFilePicked (e) {
					const files = e.target.files
					if(files[0] !== undefined) {
						this.imageName = files[0].name
						if(this.imageName.lastIndexOf('.') <= 0) {
							return
						}
						const fr = new FileReader ()
						fr.readAsDataURL(files[0])
						fr.addEventListener('load', () => {
							this.imageUrl = fr.result
							this.imageFile = files[0] // this is an image file that can be sent to server...
						})
					} else {
						this.imageName = ''
						this.imageFile = ''
						this.imageUrl = ''
					}
				}  
		}
	}
</script>