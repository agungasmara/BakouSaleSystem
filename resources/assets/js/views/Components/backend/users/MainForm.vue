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
			return {
				url:'/api/users/',
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			    group:[
					{	class:'xs12 sm6 md6',	 key:'username',	type:'text',	 text:'Username',count:100,	},
					{	class:'xs12 sm6 md6',	 key:'user_group_id',	type:'select',items:'userGroupItems',	 text:'User Group',count:100	},
					{	class:'xs12 sm6 md6',	 key:'firstname',	type:'text',	 text:'First Name',count:100	},
					{	class:'xs12 sm6 md6',	 key:'lastname',	type:'text',	 text:'Last Name',count:100	},
					{	class:'xs12 sm6 md6',	 key:'password',	type:'password',	 text:'Password',count:50	},
					{	class:'xs12 sm6 md6',	 key:'confirmPassword',	type:'password',	 text:'Confirm Password',count:50	},
					{	class:'xs12 sm4 md4',	 key:'email',	type:'text',	 text:'Email',count:50	},
					{	class:'xs12 sm4 md4',	 key:'code',	type:'text',	 text:'Code',count:25	},
					{	class:'xs12 sm4 md4',	 key:'status',	type:'select',items:'statusItems',	 text:'Status',count:100	},
					{	class:'xs12 sm12 md12',	 key:'image',	type:'image',	 Value:'',count:0	}
					
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
				    password: [
				      (v) => !!v || 'Password is required',
				      (v) => v && v.length <= 32 || 'Password must be less than 32 characters'
				    ],
				    confirmPassword: [
				      (v) => !!v || 'Confirm Password is required',
				      (v) => v && v.length <= 32 || 'Confirm Password must be less than 32 characters'
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
					password:'123',
					confirmPassword:'123',
					code: 'dgdag',
					status:0,
					user_group_id:1,
					image:'',
					salt:'test',
					ip:'127',
					date_added:'2018-01-20'
				},
				select:{
					statusItems:[
						{text:'Acitve',value:1},
						{text:'Inactive',value:0}
					],
					userGroupItems:[]
				},
				flash:Flash.state,
				breadcrumbTitle:'Users',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'Users',
			          disabled: false
			        },
			        {
			          text: 'Create',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/users/list',
			}
		},
		created(){
			this.getUserGroup()
		},
		methods:{
			getUserGroup(){
				axios.get('/api/users_group').then((res)=>{
					this.select.userGroupItems=res.data
				})
			}
		}
	}
</script>