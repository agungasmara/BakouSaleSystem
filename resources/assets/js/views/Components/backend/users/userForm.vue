<template>
	<div>
		Hello
	</div>
</template>
	
<script>
	import Flash from '../../../../helper/flash'
	import axios from 'axios'
	export default{
		data(){
			return {
				e1:true,
				valid: true,
				btnImageDisabled:false,
				btnText:'Upload Image',
				imageUrl:'',
				image:null,
			    fname: 'dga',
			    fnameRules: [
			      (v) => !!v || 'First Name is required',
			      (v) => v && v.length <= 10 || 'First Name must be less than 10 characters'
			    ],

			    lname: 'dga',
			    lnameRules: [
			      (v) => !!v || 'Last Name is required',
			      (v) => v && v.length <= 10 || 'Last Name must be less than 10 characters'
			    ],
			    username: '',
			    usernameRules: [
			      (v) => !!v || 'Username is required',
			      (v) => v && v.length <= 16 || 'Username must be less than 16 characters'
			    ],
			    password:'123',
			    passwordRules: [
			      (v) => !!v || 'Password is required',
			      (v) => v && v.length <= 32 || 'Password must be less than 32 characters'
			    ],

			    confirmPassword:'123',
			    confirmPasswordRules: [
			      (v) => !!v || 'Confirm Password is required',
			      (v) => v && v.length <= 32 || 'Confirm Password must be less than 32 characters'
			    ],
			    email:'',
			    emailRules: [
			      (v) => !!v || 'E-mail is required',
			      (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
			    ],
			    code: '',
			    codeRules: [
			      (v) => !!v || 'Code is required',
			      (v) => v && v.length <= 8 || 'Code must be less than 8 characters'
			    ],
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
				flash:Flash.state
			}
		},
		created(){
			this.getUserGroup()
		},
		methods:{
			getUserGroup(){
				axios.get('/api/getUsers').then((res)=>{
					this.items=res.data.users
					this.groups=res.data.groups
				})
			},
			saveUser (opt) {
		      	if (this.$refs.formUser.validate()) {
			      	if(this.checkPasswordConfirmed()===false){
				        // Native form submission is not yet supported
				        axios.post('/api/user/save', {
				          username: this.username,
				          fname: this.fname,
				          lname: this.lname,
				          userGroup: this.selectGroup,
				          email:this.email,
				          userImage:this.imageUrl,
				          password:this.password,
				          code:this.code,
				          status:this.selectStatus
				        }).then((res)=>{
				        	if(res.data.success==true){
				        		Flash.setSuccess(res.data.message)
				        		if(opt==1){                            
				        			this.$refs.formUser.reset()
				        		}
				        		else if(opt==2){
				        			this.$router.push('/admin/settings/list')
				        		}
				        	}
				        	/*console.log(res.data)*/
				        })
				    }
		      	}
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