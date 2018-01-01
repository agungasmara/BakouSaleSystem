<template>
	<div>
		
		<v-app id="inspire">
			<v-card flat>
				
				<div class="flash flash__success" v-if="flash.success">
					<v-alert color="success" icon="check_circle" value="true">
		            	{{flash.success}}
		            </v-alert>
	          	</div>
				<v-tabs v-model="active">
			        <v-tabs-bar class="cyan" dark>
			          	<v-tabs-item v-for="tab in tabs" :key="tab" :href="'#' + tab" ripple>
			            	 {{ tab }}
			          	</v-tabs-item>
			          	<v-tabs-slider color="yellow"></v-tabs-slider>
			        </v-tabs-bar>
			        <v-tabs-items>
			          	<v-tabs-content id="create-user">
							<user-form></user-form>
			        	</v-tabs-content>
			        	<v-tabs-content id='create-user-group''>
		          			<group-form></group-form>
			        	</v-tabs-content>
			        </v-tabs-items>
			    </v-tabs>
			    <div class="text-xs-center mt-3">
			        <v-btn @click.native="next">next tab</v-btn>
			    </div>
			</v-card>
		</v-app>
	</div>
</template>
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import userForm from './userForm.vue'
	import groupForm from './groupForm.vue'
	export default{
		components:{
			'user-form':userForm,
			'group-form':groupForm
		},
		data(){
			return{
				tabs: ['create-user','create-user-group', 'assign-user-group'],
      			active: null,
			    breadcrumbs: [
			        {
			          text: 'Adminstrator',
			          disabled: false
			        },
			        {
			          text: 'User',
			          disabled: true
			        }
		      	],
				flash:Flash.state
			}
		},
		methods:{
		    next () {
			    this.active = this.tabs[(this.tabs.indexOf(this.active) + 1) % this.tabs.length]
			}
		}
	}
</script>