<template>
	<v-app id="inspire">
		<v-card>
			<!--breadcrumbs start-->
				<breadcrumb3button
				v-bind:breadcrumb-item="breadcrumbs"
				v-bind:breadcrumb-title="breadcrumbTitle"
				v-bind:submit="submit"
				v-bind:is-valid="valid"
				v-bind:back-url="backUrl"
				></breadcrumb3button>
			<!--breadcrumbs end-->
			<v-form v-model="valid" ref="form" lazy-validation>
		    	<v-tabs>
		    		<v-tabs-bar>
			      	<!-- <v-tabs-bar dark color="cyan"> -->
			        	<v-tabs-slider color="green"></v-tabs-slider>
				        <v-tabs-item
				          v-for="i in tapItems"
				          :key="i.name"
				          :href="'#tab-' + i.name"
				        >
				           	{{ i.name }}
				        </v-tabs-item>
			      	</v-tabs-bar>
			      	<v-tabs-items>
			        	<v-tabs-content
				          v-for="i in tapItems"
				          :key="i.name"
				          :id="'tab-' + i.name"
				        >
				          	<v-card flat>
				            	<v-card-text>
				            		<v-container grid-list-md offset-s3>
				              			<v-layout wrap>
				              				<v-flex v-for="input in i.group" :key="input.key" :class="input.class">
				              					<div v-if="input.type=='select'">
													<v-select :label="input.key"  :items="select[input.items]" :rules='formRules[input.key]' required></v-select>
				              					</div>
				              					
				              					<div v-else>
													<v-text-field :label="input.key" :rules='formRules[input.key]'  :counter="10" required></v-text-field>
				              					</div>

											</v-flex>
									    </v-layout>
									</v-container>
				            	</v-card-text>
				          	</v-card>
			        	</v-tabs-content>
			      	</v-tabs-items>
			    </v-tabs>
		    	
		    </v-form>
		</v-card>
	</v-app>
</template>

<script>
	import breadcrumb3button from '../breadcrumb/breadcrumb3button.vue'
	export default{
		props:[
			'tapItems',
			'formRules',
			'breadcrumbs',
			'breadcrumbTitle',
			'backUrl'
		],
		components:
		{
			'breadcrumb3button':breadcrumb3button
		},
		data(){
			return{
				e1:true,
				count:0,
				valid:true,
			}
		},
		methods:{
			submit:function(){
				if(this.$refs.form.validate()){

				}
			}
		}
	}
</script>
