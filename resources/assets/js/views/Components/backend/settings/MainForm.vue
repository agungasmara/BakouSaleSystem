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
					{	class:'xs12 sm6 md6',	 key:'store_id',	type:'select',	 text:'Store',count:100,items:'stores',	},
					{	class:'xs12 sm6 md6',	 key:'code',	type:'text',text:'Code',count:100	},
					{	class:'xs12 sm6 md6',	 key:'key',	type:'text',	 text:'Key',count:100	},
					{	class:'xs12 sm6 md6',	 key:'value',	type:'text',	 text:'key',count:100	}
				],
				rules:{
					code: [
				      (v) => !!v || 'Code is required',
				      (v) => v && v.length <= 50 || 'Code must be less than 50 characters'
				    ],
				    key: [
				      (v) => !!v || 'Key is required',
				      (v) => v && v.length <= 50 || 'Key must be less than 50 characters'
				    ],
				    value: [
				      (v) => !!v || 'Value is required',
				      (v) => v && v.length <= 50 || 'Value must be less than 50 characters'
				    ],
				},
				data:{
					code:'dgdg',
					key: 'dgadg',
					value: 'dgdgddgdfgdgdgd',
					store_id:0
				},
				select:{
					stores:[]
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
		created(){
			this.getStore()
		},
		methods:{
			getStore(){
				axios.get('/api/getStore').then((res)=>{
					this.select.stores=res.data
				})
			}
		}
	}
</script>