<template>
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="0"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:select-items="select"
			v-bind:back-url="backUrl"
		></normal-form>
</v-app>
</template>

<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	import normalForm from '../commons/form/normalForm.vue'
	export default{
		components:{
			'normalForm':normalForm
		},
		data(){
			return{
				url:'/api/settings/',
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			    group:[
					{	class:'xs12 sm6 md6', key:'name',type:'text', text:'Group Name',count:100},
					{	class:'xs12 sm6 md6', key:'group_type',	type:'text',text:'Group type',count:100	},
					{	class:'xs12 sm6 md6', key:'permissions', type:'multiple',text:'Permissions',count:100,items:'permissions'}
				],
				rules:{
					name: [
				      (v) => !!v || 'Group Name is required',
				      (v) => v && v.length <= 50 || 'Group Name must be less than 50 characters'
				    ],
				    group_type: [
				      (v) => !!v || 'Group Type is required',
				      (v) => v && v.length <= 50 || 'Group Type must be less than 50 characters'
				    ],
				    permissions: [
				    	() => permissions.length > 0 || 'You must choose at least one'
				    ],
				},
				data:{
					name:'dgdg',
					group_type: 'dgadg',
					permissions: []
				},
				select:{
					stores:[],
					permissions: ['Product Attribute','Product Price']
				},
				breadcrumbTitle:'Settings',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Settings',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/settings/list',
			}
		},
		watch: {
			search (val) {
			  val && this.querySelections(val)
			},
			groupName(){
				if(this.$refs.groupName.validate()){
					if(this.groupName!==""){
						this.isCheckingName=true
						this.errorName=false
						this.validName=false
						this.checkNameMessage='Checking Group Name...'
						axios.get('/api/users_group/checkIfExisted/name/'+this.groupName).then((res)=>{
							if(res.data.Existed==true){
								this.valid=false
								this.errorName=true
								this.isCheckingName=false
								this.validName=false
								this.checkNameMessage='Group Name already exist'
								
							}else if(res.data.Existed==false){
								this.valid=true
								this.isCheckingName=false
								this.errorName=false
								this.validName=true
								
								this.checkNameMessage='Group Name can use'
							}else{
								this.isCheckingName=false
								this.errorName=false
								this.validName=false
							}
						})
					}else if(this.groupName==""){
						this.errorName=false
						this.isCheckingName=false
						this.validName=false
					}
				}else{
					this.valid=true
					this.isCheckingName=false
					this.errorName=false
					this.validName=false
				}
			}
		},
		methods:{
			submit (opt) {
		      	if (this.$refs.formUserGroup.validate()) {
			        // Native form submission is not yet supported
			        axios.post('/api/user_groups', {
			          groupName: this.groupName,
			          groupType: this.groupType,
			          permissions: '{"access":["'+this.permissions.join('","')+'"]}'
			        }).then((res)=>{
			        	if(res.data.success==true){
			        		Flash.setSuccess(res.data.message)
			        		if(opt==1){
			        			this.$refs.formUserGroup.reset()
			        		}
			        		else if(opt==2){
			        			this.$router.push('/admin/users_group/list')
			        		}
			        	}
			        	console.log(res.data)
			        })
		      	}
		    },
		    querySelections (v) {
				this.loading = true
					// Simulated ajax query
					setTimeout(() => {
					this.items = this.states.filter(e => {
					return (e || '').toLowerCase().indexOf((v || '').toLowerCase()) > -1
				})
					this.loading = false
				}, 500)
		    }
		}
	}
</script>