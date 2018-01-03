<template>
	<v-form v-model="valid" ref="formUserGroup" lazy-validation>
    	<v-container grid-list-md>
  			<v-layout wrap>

		    	<v-flex xs12 sm4 md4>
		      		<v-text-field label="Group Name" v-model="groupName" :rules="groupNameRules" :counter="16" required></v-text-field>
		      	</v-flex>
		      	<v-flex xs12 sm4 md4>
		      		<v-text-field label="Group Type" v-model="groupType" :rules="groupTypeRules" :counter="3" required></v-text-field>
		      	</v-flex>
		      	<v-flex xs12 sm8 md8>
		      		<v-select label="Select" v-bind:items="states" v-model="permissions" multiple chips color="green" hint="What are the target regions" persistent-hint ></v-select>
		      	</v-flex>
		      	<v-flex xs12 sm12 md12>
			      	<v-btn @click="saveUserGroup(1)" :disabled="!valid">
				        Save & New
				    </v-btn>
				    <v-btn @click="saveUserGroup(2)" :disabled="!valid">
				        Save & Close
				    </v-btn>
				    <router-link to="/admin/users_group/list">
					    <v-btn>
					        Cancele
					    </v-btn>
				    </router-link>
				</v-flex>
		    </v-layout>
		</v-container>
    </v-form>
</template>

<script>
	export default{
		data(){
			return{
				valid:true,
				groupType: '',
			    groupTypeRules: [
			      (v) => !!v || 'Group Type is required',
			      (v) => v && v.length <= 3 || 'Group Type must be less than 3 characters'
			    ],
			    permissions: [],
      			states: ['Product Attribute','Product Price'],
			    groupName: '',
			    groupNameRules: [
			      (v) => !!v || 'Group Name is required',
			      (v) => v && v.length <= 16 || 'Group Name must be less than 16 characters'
			    ],
			}
		},
		methods:{
			saveUserGroup (opt) {
		      	if (this.$refs.formUserGroup.validate()) {
			        // Native form submission is not yet supported
			        /*axios.post('/api/setting/save', {
			          store: this.select,
			          code: this.code,
			          key: this.key,
			          value: this.value
			        }).then((res)=>{
			        	if(res.data.success==true){
			        		Flash.setSuccess(res.data.message)
			        		if(opt==1){
			        			this.select=""
						        this.code=""
						        this.key=""
						        this.value=""
			        		}
			        		else if(opt==2){
			        			this.$router.push('/admin/settings/list')
			        		}
			        	}
			        })*/
			        alert(1)
		      	}
		    }
		}
	}
</script>