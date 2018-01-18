<template id="{{ $route.params.id }}">
	<v-app id="inspire">
		<normal-form
			v-bind:url="url"
			v-bind:id="dataID"
			v-bind:breadcrumb-title="breadcrumbTitle"
			v-bind:breadcrumbs="breadcrumbs"
			v-bind:form-items="group"
			v-bind:form-rules="rules"
			v-bind:form-datas="data"
			v-bind:back-url="backUrl"
		></normal-form>
	</v-card>
</v-app>
</template>
	
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
				url:'/api/users/',
				group:[
					{	class:'xs12 sm6 md6',	 key:'username',	type:'text',	 text:'Username',count:100,	},
					{	class:'xs12 sm6 md6',	 key:'user_group_id',	type:'select',items:'userGroupItems',	 text:'User Group',count:100	},
					{	class:'xs12 sm6 md6',	 key:'firstname',	type:'text',	 text:'First Name',count:100	},
					{	class:'xs12 sm6 md6',	 key:'lastname',	type:'text',	 text:'Last Name',count:100	},
					{	class:'xs12 sm4 md4',	 key:'email',	type:'text',	 text:'Email',count:50	},
					{	class:'xs12 sm4 md4',	 key:'code',	type:'text',	 text:'Code',count:25	},
					{	class:'xs12 sm4 md4',	 key:'status',	type:'select',items:'statusItems',	 text:'Status',count:100	}
					
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
					statusItems:[
						{text:'Acitve',value:1},
						{text:'Inactive',value:0}
					],
					user_group_id:1,
					userGroupItems:[]
				},
			    selectStatus:1,
			    status:[
			    	{text:'Active',value:1},
			    	{text:'Inactive',value:2}
			    ],
			    error:false,
		    	message:[],
			    select: null,
			    items: [],
			    selectGroup:null,
			    groups:[],
			    breadcrumbTitle:'Edit User',
				breadcrumbs: [
			        {
			          text: 'Administrator',
			          disabled: false
			        },
			        {
			          text: 'User',
			          disabled: false
			        },
			        {
			          text: 'Edit',
			          disabled: true
			        }
			    ],
			    backUrl:'/admin/users/list',
				flash:Flash.state
			}
		},
		created(){
			this.dataID=this.id
			this.getUserGroup()
			this.fetchUser(this.id)
		},
		methods:{
			getUserGroup(){
				axios.get('/api/users_group').then((res)=>{
					this.data.userGroupItems=res.data
				})
			},
			fetchUser(id){
				axios.get('/api/users/'+id+'/edit').then((res)=>{
					this.selectGroup=res.data.group
					this.username=res.data.username
					this.fname=res.data.firstname
					this.lname=res.data.lastname
					this.email=res.data.email
					this.code=res.data.code
					this.imageUrl=res.data.image
					this.selectStatus=res.data.status
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
		    }
		}
	}
</script>